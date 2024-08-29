<?php 
 include 'Conexion.php';

class Paciente
{
    private $PacIdentificacion;
    private $PacNombres;                           
    private $PacFechaNacimiento;
    private $PacSexo;
    private $PacEstado;
    private $Conexion;

    public function __construct($PacIdentificacion = null, $PacNombres = null, $PacApellidos = null, $PacFechaNacimiento = null, $PacSexo = null)
    {
        $this->PacIdentificacion = $PacIdentificacion;
        $this->PacNombres = $PacNombres;
        $this->PacApellidos = $PacApellidos;
        $this->PacFechaNacimiento = $PacFechaNacimiento;
        $this->PacSexo = $PacSexo;
        $this->Conexion = Conectarse();
    }

    public function agregarPaciente($PacIdentificacion, $PacNombres, $PacApellidos, $PacFechaNacimiento, $PacSexo)
    {
        $this->Conexion = Conectarse();
        
        $sql = "INSERT INTO Pacientes(PacIdentificacion, PacNombres, PacApellidos, PacFechaNacimiento, PacSexo) VALUES (?,  ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("sssss", $PacIdentificacion, $PacNombres, $PacApellidos, $PacFechaNacimiento, $PacSexo);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarPaciente($PacIdentificacion)
    {
        $this->Conexion = Conectarse();
        
        $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("s", $PacIdentificacion);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado->fetch_assoc();
    }

    public function consultarPacientes()
    {
        $this->Conexion = Conectarse();
        
        $sql = "SELECT * FROM Pacientes";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        
        return $resultado;
    }

    public function actualizarPaciente($PacIdentificacion, $PacNombres, $PacApellidos, $PacFechaNacimiento, $PacSexo)
    {
        $this->Conexion = Conectarse();
        
        $sql = "UPDATE Pacientes SET PacNombres=?, PacApellidos=?, PacFechaNacimiento=?, PacSexo=? WHERE PacIdentificacion=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("sssss", $PacNombres, $PacApellidos, $PacFechaNacimiento, $PacSexo, $PacIdentificacion);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado;
    }

    public function borrarPaciente($PacIdentificacion)
    {
        $this->Conexion = Conectarse();
        
        $sql = "DELETE FROM Pacientes WHERE PacIdentificacion = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("s", $PacIdentificacion);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        
        return $resultado;
    }
}
?>