<?php
session_start();
require_once("../database/conexao.php");
class LoginDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Conexao::conectar();
    }
    function inserir(LoginModel $modelo)
    {
        $sql = "SELECT * FROM usuario WHERE nomeUsuario = '" . $modelo->getNomeUsuario() . "' OR email='" . $modelo->getNomeUsuario() . "' AND senha = SHA1('" . $modelo->getSenha() . "')";
        $sql = mb_strtoupper($sql);
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        if($statement->rowCount() == 0){
            header("location: ../view/Login.php?msg=usuario ou senha nao estao corretos");
            exit;
        } else {
    
            $usuario_do_banco = $statement->fetch(PDO::FETCH_ASSOC);
        }

        return $usuario_do_banco;
    }
}
