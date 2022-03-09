<?php
class ComentarioModel
{
    private $id;
    private $textoComentario;
    private $idUsuario;
    private $nomeUsuario;
    private $idPublicacao;
    public function getComentario($comentario)
    {
        for ($a = 0; $a != count($comentario); $a++) {
            $comentarios[] = [
                'id' => $comentario[$a]['id'],
                'id_publicacao' => $comentario[$a]['id_publicacao'],
                'textoComentario' => $comentario[$a]['textoComentario'],
                'id_usuario' => $comentario[$a]['id_usuario'],
                'nomeUsuario' => $comentario[$a]['nomeUsuario'],
                'dataInclusao' => $comentario[$a]['dataInclusao'],
            ];
        }
        return $comentarios;
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
    public function getTextoComentario()
    {
        return $this->textoComentario;
    }

    /**
     * @param mixed 
     */
    public function setTextoComentario($textoComentario)
    {
        $this->textoComentario = $textoComentario;
    }
    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed 
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
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
    public function getIdPublicacao()
    {
        return $this->idPublicacao;
    }

    /**
     * @param mixed 
     */
    public function setIdPublicacao($idPublicacao)
    {
        $this->idPublicacao = $idPublicacao;
    }
}
