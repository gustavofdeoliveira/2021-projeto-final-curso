<?php
 
class ResumoModel
{
   private $id;
   private $tema;
   private $imagem;
   private $dataInclusao;
   private $redeTermosId;
   private $termosId;
   private $usuarioId;
 
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
   public function getTema()
   {
       return $this->tema;
   }
 
   /**
    * @param mixed
    */
   public function setTema($tema)
   {
       $this->tema = $tema;
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
   public function getDataInclusao()
   {
       return $this->dataInclusao;
   }
 
   /**
    * @param mixed
    */
   public function setDataInclusao($dataInclusao)
   {
       $this->dataInclusao = $dataInclusao;
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
   /**
    * @return mixed
    */
   public function getUsuarioId()
   {
       return $this->usuarioId;
   }
 
   /**
    * @param mixed
    */
   public function setUsuarioId($usuarioId)
   {
       $this->usuarioId = $usuarioId;
   }
}
