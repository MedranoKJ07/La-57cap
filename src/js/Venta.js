document.addEventListener("DOMContentLoaded", () => {
  const inputCodigo = document.getElementById("codigoProducto");
  const tabla = document
    .getElementById("tablaProductos")
    .querySelector("tbody");
  const subtotalSpan = document.getElementById("subtotalVenta");
  const ivaSpan = document.getElementById("ivaVenta");
  const totalSpan = document.getElementById("totalVenta");
  const entregaDomicilio = document.getElementById("entregaDomicilio");
  const formularioEntrega = document.getElementById("formularioEntrega");

  let productos = [];

  inputCodigo.addEventListener("keydown", async (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      const codigo = inputCodigo.value.trim();
      if (codigo !== "") {
        await agregarProducto(codigo);
        inputCodigo.value = "";
      }
    }
  });

  entregaDomicilio.addEventListener("change", () => {
    formularioEntrega.style.display = entregaDomicilio.checked
      ? "block"
      : "none";
  });

  async function agregarProducto(codigo) {
    try {
      const res = await fetch(
        `/api/producto?codigo=${encodeURIComponent(codigo)}`
      );
      const data = await res.json();

      if (!res.ok || !data || !data.idproducto) {
        alert("Producto no encontrado");
        return;
      }

      const productoExistente = productos.find(
        (p) => p.codigo === data.codigo_producto
      );
      if (productoExistente) {
        productoExistente.cantidad++;
      } else {
        productos.push({
          id: data.idproducto,
          codigo: data.codigo_producto,
          nombre: data.nombre_producto,
          precio: parseFloat(data.precio),
          cantidad: 1,
          Foto: data.Foto || "default.png", 
        });
      }

      renderizarTabla();
    } catch (error) {
      console.error(error);
      alert("Error al consultar el producto");
    }
  }

  function renderizarTabla() {
    tabla.innerHTML = "";
    let subtotal = 0;

    productos.forEach((p, index) => {
      const subtotalProducto = p.precio * p.cantidad;
      subtotal += subtotalProducto;
        
      const fila = document.createElement("tr");
      fila.innerHTML = `
                <td>${p.codigo}</td>
                <td><img src="/img/productos/${p.Foto}" width="40" height="40"
                                         class="rounded-circle" alt="Imagen producto"></td>
                <td>${p.nombre}</td>
                <td>C$ ${p.precio.toFixed(2)}</td>
                <td>
                    <input type="number" min="1" value="${
                      p.cantidad
                    }" class="form-control form-control-sm cantidad" data-index="${index}">
                </td>
                <td>C$ ${subtotalProducto.toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm eliminar" data-index="${index}">X</button></td>
            `;
      tabla.appendChild(fila);
    });

    const iva = subtotal * 0.15;
    const total = subtotal + iva;

    subtotalSpan.textContent = subtotal.toFixed(2);
    ivaSpan.textContent = iva.toFixed(2);
    totalSpan.textContent = total.toFixed(2);

    registrarEventos();
  }

  function registrarEventos() {
    document.querySelectorAll(".cantidad").forEach((input) => {
      input.addEventListener("change", (e) => {
        const index = e.target.dataset.index;
        const nuevaCantidad = parseInt(e.target.value);
        if (nuevaCantidad > 0) {
          productos[index].cantidad = nuevaCantidad;
          renderizarTabla();
        }
      });
    });

    document.querySelectorAll(".eliminar").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const index = e.target.dataset.index;
        productos.splice(index, 1);
        renderizarTabla();
      });
    });
  }

});
