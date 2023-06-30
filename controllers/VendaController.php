<?php
require_once "models/Compra.php";
require_once "models/Conexao.php";

class CompraController
{
    public function findAll()
    {

        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM compra");

        $stmt->execute();
        $compras = array();

        while ($compra = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $compras[] = new Compra($compra["id"], $compra["dt_hora"]);
        }

        return $compras;
    }
    public function save()
    {
        // Insere uma compra
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO compra (dt_hora) VALUES (:dt_hora)");

        $data_atual = date('Y-m-d H:i:s');
        $stmt->bindParam(":dt_hora", $data_atual);

        $stmt->execute();

        $compra = $this->findById($conexao->lastInsertId());

        // // Após salvar a compra, vou salvar os itens relacionando com a compra
        // $produtoCompraController = new ProdutoCompraController();
        // foreach ($produtos as $produtoCompra) :
        //     $produtoCompra->setCompra($compra); //Defino a compra pra cada produto
        //     $produtoCompraController->save($produtoCompra);
        // endforeach;

        return $compra;
    }

    public function update(Compra $compra)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE compra SET nome = :nome WHERE id = :id");

            // $stmt->bindParam(":nome", $compra->getNome());
            $stmt->bindParam(":id", $compra->getId());

            $stmt->execute();

            return $this->findById($compra->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar o compra: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir os produtos relacionados -> Faz o efeito cascata para não dar erro de chave estrangeira
            $stmtProdutos = $conexao->prepare("SELECT * FROM produto WHERE id_compra = :id");
            $stmtProdutos->bindParam(":id", $id);
            $stmtProdutos->execute();

            // Excluir a compra
            $stmtCompra = $conexao->prepare("DELETE FROM compra WHERE id = :id");
            $stmtCompra->bindParam(":id", $id);
            $stmtCompra->execute();

            if ($stmtCompra->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Compra excluída com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'A compra não foi encontrada.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir a compra: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM compra WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $compra = new Compra($resultado["id"], $resultado["dt_hora"]);


            return $compra;
        } catch (PDOException $e) {
            echo "Erro ao buscar a compra: " . $e->getMessage();
        }
    }
}
