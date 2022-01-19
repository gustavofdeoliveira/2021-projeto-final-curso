<?php
//Abre conecao com o banco
session_start();
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));
//Temporalizador da Mensagem de erro no login
if (!empty($_SESSION['msg']) && (time() - $_SESSION['tempo_msg'] > 10)) {
    unset($_SESSION['msg']);
}
if (!empty($_SESSION['usuarioAutenticado']) and empty($_SESSION['manterConectado']) and (time() - $_SESSION['sessao_usuario'] > 3600)) {
    unset($_SESSION['usuarioAutenticado']);
}
class UsuarioDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }

    function inserirUsuario(UsuarioModel $modelo)
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
             VALUES ( '" . $modelo->getNomeCompleto() . "', '" . $modelo->getNomeUsuario() . "', SHA1('" . $modelo->getSenha() . "'), 3,'" . $modelo->getEmail() . "','" . $modelo->getFotoAvatar() . "',CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
        }
    }
    function fazerLogin(UsuarioModel $modelo)
    {
        $_SESSION['manterConectado'] = $modelo->getManterLogin();
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
                $_SESSION['sessao_usuario'] = time();
                return true;
            } else {

                throw new \Exception('Senha incorreta');
            }
        }
        throw new \Exception('E-mail | Nome de Usuário incorreto');
    }
    function novaSenha(UsuarioModel $modelo)
    {
        $sql = "SELECT * FROM `usuario` WHERE  `email`=:email";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("email", $modelo->getEmail());
        $statement->execute();
        //Se achar o usuario
        if (!empty($statement->rowCount())) {
            //Guarda em um array os dados retornado do banco
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //Se a senha estiver correta
            ini_set("SMTP", "smtp.gmail.com");

            $Name = "Sender";
            $email = "gustavoofdeoliveira@hotmail.com";
            $recipient = "receiver@mail.com";
            $mail_body = "The text for the mail...";
            $subject = "Subject for reviever";
            $header = "From: " . $Name . " <" . $email . ">\r\n";

            mail($recipient, $subject, $mail_body, $header);
        } else if (empty($statement->rowCount())) {
            throw new \Exception('E-mail informado não encontrado');
        }
    }
    function sairUsuario()
    {
        unset($_SESSION['usuarioAutenticado']);
        header("Location:../index.php");
    }
}
