<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médico</title>
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
        <h1 class="mb-3">Médicos</h1>
        <a class="btn btn-secondary" href="../index.php">Volver menú principal</a>
        <hr>
        <h3>Lista de Médicos</h3>
        <form action="../Controlador/controladorMedico.php" method="post">
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Identificación Médico</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                        <th>Cambio Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                        //Solicita todos los datos en caso de cometer error al registrarlo, poder modificarlo.
                        //Permite cambiar el estado en caso de querer  volver activar Medico.

                        echo "<tr>";
                        echo "<td>" . $fila['MedIdentificacion'] . "</td>";
                        echo "<td>" . $fila['MedNombres'] . "</td>";
                        echo "<td>" . $fila['MedApellidos'] . "</td>";
                        echo "<td>" . $fila['MedEstado'] . "</td>";
                        echo '<td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['MedIdentificacion'] . '">Editar</button>
                              </td>';
                        echo '<td>
                                <form action="../Controlador/controladorMedico.php" method="post">
                                    <input type="hidden" name="MedIdentificacion" value="' . $fila['MedIdentificacion'] . '">
                                    <button class="btn btn-danger" type="submit" name="Acciones" value="Borrar Medico">Cambiar</button>
                                </form>
                              </td>';
                        echo "</tr>";
                        echo '<div class="modal fade" id="updateModal' . $fila['MedIdentificacion'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="updateModalLabel">Actualizar Médico - ID: ' . $fila['MedIdentificacion'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="../Controlador/controladorMedico.php" method="post">';
                        echo '<input type="hidden" name="MedIdentificacion" value="' . $fila['MedIdentificacion'] . '">';
                        echo '<div class="mb-3">
                                <label class="form-label">Nombres</label>
                                <input class="form-control" name="MedNombres" type="text" value="' . $fila['MedNombres'] . '">
                              </div>';
                        echo '<div class="mb-3">
                                <label class="form-label">Apellidos</label>
                                <input class="form-control" name="MedApellidos" type="text" value="' . $fila['MedApellidos'] . '">
                              </div>';
                        echo '<div class="mb-3">
                              <label class="form-label">Estado</label>
                              <select class="form-select" name="MedEstado">
                                  <option value="Activo">Activo</option>
                                  <option value="Inactivo">Inactivo</option>
                              </select>
                            </div>';
                        echo '<button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Medico">Actualizar Médico</button>';
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
            <form action="../Controlador/controladorMedico.php" method="post">
                <div class="mb-3">
                    <label for="MedIdentificacion" class="form-label">Identificación Médico</label>
                    <input class="form-control" id="MedIdentificacion" name="MedIdentificacion" type="text">
                </div>
                <div class="mb-3">
                    <label for="MedNombres" class="form-label">Nombres</label>
                    <input class="form-control" id="MedNombres" name="MedNombres" type="text">
                </div>
                <div class="mb-3">
                    <label for="MedApellidos" class="form-label">Apellidos</label>
                    <input class="form-control" id="MedApellidos" name="MedApellidos" type="text">
                </div>
                <button class="btn btn-success" type="submit" name="Acciones" value="Crear Medico">Crear Médico</button>
            </form>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
