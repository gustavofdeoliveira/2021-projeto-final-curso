<?php
require_once __DIR__ . "../../dao/RedeTermosDao.php";
require_once __DIR__ . "../../model/RedeTermosModel.php";

class RedeTermosControl
{
    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new RedeTermosDao();
        $this->modelo = new RedeTermosModel();
        if (isset($_REQUEST["acao"])) {
            $this->acao = $_REQUEST["acao"];
            $this->verificaAcao();
        }
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "redeTermos") {
                $this->cadastrarRedeTermos();
            }

            if ($this->acao == "excluirRede") {
                $this->excluirRedeTermos();
            }
            if ($this->acao == "excluirTermo") {
                $this->excluirTermo();
            }
            if ($this->acao == "atualizarRede") {
                $this->atualizarRedeTermos();
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
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Cadastrar-rede-termo.php");
        }
    }
    public function excluirRedeTermos()
    {
        try {
            $this->modelo->setId($_POST["idRede"]);
            $this->dao->excluirRedeTermos($this->modelo);
            header("Location:../view/Listar-redes.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Listar-redes.php");
        }
    }
    public function excluirTermo()
    {
        try {
            $this->modelo->setId($_POST["idRede"]);
            $id = $this->dao->excluirTermo($this->modelo);
            header("Location:../view/Editar-rede-termo.php?id=" . $id);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Listar-redes.php");
        }
    }
    public function atualizarRedeTermos()
    {
        try {
            $this->modelo->setid($_POST["idRede"]);
            $this->modelo->setNome($_POST["nome"]);
            $this->modelo->setDescricao($_POST["descricao"]);
            $this->modelo->setTermosIncluidos($_POST["termos"]);
            $id = $this->dao->atualizarRedeTermos($this->modelo);
            header("Location:../view/Editar-rede-termo.php?id=" . $id);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Editar-rede-termo.php");
        }
    }
    public function listarRedeTermos()
    {
        $redeTermos = $this->dao->listarRedeTermos();
        $redes = $this->modelo->getRede($redeTermos);
        return $redes;
    }
    public function pesquisaRedeTermos($id)
    {
        $rede = $this->dao->pesquisaRedeTermos($id);
        $rede_formatada = $this->modelo->getRede($rede);
        return $rede_formatada;
    }
}
new RedeTermosControl();
