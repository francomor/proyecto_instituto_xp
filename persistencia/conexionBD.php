<?php

/*
 * Mysql database class - only one connection alowed
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

class ConexionBD {

    private $_connection;
    private static $_instance; //The single instance
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "admin";
    private $_database = "instituto";

    /*
      Get an instance of the Database
      @return Instance
     */

    public static function getConexion() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    public function __construct() {
        $this->crearConexion();
    }

    public function crearConexion() {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() {
        
    }

    public function insertar($consulta) {
        $guardado = false;
        if ($this->_connection->query($consulta) === TRUE) {
            $guardado = true;
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }
        return $guardado;
    }

    public function update($consulta) {
        if ($this->_connection->query($consulta) === TRUE) {
            echo "update successfully";
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }
    }

    public function recuperar($consulta) {
        $_res = array();
        if ($resultado = $this->_connection->query($consulta)) {
            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                $_res[] = $fila;
            }

            /* liberar el conjunto de resultados */

            mysqli_free_result($resultado);
        }
        return $_res;
    }

    public function recuperar1($consulta) {
        $_res = array();
        if ($resultado = $this->_connection->query($consulta)) {
            while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $_res[] = $row;
            }
            mysqli_free_result($resultado);
        }
        return $_res;
    }

    public function existe($consulta) {
        $result = false;
        if ($resultado = $this->_connection->query($consulta)) {
            $row_cnt = $resultado->num_rows;
            if ($row_cnt > 0) {
                $result = true;
            }
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }

        return $result;
    }

    public function cantidad_registros($consulta) {
        $row_cnt = -1;
        if ($resultado = $this->_connection->query($consulta)) {
            $row_cnt = $resultado->num_rows;
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }
        return $row_cnt;
    }

    public function cerrarConexion() {
        $this->_connection->close();
    }

}

?>