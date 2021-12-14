<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "bd-projeto-final-curso";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

class Connection
{
    static function conectar()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=bd-projeto-final-curso', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
