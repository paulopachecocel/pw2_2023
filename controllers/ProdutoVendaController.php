<?php

require_once "controllers/UsuarioController.php";
require_once "models/ProdutoVenda.php";
require_once "models/Conexao.php";

class ProdutoVendaController
{
    public function findAll($id_venda)
    {

        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM produto_venda where id_venda = :id_venda");

        $stmt->bindParam(":id_venda", $id_venda);

        $stmt->execute();
        $produtoVendas = array();

        $produtoController = new ProdutoController();
        $usuarioController = new UsuarioController();
        $vendaController = new VendaController();
        $usuario =
            $usuarioController->findById($_SESSION["id_usuario"]);

        while ($produtoVenda = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produto = $produtoController->findById($produtoVenda["id_produto"]);
            $venda = $vendaController->findById($produtoVenda["id_venda"]);
            $produtoVenda = new ProdutoVenda($produtoVenda["id"], $produtoVenda["preco_custo"], $produtoVenda["qtde"], $produto, $venda, $usuario);
            $produtoVendas[] = $produtoVenda;
        }

        return $produtoVendas;
    }
    public function save(ProdutoVenda $produtoVenda)
    {
        // Insere uma produtoVenda
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO produto_venda (id_usuario, id_produto, id_venda, qtde, preco_custo) VALUES (:id_usuario, :id_produto, :id_venda, :qtde, :preco_custo)");
        $id_usuario = $_SESSION["id_usuario"];
        $id_produto =
            $produtoVenda->getProduto()->getId();
        $id_venda = $produtoVenda->getVenda()->getId();
        $qtde = $produtoVenda->getQtde();
        $preco_custo = $produtoVenda->getPrecoCusto();
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":id_produto", $id_produto);
        $stmt->bindParam(":id_venda", $id_venda);
        $stmt->bindParam(":qtde", $qtde);
        $stmt->bindParam(":preco_custo", $preco_custo);

        $stmt->execute();

        $produtoVenda = $this->findById($conexao->lastInsertId());

        // Após salvar a produtoVenda, vou salvar os itens relacionando com a produtoVenda


        return $produtoVenda;
    }

    public function update(ProdutoVenda $produtoVenda)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE produto_venda SET nome = :nome WHERE id = :id");

            // $stmt->bindParam(":nome", $produtoVenda->getNome());
            $stmt->bindParam(":id", $produtoVenda->getId());

            $stmt->execute();

            return $this->findById($produtoVenda->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar o produtoVenda: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir o produtoVenda
            $stmtProdutoVenda = $conexao->prepare("DELETE FROM produto_venda WHERE id = :id");
            $stmtProdutoVenda->bindParam(":id", $id);
            $stmtProdutoVenda->execute();

            if ($stmtProdutoVenda->rowCount() > 0) {
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

            $stmt = $conexao->prepare("SELECT * FROM produto_venda WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $produtoController = new ProdutoController();
            $usuarioController = new UsuarioController();
            $vendaController = new VendaController();

            $usuario = $usuarioController->findById($resultado["id_usuario"]);
            $produto = $produtoController->findById($resultado["id_produto"]);
            $venda = $vendaController->findById($resultado["id_venda"]);

            $produtoVenda = new ProdutoVenda($resultado["id"], $resultado["preco_custo"], $resultado["qtde"], $produto, $venda, $usuario);


            return $produtoVenda;
        } catch (PDOException $e) {
            echo "Erro ao buscar a produtoVenda: " . $e->getMessage();
        }
    }
}
