<?php
class RedeTermosModel
{
    private $id;
    private $nome;
    private $descricao;
    private $termosIncluidos;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed 
     */
    public function setId($id)
    {
        $this->id = $id;
    }
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
