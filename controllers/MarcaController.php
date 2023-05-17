<?php
require_once "models/Conexao.php";
require_once "models/Marca.php";


class MarcaController
{
    public function findAll()
    {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM marca");

        $stmt->execute();
        $marcas = array();

        while ($marca = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $marcas[] = new Marca($marca["id"], $marca["nome"]);
        }

        return $marcas;
    }
    public function save(Marca $marca)
    {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO marca (nome) VALUES (:nome)");

        $stmt->bindParam(":nome", $marca->getNome());

        $stmt->execute();

        $marca = $this->findById($conexao->lastInsertId());

        return $marca;
    }
    public function update(Marca $marca)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("UPDATE marca SET nome = :nome WHERE id = :id");

            $stmt->bindParam(":nome", $marca->getNome());
            $stmt->bindParam(":id", $marca->getId());

            $stmt->execute();

            return $this->findById($marca->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar a marca: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir os produtos relacionados -> Faz o efeito cascata para não dar erro de chave estrangeira
            $stmtProdutos = $conexao->prepare("DELETE FROM produto WHERE id_marca = :id");
            $stmtProdutos->bindParam(":id", $id);
            $stmtProdutos->execute();

            // Excluir a marca
            $stmtMarca = $conexao->prepare("DELETE FROM marca WHERE id = :id");
            $stmtMarca->bindParam(":id", $id);
            $stmtMarca->execute();

            if ($stmtMarca->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Marca excluída com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'A Marca não foi encontrada.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir a Marca: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM marca WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $marca = new Marca($resultado["id"], $resultado["nome"]);

            return $marca;
        } catch (PDOException $e) {
            echo "Erro ao buscar a marca: " . $e->getMessage();
        }
    }
}
