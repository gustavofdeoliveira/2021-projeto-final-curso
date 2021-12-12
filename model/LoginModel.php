<?php

class Login
{
    private $nmUsuario;
    private $nmSenha;

    /**
     * @return mixed
     */
    public function getNmUsuario()
    {
        return $this->nmUsuario;
    }

    /**
     * @param mixed 
     */
    public function setNmUsuario($nmUsuario)
    {
        $this->nmUsuario = $nmUsuario;
    }

    /**
     * @return mixed
     */
    public function getNmSenha()
    {
        return $this->nmSenha;
    }

    /**
     * @param mixed 
     */
    public function setNmSenha($nmSenha)
    {
        $this->nmSenha = $nmSenha;
    }
}
