<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
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
    <h1 class="mb-3">Citas</h1>
    <a class="btn btn-secondary" href="../index.php">Volver al menú principal</a>
    <hr>
    <h3>Lista de Citas</h3>
    <form action="../Controlador/controladorCitas.php" method="post">
        <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
    </form>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Número de Cita</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Consultorio</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Cambiar Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['CitNumero'] . "</td>";
                    echo "<td>" . $fila['CitFecha'] . "</td>";
                    echo "<td>" . $fila['CitHora'] . "</td>";
                    echo "<td>" . $fila['CitPaciente'] . "</td>";
                    echo "<td>" . $fila['CitMedico'] . "</td>";
                    echo "<td>" . $fila['CitConsultorio'] . "</td>";
                    echo "<td>" . $fila['CitEstado'] . "</td>";
                    echo '<td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['CitNumero'] . '">Editar</button>
                          </td>';
                    echo '<td>
                            <form action="../Controlador/controladorCitas.php" method="post">
                                <input type="hidden" name="CitNumero" value="' . $fila['CitNumero'] . '">
                                <button class="btn btn-danger" type="submit" name="Acciones" value="Borrar Cita">Cambiar</button>
                            </form>
                          </td>';
                    echo "</tr>";
                    echo '<div class="modal fade" id="updateModal' . $fila['CitNumero'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="updateModalLabel">Actualizar Cita - Número: ' . $fila['CitNumero'] . '</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<form action="../Controlador/controladorCitas.php" method="post">';
                    echo '<input type="hidden" name="CitNumero" value="' . $fila['CitNumero'] . '">';
                    echo '<div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input class="form-control" name="CitFecha" type="date" value="' . $fila['CitFecha'] . '">
                          </div>';
                    echo '<div class="mb-3">
                            <label class="form-label">Hora</label>
                            <input class="form-control" name="CitHora" type="text" value="' . $fila['CitHora'] . '">
                          </div>';
                    echo '<div class="mb-3">
                            <label class="form-label">Paciente</label>
                            <input class="form-control" name="CitPaciente" type="text" value="' . $fila['CitPaciente'] . '">
                          </div>';
                    echo '<div class="mb-3">
                            <label class="form-label">Médico</label>
                            <input class="form-control" name="CitMedico" type="text" value="' . $fila['CitMedico'] . '">
                          </div>';
                    echo '<div class="mb-3">
                            <label class="form-label">Consultorio</label>
                            <input class="form-control" name="CitConsultorio" type="text" value="' . $fila['CitConsultorio'] . '">
                          </div>';
                    echo '<div class="mb-3">
                          <label class="form-label">Estado</label>
                          <select class="form-select" name="CitEstado">
                              <option value="Asignada"' . ($fila['CitEstado'] == 'Asignada' ? ' selected' : '') . '>Asignada</option>
                              <option value="Cumplida"' . ($fila['CitEstado'] == 'Cumplida' ? ' selected' : '') . '>Cumplida</option>
                              <option value="Solicitada"' . ($fila['CitEstado'] == 'Solicitada' ? ' selected' : '') . '>Solicitada</option>
                              <option value="Cancelada"' . ($fila['CitEstado'] == 'Cancelada' ? ' selected' : '') . '>Cancelada</option>
                          </select>
                        </div>';
                    echo '<button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Cita">Actualizar Cita</button>';
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
        <h3>Agregar Cita</h3>
        <form action="../Controlador/controladorCitas.php" method="post">
            <div class="mb-3">
                <label for="CitFecha" class="form-label">Fecha</label>
                <input class="form-control" id="CitFecha" name="CitFecha" type="date">
            </div>
            <div class="mb-3">
                <label for="CitHora" class="form-label">Hora</label>
                <input class="form-control" id="CitHora" name="CitHora" type="text">
            </div>
            <div class="mb-3">
            <label for="CitaMedico" class="form-label">Médico</label>
            <select class="form-control" id="CitaMedico" name="CitaMedico" required>
                <option value="">Seleccione un médico</option>
                <?php while ($fila = mysqli_fetch_assoc($medicos)) { ?>
                    <option value="<?php echo $fila['MedIdentificacion']; ?>"><?php echo $fila['MedNombres']; ?></option>
                <?php } ?>
            </select>
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
        <div class="mb-3">
            
<label for="CitaConsultorio" class="form-label">Consultorio</label>
            <select class="form-control" id="CitaConsultorio" name="CitaConsultorio" required>
                <option value="">Seleccione un consultorio</option>
                <?php while ($fila = mysqli_fetch_assoc($consultorios)) { ?>
                    <option value="<?php echo $fila['ConNumero']; ?>"><?php echo $fila['ConNombre']; ?></option>
                <?php } ?>
            </select>
        </div>
            <button class="btn btn-success" type="submit" name="Acciones" value="Crear Cita">Crear Cita</button>
        </form>
    </div>
</div>
<br><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>