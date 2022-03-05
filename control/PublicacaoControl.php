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
                $this->atualizarPublicacao();
            }
            if ($this->acao == "salvarPublicacao") {
                $this->salvarPublicacao();
            }
            if ($this->acao == "removerPublicacao") {
                $this->removerPublicacao();
            }
            if ($this->acao == "atualizarNumeroVisualizacao") {
                $this->atualizarNumeroVisualizacao();
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
        try {
            $publicao = $this->dao->listarPublicacao();
            $publicacoes = $this->modelo->getPublicacao($publicao);
            return $publicacoes;
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            print_r($_SESSION["msg_error"]);
        }
    }

    public function pesquisaPublicacao()
    {
        try {
            $this->modelo->setId($_POST["idPublicacao"]);
            $publicacao = $this->dao->pesquisaPublicacao($this->modelo);
            $publicacao_formatada = $this->modelo->getPublicacao($publicacao);
            $_SESSION['publicacao'] = $publicacao_formatada;
            header("Location:../view/Editar-publicacao.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Editar-publicacao.php");
        }
    }

    public function verPublicacao()
    {
        try {
            $this->modelo->setId($_SESSION['pesquisa']);
            $publicacao = $this->dao->pesquisaPublicacao($this->modelo);
            $publicacao_formatada = $this->modelo->getPublicacao($publicacao);
            $_SESSION['publicacao'] = $publicacao_formatada;
            return $publicacao_formatada;
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Ver-publicacao.php");
        }
    }
    public function atualizarPublicacao()
    {
        try {
            $this->modelo->setId($_SESSION['publicacao'][0]['id']);
            $id_publicacao = $this->modelo->setId($_SESSION['publicacao'][0]['id']);
            $this->modelo->setTitulo($_POST["titulo"]);
            if ($_FILES["imagem"]["error"] == 0) {
                $tmp_img = file_get_contents($_FILES["imagem"]['tmp_name']);
                $imagem = 'data:image/png;base64,' . base64_encode($tmp_img);
                $this->modelo->setImagem($imagem);
            }
            $this->modelo->setCategoria($_POST["categoria"]);
            $this->modelo->setResumo($_POST["resumo"]);
            $this->modelo->setRedeTermosId($_POST["rede"]);
            $this->modelo->setTexto($_POST["texto_publicacao"]);
            $this->modelo->setTermosId($_POST["termosId"]);
            $id_publicacao = $this->dao->atualizarPublicacao($this->modelo);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Cadastrar-Publicacao.php");
        }
    }

    public function salvarPublicacao()
    {
        try {
            $this->modelo->setId($_POST["idPublicacao"]);
            $this->dao->salvarPublicacao($this->modelo);
            header("Location:../view/Meu-espaco.php");
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Meu-espaco.php");
        }
    }
    public function removerPublicacao()
    {
        try {
            $id_publicacao = $_POST["idPublicacao"];
            $this->modelo->setId($_POST["idPublicacao"]);
            $this->dao->removerPublicacao($this->modelo);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        }
    }
    public function listagemIndex($variavel, $ordem)
    {
        try {
            $publicacoes = $this->dao->listagemIndex($variavel, $ordem);
            $publicacoes_formatada = $this->modelo->getPublicacao($publicacoes);
            return $publicacoes_formatada;
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../index.php");
        }
    }
    public function atualizarNumeroVisualizacao()
    {
        try {
            $this->modelo->setId($_POST["idPublicacao"]);
            $id_publicacao = $_POST["idPublicacao"];
            $this->modelo->setNumeroVisualizacao($_POST["numeroVisualizacao"] +1);
            $this->dao->atualizarNumeroVisualizacao($this->modelo);
            header("Location:../view/Ver-publicacao.php?id=" . $id_publicacao);
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["msg_tempo_error"] = time();
            header("Location:../index.php");
        }
    }
}
new PublicacaoControl();
