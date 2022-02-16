<?php
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

//Abre conecao com o banco
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//Temporalizador da Mensagem de erro no login
if (!empty($_SESSION['msg_error']) && (time() - $_SESSION['tempo_msg_error'] > 15)) {
    unset($_SESSION['msg_error']);
}
if (!empty($_SESSION['msg_sucess']) && (time() - $_SESSION['tempo_msg_sucess'] > 15)) {
    unset($_SESSION['msg_sucess']);
}
if (!empty($_SESSION['usuarioAutenticado']) and empty($_SESSION['manterConectado']) and (time() - $_SESSION['sessao_usuario'] > 3600)) {
    unset($_SESSION['usuarioAutenticado']);
}
if (!isset($_SESSION['usuarioAutenticado'])) {
    $_SESSION['usuarioAutenticado'] = '';
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
            $sql = "INSERT INTO `usuario`(`nomeCompleto`,`nomeUsuario`,`senha`,`nivelAcesso`,`email`,`fotoAvatar`,`dataInclusao`) 
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

    function atualizarNivel(UsuarioModel $modelo)
    {

        $sql = "SELECT * FROM `usuario` WHERE `idUsuario`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();

        //Se achar o usuario
        if (!empty($statement->rowCount())) {
            //Guarda em um array os dados retornado do banco
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['nivelAcesso'] == 1) {
                $novoNivel = 2;
            } else if ($result['nivelAcesso'] == 2) {
                $novoNivel = 3;
            } else if ($result['nivelAcesso'] == 3) {
                $novoNivel = 1;
            }
            $sql = "UPDATE `usuario` SET `nivelAcesso`= $novoNivel WHERE `idUsuario`=:id";
            $statement = $this->conn->prepare($sql);
            $statement->bindValue("id", $modelo->getId());
            $statement->execute();
            $_SESSION["msg_sucess"] = "Nível de acesso do usuário " . $modelo->getId() . " atualizado!";
            $_SESSION["tempo_msg_sucess"] = time();
        } else {
            throw new \Exception('Usuário não encontrado');
        }
    }
    function excluirUsuario(UsuarioModel $modelo)
    {
        $usuario =  $_SESSION['usuarioAutenticado'];
        if ($usuario['nivelAcesso'] != 1) {
            $sql = "SELECT * FROM `usuario` WHERE `idUsuario`=:id";
            $statement = $this->conn->prepare($sql);
            $statement->bindValue("id", $usuario['idUsuario']);

            $statement->execute();
            if ($statement->rowCount()) {
                //Guarda em um array os dados retornado do banco
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                //Se a senha estiver correta
                if ($result['senha'] === sha1($modelo->getSenha())) {
                    $sql = "DELETE FROM `usuario` WHERE `idUsuario`=:id";
                    $statement = $this->conn->prepare($sql);
                    $statement->bindValue("id", $usuario['idUsuario']);
                    $statement->execute();
                    unset($_SESSION['usuarioAutenticado']);
                    header("Location:../index.php");
                } else {
                    throw new \Exception('Senha incorreta!');
                }
            } else {
                throw new \Exception('Usuário não encontrado');
            }
        }

        if ($usuario['nivelAcesso'] == 1) {
            $sql = "DELETE FROM `usuario` WHERE `idUsuario`=:id";
            $statement = $this->conn->prepare($sql);
            $statement->bindValue("id", $modelo->getId());
            $statement->execute();
            $_SESSION["msg_sucess"] = "Usuário " . $modelo->getId() . " excluído!";
            $_SESSION["tempo_msg_sucess"] = time();
            header("Location:../view/Listar-usuarios.php");
        }
    }
    function atualizarUsuario(UsuarioModel $modelo)
    {

        $usuario =  $_SESSION['usuarioAutenticado'];
        if (empty($modelo->getSenha())) {
            $sql = "SELECT * FROM `usuario` WHERE `nomeUsuario` = :nomeUsuario OR `email`=:email";
            $statement = $this->conn->prepare($sql);
            $statement->execute(array(':nomeUsuario' => $modelo->getNomeUsuario(), ':email' => $modelo->getEmail()));
            $statement->execute();
            if ($statement->rowCount()) {
                $sql = "UPDATE `usuario` SET 
            `nomeCompleto` = '" . $modelo->getNomeCompleto() . "',
            `nomeUsuario` = '" . $modelo->getNomeUsuario() . "',
            `email` ='" . $modelo->getEmail() . "' WHERE `idUsuario`=:id";
                $statement = $this->conn->prepare($sql);
                $statement->bindValue("id", $usuario['idUsuario']);
                $statement->execute();
                $_SESSION["msg_sucess"] = "Dados do usuário atualizados!";
                $_SESSION["tempo_msg_sucess"] = time();

                $sql = "SELECT * FROM `usuario` WHERE `idUsuario` = :id";
                $statement = $this->conn->prepare($sql);
                $statement->bindValue("id", $usuario['idUsuario']);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $_SESSION['usuarioAutenticado'] = $result;
            } else {
                throw new \Exception('nome de usuário | e-mail já cadastrado!');
            }
        }

        if (!empty($modelo->getSenha())) {
            $sql = "UPDATE `usuario` SET 
            `senha` =SHA1('" . $modelo->getSenha() . "') WHERE `idUsuario`=:id";

            $statement = $this->conn->prepare($sql);
            $statement->bindValue("id", $usuario['idUsuario']);
            $statement->execute();
            $_SESSION["msg_sucess"] = "Dados do usuário atualizados!";
            $_SESSION["tempo_msg_sucess"] = time();

            $sql = "SELECT * FROM `usuario` WHERE `idUsuario` = :id";
            $statement = $this->conn->prepare($sql);
            $statement->bindValue("id", $usuario['idUsuario']);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['usuarioAutenticado'] = $result;
        }
    }

    function atualizarAvatar(UsuarioModel $modelo)
    {
        $sql = "UPDATE `usuario` SET `fotoAvatar`= '" . $modelo->getFotoAvatar() . "' WHERE `idUsuario`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $sql = "SELECT * FROM `usuario` WHERE `idUsuario`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $_SESSION['usuarioAutenticado'] = $result;
        $_SESSION["msg_sucess"] = "foto de Avatar do usuário " . $modelo->getId() . " atualizado!";
        $_SESSION["tempo_msg_sucess"] = time();
    }
    function listarUsuario(){
        $query_usuarios = "SELECT `idUsuario`,`nomeCompleto`,`nivelAcesso`,`dataInclusao` FROM `usuario` ORDER BY `idUsuario` DESC";
        $statement = $this->conn->prepare($query_usuarios);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $usuarios[] = $result;
            }
            return $usuarios;
        }
    }
}
