<?php

class CadastroModel
{
    private $nomeCompleto;
    private $nomeUsuario;
    private $senha;
    private $email;

    /**
     * @return mixed
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * @param mixed 
     */
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed 
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
