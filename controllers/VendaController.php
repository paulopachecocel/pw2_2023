<?php
require_once "models/Venda.php";
require_once "models/Conexao.php";

class VendaController
{
    public function findAll()
    {

        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM venda");

        $stmt->execute();
        $vendas = array();

        while ($venda = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vendas[] = new Venda($venda["id"], $venda["dt_hora"]);
        }

        return $vendas;
    }
    public function save()
    {
        // Insere uma venda
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO venda (dt_hora) VALUES (:dt_hora)");

        $data_atual = date('Y-m-d H:i:s');
        $stmt->bindParam(":dt_hora", $data_atual);

        $stmt->execute();

        $venda = $this->findById($conexao->lastInsertId());

        // // Após salvar a venda, vou salvar os itens relacionando com a venda
        // $produtoVendaController = new ProdutoVendaController();
        // foreach ($produtos as $produtoVenda) :
        //     $produtoVenda->setVenda($venda); //Defino a venda pra cada produto
        //     $produtoVendaController->save($produtoVenda);
        // endforeach;

        return $venda;
    }

    public function update(Venda $venda)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE venda SET nome = :nome WHERE id = :id");

            // $stmt->bindParam(":nome", $venda->getNome());
            $stmt->bindParam(":id", $venda->getId());

            $stmt->execute();

            return $this->findById($venda->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar o venda: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir os produtos relacionados -> Faz o efeito cascata para não dar erro de chave estrangeira
            $stmtProdutos = $conexao->prepare("SELECT * FROM produto WHERE id_venda = :id");
            $stmtProdutos->bindParam(":id", $id);
            $stmtProdutos->execute();

            // Excluir a venda
            $stmtVenda = $conexao->prepare("DELETE FROM venda WHERE id = :id");
            $stmtVenda->bindParam(":id", $id);
            $stmtVenda->execute();

            if ($stmtVenda->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Venda excluída com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'A venda não foi encontrada.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir a venda: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM venda WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $venda = new Venda($resultado["id"], $resultado["dt_hora"]);


            return $venda;
        } catch (PDOException $e) {
            echo "Erro ao buscar a venda: " . $e->getMessage();
        }
    }
}
