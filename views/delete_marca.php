<?php
require_once "controllers/MarcaController.php";

if (isset($_GET["id"])) {
    $marcaController = new MarcaController();
    $marcaController->delete($_GET["id"]);

    // Voltando pra tela anterior
    header("Location: ?pg=marcas");
}
