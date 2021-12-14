<?php
session_start();
require_once("../database/Connection.php");
class LoginDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }

    function buscarUsuario(LoginModel $modelo)
    {
        $sql = "SELECT * FROM usuario WHERE nomeUsuario = :nomeUsuario OR email=:nomeUsuario";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':nomeUsuario', $modelo->getNomeUsuario());
        $statement->execute();
        if ($statement->rowCount()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['senha'] === sha1($modelo->getSenha())) {
                $_SESSION['usuarioAutenticado'] = $result;
                return true;
            } else {
                
                throw new \Exception('Senha incorreta');
            }
        }
        throw new \Exception('E-mail | Nome de Usuário incorreto');
    }
}
