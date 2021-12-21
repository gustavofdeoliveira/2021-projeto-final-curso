<?php
require_once "../dao/CadastroDao.php";
require_once "../model/CadastroModel.php";
class CadastroControl
{

    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new CadastroDao();
        $this->modelo = new CadastroModel();

        $this->acao = $_REQUEST["acao"];
        $this->verificaAcao();
    }

    public function verificaAcao()
    {
        if ($this->acao) {
            try {
                $this->modelo->setNomeCompleto($_POST["nomeCompleto"]);
                $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
                $this->modelo->setSenha($_POST["senha"]);
                $this->modelo->setEmail($_POST["email"]);
                $this->dao->cadastrarUsuario($this->modelo);
                $this->dao->cadastrarUsuario($this->modelo);
                header("Location:../view/CadastroFinalizado.php");

            } catch (\Exception $e) {
                $_SESSION["msg_error"] = $e->getMessage();
                $_SESSION["tempo_msg_error"] = time();
                header("Location:../view/Cadastrar.php");
            }
        }
    }
}
new CadastroControl();
