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
        print_r($this->acao); 
        $this->verificaAcao();
    }

    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "login") {
                $this->login();
            }
            if ($this->acao == "cadastro") {
                $this->cadastrarUsuario();
            }
            if ($this->acao == "recuperar") {
                $this->recuperarSenha();
            }
            if ($this->acao == "sair") {
                $this->desconectarUsuario();
            }
            if ($this->acao == "atualizaNivel") {
                $this->atualizarNivelUsuario(); 
            }
            if ($this->acao == "excluirUsuario") {
                $this->excluirUsuario();                
            }
        }
    }
    public function login()
    {
        try {
            $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
            $this->modelo->setSenha($_POST["senha"]);
            if (!empty($_POST["manterLogin"])) {
                $this->modelo->setManterLogin($_POST["manterLogin"]);
            }
            $this->dao->fazerLogin($this->modelo);
            $_SESSION['usuarioAutenticado'];
            header("Location:../index.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:view/Login.php");
        }
    }
    public function cadastrarUsuario()
    {
        try {
            $this->modelo->setNomeCompleto($_POST["nomeCompleto"]);
            $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
            $this->modelo->setSenha($_POST["senha"]);
            $this->modelo->setEmail($_POST["email"]);
            $avatarNumero = rand(1, 6);
            $this->modelo->setFotoAvatar("http://localhost/2021-projeto-final-curso/image/avatares/Avatar-" . $avatarNumero . ".png");
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
    public function atualizarNivelUsuario()
    {
        try {
            print_r($this->modelo->setId($_POST['Usuario']));
            $this->dao->atualizarNivel($this->modelo);
            header("Location:../view/Listar-usuarios.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Listar-usuarios.php");
        }
    }
    public function excluirUsuario()
    {
        try {
            print_r($this->modelo->setId($_POST['Usuario']));
            $this->dao->deletarUsuario($this->modelo);
            header("Location:../view/Listar-usuarios.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            header("Location:../view/Listar-usuarios.php");
        }
    }
}
new UsuarioControl();
