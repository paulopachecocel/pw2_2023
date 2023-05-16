<?php
require_once "controllers/ProdutoController.php";

if (isset($_GET["id"])) {
	$produtoController = new ProdutoController();
	$produto = $produtoController->findById($_GET["id"]);
}

// Salva quando recebe dados do formulário
if (
	isset($_POST["nome"]) &&
	isset($_POST["percentual_lucro"]) &&
	isset($_POST["marca"]) &&
	isset($_POST["categoria"])
) {
	$produtoController = new ProdutoController();

	// Recuperando a Categoria
	$categoriaController = new CategoriaController;
	$categoria = $categoriaController->findById($_POST["categoria"]);

	// Recuperando a Categoria
	$marcaController = new MarcaController;
	$marca = $marcaController->findById($_POST["marca"]);

	// Construindo o Produto
	$produto = new Produto(null, $_POST["nome"], $_POST["percentual_lucro"], $categoria, $marca);

	// Salvando ou Atualizando Produto
	if (isset($_GET["id"])) {
		$produto->setId($_GET["id"]);
		$produtoController->update($produto);
	} else {

		$produtoController->save($produto);
	}

	// Voltando pra tela anterior
	header("Location: ?pg=produtos");

	// Encerra a execução do script php
	exit();
}

?>


<div class="container mt-2">
	<h1 class="text-center mb-0">Cadastro de Produto</h1>
	<form method="POST">
		<div class="form-group">
			<label for="categoria">Categoria</label>
			<select class="form-control" id="categoria" name="categoria">
				<?php
				$categoriaController = new CategoriaController();
				$categorias = $categoriaController->findAll();

				foreach ($categorias as $categoria) :
					$selected = (isset($produto) && $produto->getCategoria()->getId() == $categoria->getId()) ? "selected" : "";
					echo "<option value=" . $categoria->getId() . ">" . $categoria->getNome() . "</option>";
				endforeach;
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="marca">Marca</label>
			<select class="form-control" id="marca" name="marca">
				<?php
				$marcaController = new MarcaController();
				$marcas = $marcaController->findAll();

				foreach ($marcas as $marca) :
					$selected = (isset($produto) && $produto->getMarca()->getId() == $marca->getId()) ? "selected" : "";
					echo "<option value=" . $marca->getId() . " " . $selected . ">" . $marca->getNome() . "</option>";
				endforeach;
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($produto) ? $produto->getNome() : ''; ?>">
		</div>
		<div class="form-group">
			<label for="percentual_lucro">Percentual de Lucro</label>
			<input type="text" class="form-control" id="percentual_lucro" name="percentual_lucro" value="<?php echo isset($produto) ? $produto->getPercentualLucro() : ''; ?>">
		</div>
		<input type="submit" class="btn btn-primary" id="salvar" name="salvar" value="Salvar">
	</form>
</div>