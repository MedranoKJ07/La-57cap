<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col mt-0">
                <h2 class="card-title">Gestión de Clientes</h2>
            </div>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-auto mt-0">
                <form method="POST" action="" class="mb-3 d-flex gap-2 flex-wrap align-items-center">
                    <input type="text" name="busqueda" class="form-control w-auto"
                        placeholder="Buscar por nombre o correo" value="<?php echo $busqueda ?? ''; ?>">

                    <input type="submit" class="btn btn-primary" value="Filtrar">
                    <a href="/admin/GestionarCliente" class="btn btn-secondary">Limpiar</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-12 col-xl-12">
        <table class="table table-hover my-0">
            <thead>
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
                <?php if (!empty($cliente)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente->p_nombre . ' ' . $cliente->s_nombre . ' ' . $cliente->p_apellido . ' ' . $cliente->s_apellido; ?>
                            </td>
                            <td><?php echo $cliente->n_telefono; ?></td>
                            <td><?php echo $cliente->direccion; ?></td>
                            <td><?php echo $cliente->Municipio; ?></td>
                            <td><?php echo $cliente->userName ?? '—'; ?></td>
                            <td><?php echo $cliente->email ?? '—'; ?></td>
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