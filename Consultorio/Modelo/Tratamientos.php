<?php
include 'Conexion.php';

class Tratamiento
{
    private $TraNumero;
    private $TraFechaAsignado;
    private $TraDescripcion;
    private $TraFechaInicio;
    private $TraFechaFin;
    private $TraObservaciones;
    private $TraPaciente;
    private $Conexion;

    public function __construct($TraNumero = null, $TraFechaAsignado = null, $TraDescripcion = null, $TraFechaInicio = null, $TraFechaFin = null, $TraObservaciones = null, $TraPaciente = null)
    {
        $this->TraNumero = $TraNumero;
        $this->TraFechaAsignado = $TraFechaAsignado;
        $this->TraDescripcion = $TraDescripcion;
        $this->TraFechaInicio = $TraFechaInicio;
        $this->TraFechaFin = $TraFechaFin;
        $this->TraObservaciones = $TraObservaciones;
        $this->TraPaciente = $TraPaciente;
        $this->Conexion = Conectarse();
    }

    public function agregarTratamiento($TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente)
    {
        $this->Conexion = Conectarse();
        
        $sql = "INSERT INTO Tratamientos(TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones, TraPaciente) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssss", $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarTratamiento($TraNumero)
    {
        $this->Conexion = Conectarse();
        
        $sql = "SELECT * FROM Tratamientos WHERE TraNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $TraNumero);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado->fetch_assoc();
    }

    public function consultarTratamientos()
    {
        $this->Conexion = Conectarse();
        
        $sql = "SELECT * FROM Tratamientos";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        
        return $resultado;
    }

    public function actualizarTratamiento($TraNumero, $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente)
    {
        $this->Conexion = Conectarse();
        
        $sql = "UPDATE Tratamientos SET TraFechaAsignado=?, TraDescripcion=?, TraFechaInicio=?, TraFechaFin=?, TraObservaciones=?, TraPaciente=? WHERE TraNumero=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssssi", $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente, $TraNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado;
    }

    public function borrarTratamiento($TraNumero)
    {
        $this->Conexion = Conectarse();
        
        $sql = "DELETE FROM Tratamientos WHERE TraNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $TraNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado;
    }
    public function obtenerPacientes()
    {
        $sql = "SELECT PacIdentificacion, PacNombres FROM Pacientes";
        $resultado = $this->Conexion->query($sql);
        return $resultado;
    }
}

?>