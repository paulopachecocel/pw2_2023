<?php
require_once "models/Conexao.php";
require_once "controllers/ProdutoController.php";
require_once "models/Produto.php";
class ProdutoController
{
    public function findAll()
    {

        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM produto");

        $stmt->execute();
        $produtos = array();

        while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Buscar Categoria da Composição
            $categoriaController = new CategoriaController();
            $categoria = $categoriaController->findById($produto["id_categoria"]);
            // Buscar Marca da Composição
            $marcaController = new MarcaController();
            $marca = $marcaController->findById($produto["id_marca"]);
            $produtos[] = new Produto($produto["id"], $produto["nome"], $produto["percentual_lucro"], $categoria, $marca);
        }
        // $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $produtos;
    }
    public function save(array $produtos)
    {
        // Insere uma compra
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO compra (dt_hora) VALUES (:dt_hora)");

        $stmt->bindParam(":dt_hora", date('Y-m-d H:i:s'));

        $stmt->execute();

        $compra = $this->findById($conexao->lastInsertId());

        // Após salvar a compra, vou salvar os itens relacionando com a compra
        $produtoCompraController = new ProdutoCompraController();
        foreach ($produtos as $produtoCompra) :
            $produtoCompra->setCompra($compra); //Defino a compra pra cada produto
            $produtoCompraController->save($produtoCompra);
        endforeach;

        return $compra;
    }

    public function update(Produto $produto)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE produto SET nome = :nome, percentual_lucro = :percentual_lucro, id_categoria = :id_categoria, id_marca = :id_marca WHERE id = :id");

            $stmt->bindParam(":nome", $produto->getNome());
            $stmt->bindParam(":percentual_lucro", $produto->getPercentualLucro());
            $stmt->bindParam(":id_categoria", $produto->getCategoria()->getId());
            $stmt->bindParam(":id_marca", $produto->getMarca()->getId());
            $stmt->bindParam(":id", $produto->getId());

            $stmt->execute();

            return $this->findById($produto->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar o produto: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("DELETE FROM produto WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Produto excluída com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'A Produto não foi encontrada.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir a Produto: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM produto WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Buscar Categoria da Composição
            $categoriaController = new CategoriaController();
            $categoria = $categoriaController->findById($produto["id_categoria"]);
            // Buscar Marca da Composição
            $marcaController = new MarcaController();
            $marca = $marcaController->findById($produto["id_marca"]);

            return new Produto($produto["id"], $produto["nome"], $produto["percentual_lucro"], $categoria, $marca);
        } catch (PDOException $e) {
            echo "Erro ao buscar o produto: " . $e->getMessage();
        }
    }
}
