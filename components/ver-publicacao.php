<?php
require_once __DIR__ . '../../control/PublicacaoControl.php';
require_once __DIR__ . '../../components/mensagem.php';
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

function verPublicacao()
{
    $conn = Connection::conectar();

    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    $_SESSION['pesquisa'] = $url[1];
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
        $id_rede = $id_termos[1]['id_rede'];
        $query_termo = "SELECT * FROM `redetermos` WHERE `id` =:id";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id_rede);
        $result->execute();

        $row =  $result->fetch(PDO::FETCH_ASSOC);
        $publicacao['redeTermos'][0] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'descricao' => $row['descricao'],
            'dataInclusao' => $row['dataInclusao'],
        ];
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

    $sql = "SELECT * FROM `usuarios_publicacoes_salvas` WHERE `id_publicacao`=:id";
    $result = $conn->prepare($sql);
    $result->bindParam(':id', $_SESSION['pesquisa']);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        $isSalva = true;
    } else {
        $isSalva = false;
    }

    $query_rede = "SELECT DISTINCT `id_publicacao` FROM `publicacao_termo_rede_termos` 
    WHERE `id_rede` =:id  AND `id_publicacao` !=:id_ignorado LIMIT 3";
    $result = $conn->prepare($query_rede);
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
        $rede = '<p id="rede-publicacao">' . $publicacao['redeTermos'][0]['nome'] . '</p>';
    }
    if (!empty($publicacao['semelhantes'])) {

        $semalhantes_titulo = '<p id="texto-publicacao-semelhante">Publicações semelhantes</p>';
        $semalhantes = '';
        for ($a = 0; $a != count($publicacao['semelhantes']); $a++) {
            $semalhantes .= '<img class="img-publicacao-semelhante" id="img-publicacao-semelhante" src="' . $publicacao['semelhantes'][$a]['imagem'] . '"><a class="titulo-publicacao-semelhante" target="_blank" href="//localhost/2021-projeto-final-curso/view/Ver-publicacao.php?id=' . $publicacao['semelhantes'][$a]['id'] . '">' . $publicacao['semelhantes'][$a]['titulo'] . '</a>';
        }
    } else {
        $semalhantes_titulo = '';
        $semalhantes = '';
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
        }
        if ($isSalva == false) {
            $btn_salvar = '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
                '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="salvarPublicacao"><button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacao[0]['id'] . '">' .
                '<i class="fa fa-verde fa-bookmark-o" aria-hidden="true"></i></button></form>';
        }
        if($isSalva == true){
            $btn_salvar = '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
                '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="removerPublicacao"><button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacao[0]['id'] . '">' .
                '<i class="fa fa-verde fa-bookmark" aria-hidden="true"></i></button></form>';
        }
    } else {
        $btn_edicao = "";
        $btn_salvar = "";
    }

    return '<div class="row">
    <div class="col-xl-8 col-lg-8">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <p id="titulo-publicacao">' . $publicacao[0]["titulo"] . '</p>
                <div class="row">
                    <p id="texto-resumo">' . $publicacao[0]["resumo"] . '</p>
                </div>
                '.setMensagens().'
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
