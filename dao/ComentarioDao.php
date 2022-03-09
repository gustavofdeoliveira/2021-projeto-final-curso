<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

if (!empty($_SESSION["msg_error"]) and (time() - $_SESSION["tempo_msg_error"] > 20)) {
    unset($_SESSION["msg_error"]);
}
if (!empty($_SESSION["msg_sucess"]) && (time() - $_SESSION["tempo_msg_sucess"] > 20)) {
    unset($_SESSION["msg_sucess"]);
}

class ComentarioDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }
    function inserirComentario(ComentarioModel $modelo)
    {
        $sql = "INSERT INTO `comentario` (`textoComentario`,`id_usuario`,`id_publicacao`,`nomeUsuario`,`dataInclusao`)
                VALUES ('" . $modelo->getTextoComentario() . "',
                '" . $modelo->getIdUsuario() . "',
                '" . $modelo->getIdPublicacao() . "',
                '" . $modelo->getNomeUsuario() . "',
                CURRENT_DATE())";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $_SESSION["tempo_msg_sucess"] = time();
        $_SESSION["msg_sucess"] = "Comentário publicado com sucesso!";
        return $modelo->getIdPublicacao();
    }
    function excluirComentario($id_comentario){
        $sql = "DELETE FROM `comentario` WHERE id = '$id_comentario' ";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $_SESSION["tempo_msg_sucess"] = time();
        $_SESSION["msg_sucess"] = "Comentário deletado com sucesso!";
    }
}
