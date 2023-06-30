<?php
include_once("restrict.php");
require_once "controllers/CompraController.php";

$controller = new CompraController();
$compras = $controller->findAll();

// Verificar se existe uma mensagem definida na sessão
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('" . $_SESSION['mensagem'] . "')</script>";
    unset($_SESSION['mensagem']); // Limpar a variável de sessão após exibir o alerta
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="text-center mb-0">Lista de Compras</h1>
                <a href="?pg=form_compra" class="btn btn-success" role="button">Cadastrar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $compra) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($compra->getId()); ?></td>
                            <td><?php echo htmlspecialchars($compra->getDataHora()); ?></td>
                            <td>
                                <a class="" href="?pg=form_compra&id=<?php echo $compra->getId(); ?>">
                                    <i class="fas fa-eye"></i></a>
                                <a class="" href="?pg=delete_compra&id=<?php echo $compra->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta compra?')">
                                    <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>