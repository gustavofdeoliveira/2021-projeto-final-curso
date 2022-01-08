<?php
//Abre conecao com o banco
session_start();
require_once("../database/Connection.php");
//Temporalizador da Mensagem de erro no login
if (!empty($_SESSION['msg_error']) && (time() - $_SESSION['tempo_msg_error'] > 10)) {
    unset($_SESSION['msg_error']);
}
// if (!empty($_SESSION['usuarioAutenticado']) && !empty($_SESSION['manterConectado'])) {
//     $usuario = $_SESSION['usuarioAutenticado'];
//     if ($usuario['nivelAcesso'] == 1) {
//         header("Location:../view/Dashboard-Administrativo.php");
//     } else if ($usuario['nivelAcesso'] == 2) {
//         header("Location:../view/Dashboard-Administrativo.php");
//     } else if ($usuario['nivelAcesso'] === 3) {
//         header("Location:../view/Dashboard-Usuario.php");
//     }
// }else if(!empty($_SESSION['usuarioAutenticado']) && empty($_SESSION['manterConectado']) && (time() - $_SESSION['tempo_msg_error'] > 3600)){
//     unset($_SESSION['usuarioAutenticado']);
//     header("Location:../view/Login.php");
// }
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
             VALUES ( '" . $modelo->getNomeCompleto() . "', '" . $modelo->getNomeUsuario() . "', SHA1('" . $modelo->getSenha() . "'), 1,'" . $modelo->getEmail() . "',CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
        }
    }
    function buscarUsuario(UsuarioModel $modelo)
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
}
