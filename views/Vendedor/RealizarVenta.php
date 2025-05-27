<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">🧾 Realizar Venta</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="/vendedor/realizar-venta" id="formVenta">

            <!-- Cliente -->
            <div class="mb-3">
                <label for="idCliente" class="form-label fw-semibold">Nombre del Cliente:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="idCliente" name="nombre_cliente"
                        placeholder="Buscar por nombre del cliente">
                    <div id="buscar">
                        <button type="button" class="btn btn-outline-secondary" id="buscarClienteBtn">Buscar</button>
                    </div>
                </div>

                <!-- Resultado de búsqueda -->
                <div id="datosCliente" class="mt-2">
                    <input type="hidden" id="id_cliente_registrado" name="id_cliente_registrado">
                    <input type="text" class="form-control mt-1" id="nombre_cliente_mostrado"
                        placeholder="Nombre Cliente" readonly>
                    <input type="text" class="form-control mt-1" id="telefono_cliente_mostrado" placeholder="Teléfono"
                        readonly>
                    <input type="text" class="form-control mt-1" id="direccion_cliente_mostrado" placeholder="Dirección"
                        readonly>
                </div>
            </div>



            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="cliente_sin_registro" id="clientenoTieneRegistro">
                <label class="form-check-label" for="clientenoTieneRegistro">
                    No tiene registro
                </label>
            </div>


            <!-- Resultado dinámico de cliente -->
            <div id="clienteInfo" class="mb-4"></div>

            <!-- Input para escanear código -->
            <div class="mb-4">
                <label for="codigoProducto" class="form-label fw-semibold">Código de producto:</label>
                <input type="text" class="form-control" id="codigoProducto" placeholder="Escanea o escribe el código">
            </div>

            <!-- Tabla de productos -->
            <div class="table-responsive mb-4">
                <table class="table table-striped align-middle text-center" id="tablaProductos">
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
                        <!-- Productos se insertan por JS -->
                    </tbody>
                </table>
            </div>

            <!-- Totales -->
            <div class="mb-4 text-end">
                <p class="mb-1">Subtotal: <strong>C$ <span id="subtotalVenta">0.00</span></strong></p>
                <p class="mb-1">IVA (15%): <strong>C$ <span id="ivaVenta">0.00</span></strong></p>
                <h5>Total: <strong>C$ <span id="totalVenta">0.00</span></strong></h5>
            </div>

            <!-- Checkbox para entrega -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="entregaDomicilio">
                <label class="form-check-label" for="entregaDomicilio">¿Entregar a domicilio?</label>
            </div>

            <!-- Bloque de entrega -->
            <div id="bloqueEntregaAdicional" style="display:none;">
                <div class="mb-3">
                    <label class="form-label">Dirección:</label>
                    <input type="text" name="direccion" class="form-control" id="direccion"
                        placeholder="Dirección del cliente">
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha de entrega:</label>
                    <input type="date" name="fechaEntrega" class="form-control" id="fechaEntrega"
                        min="<?= date('Y-m-d') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Hora de entrega:</label>
                    <input type="time" name="horaEntrega" class="form-control" id="horaEntrega">
                </div>
                <div class="mb-3">
                    <label class="form-label">Comentarios:</label>
                    <input type="text" name="Comentario" class="form-control" id="Comentario"
                        placeholder="Comentarios adicionales">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Finalizar Venta</button>
        </form>
    </div>
</div>

<script src="/build/js/Venta.js"></script>