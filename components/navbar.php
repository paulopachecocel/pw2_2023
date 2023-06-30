    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?pg=usuario">Usuario</a>
					</li>
				</ul>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?pg=produtos">Produtos</a>
					</li>
				</ul>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?pg=categorias">Categorias</a>
					</li>
				</ul>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?pg=marcas">Marcas</a>
					</li>
				</ul>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?pg=compras">Compras</a>
					</li>
				</ul>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?pg=compras">Vendas</a>
					</li>
				</ul>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if(isset($_SESSION["nome_usuario"])) { echo "<p class='p-2'>Seja bem vindo <b>". $_SESSION["nome_usuario"] . "</b> </p>"; ?>

                            <li class="nav-item">
                                <a class="nav-link" href="?pg=logout">Sair</a>
                            </li>
                        <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="views/form_login.php">Login</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
			</div>
		</div>
	</nav>
    