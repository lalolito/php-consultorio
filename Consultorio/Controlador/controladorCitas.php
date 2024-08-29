

<?php
require_once '../Modelo/Citas.php';

$gestorCita = new Cita();

$medicos = $gestorCita->obtenerMedicos();
$pacientes = $gestorCita->obtenerPacientes();
$consultorios = $gestorCita->obtenerConsultorios();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

try {
    if ($elegirAcciones == 'Crear Cita') {
        $fecha = $_POST['CitFecha'];
        $hora = $_POST['CitHora'];
        $medico = $_POST['CitaMedico'];
        $paciente = $_POST['CitaPaciente'];
        $consultorio = $_POST['CitaConsultorio'];

        $gestorCita->agregarCita($fecha, $hora, $paciente, $medico, $consultorio);

    } elseif ($elegirAcciones == 'Actualizar Cita') {
        $gestorCita->actualizarCita(
            $_POST['CitNumero'],
            $_POST['CitFecha'],
            $_POST['CitHora'],
            $_POST['CitPaciente'],
            $_POST['CitMedico'],
            $_POST['CitConsultorio'],
            $_POST['CitEstado']
        );
    } elseif ($elegirAcciones == 'Borrar Cita') {
        $gestorCita->borrarCita($_POST['CitNumero']);
    } elseif ($elegirAcciones == 'Buscar Cita') {
        $resultado = $gestorCita->consultarCita($_POST['CitNumero']);
    }

    $resultado = $gestorCita->consultarCitas();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

include "../Vista/vistaCitas.php";
?>