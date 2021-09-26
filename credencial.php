<?php

require("Entidades/cuentas.php");
require("Entidades/usuarios.php");

$cuenta = new Cuenta();
$cuenta->id = $_COOKIE["id"];
$cuenta->obtenerPorId();

$_SESSION["id"] = $cuenta->id;
$_SESSION["cbu"] = $cuenta->cbu;
$_SESSION["saldo"] = $cuenta->saldo;

$usuario = new Usuario();
$usuario->id = $_COOKIE["id"];
$usuario->obtenerPorId();

$_SESSION["id"] = $usuario->id;
$_SESSION["nombre"] = $usuario->nombre;
$_SESSION["apellido"] = $usuario->apellido;
$_SESSION["correo"] = $usuario->correo;
$_SESSION["clave"] = $usuario->clave;

?>