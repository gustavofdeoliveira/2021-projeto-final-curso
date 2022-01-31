<?php
require_once "../dao/PublicacaoDao.php";
require_once "../model/PublicacaoModel.php";

if (!empty($_SESSION["msg_error"]) && (time() - $_SESSION["tempo_msg_error"] > 20)) {
    unset($_SESSION["msg_error"]);
}
if (!empty($_SESSION["msg_sucess"]) && (time() - $_SESSION["tempo_msg_sucess"] > 20)) {
    unset($_SESSION["msg_sucess"]);
}

class PublicacaoControl
{
    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new PublicacaoDao();
        $this->modelo = new PublicacaoModel();
        $this->acao = $_REQUEST["acao"];
        $this->verificaAcao();
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "cadastrarPublicacao") {
                $this->inserirPublicacao();
            }
        }
    }
    public function inserirPublicacao()
    {
        try {
            $this->modelo->setTitulo($_POST["titulo"]);
            $this->modelo->setImagem($_POST["file-img"]);
            $this->modelo->setCategoria($_POST["categoria"]);
            $this->modelo->setResumo($_POST["resumo"]);
            $this->modelo->setRedeTermosId($_POST["rede"]);
            $this->modelo->setTexto($_POST["texto"]);
            $this->modelo->setTermosId($_POST["termosId"]);
            $this->dao->inserirPublicacao($this->modelo);
            header("Location:../view/Cadastrar-rede-termo.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
            header("Location:../view/Cadastrar-Publicacao.php");
        }
    }
}
new PublicacaoControl();
