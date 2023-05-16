<?php
require_once "models/Categoria.php";
require_once "models/Conexao.php";

class CategoriaController
{
    public function findAll()
    {

        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM categoria");

        $stmt->execute();
        $categorias = array();

        while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias[] = new Categoria($categoria["id"], $categoria["nome"]);
        }

        return $categorias;
    }
    public function save(Categoria $categoria)
    {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO categoria (nome) VALUES (:nome)");

        $stmt->bindParam(":nome", $categoria->getNome());

        $stmt->execute();

        $categoria = $this->findById($conexao->lastInsertId());

        return $categoria;
    }
    public function update(Categoria $categoria)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE categoria SET nome = :nome WHERE id = :id");

            $stmt->bindParam(":nome", $categoria->getNome());
            $stmt->bindParam(":id", $categoria->getId());

            $stmt->execute();

            return $this->findById($categoria->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar o categoria: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir os produtos relacionados -> Faz o efeito cascata para não dar erro de chave estrangeira
            $stmtProdutos = $conexao->prepare("DELETE FROM produto WHERE id_categoria = :id");
            $stmtProdutos->bindParam(":id", $id);
            $stmtProdutos->execute();

            // Excluir a categoria
            $stmtCategoria = $conexao->prepare("DELETE FROM categoria WHERE id = :id");
            $stmtCategoria->bindParam(":id", $id);
            $stmtCategoria->execute();

            if ($stmtCategoria->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Categoria excluída com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'A categoria não foi encontrada.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir a categoria: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM categoria WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $categoria = new Categoria($resultado["id"], $resultado["nome"]);


            return $categoria;
        } catch (PDOException $e) {
            echo "Erro ao buscar a categoria: " . $e->getMessage();
        }
    }
}
