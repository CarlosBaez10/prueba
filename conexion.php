<?PHP

class Conexion extends mysqli {
    public function __construct() {
        parent::__construct('localhost', 'root', 'root', 'prueba');

        if (mysqli_connect_error()) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }
}

?>
