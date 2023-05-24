<?php
require_once "Bcrypt.php";
require_once "models/Conexao.php";
require_once "models/Usuario.php";


class UsuarioController
{
    public function login($login, $senha)
    {
    }
    public function logout()
    {
        session_start();
        unset($_SESSION["usuario"]);
        header("Location: ../index.php");
    }
    public function findAll()
    {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("SELECT * FROM usuario");

        $stmt->execute();
        $usuarios = array();

        while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario($usuario["id"], $usuario["nome"], $usuario["login"]);
        }

        return $usuarios;
    }
    public function save(Usuario $usuario)
    {
        $conexao = Conexao::getInstance();

        $stmt = $conexao->prepare("INSERT INTO usuario (nome, login, senha) VALUES (:nome, :login, :senha) ");

        $stmt->bindParam(":nome", $usuario->getNome());
        $stmt->bindParam(":login", $usuario->getLogin());
        $stmt->bindParam(":senha", Bcrypt::hash($usuario->getSenha()));

        $stmt->execute();

        $marca = $this->findById($conexao->lastInsertId());

        return $usuario;
    }
    public function update(Usuario $usuario)
    {
        try {
            $conexao = Conexao::getInstance();

            if($usuario->getSenha()==null){
                $stmt = $conexao->prepare("UPDATE usuario SET nome = :nome, login = :login WHERE id = :id");
            } else {
                $stmt = $conexao->prepare("UPDATE usuario SET nome = :nome, login = :login, senha = :senha WHERE id = :id");
                $stmt->bindParam(":senha", Bcrypt::hash($usuario->getSenha()));
            }

            //$stmt->bindParam(":senha", Bcrypt::hash($usuario->getSenha()));
            $stmt->bindParam(":login", $usuario->getLogin());
            $stmt->bindParam(":nome", $usuario->getNome());
            $stmt->bindParam(":id", $usuario->getId());

            $stmt->execute();

            return $this->findById($usuario->getId());
        } catch (PDOException $e) {
            echo "Erro ao atualizar a usuario: " . $e->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $conexao = Conexao::getInstance();

            // Excluir o usuario
            $stmtUsuario = $conexao->prepare("DELETE FROM usuario WHERE id = :id");
            $stmtUsuario->bindParam(":id", $id);
            $stmtUsuario->execute();

            if ($stmtUsuario->rowCount() > 0) {
                $_SESSION['mensagem'] = 'Usuario excluída com sucesso!';
                return true;
            } else {
                $_SESSION['mensagem'] = 'O Usuario não foi encontrado.';
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = 'Erro ao excluir o Usuario: ' . $e->getMessage();
            return false;
        }
    }
    public function findById($id)
    {
        try {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("SELECT * FROM usuario WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $usuario = new Usuario($resultado["id"], $resultado["nome"], $resultado["login"], null);

            return $usuario;
        } catch (PDOException $e) {
            echo "Erro ao buscar a usuario: " . $e->getMessage();
        }
    } 
}
