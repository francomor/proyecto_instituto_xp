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
    private $_password = ""; //admin
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

    /* Crean conexion en la BD (NO USAR, tiene Singleton)
    */
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

    /* Insertar en la BD
    * @param consulta consulta insert
    * @return guardado verdadero si se guardo correctamente
    */
    public function insertar($consulta) {
        $guardado = false;
        if ($this->_connection->query($consulta) === TRUE) {
            $guardado = true;
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }
        return $guardado;
    }

    /* Actualizar en la BD
    * @param consulta consulta update
    */
    public function update($consulta) {
        if ($this->_connection->query($consulta) === TRUE) {
            echo "update successfully";
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }
    }

    /* Recuperar en la BD
    * @param consulta consulta select
    * @return array[][] donde el primer campo es la fila y el segundo corresponde con las columnas
    */
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

    /* Recuperar en la BD un array asociativo
    * @param consulta consulta select
    * @return array asociativo donde cada columna se representa por su nombre
    */
    public function recuperar_asociativo($consulta) {
        $_res = array();
        if ($resultado = $this->_connection->query($consulta)) {
            while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $_res[] = $row;
            }
            mysqli_free_result($resultado);
        }
        return $_res;
    }

    /* Existe en la BD
    * @param consulta consulta a verificar
    * @return boolean verdadero si existe al menos una fila
    */
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

    /* Cantidad de registros de una consulta en la BD
    * @param consulta consulta
    * @return int cantidad de registros de la consulta
    */
    public function cantidad_registros($consulta) {
        $row_cnt = -1;
        if ($resultado = $this->_connection->query($consulta)) {
            $row_cnt = $resultado->num_rows;
        } else {
            echo "Error: " . $consulta . "<br>" . $this->_connection->error;
        }
        return $row_cnt;
    }

    /* Cerrar conexion en la BD
    */
    public function cerrarConexion() {
        $this->_connection->close();
    }

}

?>