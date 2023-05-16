<?php
require_once "controllers/MarcaController.php";
// Inicia a sessão
if (
	isset($_POST["nome"])
) {
	$marcaController = new MarcaController();

	// Construindo o Marca
	$marca = new Marca(null, $_POST["nome"]);

	// Salvando o Marca
	$marcaController->save($marca);

	// Voltando pra tela anterior
	header("Location: ?pg=marcas");

	// Encerra a execução do script php
	exit();
}

?>

<div class="container mt-2">
	<h1 class="text-center mb-0">Cadastro de Marca</h1>
	<form method="POST">

		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="nome">
		</div>
		<input type="submit" class="btn btn-primary" id="salvar" name="salvar" value="Salvar">
	</form>
</div>