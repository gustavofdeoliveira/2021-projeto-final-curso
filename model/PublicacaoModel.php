<?php
class PublicacaoModel
{
    private $id;
    private $titulo;
    private $categoria;
    private $numeroVisualizacao;
    private $resumo;
    private $imagemTeorico;
    private $texto;
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
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * @param mixed 
     */
    public function setImagem($resumo)
    {
        $this->resumo = $resumo;
    }
}
