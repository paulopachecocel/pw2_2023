<?php
require_once "C:/xampp/htdocs/pw2_2023-master/controllers/UsuarioController.php";

    // Inicia a sessão
    session_start();
    
    if(isset($_POST["usuario"]) && isset($_POST["senha"])) {
        $usuarioController = new UsuarioController();
        $usuarioController->login($_POST["usuario"], $_POST["senha"]);
    }
	//para limpar a mensagem quando o uauario esta errado depois de mostrar
	if (isset($_SESSION['mensagem'])) {
		echo "<script>alert('" . $_SESSION['mensagem'] . "')</script>";
		unset($_SESSION['mensagem']); // Limpar a variável de sessão após exibir o alerta
	}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
    <!-- Área para os Scripts CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Título da Página -->
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-4">
				<form method="POST">
					<div class="mb-3">
						<label for="usuario" class="form-label">Usuário</label>
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite seu usuário">
					</div>
					<div class="mb-3">
						<label for="senha" class="form-label">Senha</label>
						<input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
					</div>
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Área para os Scripts Java Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
