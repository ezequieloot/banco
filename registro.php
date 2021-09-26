<?php

require("Entidades/usuarios.php");
require("Entidades/cuentas.php");

if($_REQUEST) {
    if(isset($_POST["enviar"])) {
        $usuario = new Usuario();
        $usuario->nombre = $_POST["nombre"];
        $usuario->apellido = $_POST["apellido"];
        $usuario->correo = $_POST["correo"];
        $clave = $_POST["clave"];
        $usuario->clave = password_hash($clave, PASSWORD_DEFAULT);
        $usuario->nuevo();

        // Crear cuenta

        $cuenta = new Cuenta();
        $cuenta->id = $usuario->id;
        $cuenta->cbu = rand(10000000000000, 100000000000000);
        $cuenta->saldo = 200.00;
        $cuenta->nuevo();

        header("location: ingresar.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
    <!---->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <section class="bg-success">
        <div class="container">
            <div class="row align-items-center vh-100">
                <div class="col-12 col-md-8">
                    <img src="images/transfer.svg" class="img-fluid" height="800">
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <br>
                            <div class="text-center">
                                <h1><em>Banco&copy;</em></h1>
                            </div>
                            <br>
                            <form method="POST">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nombre" placeholder="">
                                    <label>Nombre</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="apellido" placeholder="">
                                    <label>Apellido</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="correo" placeholder="">
                                    <label>Correo</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="clave" placeholder="">
                                    <label>Clave</label>
                                </div>
                                <br>
                                <div class="text-end">
                                    <a href="ingresar.php" class="btn btn-light">Ingresar</a>
                                    <button type="submit" class="btn btn-success" name="enviar">Registrarme</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>