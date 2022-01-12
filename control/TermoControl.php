<?php
require_once "../dao/TermoDao.php";
require_once "../model/TermoModel.php";

class TermoControl
{
    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new TermoDao();
        $this->modelo = new TermoModel();
        $this->acao = $_REQUEST["acao"];
        $this->verificaAcao();
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "inserir") {
                $this->cadastrarTermo();
            }
        }
    }
    public function cadastrarTermo()
    {
        try {    
            $this->modelo->setTipoTermo($_POST["tipoTermo"]);
            $this->modelo->setNome($_POST["nome"]);
            $this->modelo->setNomeVariavel($_POST["nomeVariavel"]);
            $this->modelo->setConceito($_POST["conceito"]);
            $this->dao->inserirTermo($this->modelo);           
            header("Location:../view/Cadastrar-termo.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg"] = time();
            header("Location:../view/Cadastrar-termo.php");
        }
    }
}
new TermoControl();
