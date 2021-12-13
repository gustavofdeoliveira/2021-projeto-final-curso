<?php
require_once "../dao/LoginDao.php";
require_once "../model/LoginModel.php";

class LoginControl
{
    private $dao;
    private $modelo;
    private $acao;
    function __construct()
    {
        $this->dao = new LoginDao();
        $this->modelo = new LoginModel();
        $this->acao = $_REQUEST["acao"];
        $this->verificaAcao();
    }
    function verificaAcao()
    {
        switch ($this->acao) {
            case 1:
                $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
                $this->modelo->setSenha($_POST["senha"]);
                $this->dao->inserir($this->modelo);
                break;
        }
    }
}
new LoginModel();