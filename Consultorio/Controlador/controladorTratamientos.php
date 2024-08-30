<?php
require_once '../Modelo/Tratamientos.php';

$gestorTratamiento = new Tratamiento();
$pacientes = $gestorTratamiento->obtenerPacientes();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Tratamiento') {
    $gestorTratamiento->agregarTratamiento(
        $_POST['TraFechaAsignado'],
        $_POST['TraDescripcion'],
        $_POST['TraFechaInicio'],
        $_POST['TraFechaFin'],
        $_POST['TraObservaciones'],
        $_POST['TraPaciente']
    );
} elseif ($elegirAcciones == 'Actualizar Tratamiento') {
    $TraNumero = $_POST['TraNumero'];
    $TraFechaAsignado = $_POST['TraFechaAsignado'];
    $TraDescripcion = $_POST['TraDescripcion'];
    $TraFechaInicio = $_POST['TraFechaInicio'];
    $TraFechaFin = $_POST['TraFechaFin'];
    $TraObservaciones = $_POST['TraObservaciones'];
    $TraPaciente = $_POST['TraPaciente'];

    $gestorTratamiento->actualizarTratamiento($TraNumero, $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente);

} elseif ($elegirAcciones == 'Borrar Tratamiento') {
    $gestorTratamiento->borrarTratamiento($_POST['TraNumero']);

} elseif ($elegirAcciones == 'Buscar Tratamiento') {
    $resultado = $gestorTratamiento->consultarTratamiento($_POST['TraNumero']);
}

$resultado = $gestorTratamiento->consultarTratamientos();
include "../Vista/vistaTratamientos.php";
?>
    