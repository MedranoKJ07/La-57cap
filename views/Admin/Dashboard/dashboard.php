<h2 class="text-center mb-4"><?= $titulo ?? 'Dashboard' ?></h2>

<div class="row g-4">
    <!-- Total de Ventas -->
    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Total de Ventas</h5>
                <p class="display-6 fw-bold text-primary"><?= $datos['totalVentas'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <!-- Total de Ingresos -->
    <div class="col-md-4">
        <div class="card border-success shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Total de Ingresos</h5>
                <p class="display-6 fw-bold text-success">C$ <?= number_format($datos['ingresos'] ?? 0, 2) ?></p>
            </div>
        </div>
    </div>

    <!-- Pedidos Entregados -->
    <div class="col-md-4">
        <div class="card border-info shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Pedidos Entregados</h5>
                <p class="display-6 fw-bold text-info"><?= $datos['pedidosEntregados'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <!-- Stock Bajo -->
    <div class="col-md-4">
        <div class="card border-warning shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Productos con Stock Bajo</h5>
                <p class="display-6 fw-bold text-warning"><?= $datos['stockBajo'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <!-- Devoluciones -->
    <div class="col-md-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Devoluciones Registradas</h5>
                <p class="display-6 fw-bold text-danger"><?= $datos['devoluciones'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <!-- Clientes Registrados -->
    <div class="col-md-4">
        <div class="card border-secondary shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Clientes Registrados</h5>
                <p class="display-6 fw-bold text-secondary"><?= $datos['clientes'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <!-- Productos Activos -->
    <div class="col-md-4">
        <div class="card border-dark shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Productos Activos</h5>
                <p class="display-6 fw-bold text-dark"><?= $datos['productos'] ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>
