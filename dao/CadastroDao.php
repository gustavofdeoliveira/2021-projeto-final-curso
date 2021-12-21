<?php
session_start();
require_once("../database/Connection.php");
//Temporalizador da Mensagem de erro no login
if (!empty($_SESSION['msg_error']) && (time() - $_SESSION['tempo_msg_error'] > 10)) {
    unset($_SESSION['msg_error']);
}
class CadastroDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }

    function cadastrarUsuario(CadastroModel $modelo)
    {
        $sql = "SELECT * FROM `usuario` WHERE `nomeUsuario`=:nomeUsuario OR `email`=:email";
        $statement = $this->conn->prepare($sql);
        $statement->execute(array(':nomeUsuario' => $modelo->getNomeUsuario(), ':email' => $modelo->getEmail()));
        //Se achar o usuario
        if (!empty($statement->rowCount())) {
            //Guarda em um array os dados retornado do banco
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //Se a senha estiver correta
            if ($result['email'] === $modelo->getEmail()) {
                throw new \Exception('E-mail já cadastrado');
            } else if ($result['nomeUsuario'] === $modelo->getNomeUsuario()) {
                throw new \Exception('Nome de Usuário já cadastrado');
            }
        } else if (empty($statement->rowCount())) {
            $sql = "INSERT INTO `usuario`(`nomeCompleto`,`nomeUsuario`,`senha`,`nivelAcesso`,`email`,`dataInclusao`) 
             VALUES ( '" . $modelo->getNomeCompleto() . "', '" . $modelo->getNomeUsuario() . "', SHA1('" . $modelo->getSenha() . "'), 1,'" . $modelo->getEmail() . "',CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            
        }
    }
}
