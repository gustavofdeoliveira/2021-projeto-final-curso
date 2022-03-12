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
        if (isset($_REQUEST["acao"])) {
            $this->acao = $_REQUEST["acao"];
            $this->verificaAcao();
        }
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "inserirTermo") {
                $this->inserirTermo();
            }
            if ($this->acao == "excluirTermo") {
                $this->excluirTermo();
            }
            if ($this->acao == "editarTermo") {
                $this->atualizarTermo();
            }
            if ($this->acao == "OrdenarTermo") {
                $this->ordenarTermo();
            }
            if ($this->acao == "salvarTermo") {
                $this->salvarTermo();
            }
            if ($this->acao == "removerTermo") {
                $this->removerTermo();
            }
            if($this->acao =="verTermo"){
                $this->verTermo(); 
            }
        }
    }
    public function inserirTermo()
    {
        try {
            $this->modelo->setTipoTermo($_POST["tipoTermo"]);
            $this->modelo->setNome($_POST["nome"]);
            $this->modelo->setConceito($_POST["conceito"]);
            $id_termo = $this->dao->inserirTermo($this->modelo);
            header("Location:../view/Ver-termo.php?id=".$id_termo);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();

            header("Location:../view/Cadastrar-termo.php");
        }
    }
    public function excluirTermo()
    {
        try {
            print_r($this->modelo->setId($_POST['Termo']));
            $this->dao->excluirTermo($this->modelo);
            header("Location:../view/Listar-termos.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Listar-termos.php");
        }
    }
    public function atualizarTermo()
    {
        try {
            $this->modelo->setId($_POST["idTermo"]);
            $this->modelo->setTipoTermo($_POST["tipoTermo"]);
            $this->modelo->setNome($_POST["nome"]);
            $this->modelo->setConceito($_POST["conceito"]);
            $id_termo = $this->dao->atualizarTermo($this->modelo);
            header("Location:../view/Ver-termo.php?id=".$id_termo);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Editar-termo.php");
        }
    }
    public function listarTermo()
    {
        $listagem = $this->dao->listarTermo();
        $termos = $this->modelo->getTermo($listagem);
        return $termos;
    }
    public function ordenarTermo()
    {
        try {
            $letraPesquisa = $_POST["letraPesquisa"];
            $termos = $this->dao->ordenarTermo($letraPesquisa);
            $termos_formatado = $this->modelo->getTermo($termos);
            $_SESSION['termos_biblioteca'] = $termos_formatado;
            $_SESSION['letra_pesquisa'] = $letraPesquisa;
            header("Location:../view/Listagem-Biblioteca.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Biblioteca.php");
        }
    }
    public function salvarTermo()
    {
        try {
            $this->modelo->setId($_POST["idTermo"]);
            $this->dao->salvarTermo($this->modelo);
            header("Location:../view/Meu-espaco.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            print_r($_SESSION["msg_error"]);
            exit();
        }
    }
    public function removerTermo()
    {
        try {
            $id_publicacao = $_POST["idTermo"];
            $this->modelo->setId($_POST["idTermo"]);
            $this->dao->removerTermo($this->modelo);
            header("Location:../view/Listagem-Biblioteca.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
            exit();
        }
    }
     public function verTermo()
    {
        try{
            $id_termo = $_POST['idTermo'];
            $this->modelo->setId($_POST['idTermo']);
            $termo = $this->dao->verTermo($this->modelo);
            $termo_formatado = $this->modelo->getTermo($termo);
            $_SESSION['termo'] = $termo_formatado;
            header("Location:../view/Editar-Termo.php?id=".$id_termo);
        }catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
            exit();
        }
    }
    public function listagemTermosSalvos()
    {
        try {
            $termos = $this->dao->listagemTermosSalvos();
            if (!empty($termos)) {
                $termo_formatado = $this->modelo->getTermo($termos);
                return $termo_formatado;
            }
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
            exit();
            header("Location:../view/Meu-espaco.php");
        }
    }
}
new TermoControl();
