<h2 class="text-center mb-4">Panel de Reportes</h2>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <!-- Ventas -->
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Ventas por Fecha</h5>
                    <p class="card-text">Resumen diario, mensual o anual de ventas.</p>
                    <a href="/admin/reporte/ventas-fecha" class="btn btn-primary w-100">Ver Reporte</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-tie fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Ventas por Vendedor</h5>
                    <p class="card-text">Comparativa de ventas realizadas por cada vendedor.</p>
                    <a href="/admin/reportes/ventas-vendedor" class="btn btn-success w-100">Ver Reporte</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-box fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Ventas por Producto</h5>
                    <p class="card-text">Productos más vendidos en el período seleccionado.</p>
                    <a href="/admin/reportes/ventas-producto" class="btn btn-warning w-100">Ver Reporte</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-tags fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Ventas por Categoría</h5>
                    <p class="card-text">Desempeño de cada categoría de productos.</p>
                    <a href="/admin/reportes/ventas-categoria" class="btn btn-info w-100">Ver Reporte</a>
                </div>
            </div>
        </div>

        <!-- Pedidos -->
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-motorcycle fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">Pedidos por Repartidor</h5>
                    <p class="card-text">Seguimiento de entregas realizadas por repartidores.</p>
                    <a href="/admin/reportes/pedidos-repartidor" class="btn btn-danger w-100">Ver Reporte</a>
                </div>
            </div>
        </div>



        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-warehouse fa-3x text-dark mb-3"></i>
                    <h5 class="card-title">Valorización de Inventario</h5>
                    <p class="card-text">Valor actual del inventario disponible.</p>
                    <a href="/admin/reporte/valorizacion-inventario" class="btn btn-dark w-100">Ver Reporte</a>
                </div>
            </div>
        </div>

        <!-- Compras -->
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-truck-loading fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Productos Comprados</h5>
                    <p class="card-text">Total de productos adquiridos y su costo.</p>
                    <a href="/admin/reporte/productos-comprados" class="btn btn-primary w-100">Ver Reporte</a>
                </div>
            </div>
        </div>

    </div>
</div>
