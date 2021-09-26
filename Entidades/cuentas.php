<?php

class Cuenta {
    private $id;
    private $cbu;
    private $saldo;

    public function __get($propiedad) {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor) {
        return $this->$propiedad = $valor;
    }

    public function nuevo() {
        require("config.php");
        $query = "INSERT INTO cuentas(id, cbu, saldo)
        VALUES(
            '" . $this->id . "',
            '" . $this->cbu . "',
            '" . $this->saldo . "'
        )";
        $mysqli->query($query);
        $mysqli->close();
    }

    public function obtenerPorId() {
        require("config.php");
        $query = "SELECT * FROM cuentas WHERE id =" . $this->id;
        $resultado = $mysqli->query($query);
        if($fila = $resultado->fetch_assoc()) {
            $this->id = $fila["id"];
            $this->cbu = $fila["cbu"];
            $this->saldo = $fila["saldo"];
        }
        $mysqli->close();
    }

    public function editar() {
        require("config.php");
        $query = "UPDATE cuentas SET saldo = '" . $this->saldo . "' WHERE id =" . $this->id;
        $mysqli->query($query);
        $mysqli->close();
    }

    public function borrar() {
        require("config.php");
        $query = "DELETE FROM cuentas WHERE id =" . $this->id;
        $mysqli->query($query);
        $mysqli->close();
    }
}

?>