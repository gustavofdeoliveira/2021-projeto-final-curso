<?php

class LoginModel
{
    private $nomeUsuario;
    private $senha;
    private $manterLogin;
    /**
     * @return mixed
     */
    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    /**
     * @param mixed 
     */
    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed 
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    /**
     * @return mixed
     */
    public function getManterLogin()
    {
        return $this->manterLogin;
    }

    /**
     * @param mixed 
     */
    public function setManterLogin($manterLogin)
    {
        $this->manterLogin = $manterLogin;
    }
}
