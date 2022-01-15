<?php
class RedeTermosModel
{
    private $nome;
    private $descricao;
    private $termosIncluidos;
    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed 
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed 
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getTermosIncluidos()
    {
        return $this->termosIncluidos;
    }

    /**
     * @param mixed 
     */
    public function setTermosIncluidos($termosIncluidos)
    {
        $this->termosIncluidos = $termosIncluidos;
    }
}
