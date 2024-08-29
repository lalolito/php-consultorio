<?php
require_once '../Modelo/Consultorio.php';

$gestorConsultorio = new Consultorio();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Consultorio') {
    $gestorConsultorio->agregarConsultorio(
        $_POST['ConNumero'],
        $_POST['ConNombre']
    );
} elseif ($elegirAcciones == 'Actualizar Consultorio') {
    $ConNumero = $_POST['ConNumero'];
    $ConNombre = $_POST['ConNombre'];

    $gestorConsultorio->actualizarConsultorio($ConNumero, $ConNombre);

} elseif ($elegirAcciones == 'Borrar Consultorio') {
    $gestorConsultorio->borrarConsultorio($_POST['ConNumero']);

} elseif ($elegirAcciones == 'Buscar Consultorio') {
    $resultado = $gestorConsultorio->consultarConsultorio($_POST['ConNumero']);
}

$resultado = $gestorConsultorio->consultarConsultorios();
include "../Vista/vistaConsultorio.php";
?>
