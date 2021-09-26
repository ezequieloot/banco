<?php

class Movimiento {
    private $id;
    private $cuenta;
    private $asunto;
    private $importe;

    public function __get($propiedad) {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor) {
        return $this->$propiedad = $valor;
    }

    public function nuevo() {
        require("config.php");
        $query = "INSERT INTO movimientos(cuenta, asunto, importe)
        VALUES(
            '" . $this->cuenta . "',
            '" . $this->asunto . "',
            '" . $this->importe . "'
        )";
        $mysqli->query($query);
        $mysqli->close();
    }

    public function obtenerPorAsunto() {
        require("config.php");
        $query = "SELECT * FROM movimientos WHERE cuenta =" . $this->cuenta . " AND asunto =" . "'" . $this->asunto . "'";
        $resultado = $mysqli->query($query);
        $lista = array();
        if($resultado) {
            while($fila = $resultado->fetch_assoc()) {
                $obj = new Movimiento();
                $obj->id = $fila["id"];
                $obj->cuenta = $fila["cuenta"];
                $obj->asunto = $fila["asunto"];
                $obj->importe = $fila["importe"];
                $lista[] = $obj;
            }
            return $lista;
        }
        $mysqli->close();
    }

    public function obtenerTodo() {
        $lista = array();
        require("config.php");
        $query = "SELECT * FROM movimientos WHERE cuenta =" . $this->cuenta;
        $resultado = $mysqli->query($query);
        if($resultado) {
            while($fila = $resultado->fetch_assoc()) {
                $obj = new Movimiento();
                $obj->id = $fila["id"];
                $obj->cuenta = $fila["cuenta"];
                $obj->asunto = $fila["asunto"];
                $obj->importe = $fila["importe"];
                $lista[] = $obj;
            }
            return $lista;
        }
        $mysqli->close();
    }

    public function borrar() {
        require("config.php");
        $query = "DELETE FROM movimientos WHERE cuenta =" . $this->cuenta;
        $mysqli->query($query);
        $mysqli->close();
    }
}

?>