<?php

// Inicia a sessão
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Produtos</title>
    <!-- Área para os Scripts CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Para utilizar ícones -->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <!-- Título da Página -->
</head>

<body>
    <?php include "components/navbar.php"; ?>
    <!-- Conteúdo do Body -->

    <!-- Faço a verificação se a página existe -->
    <?php
    if (!isset($_GET["pg"])) {
        $pg = "";
    } else {
        $pg = $_GET["pg"];
    }
    ?>

    <!-- Se existe, então eu faço o include dela no index -->
    <?php
    if ($pg == "" or !file_exists("views\\" . $pg . ".php")) {
        include "views\produtos.php";
    } else {
        include "views\\" . $pg . ".php";
    }
    ?>



    <!-- Área para os Scripts Java Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>