<!-- <?php
//require_once __DIR__ . "../../dao/ResumoDao.php";
require_once __DIR__ . "../../model/ResumoModel.php";
class ResumoControl
{
   private $dao;
   private $modelo;
   private $acao;
 
   function __construct()
   {
    //    $this->dao = new ResumoDao();
       $this->modelo = new ResumoModel();
       $this->acao = $_REQUEST["acao"];
       $this->verificaAcao();
   }
   public function verificaAcao()
   {
       if ($this->acao) {
        //    if ($this->acao == "adicionarResumo") {
        //        $this->adicionarResumi();
        //    }
           if ($this->acao == "excluirResumo") {
               $this->excluirResumo();
           }
       }
   }
  
   public function inserirResumo()
   {
       try {
           $this->modelo->setTema($_POST["tema"]);
           $this->modelo->setImagem($_POST["file-img"]);
           $this->modelo->setRedeTermosId($_POST["rede"]);
           $this->modelo->setTermosId($_POST["termosId"]);
          
           $id_resumo = $this->dao->inserirResumo($this->modelo);
           //header("Location:../view/Ver-resumo.php?id=" . $id_publicacao);
       } catch (\Exception $e) {
           $_SESSION["msg_error"] = $e->getMessage();
           $_SESSION["msg_tempo_error"] = time();
           header("Location:../view/Adicionar-resumo.php");
       }
   }
 
   public function excluirResumo()
   {
       try {
           $this->modelo->setTema($_POST["idPublicacao"]);
           $this->dao->excluirResumo($this->modelo);
            header("Location:../view/Listar-publicacao.php");
       } catch (\Exception $e) {
           $_SESSION["msg_error"] = $e->getMessage();
           $_SESSION["msg_tempo_error"] = time();
           header("Location:../view/Listar-publicacao.php");
       }
   }
}
new ResumoControl(); 
