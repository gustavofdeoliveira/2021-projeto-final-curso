
<?php
require_once __DIR__ . "../../dao/ComentarioDao.php";
require_once __DIR__ . "../../model/ComentarioModel.php";
class ComentarioControl
{
    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new ComentarioDao();
        $this->modelo = new ComentarioModel();
        if (isset($_REQUEST["acao"])) {
            $this->acao = $_REQUEST["acao"];
            $this->verificaAcao();
        }
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "inserirComentario") {
                $this->inserirComentario();
            }
            if ($this->acao == "excluirComentario") {
                $this->excluirComentario();
            }
        }
    }
    public function inserirComentario()
    {
        try {
            $this->modelo->setTextoComentario($_POST["comentario"]);
            $this->modelo->setIdUsuario($_POST["idUsuario"]);
            $this->modelo->setIdPublicacao($_POST["idPublicacao"]);
            $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
            $id_publicacao = $this->dao->inserirComentario($this->modelo);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
            exit();
        }
    }

    public function excluirComentario()
    {
        try {
            $id_comentario = $_POST["idComentario"];
            $id_publicacao = $_POST["idPublicacao"];
            $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
            $this->dao->excluirComentario($id_comentario);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
            exit();
            header("Location:../view/Ver-publicacao.php");
        }
    }
}

new ComentarioControl();
