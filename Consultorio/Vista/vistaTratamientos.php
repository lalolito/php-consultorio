<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
    body {
        background-color: #09B7D6;
    }

    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h1, h3 {
        color: #343a40;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .btn {
        border-radius: 5px;
    }

    table {
        margin-top: 20px;
    }

    th, td {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
    <div class="container mt-5">
        <h1 class="mb-3">Tratamientos</h1>
        <a class="btn btn-secondary" href="../index.php">Volver menú principal</a>
        <hr>
        <h3>Lista de Tratamientos</h3>
        <form action="../Controlador/controladorTratamientos.php" method="post">
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Número de Tratamiento</th>
                        <th>Fecha Asignado</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Paciente</th>
                        <th>Actualizar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['TraNumero'] . "</td>";
                        echo "<td>" . $fila['TraFechaAsignado'] . "</td>";
                        echo "<td>" . $fila['TraDescripcion'] . "</td>";
                        echo "<td>" . $fila['TraFechaInicio'] . "</td>";
                        echo "<td>" . $fila['TraFechaFin'] . "</td>";
                        echo "<td>" . $fila['TraPaciente'] . "</td>";
                        echo '<td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['TraNumero'] . '">Editar</button>
                              </td>';
                        echo '<td>
                                <form action="../Controlador/controladorTratamientos.php" method="post">
                                    <input type="hidden" name="TraNumero" value="' . $fila['TraNumero'] . '">
                                    <button class="btn btn-danger" type="submit" name="Acciones" value="Borrar Tratamiento">Borrar</button>
                                </form>
                              </td>';
                        echo "</tr>";
                        echo '<div class="modal fade" id="updateModal' . $fila['TraNumero'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="updateModalLabel">Actualizar Tratamiento - ID: ' . $fila['TraNumero'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="../Controlador/controladorTratamientos.php" method="post">';
                        echo '<input type="hidden" name="TraNumero" value="' . $fila['TraNumero'] . '">';
                        echo '<div class="mb-3">
                                <label class="form-label">Fecha Asignado</label>
                                <input class="form-control" name="TraFechaAsignado" type="date" value="' . $fila['TraFechaAsignado'] . '">
                              </div>';
                        echo '<div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="TraDescripcion">' . $fila['TraDescripcion'] . '</textarea>
                              </div>';
                        echo '<div class="mb-3">
                                <label class="form-label">Fecha Inicio</label>
                                <input class="form-control" name="TraFechaInicio" type="date" value="' . $fila['TraFechaInicio'] . '">
                              </div>';
                        echo '<div class="mb-3">
                                <label class="form-label">Fecha Fin</label>
                                <input class="form-control" name="TraFechaFin" type="date" value="' . $fila['TraFechaFin'] . '">
                              </div>';
                        echo '<div class="mb-3">
                                <label class="form-label">Paciente</label>
                                <input class="form-control" name="TraPaciente" type="text" value="' . $fila['TraPaciente'] . '">
                              </div>';
                        echo '<button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Tratamiento">Actualizar Tratamiento</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <h3>Agregar</h3>
            <form action="../Controlador/controladorTratamientos.php" method="post">
                <div class="mb-3">
                    <label for="TraFechaAsignado" class="form-label">Fecha Asignado</label>
                    <input class="form-control" id="TraFechaAsignado" name="TraFechaAsignado" type="date">
                </div>
                <div class="mb-3">
                    <label for="TraDescripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="TraDescripcion" name="TraDescripcion"></textarea>
                </div>
                <div class="mb-3">
                    <label for="TraFechaInicio" class="form-label">Fecha Inicio</label>
                    <input class="form-control" id="TraFechaInicio" name="TraFechaInicio" type="date">
                </div>
                <div class="mb-3">
                    <label for="TraFechaFin" class="form-label">Fecha Fin</label>
                    <input class="form-control" id="TraFechaFin" name="TraFechaFin" type="date">
                </div>
                <div class="mb-3">
            <label for="CitaPaciente" class="form-label">Paciente</label>
            <select class="form-control" id="CitaPaciente" name="CitaPaciente" required>
                <option value="">Seleccione un paciente</option>
                <?php while ($fila = mysqli_fetch_assoc($pacientes)) { ?>
                    <option value="<?php echo $fila['PacIdentificacion']; ?>"><?php echo $fila['PacNombres']; ?></option>
                <?php } ?>
            </select>
            </div>
                <button class="btn btn-success" type="submit" name="Acciones" value="Crear Tratamiento">Crear Tratamiento</button>
            </form>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
