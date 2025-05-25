<div class="card">
    <div class="container py-4">
        <div class="card-header">
            <h2 class="mb-4">Realizar Venta</h2>
        </div>

        <div class="card-body">
            <!-- Input para escanear código -->
            <div class="mb-3">
                <label for="codigoProducto" class="form-label">Escanear o ingresar código de producto:</label>
                <input type="text" class="form-control" id="codigoProducto" placeholder="Escanea o escribe el código"
                    autofocus>
            </div>

            <!-- Tabla de productos agregados -->
            <div class="table-responsive mb-3">
                <table class="table table-bordered align-middle text-center" id="tablaProductos">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Imagen</th> 
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Productos serán agregados aquí por JS -->
                    </tbody>
                </table>
            </div>

            <!-- Totales -->
            <div class="mb-3 text-end">
                <p>Subtotal: C$ <span id="subtotalVenta">0.00</span></p>
                <p>IVA (15%): C$ <span id="ivaVenta">0.00</span></p>
                <h5>Total: C$ <span id="totalVenta">0.00</span></h5>
            </div>


            <!-- Checkbox: Entrega a domicilio -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="entregaDomicilio">
                <label class="form-check-label" for="entregaDomicilio">¿Entregar a domicilio?</label>
            </div>

            <!-- Dirección de entrega -->
            <div id="formularioEntrega" class="mb-3" style="display: none;">
                <label for="direccion" class="form-label">Dirección de entrega:</label>
                <input type="text" class="form-control" id="direccion" placeholder="Dirección del cliente">
            </div>

            <!-- Botón para finalizar venta -->
            <div class="text-end">
                <button class="btn btn-success" id="finalizarVenta">Finalizar Venta</button>

            </div>
        </div>

    </div>
</div>


<!-- Script JS inicial -->
<script src="/build/js/venta.js"></script>