<?php
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
class LoginDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }

    function buscarUsuario(LoginModel $modelo)
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
}
