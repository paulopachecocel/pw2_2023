<?php

class Conexao {
    private static $conexao = null;
    private static $host = "localhost";
    private static $usuario = "root";
    private static $senha = "";
    private static $banco = "pw2_2023";

    private function __construct() {}

    public static function getInstance() {
        if (self::$conexao === null) {
            try {
                self::$conexao = new PDO("mysql:host=" . self::$host . ";port=3306;dbname=" . self::$banco, self::$usuario, self::$senha);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        return self::$conexao;
    }
}
