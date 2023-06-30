<?php
include_once("restrict.php");
require_once "controllers/VendaController.php";
require_once "controllers/ProdutoController.php";
require_once "controllers/ProdutoVendaController.php";
require_once "models/ProdutoVenda.php";
require_once "models/Produto.php";


if (isset($_POST["finalizarVenda"])) {
	unset($_SESSION["venda_id"]);
	header("Location: ?pg=vendas");
	exit();
}

if (!isset($_SESSION['venda_id'])) {
	$vendaController = new VendaController();
	$venda = new Venda(null, null);
	$venda = $vendaController->save();
	$_SESSION['venda_id'] = $venda->getId();
}

$produtoVendaController = new ProdutoVendaController();

if (isset($_POST['adicionarProduto'])) {
	$produtoController = new ProdutoController();
	$vendaController = new VendaController();
	$usuarioController = new UsuarioController();
	// Dados do formulário
	$usuario = $usuarioController->findById($_SESSION['id_usuario']);
	$produto = $produtoController->findById($_POST['produto']);
	$venda = $vendaController->findById($_SESSION["venda_id"]);
	$quantidade = $_POST['qtde'];
	$valorUnitario = $_POST['preco_custo'];

	// Criar uma nova instância de ProdutoVenda
	$produtoVenda = new ProdutoVenda(null, $valorUnitario, $quantidade, $produto, $venda, $usuario);

	$produtoVendaController->save($produtoVenda);
}

$produtosVenda = $produtoVendaController->findAll($_SESSION["venda_id"]);

?>



<div class="container mt-2">
	<h1 class="text-center mb-0">Cadastro de Venda</h1>
	<br>
	<form method="POST">
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="produto">Produto</label>
				<select class="form-control" id="produto" name="produto" required>
					<?php
					$produtoController = new ProdutoController();
					$produtos = $produtoController->findAll();
					foreach ($produtos as $produto) :
						echo "<option value=" . $produto->getId() . ">" . $produto->getNome() . "</option>";
					endforeach;
					?>
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="qtde">Quantidade</label>
				<input type="text" class="form-control" id="qtde" name="qtde" required>
			</div>

			<div class="form-group col-md-3">
				<label for="preco_custo">Preço de Custo</label>
				<input type="text" class="form-control" id="preco_custo" name="preco_custo" required>
			</div>
			<div class="form-group col-md-3 align-self-end">
				<input type="submit" class="btn btn-primary" id="salvar" name="adicionarProduto" value="Adicionar Produto">
			</div>

		</div>
	</form>
	<form method="POST">
		<input type="submit" class="btn btn-success" id="finalizar" name="finalizarVenda" value="Finalizar Venda">
	</form>
</div>

<div class="container mt-5">
	<div class="row">
		<div class="col">
			<div class="d-flex justify-content-between mb-3">
				<h3 class="text-center mb-0">Lista de Produtos</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Produto</th>
						<th>Qtde</th>
						<th>Preço de Custo</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($produtosVenda as $key => $produtoVenda) : ?>
						<tr>
							<td><?php echo htmlspecialchars($produtoVenda->getProduto()->getNome()); ?></td>
							<td><?php echo htmlspecialchars($produtoVenda->getProduto()->getNome()); ?></td>
							<td><?php echo number_format($produtoVenda->getQtde(), 2, ',', '.'); ?></td>
							<td><?php echo "R\$ " . number_format($produtoVenda->getPrecoCusto(), 2, ',', '.'); ?></td>
							<td>
								<a class="" href="?pg=delete_produto_venda&id=<?php echo $produtoVenda->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
									<i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>