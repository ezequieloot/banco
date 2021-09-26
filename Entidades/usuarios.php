<?php

class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;

    public function __get($propiedad) {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor) {
        return $this->$propiedad = $valor;
    }

    public function nuevo() {
        require("config.php");
        $query = "INSERT INTO usuarios(nombre, apellido, correo, clave)
        VALUES(
            '" . $this->nombre . "',
            '" . $this->apellido . "',
            '" . $this->correo . "',
            '" . $this->clave . "'
        )";
        $mysqli->query($query);
        $this->id = $mysqli->insert_id;
        $mysqli->close();
    }

    public function validar() {
        require("config.php");
        $query = "SELECT * FROM usuarios WHERE correo =" . "'" . $this->correo . "'";
        $resultado = $mysqli->query($query);
        if($fila = $resultado->fetch_assoc()) {
            $this->id = $fila["id"];
            $this->clave = $fila["clave"];
        }
        $mysqli->close();
    }

    public function obtenerPorId() {
        require("config.php");
        $query = "SELECT * FROM usuarios WHERE id =" . $this->id;
        $resultado = $mysqli->query($query);
        if($fila = $resultado->fetch_assoc()) {
            $this->id = $fila["id"];
            $this->nombre = $fila["nombre"];
            $this->apellido = $fila["apellido"];
            $this->correo = $fila["correo"];
            $this->clave = $fila["clave"];
        }
        $mysqli->close();
    }

    public function editar() {
        require("config.php");
        $query = "UPDATE usuarios SET
        nombre = '" . $this->nombre . "',
        apellido = '" . $this->apellido . "',
        correo = '" . $this->correo . "',
        clave = '" . $this->clave . "' WHERE id =" . $this->id;
        $mysqli->query($query);
        $mysqli->close();
    }

    public function borrar() {
        require("config.php");
        $query = "DELETE FROM usuarios WHERE id =" . $this->id;
        $mysqli->query($query);
        $mysqli->close();
    }
}

?>