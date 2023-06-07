<?php
require_once "controllers/ProdutoController.php";
include_once("restrict.php");

if (isset($_GET["id"])) {
    $produtoController = new ProdutoController();
    $produtoController->delete($_GET["id"]);

    // Voltando pra tela anterior
    header("Location: ?pg=produtos");
}
