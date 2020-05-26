<?php

class Database {
    public $conexion;
    function __construct()
    {
        return $this->conectar();
    }

    private function conectar(){
        switch ($_SERVER['SERVER_NAME']) {
            case 'ejem.funacsep.com':       
                define('MYSQL_HOSTNAME', "127.0.0.1");
                define('MYSQL_USERNAME', "dvn");
                define('MYSQL_PASSWORD', 'Duvan07*');
                define('MYSQL_DATABASE', "ejem");
                break;
            case 'localhost':
                define('MYSQL_HOSTNAME', "127.0.0.1");
                define('MYSQL_USERNAME', "dvn");
                define('MYSQL_PASSWORD', 'Duvan07*');
                define('MYSQL_DATABASE', "ejem");
                break;
            /* Continuar */
            default:
                die("<h1 style='text-align: center;'>HOST NO VALIDO</h1>");
        }

        $this->conexion = new mysqli(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
        if ($this->conexion->connect_error) {
            die('Error de Conexión (' . $this->conexion->connect_errno . ') '
                    . $this->conexion->connect_error);
                    exit;
        }
        $this->conexion->set_charset("utf8");
        return $this->conexion;
    }

}
?>