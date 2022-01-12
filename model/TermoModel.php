<?php
class TermoModel
{
    private $tipoTermo;
    private $nome;
    private $nomeVariavel;
    private $conceito;
    /**
     * @return mixed
     */
    public function getTipoTermo()
    {
        return $this->tipoTermo;
    }

    /**
     * @param mixed 
     */
    public function setTipoTermo($tipoTermo)
    {
        $this->tipoTermo = $tipoTermo;
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
    public function getNomeVariavel()
    {
        return $this->nomeVariavel;
    }

    /**
     * @param mixed 
     */
    public function setNomeVariavel($nomeVariavel)
    {
        $this->nomeVariavel = $nomeVariavel;
    }
    /**
     * @return mixed
     */
    public function getConceito()
    {
        return $this->conceito;
    }

    /**
     * @param mixed 
     */
    public function setConceito($conceito)
    {
        $this->conceito = $conceito;
    }
}
