<?php

class Login
{
    private $nomeUsuario;
    private $nomeSenha;

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
    public function getNomeSenha()
    {
        return $this->nomeSenha;
    }

    /**
     * @param mixed 
     */
    public function setNomeSenha($nomeSenha)
    {
        $this->nomeSenha = $nomeSenha;
    }
}
