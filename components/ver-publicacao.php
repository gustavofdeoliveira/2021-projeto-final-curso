<?php
require_once __DIR__ . '../../control/PublicacaoControl.php';
require_once __DIR__ . '../../components/mensagem.php';
require_once __DIR__ . '../../components/mensagem-error.php';
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

function verPublicacao()
{
    $conn = Connection::conectar();

    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    if (!empty($url[1])) {
        $_SESSION['pesquisa'] = $url[1];
    } else {
        $mensagemError = setMensagemError();
        return $mensagemError;
    }

    $publicacaoControl = new PublicacaoControl;
    $publicacao =  $publicacaoControl->verPublicacao($_SESSION['pesquisa']);
    $query_termo = "SELECT `a`.`id`,`a`.`id_publicacao`, `a`.`id_rede`, `a`.`id_termo` FROM `publicacao_termo_rede_termos` as A INNER JOIN `publicacao` as B ON `b`.`id` = `a`.`id_publicacao` WHERE `a`.`id_publicacao` = :id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $_SESSION['pesquisa']);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_termos[] = [
                'id_termo' => $row_id['id_termo'],
                'id_rede' => $row_id['id_rede'],
            ];
        }

        $id_rede = $id_termos[0]['id_rede'];

        if (!empty($id_rede)) {
            $query_termo = "SELECT * FROM `redetermos` WHERE `id` =:id";
            $result = $conn->prepare($query_termo);
            $result->bindParam(':id', $id_rede);
            $result->execute();
            if (($result) and ($result->rowCount() != 0)) {
                $row =  $result->fetch(PDO::FETCH_ASSOC);
                $publicacao['redeTermos'][0] = [
                    'id' => $row['id'],
                    'nome' => $row['nome'],
                    'descricao' => $row['descricao'],
                    'dataInclusao' => $row['dataInclusao'],
                ];
            }
        }
        for ($a = 0; $a != count($id_termos); $a++) {
            $id = $id_termos[$a]['id_termo'];
            $query_termo = "SELECT * FROM `termo` WHERE `id` =:id";
            $result = $conn->prepare($query_termo);
            $result->bindParam(':id', $id);
            $result->execute();

            while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                $publicacao['termos'][$a] = [
                    'id' => $row_termo['id'],
                    'nome' => $row_termo['nome']
                ];
            }
        }
    }

    $sql = "SELECT * FROM `usuarios_publicacoes_salvas` WHERE `id_publicacao`=:id AND `id_usuario`= :id_usuario";
    $result = $conn->prepare($sql);
    $result->bindParam(':id', $_SESSION['pesquisa']);
    if (!isset($_SESSION['usuarioAutenticado'])) {
        $result->bindParam(':id_usuario', $_SESSION['usuarioAutenticado']['idUsuario']);
    }else{
        $id = 0;
        $result->bindParam(':id_usuario', $id);
    }
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        $isSalva = true;
    } else {
        $isSalva = false;
    }

    $sql = "SELECT * FROM `comentario` WHERE `id_publicacao`=:id ORDER BY `dataInclusao` DESC";
    $result = $conn->prepare($sql);
    $result->bindParam(':id', $_SESSION['pesquisa']);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($comentario = $result->fetch(PDO::FETCH_ASSOC)) {
            $comentarios[] = [
                'id' => $comentario['id'],
                'id_publicacao' => $comentario['id_publicacao'],
                'textoComentario' => $comentario['textoComentario'],
                'id_usuario' => $comentario['id_usuario'],
                'nomeUsuario' => $comentario['nomeUsuario'],
                'dataInclusao' => $comentario['dataInclusao']
            ];
        }
        $publicacao['comentarios'] = $comentarios;
    }

    $sql = "SELECT DISTINCT `id_publicacao` FROM `publicacao_termo_rede_termos` 
    WHERE `id_rede` =:id  AND `id_publicacao` !=:id_ignorado LIMIT 3";
    $result = $conn->prepare($sql);
    $result->bindParam(':id', $id_rede);
    $result->bindParam(':id_ignorado', $_SESSION['pesquisa']);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
        while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_publicacao[] = [
                'id_publicacao' => $row_publicacao['id_publicacao']
            ];
        }
        for ($a = 0; $a != count($id_publicacao); $a++) {
            $query_publicacao = "SELECT `id`,`titulo`,`imagem` FROM `publicacao` WHERE `id` = :id LIMIT 3";
            $result = $conn->prepare($query_publicacao);
            $id = $id_publicacao[$a]['id_publicacao'];
            $result->bindParam(':id', $id);
            $result->execute();
            while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
                $publicacao['semelhantes'][$a] = [
                    'id' => $row_publicacao['id'],
                    'titulo' => $row_publicacao['titulo'],
                    'imagem' => $row_publicacao['imagem']
                ];
            }
        }
    }
    if (!empty($publicacao[0]["imagem"])) {
        $imagem = '<img id="img-publicacao" class="img-publicacao" src="' . $publicacao[0]["imagem"] . '">';
    } else {
        $imagem = "";
    }
    if (!empty($publicacao['redeTermos'])) {
        $rede = '<a href="../view/Ver-rede-termo.php?id=' . $publicacao['redeTermos'][0]['id'] . '" id="rede-publicacao">' . $publicacao['redeTermos'][0]['nome'] . '</a>';
    } else {
        $rede = '';
    }
    if (!empty($publicacao['semelhantes'])) {

        $semalhantes_titulo = '<p id="texto-publicacao-semelhante">Publicações semelhantes</p>';
        $semalhantes = '';
        for ($a = 0; $a != count($publicacao['semelhantes']); $a++) {
            $semalhantes .= '<img class="img-publicacao-semelhante" id="img-publicacao-semelhante" src="' . $publicacao['semelhantes'][$a]['imagem'] . '"><a class="titulo-publicacao-semelhante" target="_blank" href="//localhost/Terere-com-Sociologia/view/Ver-publicacao.php?id=' . $publicacao['semelhantes'][$a]['id'] . '">' . $publicacao['semelhantes'][$a]['titulo'] . '</a>';
        }
    } else {
        $semalhantes_titulo = '';
        $semalhantes = '';
    }
    if (!empty($publicacao['comentarios'])) {
        $comenta = '';
        for ($a = 0; $a != count($publicacao['comentarios']); $a++) {
            if (!empty($_SESSION['usuarioAutenticado'])) {
                if ($publicacao['comentarios'][$a]['id_usuario'] == $_SESSION['usuarioAutenticado']['idUsuario']) {
                    $btn_excluir_comentario = '
                    <form action="../control/ComentarioControl.php" method="POST" class="form-group">' .
                        '<input style="display:none" type="hidden" name="acao" value="excluirComentario">' .
                        '<input style="display:none" type="hidden" name="idPublicacao" value="' . $_SESSION['pesquisa'] . '">' .
                        '<button class="btn-excluir-atualizar" type="submit" name="idComentario" value="' . $publicacao['comentarios'][$a]['id'] . '">' .
                        '<div class="comentario-excluir pull-right">
            <i class="fa fa-times" aria-hidden="true"></i>
            </div></button></form>';
                } else {
                    $btn_excluir_comentario = '';
                }
            } else {
                $btn_excluir_comentario = '';
            }
            $comentario_data = new DateTime($publicacao['comentarios'][$a]['dataInclusao']);

            $comentario .= '<div class="comentario">
            <div class="row">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-10">
                <div class="d-flex">
                    <div class="comentario-nome-usuario">@' . $publicacao['comentarios'][$a]['nomeUsuario'] . ' <span>comentou:</span></div>
                    <div class="comentario-data pull-right"><pan>' . $comentario_data->format('d/m/Y') . '</pan></div>
                    </div>
                    <div class="comentario-texto">' . $publicacao['comentarios'][$a]['textoComentario'] . '</div>
                    
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2">
                    ' . $btn_excluir_comentario . '
                </div>
            </div>  
        </div>';
        }
    } else {
        $comentario = '';
    }
    if (!empty($_SESSION['usuarioAutenticado'])) {
        if ($_SESSION['usuarioAutenticado']['nivelAcesso'] == 1 || $_SESSION['usuarioAutenticado']['nivelAcesso'] == 2) {
            $btn_edicao =
                '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
                '<input class="btn-excluir-atualizar" style="display:none" type="hidden" name="idPublicacao" value="' . $publicacao[0]['id'] . '">' .
                '<button class="btn-excluir-atualizar" type="submit" name="acao" value="pesquisarPublicacao">' .
                '<i class="fa fa-verde fa-pencil-square-o" aria-hidden="true"></i></button></form>' .

                '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
                '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirPublicacao">' .
                '<button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacao[0]['id'] . '">' .
                '<i class="fa fa-verde fa-trash-o" aria-hidden="true"></i></button></form>';
        } else {
            $btn_edicao = "";
        }
        if ($isSalva == false) {
            $btn_salvar = '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
                '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="salvarPublicacao"><button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacao[0]['id'] . '">' .
                '<i class="fa fa-verde fa-bookmark-o" aria-hidden="true"></i></button></form>';
        }
        if ($isSalva == true) {
            $btn_salvar = '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
                '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="removerPublicacao"><button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacao[0]['id'] . '">' .
                '<i class="fa fa-verde fa-bookmark" aria-hidden="true"></i></button></form>';
        }
        $btn_comentario = '<button type="submit" name="acao" value="inserirComentario" class="submit-comentario float-right">comentar</button>';
        $place_holder = 'Fazer um comentário...';
        $status_textarea = "";
        $comentario_id_usuario = '<input type="hidden" name="idUsuario" value="' . $_SESSION['usuarioAutenticado']['idUsuario'] . '">';
        $comentario_nome_usuario = '<input type="hidden" name="nomeUsuario" value="' . $_SESSION['usuarioAutenticado']['nomeUsuario'] . '">';
    } else {
        $btn_salvar = "";
        $btn_comentario = "";
        $place_holder = "Você precisa fazer login para comentar...";
        $status_textarea = "disabled";
        $comentario_id_usuario = '';
        $comentario_nome_usuario = '';
        $btn_edicao = "";
    }

    return '<div class="row">
    <div class="col-xl-8 col-lg-8">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <p id="titulo-publicacao">' . $publicacao[0]["titulo"] . '</p>
                <div class="row">
                    <p id="texto-resumo">' . $publicacao[0]["resumo"] . '</p>
                </div>
                ' . setMensagens() . '
                <div class="row">
                    <p id="categoria-publicacao">' . $publicacao[0]["categoria"] . '</p>
                    ' . $rede . '
                <div class="d-contents">' . $btn_salvar . $btn_edicao . '</div>
                </div>
                <div class="row">' . $imagem . '
                </div>
                <div class="row">
                    <p id="texto-publicacao">' . $publicacao[0]["texto"] . '</p>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="col-xl-8">
                <p id="titulo-comentario">comentários</p>
                <hr id="hr-comentario">
                </div>
                <form action="../control/ComentarioControl.php" method="POST" class="form-group">
                <div class="row">
                    <label class="label-comentario">Comentar essa publicação:</label>
                    ' . $comentario_id_usuario . '
                    <input type="hidden" name="idPublicacao" value="' . $_SESSION['pesquisa'] . '">
                    ' . $comentario_nome_usuario . '
                    <textarea  name="comentario" placeholder="' . $place_holder . '" id="comentario" ' . $status_textarea . '></textarea>
                    ' . $btn_comentario . '
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="container-comentario">  
                    ' . $comentario . '
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="row">
            <div id="publicacao-semelhantes">
            ' . $semalhantes_titulo . $semalhantes . '
            </div>
        </div>
    </div>
</div>';
    header("Location:../view/Ver-publicacao.php");
}

function titlePublicacao()
{
    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    if (!empty($url[1])) {
        $_SESSION['pesquisa'] = $url[1];
        $publicacaoControl = new PublicacaoControl;
        $publicacao =  $publicacaoControl->verPublicacao($_SESSION['pesquisa']);
        return $publicacao[0]['titulo'];
    } else {
        return "Publicação";
    }
}
