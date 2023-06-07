<?php
require_once "controllers/MarcaController.php";
include_once("restrict.php");
// Inicia a sessão
if (isset($_GET["id"])) {
	$marcaController = new MarcaController();
	$marca = $marcaController->findById($_GET["id"]);
}

if (
	isset($_POST["nome"])
) {
	$marcaController = new MarcaController();

	// Construindo o Marca
	$marca = new Marca(null, $_POST["nome"]);

	// Salvando ou Atualizando a Marca
	if (isset($_GET["id"])) {
		$marca->setId($_GET["id"]);
		$marcaController->update($marca);
	} else {

		$marcaController->save($marca);
	}

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
			<input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($marca) ? $marca->getNome() : ''; ?>">
		</div>
		<input type="submit" class="btn btn-primary" id="salvar" name="salvar" value="Salvar">
	</form>
</div>