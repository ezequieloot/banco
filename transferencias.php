<?php

require("Entidades/movimientos.php");

if(!isset($_COOKIE["id"])) {
    header("location: ingresar.php");
}

require("credencial.php");

if($_REQUEST) {
    if(isset($_POST["enviar"])) {
        if($_POST["importe"] < $_SESSION["saldo"]) {
            $movimiento = new Movimiento();
            $movimiento->cuenta = $_POST["cbu"];
            $movimiento->asunto = $_POST["asunto"];
            $movimiento->importe = $_POST["importe"];
            $movimiento->nuevo();
    
            // Editar saldo
    
            $cuenta = new Cuenta();
            $cuenta->id = $_POST["id"];
            $cuenta->saldo = $_SESSION["saldo"] - $_POST["importe"];
            $cuenta->editar();
    
            header("location: index.php");
        }
        else {
            echo "<div class='alert alert-danger'><b>Saldo insuficiente!</b> Tu saldo actual es de: <em>$ " . $_SESSION["saldo"] . "</em></div>";
        }
    }
}

$entidad = new Movimiento();
$entidad->asunto = "transferencia";
$entidad->cuenta = $_SESSION["cbu"];
$transferencias = $entidad->obtenerPorAsunto();

?>

<?php include("cabeza.html"); ?>

<section>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h2>Transferencias</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="id">
                                            <option><?php echo $_SESSION["id"]; ?></option>
                                        </select>
                                        <label>Id</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="cbu">
                                            <option><?php echo $_SESSION["cbu"]; ?></option>
                                        </select>
                                        <label>CBU</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="asunto">
                                            <option>transferencia</option>
                                        </select>
                                        <label>Asunto</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" step="any" name="importe" placeholder="Importe">
                                        <label>Importe</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="text-end">
                                <button type="submit" class="btn btn-dark" name="enviar">Transferir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="display-2">Historial</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table border shadow">
                        <tr>
                            <td>Id</td>
                            <td>Cuenta</td>
                            <td>Asunto</td>
                            <td>Importe</td>
                        </tr>

                        <?php foreach($transferencias as $i): ?>

                        <tr>
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