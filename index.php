<?php

session_start();

require("Entidades/movimientos.php");

if(!isset($_COOKIE["id"])) {
    header("location: ingresar.php");
}

// Credenciales

require("credencial.php");

if(isset($_GET["salir"])) {
    session_destroy();
    setcookie("id", "", time() - 1000);
    header("location: ingresar.php");
}

if(isset($_GET["borrar"])) {
    $usuario->borrar();
    $cuenta->borrar();
    $movimientos->cuenta = $_SESSION["cbu"];
    $movimientos->borrar();
    session_destroy();
    setcookie("id", "", time() - 1000);
    header("location: ingresar.php");
}

$entidad = new Movimiento();
$entidad->cuenta = $_SESSION["cbu"];
$movimientos = $entidad->obtenerTodo();

?>

<?php include("cabeza.html"); ?>

<section>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h2>Inicio</h2>
            </div>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card bg-success">
                    <div class="card-body">
                        <h4 class="text-white"><?php echo strtoupper($_SESSION["nombre"] . " " . $_SESSION["apellido"]); ?></h4>
                        <h3 class="text-white"><em>CBU:</em></h3>
                        <span class="display-4 text-white fw-bold"><?php echo $_SESSION["cbu"]; ?></span>
                        <h3 class="text-white"><em>Saldo:</em></h3>
                        <span class="display-4 text-white fw-bold">$ <?php echo $_SESSION["saldo"]; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <img src="images/payments.svg" class="img-fluid" width="500">
            </div>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="display-2">Movimientos</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table border shadow">
                        <tr>
                            <td>Id</td>
                            <td>CBU</td>
                            <td>Asunto</td>
                            <td>Importe</td>
                        </tr>

                        <?php foreach($movimientos as $i): ?>
                            <?php
                            
                            if($i->asunto == "pago" || $i->asunto == "transferencia") {
                                $color = "table-danger";
                            }
                            else {
                                $color = "table-success";
                            }
                            
                            ?>

                            <tr class="<?php echo $color; ?>">
                                <td><?php echo $i->id; ?></td>
                                <td><?php echo $i->cuenta; ?></td>
                                <td><?php echo $i->asunto; ?></td>
                                <td><?php echo $i->importe; ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </div>
</section>

<?php include("pie.html"); ?>