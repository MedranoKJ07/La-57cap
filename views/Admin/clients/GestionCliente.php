<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Gestión de Clientes</h2>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <form method="POST" action="" class="d-flex gap-2 flex-wrap align-items-center">
            <input type="text" name="busqueda" class="form-control w-auto"
                placeholder="Buscar por nombre o correo"
                value="<?php echo s($busqueda ?? ''); ?>">

            <input type="submit" class="btn btn-primary" value="Filtrar">
            <a href="/admin/GestionarCliente" class="btn btn-secondary">Limpiar</a>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Municipio</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Confirmado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td>
                                    <?php echo s($cliente->p_nombre . ' ' . $cliente->s_nombre . ' ' . $cliente->p_apellido . ' ' . $cliente->s_apellido); ?>
                                </td>
                                <td><?php echo s($cliente->n_telefono); ?></td>
                                <td><?php echo s($cliente->direccion); ?></td>
                                <td><?php echo s($cliente->Municipio); ?></td>
                                <td><?php echo s($cliente->userName ?? '—'); ?></td>
                                <td><?php echo s($cliente->email ?? '—'); ?></td>
                                <td>
                                    <?php
                                    $estado = ($cliente->confirmado ?? "0") == "1" ? "Sí" : "No";
                                    $color = ($cliente->confirmado ?? "0") == "1" ? "success" : "secondary";
                                    ?>
                                    <span class="badge bg-<?php echo $color; ?>"><?php echo $estado; ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No se encontraron clientes.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
