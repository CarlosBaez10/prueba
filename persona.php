<?php 

require_once('./conexion.php');

class Persona {

    private $con;

    public function __construct() {
        $this->con = new Conexion();
    }

    public function persona($persona_tip_id,$persona_identificacion,$persona_nombre,$persona_apellido,$persona_fecha,$id_person=NULL)
    {
        if($id_person){
            $sql = "UPDATE persona SET persona_tip_id=$persona_tip_id, persona_identificacion='$persona_identificacion', persona_nombre='$persona_nombre', persona_apellido='$persona_apellido', persona_fecha='$persona_fecha'
                    WHERE persona_id=$id_person";
        }else {
            $exist = $this->validarPersona($persona_identificacion);
            if($exist){
                return "existe";
            }
            $sql = "INSERT INTO persona (persona_tip_id, persona_identificacion, persona_nombre, persona_apellido, persona_fecha)
                    VALUES($persona_tip_id, '$persona_identificacion', '$persona_nombre', '$persona_apellido', '$persona_fecha')";
        }
        $this->con->query($sql);
        return mysqli_affected_rows($this->con);
        $this->con->close();
    }

    public function validarPersona($persona_identificacion)
    {
        $response = false;
        $validaId = "SELECT persona_identificacion FROM persona WHERE persona_identificacion=$persona_identificacion";
        $id = $this->con->query($validaId);
        if(mysqli_num_rows($id)){
            $response =  true;
        }
        return $response;
    }

    public function tipoDocumento()
    {
        $tipoD = "SELECT tip_id, tip_nombre FROM tipo_documento";
        return $this->con->query($tipoD);
        $this->con->close();
    }

    public function datosTabla()
    {
        $datosT = "SELECT tip_id, tip_nombre, persona_id, persona_identificacion, persona_nombre, persona_apellido, persona_fecha FROM persona
                    LEFT JOIN tipo_documento ON persona.persona_tip_id=tipo_documento.tip_id";
        return $this->con->query($datosT);
        $this->con->close();   
    }

    public function eliminarPersona($id)
    {
        $datosT = "DELETE FROM persona WHERE persona.persona_id=$id";
        $this->con->query($datosT);
        return mysqli_affected_rows($this->con);
        $this->con->close();   
    }

    public function encriptarMd5($data)
    {
        return md5($data);
    }

}

?>