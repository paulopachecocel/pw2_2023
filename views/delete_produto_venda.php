<?php
include_once("restrict.php");
require_once "controllers/ProdutoVendaController.php";

if (isset($_GET["id"])) {
    $produtoController = new ProdutoVendaController();
    $produtoController->delete($_GET["id"]);

    // Voltando pra tela anterior
    header("Location: ?pg=form_venda");
}
