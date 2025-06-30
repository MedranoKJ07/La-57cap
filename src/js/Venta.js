document.addEventListener("DOMContentLoaded", () => {
  const inputCodigo = document.getElementById("codigoProducto");

  const tabla = document
    .getElementById("tablaProductos")
    .querySelector("tbody");
  const subtotalSpan = document.getElementById("subtotalVenta");
  const ivaSpan = document.getElementById("ivaVenta");
  const totalSpan = document.getElementById("totalVenta");

  const entregaDomicilio = document.getElementById("entregaDomicilio");

  const bloqueEntregaAdicional = document.getElementById(
    "bloqueEntregaAdicional"
  );

  const direccionInput = document.getElementById("direccion");
  const fechaEntregaInput = document.getElementById("fechaEntrega");
  const horaEntregaInput = document.getElementById("horaEntrega");

  const form = document.getElementById("formVenta");

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
    bloqueEntregaAdicional.style.display = entregaDomicilio.checked
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

      if (!data.disponible_para_venta) {
        alert(
          "Este producto no está disponible para la venta. El stock mínimo se alcanzó."
        );
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
          foto: data.Foto || "default.png",
          stock_disponible: data.stock_disponible,
        });
      }

      renderizarTabla();
    } catch (error) {
      console.error("Error al consultar producto:", error);
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
    <td>
        ${p.codigo}
        <input type="hidden" name="productos[${index}][id]" value="${p.id}">
        <input type="hidden" name="productos[${index}][codigo]" value="${
        p.codigo
      }">
    </td>
    <td>
        <img src="/img/productos/${
          p.foto
        }" width="40" height="40" class="rounded-circle" alt="Producto">
    </td>
    <td>
        ${p.nombre}
        <input type="hidden" name="productos[${index}][nombre]" value="${
        p.nombre
      }">
    </td>
    <td>
        C$ ${p.precio.toFixed(2)}
        <input type="hidden" name="productos[${index}][precio]" value="${
        p.precio
      }">
    </td>
    <td>
        <input type="number"
               name="productos[${index}][cantidad]"
               min="1"
               max="${p.stock_disponible}"
               value="${p.cantidad}"
               class="form-control form-control-sm cantidad"
               data-index="${index}">
    </td>
    <td>C$ ${subtotalProducto.toFixed(2)}</td>
    <td>
        <button type="button" class="btn btn-danger btn-sm eliminar" data-index="${index}">X</button>
    </td>
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

  form.addEventListener("submit", (e) => {
    if (productos.length === 0) {
      e.preventDefault();
      alert("Debes agregar al menos un producto.");
    }

    // Validación extra si se requiere entrega
    if (entregaDomicilio.checked) {
      if (
        !direccionInput.value ||
        !fechaEntregaInput.value ||
        !horaEntregaInput.value
      ) {
        e.preventDefault();
        alert("Completa todos los campos de entrega.");
      }
    }
  });
  const checkbox = document.getElementById("clientenoTieneRegistro");

  // Al cargar la página, ocultar si está chequeado
  if (checkbox.checked) {
    buscarDiv.style.display = "none";
  }

  const buscarBtn = document.getElementById("buscarClienteBtn");
  const sinRegistroCheckbox = document.getElementById("clientenoTieneRegistro");

  const inputCliente = document.getElementById("idCliente");
  const buscarDiv = document.getElementById("buscar"); // contenedor del botón Buscar
  const datosClienteDiv = document.getElementById("datosCliente"); // contenedor de los datos

  const idClienteInput = document.getElementById("id_cliente_registrado");
  const nombreClienteInput = document.getElementById("nombre_cliente_mostrado");
  const telefonoClienteInput = document.getElementById(
    "telefono_cliente_mostrado"
  );
  const direccionClienteInput = document.getElementById(
    "direccion_cliente_mostrado"
  );

  // Evento para el checkbox de "Cliente sin registro"        
  sinRegistroCheckbox.addEventListener("change", function () {
    if (this.checked) {
      buscarDiv.style.display = "none";
      datosClienteDiv.style.display = "none";
      inputCliente.value = "";
      inputCliente.placeholder = "Ingrese el nombre del cliente";
      inputCliente.disabled = false;
      limpiarDatosCliente();
    } else {
      inputCliente.value = "";
      inputCliente.placeholder = "Buscar por nombre del cliente";
      inputCliente.disabled = false;
      datosClienteDiv.style.display = "block";
      buscarDiv.style.display = "block";
    }
  });

  buscarBtn.addEventListener("click", async () => {
    if (sinRegistroCheckbox.checked) {
      limpiarDatosCliente();
      return;
    }

    const nombre = inputCliente.value.trim();
    if (nombre === "") return;

    const cliente = await buscarCliente(nombre);

    if (cliente) {
      idClienteInput.value = cliente.idcliente;
      nombreClienteInput.value = cliente.nombre_completo;
      telefonoClienteInput.value = cliente.telefono;
      direccionClienteInput.value = cliente.direccion;
    } else {
      limpiarDatosCliente();
      alert("Cliente no encontrado.");
    }
  });

  async function buscarCliente(nombre) {
    try {
      const res = await fetch(
        `/api/cliente?nombre=${encodeURIComponent(nombre)}`
      );
      const data = await res.json();
      return res.ok ? data : null;
    } catch (error) {
      console.error("Error al buscar cliente:", error);
      return null;
    }
  }

  function limpiarDatosCliente() {
    idClienteInput.value = "";
    nombreClienteInput.value = "";
    telefonoClienteInput.value = "";
    direccionClienteInput.value = "";
  }
});
