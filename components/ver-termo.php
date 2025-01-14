<?php
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));
require_once __DIR__ . '../../components/mensagem-error.php';
require_once __DIR__ . '../../control/TermoControl.php';


function setTermo()
{
    $conn = Connection::conectar();
    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    if (!empty($url[1])) {
        $id_pesquisa = $url[1];
    } else {
        $mensagemError = setMensagemError();
        return $mensagemError;
    }
    if ($url[0] == "termo") {
        $url[1] = utf8_encode(base64_decode($url[1]));
        $id_pesquisa = '';
        $id_url = explode("%20", $url[1]);
        for ($a = 0; $a != count($id_url); $a++) {
            $id_pesquisa .= $id_url[$a] . " ";
        }

        $query_termo = "SELECT * FROM `termo` WHERE `nome`=:nome";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':nome', $id_pesquisa);
        $result->execute();

        if (($result) and ($result->rowCount() != 0)) {
            while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                $id_pesquisa = $row_termo['id'];
            }
        }
    }

    if (!empty($id_pesquisa)) {
        $query_termo = "SELECT * FROM `termo` WHERE `id`=:id";
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
            $sql = "SELECT * FROM `usuarios_termos_salvos` WHERE `id_termo` = :id_termo AND `id_usuario`= :id_usuario";
            $result = $conn->prepare($sql);
            $result->bindParam(':id_termo', $dados['termo']['id']);
            $result->bindParam(':id_usuario', $_SESSION['usuarioAutenticado']['idUsuario']);
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
                $baloes_rede .= '<a id="rede-termo-balao" target="_blank" href="//localhost/Terere-com-Sociologia/view/Ver-rede-termo.php?id=' . $dados['redeTermos'][$a]['id'] . '">' . $dados['redeTermos'][$a]['nome'] . '</a>';
            }
            $redes = '<div class="row">
            <div class="col-xl-12">
              <p id="termo-rede">este termo está presente na(s) seguinte(s) rede(s) de termo: </p>
              <div class="input-group"><div id="rede-termos-balao">' . $baloes_rede . '</div></div>
            </div>
          </div>';
        } else {
            $redes = '';
        }
        if (!empty($dados['semelhantes'])) {
            for ($a = 0; $a != count($dados['semelhantes']); $a++) {
                $semelhantes =  '<img class="img-publicacao-semelhante" id="img-publicacao-semelhante" src="' . $dados['semelhantes'][$a]['imagem'] . '"><a class="titulo-publicacao-semelhante" target="_blank" href="//localhost/Terere-com-Sociologia/view/Ver-publicacao.php?id=' . $dados['semelhantes'][$a]['id'] . '">' . $dados['semelhantes'][$a]['titulo'] . '</a>';
            }
            $btn_linha = ' <div id="publicacao-semelhantes">
            <a href="../view/Linha-tempo.php" id="termo-botao">Ir para Linha do Tempo de Publicações</a>
            </div>';
        } else {
            $btn_linha = '';
            $semelhantes = '';
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
              <p id="rede-descricao-texto">' . $dados['termo']['conceito'] . '</p>
            </div>
          </div>
          ' . $redes . '
        </div>
        <div class="col-xl-4 col-lg-4">
          <div class="row">
          <div id="publicacao-semelhantes">
            ' . $semelhantes . $btn_linha . '
          </div>
          </div>
        </div>
      </div>';
    }
}
function titleTermo()
{
    $conn = Connection::conectar();
    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    if ($url[0] == "termo") {
        $id_pesquisa = '';
        $id_url = explode("%20", $url[1]);
        for ($a = 0; $a != count($id_url); $a++) {
            $id_pesquisa .= $id_url[$a] . " ";
        }
        $query_termo = "SELECT * FROM `termo` WHERE `nome`=:nome";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':nome', $id_pesquisa);
        $result->execute();
        if (($result) and ($result->rowCount() != 0)) {
            while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                $Termo = $row_termo['nome'];
            }
        } else {
            $Termo = "Termo";
        }
        return $Termo;
    }
    if ($url[0] == "id") {
        if (!empty($_SESSION['pesquisa'])) {
            $_SESSION['pesquisa'] = $url[1];
            $TermoControl = new TermoControl;
            $Termo =  $TermoControl->pesquisaTermo($_SESSION['pesquisa']);
            return $Termo[0]['nome'];
        } else {
            return "Termo";
        }
    }
}
