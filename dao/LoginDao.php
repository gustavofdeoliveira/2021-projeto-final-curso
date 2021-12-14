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
        $sql = "SELECT * FROM usuario WHERE nomeUsuario = '" . $modelo->getNomeUsuario() . "' OR email='" . $modelo->getNomeUsuario() . "' AND senha = SHA1('" . $modelo->getSenha() . "')";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        if ($statement->rowCount() == 0) {
            header("location: ../view/Login.php?msg=usuario não cadastrado");
            exit;
        } else {

            $usuario_do_banco = $statement->fetch(PDO::FETCH_ASSOC);
            
            if (sha1(($modelo->getSenha()) == $usuario_do_banco["senha"] ) &&
                ($modelo->getNomeUsuario() ==  $usuario_do_banco["nomeUsuario"]) ||
                ($modelo->getNomeUsuario() ==  $usuario_do_banco["email"])                
            ) {
                $usuario_do_banco = "Usuario autenticado";
            } else {
                $usuario_do_banco = "nome de usuario | E-mail ou senha incorretos";
            }
        }

        return $usuario_do_banco;
    }
}
