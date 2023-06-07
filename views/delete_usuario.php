<?php
require_once "controllers/UsuarioController.php";
include_once("restrict.php");

if (isset($_GET["id"])) {
    $usuarioController = new UsuarioController();
    $usuarioController->delete($_GET["id"]);

    // Voltando pra tela anterior
    header("Location: ?pg=usuario");
}
