<?php
include 'Conexion.php';

class Cita
{
    private $CitNumero;
    private $CitFecha;
    private $CitHora;
    private $CitPaciente;
    private $CitMedico;
    private $CitConsultorio;
    private $CitEstado;
    private $Conexion;

    public function __construct($CitNumero = null, $CitFecha = null, $CitHora = null, $CitPaciente = null, $CitMedico = null, $CitConsultorio = null, $CitEstado = 'Asignada')
    {
        $this->CitNumero = $CitNumero;
        $this->CitFecha = $CitFecha;
        $this->CitHora = $CitHora;
        $this->CitPaciente = $CitPaciente;
        $this->CitMedico = $CitMedico;
        $this->CitConsultorio = $CitConsultorio;
        $this->CitEstado = $CitEstado;
        $this->Conexion = Conectarse();
    }

    public function agregarCita($CitFecha, $CitHora, $CitPaciente, $CitMedico, $CitConsultorio)
    {        
        $this->Conexion = Conectarse();
    
        $sql = "INSERT INTO citas (CitFecha, CitHora, CitPaciente, CitMedico, CitConsultorio, CitEstado)
                VALUES (?, ?, ?, ?, ?, 'Asignada')";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssi", $CitFecha, $CitHora, $CitPaciente, $CitMedico, $CitConsultorio);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarCita($CitNumero)
    {
        $this->Conexion = Conectarse();

        $sql = "SELECT * FROM citas WHERE CitNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $CitNumero);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;   
    }

    public function consultarCitas()
    {
        $this->Conexion = Conectarse();

        $sql = "SELECT * FROM citas";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;  
    }

    public function actualizarCita($CitNumero, $CitFecha, $CitHora, $CitPaciente, $CitMedico, $CitConsultorio, $CitEstado)
    {
        $this->Conexion = Conectarse();
     
        $sql = "UPDATE citas SET CitFecha=?, CitHora=?, CitPaciente=?, CitMedico=?, CitConsultorio=?, CitEstado=? WHERE CitNumero=?";
         
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssssi", $CitFecha, $CitHora, $CitPaciente, $CitMedico, $CitConsultorio, $CitEstado, $CitNumero);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->Conexion->close();
     
        return $resultado;
    }

    public function borrarCita($CitNumero)
    {
        $this->Conexion = Conectarse();
     
        $sql = "UPDATE citas SET CitEstado = 'Cancelada' WHERE CitNumero=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $CitNumero);
        $resultado = $stmt->execute();
     
        $stmt->close();
        $this->Conexion->close();
     
        return $resultado;
    }

    public function obtenerMedicos()
    {
        $sql = "SELECT MedIdentificacion, MedNombres FROM Medicos WHERE MedEstado = 'Activo'";
        $resultado = $this->Conexion->query($sql);
        return $resultado;
    }

    public function obtenerPacientes()
    {
        $sql = "SELECT PacIdentificacion, PacNombres FROM Pacientes";
        $resultado = $this->Conexion->query($sql);
        return $resultado;
    }

    public function obtenerConsultorios()
    {
        $sql = "SELECT ConNumero, ConNombre FROM Consultorios";
        $resultado = $this->Conexion->query($sql);
        return $resultado;
    }

}
?>