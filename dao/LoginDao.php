<?php
session_start();
require_once("../database/Connection.php");
//Temporalizador da Mensagem de erro no login
if (!empty($_SESSION['msg_error']) && (time() - $_SESSION['tempo_msg_error'] > 10)) {
    unset($_SESSION['msg_error']);
}
class LoginDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }

    function buscarUsuario(LoginModel $modelo)
    {
        $sql = "SELECT * FROM `usuario` WHERE `nomeUsuario` = :nomeUsuario OR `email`=:nomeUsuario";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':nomeUsuario', $modelo->getNomeUsuario());
        $statement->execute();
        //Se achar o usuario
        if ($statement->rowCount()) {
            //Guarda em um array os dados retornado do banco
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //Se a senha estiver correta
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
