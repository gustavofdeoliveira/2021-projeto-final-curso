<?php
class TermoModel
{
    private $id;
    private $tipoTermo;
    private $nome;
    private $nomeVariavel;
    private $conceito;

    public function getTermo($termo)
    {
        for ($a = 0; $a != count($termo); $a++) {
            $termos[] = [
                'id' => $termo[$a]['id'],
                'tipo' => $termo[$a]['tipoTermo'],
                'nome' => $termo[$a]['nome'],
                'conceito' => $termo[$a]['conceito']
            ];
        }
        return $termos;
    }

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
