<?php
include_once("restrict.php");
require_once "controllers/VendaController.php";

$controller = new VendaController();
$vendas = $controller->findAll();

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
                <h1 class="text-center mb-0">Lista de Vendas</h1>
                <a href="?pg=form_venda" class="btn btn-success" role="button">Cadastrar</a>
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
                    <?php foreach ($vendas as $venda) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($venda->getId()); ?></td>
                            <td><?php echo htmlspecialchars($venda->getDataHora()); ?></td>
                            <td>
                                <a class="" href="?pg=form_venda&id=<?php echo $venda->getId(); ?>">
                                    <i class="fas fa-eye"></i></a>
                                <a class="" href="?pg=delete_venda&id=<?php echo $venda->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta venda?')">
                                    <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>