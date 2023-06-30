<?php

require_once "controllers/UsuarioController.php";
require_once "models/ProdutoCompra.php";
require_once "models/Conexao.php";

class ProdutoCompraController
{
    public function findAll($id_compra)
    {

        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM produto_compra where id_compra = :id_compra");

        $stmt->bindParam(":id_compra", $id_compra);

        $stmt->execute();
        $produtoCompras = array();

        $produtoController = new ProdutoController();
        $usuarioController = new UsuarioController();
        $compraController = new CompraController();
        $usuario =
            $usuarioController->findById($_SESSION["id_usuario"]);

        while ($produtoCompra = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produto = $produtoController->findById($produtoCompra["id_produto"]);
            $compra = $compraController->findById($produtoCompra["id_compra"]);
            $produtoCompra = new ProdutoCompra($produtoCompra["id"], $produtoCompra["preco_custo"], $produtoCompra["qtde"], $produto, $compra, $usuario);
            $produtoCompras[] = $produtoCompra;
        }

        return $produtoCompras;
    }
    public function save(ProdutoCompra $produtoCompra)
    {
        // Insere uma produtoCompra
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO produto_compra (id_usuario, id_produto, id_compra, qtde, preco_custo) VALUES (:id_usuario, :id_produto, :id_compra, :qtde, :preco_custo)");
        $id_usuario = $_SESSION["id_usuario"];
        $id_produto =
            $produtoCompra->getProduto()->getId();
        $id_compra = $produtoCompra->getCompra()->getId();
        $qtde = $produtoCompra->getQtde();
        $preco_custo = $produtoCompra->getPrecoCusto();
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":id_produto", $id_produto);
        $stmt->bindParam(":id_compra", $id_compra);
        $stmt->bindParam(":qtde", $qtde);
        $stmt->bindParam(":preco_custo", $preco_custo);

        $stmt->execute();

        $produtoCompra = $this->findById($conexao->lastInsertId());

        // Após salvar a produtoCompra, vou salvar os itens relacionando com a produtoCompra


        return $produtoCompra;
    }

    public function update(ProdutoCompra $produtoCompra)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE produto_compra SET nome = :nome WHERE id = :id");

            // $stmt->bindParam(":nome", $produtoCompra->getNome());
            $stmt->bindParam(":id", $produtoCompra->getId());

            $stmt->execute();

            return $this->findById($produtoCompra->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar o produtoCompra: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir o produtoCompra
            $stmtProdutoCompra = $conexao->prepare("DELETE FROM produto_compra WHERE id = :id");
            $stmtProdutoCompra->bindParam(":id", $id);
            $stmtProdutoCompra->execute();

            if ($stmtProdutoCompra->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Produto excluído com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'O produto não foi encontrado.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir o produto: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM produto_compra WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $produtoController = new ProdutoController();
            $usuarioController = new UsuarioController();
            $compraController = new CompraController();

            $usuario = $usuarioController->findById($resultado["id_usuario"]);
            $produto = $produtoController->findById($resultado["id_produto"]);
            $compra = $compraController->findById($resultado["id_compra"]);

            $produtoCompra = new ProdutoCompra($resultado["id"], $resultado["preco_custo"], $resultado["qtde"], $produto, $compra, $usuario);


            return $produtoCompra;
        } catch (PDOException $e) {
            echo "Erro ao buscar a produtoCompra: " . $e->getMessage();
        }
    }
}
