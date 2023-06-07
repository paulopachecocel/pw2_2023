<?php
require_once "controllers/MarcaController.php";
include_once("restrict.php");

$controller = new MarcaController();
$marcas = $controller->findAll();

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
                            <td>
                                <a class="" href="?pg=form_marca&id=<?php echo $marca->getId(); ?>">
                                    <i class="fas fa-eye"></i></a>
                                <a class="" href="?pg=delete_marca&id=<?php echo $marca->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta marca?')">
                                    <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>