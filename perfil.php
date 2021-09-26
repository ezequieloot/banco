<?php

if(!isset($_COOKIE["id"])) {
    header("location: ingresar.php");
}

require("credencial.php");

if($_REQUEST) {
    if(isset($_POST["enviar"])) {
        $usuario = new Usuario();
        $usuario->id = $_SESSION["id"];
        $usuario->nombre = $_POST["nombre"];
        $usuario->apellido = $_POST["apellido"];
        $usuario->correo = $_POST["correo"];
        
        if($_POST["clave"] == "") {
            $usuario->clave = $_SESSION["clave"];
        }
        else {
            $clave = $_POST["clave"];
            $usuario->clave = password_hash($clave, PASSWORD_DEFAULT);
        }
        $usuario->editar();

        header("location: index.php");
    }
}

?>

<?php include("cabeza.html"); ?>

<section>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h2>Perfil</h2>
            </div>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <img src="images/account.svg" class="img-fluid" height="500">
            </div>
            <div class="col-12 col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nombre" value="<?php echo $_SESSION["nombre"]; ?>" placeholder="">
                                <label>Nombre</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="apellido" value="<?php echo $_SESSION["apellido"]; ?>" placeholder="">
                                <label>Apellido</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="email" class="form-control" name="correo" value="<?php echo $_SESSION["correo"]; ?>" placeholder="">
                                <label>Correo</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="clave" placeholder="">
                                <label>Clave</label>
                            </div>
                            <br>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark" name="enviar">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row p-3">
            <div class="col-12">
                <div class="alert alert-danger">Para borrar la cuenta haz click en este <a href="index.php?borrar" class="alert-link">enlace</a></div>
            </div>
        </div>
    </div>
</section>

<?php include("pie.html"); ?>