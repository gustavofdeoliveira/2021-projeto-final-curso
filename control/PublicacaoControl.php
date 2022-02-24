<?php
require_once __DIR__ . "../../dao/PublicacaoDao.php";
require_once __DIR__ . "../../model/PublicacaoModel.php";
class PublicacaoControl
{
    private $dao;
    private $modelo;
    private $acao;

    function __construct()
    {
        $this->dao = new PublicacaoDao();
        
        $this->modelo = new PublicacaoModel();
        if (isset($_REQUEST["acao"])) {
            $this->acao = $_REQUEST["acao"];
            $this->verificaAcao();
        }
    }
    public function verificaAcao()
    {
        if ($this->acao) {
            if ($this->acao == "cadastrarPublicacao") {
                $this->inserirPublicacao();
            }
            if ($this->acao == "excluirPublicacao") {
                $this->excluirPublicacao();
            }
            if ($this->acao == "pesquisarPublicacao") {
                $this->pesquisaPublicacao();
            }
            if ($this->acao == "editarPublicacao") {
                $this->editarPublicacao();
            }
        }
    }

    public function inserirPublicacao()
    {
        try {
            $this->modelo->setTitulo($_POST["titulo"]);
            $tmp_img = file_get_contents($_FILES["imagem"]['tmp_name']);
            $imagem = 'data:image/png;base64,' . base64_encode($tmp_img);
            $this->modelo->setImagem($imagem);
            $this->modelo->setCategoria($_POST["categoria"]);
            $this->modelo->setResumo($_POST["resumo"]);
            $this->modelo->setRedeTermosId($_POST["rede"]);
            $this->modelo->setTexto($_POST["texto_publicacao"]);
            $this->modelo->setTermosId($_POST["termosId"]);
            $id_publicacao = $this->dao->inserirPublicacao($this->modelo);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Cadastrar-Publicacao.php");
        }
    }

    public function excluirPublicacao()
    {
        try {
            $this->modelo->setTitulo($_POST["idPublicacao"]);
            $this->dao->excluirPublicacao($this->modelo);
            header("Location:../view/Listar-publicacao.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Listar-publicacao.php");
        }
    }

    public function listarPublicacao()
    {
        $publicao = $this->dao->listarPublicacao();
        $publicacoes = $this->modelo->getPublicacao($publicao);
        return $publicacoes;
    }

    public function pesquisaPublicacao()
    {
        $this->modelo->setId($_POST["idPublicacao"]);
        $publicacao = $this->dao->pesquisaPublicacao($this->modelo);
        $publicacao_formatada = $this->modelo->getPublicacao($publicacao);
        $_SESSION['publicacao'] = $publicacao_formatada;
        header("Location:../view/Editar-publicacao.php");
        return $publicacao_formatada;
    }
    public function editarPublicacao()
    {
        try {
            $this->modelo->setId($_SESSION['publicacao'][0]['id']);
            $this->modelo->setTitulo($_POST["titulo"]);
            //Esse campo verifica se a imagem foi atualizada
            if (isset($_FILES["imagem"])) {
                $tmp_img = file_get_contents($_FILES["imagem"]['tmp_name']);
                $imagem = 'data:image/png;base64,' . base64_encode($tmp_img);
                $this->modelo->setImagem($imagem);
            } 
            $this->modelo->setCategoria($_POST["categoria"]);
            $this->modelo->setResumo($_POST["resumo"]);
            $this->modelo->setRedeTermosId($_POST["rede"]);
            $this->modelo->setTexto($_POST["texto_publicacao"]);
            $this->modelo->setTermosId($_POST["termosId"]);
            print_r($this->modelo);
            // $id_publicacao = $this->dao->inserirPublicacao($this->modelo);
            // header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Cadastrar-Publicacao.php");
        }
    }
}
new PublicacaoControl();
