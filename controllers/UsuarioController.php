<?php
require_once "\models\Usuario.php";
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
    }
    public function save(Usuario $usuario)
    {
    }
    public function update(Usuario $usuario)
    {
    }
    public function delete(Usuario $usuario)
    {
    }
    public function findById($id)
    {
    }
}
