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
    }
    public function delete(Marca $marca)
    {
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
