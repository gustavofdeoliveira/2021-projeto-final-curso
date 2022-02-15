<?php
class PublicacaoModel
{
    private $id;
    private $titulo;
    private $categoria;
    private $numeroVisualizacao;
    private $resumo;
    private $imagem;
    private $texto;
    private $redeTermosId;
    private $termosId;

    public function getPublicacao($publicao)
    {
        for ($a = 0; $a != count($publicao); $a++) {
            $publicacoes[] = [
                'id' => $publicao[$a]['id'],
                'titulo' => $publicao[$a]['titulo'],
                'categoria' => $publicao[$a]['categoria']
            ];
        }
        return $publicacoes;
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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed 
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed 
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    /**
     * @return mixed
     */
    public function getNumeroVisualizacao()
    {
        return $this->numeroVisualizacao;
    }

    /**
     * @param mixed 
     */
    public function setNumeroVisualizacao($numeroVisualizacao)
    {
        $this->numeroVisualizacao = $numeroVisualizacao;
    }
    /**
     * @return mixed
     */
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * @param mixed 
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;
    }
    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed 
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }
    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed 
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }
    /**
     * @return mixed
     */
    public function getRedeTermosId()
    {
        return $this->redeTermosId;
    }

    /**
     * @param mixed 
     */
    public function setRedeTermosId($redeTermosId)
    {
        $this->redeTermosId = $redeTermosId;
    }
    /**
     * @return mixed
     */
    public function getTermosId()
    {
        return $this->termosId;
    }

    /**
     * @param mixed 
     */
    public function setTermosId($termosId)
    {
        $this->termosId = $termosId;
    }
}
