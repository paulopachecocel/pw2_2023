<?php
require_once "controllers/CategoriaController.php";
include_once("restrict.php");

if (isset($_GET["id"])) {
    $categoriaController = new CategoriaController();
    $categoriaController->delete($_GET["id"]);

    // Voltando pra tela anterior
    header("Location: ?pg=categorias");
}
