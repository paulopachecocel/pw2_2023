<?php
require_once "controllers/MarcaController.php";

$controller = new MarcaController();
$marcas = $controller->findAll();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="text-center mb-0">Lista de Marcas</h1>
                <a href="?pg=form_marca" class="btn btn-success" role="button">Cadastrar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($marcas as $marca) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($marca->getId()); ?></td>
                            <td><?php echo htmlspecialchars($marca->getNome()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>