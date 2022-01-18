<?php
require_once "../dao/RedeTermosDao.php";
require_once "../model/RedeTermosModel.php";

class RedeTermosControl
{
    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new RedeTermosDao();
        $this->modelo = new RedeTermosModel();
        $this->acao = $_REQUEST["acao"];
        $this->verificaAcao();
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "redeTermos") {
                $this->cadastrarRedeTermos();
            }
        }
    }
    public function cadastrarRedeTermos()
    {
        try {
            $this->modelo->setNome($_POST["nome"]);
            $this->modelo->setDescricao($_POST["descricao"]);    
            $this->modelo->setTermosIncluidos($_POST["termos"]);    
            $this->dao->inserirRedeTermos($this->modelo);
            header("Location:../view/Cadastrar-rede-termo.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo"] = time();
            header("Location:../view/Cadastrar-rede-termo.php");
        }
    }
}
new RedeTermosControl();
