<?php
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));
function setTermo()
{

    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    $id_pesquisa = $url[1];
    $conn = Connection::conectar();

    // $id_pesquisa = 18;
    if (!empty($id_pesquisa)) {

        $query_termo = "SELECT * FROM `termo` WHERE `id`=:id OR 'nome'=:id";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id_pesquisa);
        $result->execute();


        if (($result) and ($result->rowCount() != 0)) {

            while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados['termo'] = [
                    'id' => $row_publicacao['id'],
                    'nome' => $row_publicacao['nome'],
                    'conceito' => $row_publicacao['conceito']
                ];
            }
        }

        $query_termo = "SELECT `id_publicacao` FROM `publicacao_termo_rede_termos` as A INNER JOIN `termo` as B ON `b`.`id` = `a`.`id_termo` WHERE `a`.`id_termo` = :id LIMIT 3";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id_pesquisa);
        $result->execute();
        if (($result) and ($result->rowCount() != 0)) {
            while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
                $id_publicacao[] = [
                    'id_publicacao' => $row_id['id_publicacao']
                ];
            }

            for ($a = 0; $a != count($id_publicacao); $a++) {
                $id = $id_publicacao[$a]['id_publicacao'];

                $query_termo = "SELECT * FROM `publicacao` WHERE `id` =:id";
                $result = $conn->prepare($query_termo);
                $result->bindParam(':id', $id);
                $result->execute();

                while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados['semelhantes'][$a] = [
                        'id' => $row_termo['id'],
                        'titulo' => $row_termo['titulo'],
                        'imagem' => $row_termo['imagem']

                    ];
                }
            }
        }
        $query_termo = "SELECT `id_rede` FROM `rede_termos_termo` as A INNER JOIN `redetermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_termo` = :id LIMIT 3";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id_pesquisa);
        $result->execute();
        if (($result) and ($result->rowCount() != 0)) {
            while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
                $id_redes[] = [
                    'id_rede' => $row_id['id_rede']
                ];
            }
            for ($a = 0; $a != count($id_redes); $a++) {
                $id = $id_redes[$a]['id_rede'];

                $query_rede = "SELECT * FROM `redetermos` WHERE `id` =:id";
                $result = $conn->prepare($query_rede);
                $result->bindParam(':id', $id);
                $result->execute();

                while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados['redeTermos'][$a] = [
                        'id' => $row_termo['id'],
                        'nome' => $row_termo['nome']
                    ];
                }
            }
        }
        $query_termo = "SELECT `id_termo` FROM `rede_termos_termo` as A INNER JOIN `redetermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_rede` = :id LIMIT 5;";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id_pesquisa);
        $result->execute();

        if (($result) and ($result->rowCount() != 0)) {
            while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
                $id_termos[] = [
                    'id_termo' => $row_id['id_termo']
                ];
            }

            for ($a = 0; $a != count($id_termos); $a++) {
                $id = $id_termos[$a]['id_termo'];

                $query_termo = "SELECT * FROM `termo` WHERE `id` =:id";
                $result = $conn->prepare($query_termo);
                $result->bindParam(':id', $id);
                $result->execute();

                while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados['termos'][$a] = [
                        'id' => $row_termo['id'],
                        'nome' => $row_termo['nome']
                    ];
                }
            }
        }
        if (!empty($_SESSION['usuarioAutenticado'])) {
            $sql = "SELECT * FROM `usuarios_termos_salvos` WHERE `id_termo` = :id_termo";
            $result = $conn->prepare($sql);
            $result->bindParam(':id_termo', $dados['termo']['id']);
            $result->execute();
            $result->fetch(PDO::FETCH_ASSOC);
            if (($result) and ($result->rowCount() == 0)) {
                $btn_salvar = '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="salvarTermo"><button class="btn-excluir-atualizar" type="submit" name="idTermo" value="' . $dados['termo']['id'] . '">' .
                    '<i class="fa fa-verde fa-bookmark-o" aria-hidden="true"></i></button></form>';
            } else {
                $btn_salvar = '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="removerTermo"><button class="btn-excluir-atualizar" type="submit" name="idTermo" value="' . $dados['termo']['id'] . '">' .
                    '<i class="fa fa-verde fa-bookmark" aria-hidden="true"></i></button></form>';
            }
            if ($_SESSION['usuarioAutenticado']['nivelAcesso'] == 1 || $_SESSION['usuarioAutenticado']['nivelAcesso'] == 2) {
                $btn_edicao =
                    '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                    '<input class="btn-excluir-atualizar" style="display:none" type="hidden" name="idTermo" value="' . $dados['termo']['id'] . '">' .
                    '<button class="btn-excluir-atualizar" type="submit" name="acao" value="verTermo">' .
                    '<i class="fa fa-verde fa-pencil-square-o" aria-hidden="true"></i></button></form>' .

                    '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirTermo">' .
                    '<button class="btn-excluir-atualizar" type="submit" name="Termo" value="' . $dados['termo']['id'] . '">' .
                    '<i class="fa fa-verde fa-trash-o" aria-hidden="true"></i></button></form>';
            } else {
                $btn_edicao = '';
            }
        } else {
            $btn_salvar = '';
            $btn_edicao = "";
        }
        $baloes_rede = '';
        if (!empty($dados['redeTermos'])) {
            for ($a = 0; $a != count($dados['redeTermos']); $a++) {
                $baloes_rede .= '<a id="rede-termo-balao" target="_blank" href="//localhost/2021-projeto-final-curso/view/Ver-rede-termo.php?id=' . $dados['redeTermos'][$a]['id'] . '">' . $dados['redeTermos'][$a]['nome'] . '</a>';
            }
            $redes = '<div class="row">
            <div class="col-xl-12">
              <p id="termo-rede">este termo está presente na(s) seguinte(s) rede(s) de termo: </p>
              <div id="rede-termos-balao">' . $baloes_rede . '</div>
            </div>
          </div>';
        } else {
            $redes = '';
        }
        if (!empty($dados['semelhantes'])) {
            for ($a = 0; $a != count($dados['semelhantes']); $a++) {
                $semelhantes =  '<img class="img-publicacao-semelhante" id="img-publicacao-semelhante" src="' . $dados['semelhantes'][$a]['imagem'] . '"><a class="titulo-publicacao-semelhante" target="_blank" href="//localhost/2021-projeto-final-curso/view/Ver-publicacao.php?id=' . $dados['semelhantes'][$a]['id'] . '">' . $dados['semelhantes'][$a]['titulo'] . '</a>';
            }
            $btn_linha = ' <div id="publicacao-semelhantes">
            <a href="../view/Linha-tempo.php" id="termo-botao">Ir para Linha do Tempo de Publicações</a>
            </div>';
        } else {
            $btn_linha = '';
            $semelhantes ='';
        }
        return '<div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
          <div class="row">
            
              <p id="termo-nome">' . $dados['termo']['nome'] . '</p>
              <div class="pull-right" id="rede-botoes">
                ' . $btn_salvar . $btn_edicao . '
              </div>
            
            <hr id="rede-hr">
          </div>

          <div class="row">
            <div class="col-xl-12">
              <p id="rede-descricao-texto">' . $dados['termo']['nome'] . '</p>
            </div>
          </div>
          ' . $redes . '
        </div>
        <div class="col-xl-4 col-lg-4">
          <div class="row">
            '.$semelhantes.$btn_linha.'
          </div>
        </div>
      </div>';
    } else {
        return null;
    }
}
