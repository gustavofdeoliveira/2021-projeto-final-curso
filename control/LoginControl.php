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

    public function verificaAcao()
    {
        if ($this->acao) {
            try {
                $this->modelo->setNomeUsuario($_POST["nomeUsuario"]);
                $this->modelo->setSenha($_POST["Senha"]);
                $this->dao->buscarUsuario($this->modelo);
                //Guarda os dados do usuario
                $usuario = $_SESSION['usuarioAutenticado'];
                
                if ($usuario['nivelAcesso'] == 1) {
                    header("Location:../view/Dashboard.php");
                } else if ($usuario['nivelAcesso'] == 2) {
                    header("Location:../view/Login.php");
                } else if ($usuario['nivelAcesso'] === 3) {
                    header("Location:../view/");
                }
            } catch (\Exception $e) {
                $_SESSION["msg_error"] = $e->getMessage();
                $_SESSION["tempo_msg_error"] = time();
                header("Location:../view/Login.php");
            }
        }
    }
}
new LoginControl();
