<?php
require_once '../Modelo/Pacientes.php';

$gestorPaciente = new Paciente();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Paciente') {
    $gestorPaciente->agregarPaciente(
        $_POST['PacIdentificacion'],
        $_POST['PacNombres'],
        $_POST['PacApellidos'],
        $_POST['PacFechaNacimiento'],
        $_POST['PacSexo']
    );
} elseif ($elegirAcciones == 'Actualizar Paciente') {
    $PacIdentificacion = $_POST['PacIdentificacion'];
    $PacNombres = $_POST['PacNombres'];
    $PacApellidos = $_POST['PacApellidos'];
    $PacFechaNacimiento = $_POST['PacFechaNacimiento'];
    $PacSexo = $_POST['PacSexo'];

    $gestorPaciente->actualizarPaciente($PacIdentificacion, $PacNombres, $PacApellidos, $PacFechaNacimiento, $PacSexo);

} elseif ($elegirAcciones == 'Borrar Paciente') {
    $gestorPaciente->borrarPaciente($_POST['PacIdentificacion']);

} elseif ($elegirAcciones == 'Buscar Paciente') {
    $resultado = $gestorPaciente->consultarPaciente($_POST['PacIdentificacion']);
}

$resultado = $gestorPaciente->consultarPacientes();
include "../Vista/vistaPacientes.php";
?>
