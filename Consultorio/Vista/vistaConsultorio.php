<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio</title>
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
        <h1 class="mb-3">Consultorios</h1>
        <a class="btn btn-secondary" href="../index.php">Volver menú principal</a>
        <hr>
        <h3>Lista de Consultorios</h3>
        <form action="../Controlador/controladorConsultorio.php" method="post">
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Número de Consultorio</th>
                        <th>Nombre</th>
                        <th>Actualizar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['ConNumero'] . "</td>";
                        echo "<td>" . $fila['ConNombre'] . "</td>";
                        echo '<td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['ConNumero'] . '">Editar</button>
                              </td>';
                        echo '<td>
                                <form action="../Controlador/controladorConsultorio.php" method="post">
                                    <input type="hidden" name="ConNumero" value="' . $fila['ConNumero'] . '">
                                    <button class="btn btn-danger" type="submit" name="Acciones" value="Borrar Consultorio">Borrar</button>
                                </form>
                              </td>';
                        echo "</tr>";
                        echo '<div class="modal fade" id="updateModal' . $fila['ConNumero'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="updateModalLabel">Actualizar Consultorio - ID: ' . $fila['ConNumero'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="../Controlador/controladorConsultorio.php" method="post">';
                        echo '<input type="hidden" name="ConNumero" value="' . $fila['ConNumero'] . '">';
                        echo '<div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input class="form-control" name="ConNombre" type="text" value="' . $fila['ConNombre'] . '">
                              </div>';
                        echo '<button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Consultorio">Actualizar Consultorio</button>';
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
            <form action="../Controlador/controladorConsultorio.php" method="post">
                <div class="mb-3">
                    <label for="ConNumero" class="form-label">Número de Consultorio</label>
                    <input class="form-control" id="ConNumero" name="ConNumero" type="text">
                </div>
                <div class="mb-3">
                    <label for="ConNombre" class="form-label">Nombre</label>
                    <input class="form-control" id="ConNombre" name="ConNombre" type="text">
                </div>
                <button class="btn btn-success" type="submit" name="Acciones" value="Crear Consultorio">Crear Consultorio</button>
            </form>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
