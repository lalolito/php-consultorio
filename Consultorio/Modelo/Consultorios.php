<?php
include 'Conexion.php';

class Consultorio
{
    private $ConNumero;
    private $ConNombre;
    private $Conexion;

    public function __construct($ConNumero = null, $ConNombre = null)
    {
        $this->ConNumero = $ConNumero;
        $this->ConNombre = $ConNombre;
        $this->Conexion = Conectarse();
    }

    public function agregarConsultorio($ConNumero, $ConNombre)
    {
        $this->Conexion = Conectarse();
        
        $sql = "INSERT INTO Consultorios(ConNumero, ConNombre) VALUES (?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("is", $ConNumero, $ConNombre);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarConsultorio($ConNumero)
    {
        $this->Conexion = Conectarse();
        
        $sql = "SELECT * FROM Consultorios WHERE ConNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $ConNumero);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado->fetch_assoc();
    }

    public function consultarConsultorios()
    {
        $this->Conexion = Conectarse();
        
        $sql = "SELECT * FROM Consultorios";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        
        return $resultado;
    }

    public function actualizarConsultorio($ConNumero, $ConNombre)
    {
        $this->Conexion = Conectarse();
        
        $sql = "UPDATE Consultorios SET ConNombre=? WHERE ConNumero=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("si", $ConNombre, $ConNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado;
    }

    public function borrarConsultorio($ConNumero)
    {
        $this->Conexion = Conectarse();
        
        $sql = "DELETE FROM Consultorios WHERE ConNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $ConNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado;
    }
}

?>