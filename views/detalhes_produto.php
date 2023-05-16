<?php
require_once "controllers/ProdutoController.php";

$produto = null;

$produtoController = new ProdutoController();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produto = $produtoController->findById($id);
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes</title>
    <!-- Área para os Scripts CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Título da Página -->
</head>

<body>
    <!-- Conteúdo do Body -->

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="text-center mb-5">Detalhes do Produto</h1>

                <?php if ($produto != null) { ?>

                    <div class="card">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-8 d-flex flex-column">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $produto->getNome(); ?></h5>
                                        <!-- <p class="card-text"><?php /*echo $produto->getDescricao(); */ ?></p>
                                    <p class="card-text"><?php /* echo $produto->getValor(); */ ?></p> -->
                                    </div>
                                    <div class="row mt-auto d-flex justify-content-end align-items-end p-3">
                                        <div class="p-3">
                                            <button class="btn btn-secondary" onclick="history.back();">Voltar</button>
                                        </div>
                                        <div class="p-3">
                                            <button class="btn btn-primary">Comprar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Algo deu errado!</h4>
                            <p>Produto não encontrado...</p>
                            <hr>
                            <p class="mb-0"><button class="btn btn-secondary" onclick="history.back();">Voltar</button></p>
                        </div>
                    <?php } ?>
                    </div>
            </div>



            <!-- Área para os Scripts Java Scripts -->
            <script src="../js/jquery.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/scripts.js"></script>
</body>

</html>