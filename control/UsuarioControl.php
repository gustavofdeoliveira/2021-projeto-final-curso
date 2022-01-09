<?php
require_once "../dao/UsuarioDao.php";
require_once "../model/UsuarioModel.php";
class UsuarioControl
{

    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new UsuarioDao();
        $this->modelo = new UsuarioModel();
        $this->acao = $_REQUEST["acao"];
        $this->verificaAcao();
    }

    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "login") {
                $this->login();
            } elseif ($this->acao == "cadastro") {
                $this->cadastrarUsuario();
            } elseif ($this->acao == "recuperar") {
                $this->recuperarSenha();
            } elseif ($this->acao == "sair") {
                $this->desconectarUsuario();
            }
        }
    }
    public function login()
    {
        try {
            $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
            $this->modelo->setSenha($_POST["senha"]);
            if(!empty($_POST["manterLogin"])){
                $this->modelo->setManterLogin($_POST["manterLogin"]);
            }
            $this->dao->buscarUsuario($this->modelo);
            //Guarda os dados do usuario
            $_SESSION['usuarioAutenticado'];
            //teste nivel de acesso do usuario
            header("Location:../view/index.php");
        
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Login.php");
        }
    }
    public function cadastrarUsuario()
    {
        try {
            $this->modelo->setNomeCompleto($_POST["nomeCompleto"]);
            $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
            $this->modelo->setSenha($_POST["senha"]);
            $this->modelo->setEmail($_POST["email"]);
            $avatarNumero = rand(1,6);
            $this->modelo->setFotoAvatar("http://localhost/2021-projeto-final-curso/image/avatares/Avatar-".$avatarNumero.".png");
            $this->dao->inserirUsuario($this->modelo);
            header("Location:../view/CadastroFinalizado.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Cadastrar.php");
        }
    }
    public function recuperarSenha()
    {
        try {
            $this->modelo->setEmail($_POST["email"]);
            $this->dao->novaSenha($this->modelo);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Esqueceu-Senha.php");
        }
    }
    public function desconectarUsuario()
    {
        try {
            $this->dao->sairUsuario();
        } catch (\Exception $e) {
            print_r($e->getMessage());
            header("Location:../view/index.php");
        }
    }
}
new UsuarioControl();
