<?php

require("Entidades/usuarios.php");

if($_REQUEST) {
    if(isset($_POST["enviar"])) {
        $usuario = new usuario();
        $usuario->correo = $_POST["correo"];
        $usuario->validar();
        $clave = $_POST["clave"];
        if(password_verify($clave, $usuario->clave)) {
            $hr = time() + 1000;
            setcookie("id", $usuario->id, $hr);
            header("location: index.php");
        }
        else {
            echo "<div class='alert alert-danger'><b>El correo o la clave son incorrectos!</b></div>";
        }
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
                    <img src="images/love.svg" class="img-fluid" width="600">
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
                                    <input type="email" class="form-control" name="correo" value="ezequiel@test.com" placeholder="">
                                    <label>Correo</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="clave" value="test" placeholder="">
                                    <label>Clave</label>
                                </div>
                                <br>
                                <div class="text-end">
                                    <a href="registro.php" class="btn btn-light">Registrarme</a>
                                    <button type="submit" class="btn btn-success" name="enviar">Ingresar</button>
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