<?php
require_once "../dao/PublicacaoDao.php";
require_once "../model/PublicacaoModel.php";
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
            if ($this->acao == "excluirPublicacao") {
                $this->excluirPublicacao();
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
            $this->modelo->setTexto($_POST["texto_publicacao"]);
            $this->modelo->setTermosId($_POST["termosId"]);
            
            $id_publicacao = $this->dao->inserirPublicacao($this->modelo);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Cadastrar-Publicacao.php");
        }
    }

    public function excluirPublicacao()
    {
        try {
            $this->modelo->setTitulo($_POST["idPublicacao"]);
            $this->dao->excluirPublicacao($this->modelo);
             header("Location:../view/Listar-publicacao.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Listar-publicacao.php");
        }
    }
}
new PublicacaoControl();
