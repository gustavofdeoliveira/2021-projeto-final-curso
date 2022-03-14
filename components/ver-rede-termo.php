<?php
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));
require_once __DIR__ . '../../components/mensagem-error.php';
require_once __DIR__ . '../../control/RedeTermosControl.php';


function setRedeTermo()
{
  $id_url = $_SERVER['QUERY_STRING'];
  $url = explode("=", $id_url);
  $conn = Connection::conectar();
  if (!empty($url[1])) {
    $id_pesquisa = $url[1];
  } else {
    $mensagemError = setMensagemError();
    return $mensagemError;
  }
  if (!empty($id_pesquisa)) {

    $query_publicacao = "SELECT * FROM `redeTermos` WHERE `id`=:id";
    $result = $conn->prepare($query_publicacao);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();


    if (($result) and ($result->rowCount() != 0)) {

      while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
        $dados['redeTermos'] = [
          'id' => $row_publicacao['id'],
          'nome' => $row_publicacao['nome'],
          'descricao' => $row_publicacao['descricao']
        ];
      }
    }

    $query_termo = "SELECT * FROM `rede_termos_termo` as A INNER JOIN `redeTermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_rede` = :id";
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
    if (!empty($dados['termos'])) {
      $baloes_termos = '';
      for ($a = 0; $a != count($dados['termos']); $a++) {
        $baloes_termos .= '<a id="rede-termo-balao" target="_blank" href="//localhost/Terere-com-Sociologia/view/Ver-termo.php?id=' . $dados['termos'][$a]['id'] . '">' . $dados['termos'][$a]['nome'] . '</a>';
      }
    }
    if (!empty($_SESSION['usuarioAutenticado'])) {
      if ($_SESSION['usuarioAutenticado']['nivelAcesso'] == 1 || $_SESSION['usuarioAutenticado']['nivelAcesso'] == 2) {
        $btn_edicao = '<a href="../view/Editar-rede-termo.php?id=' . $dados['redeTermos']['id'] . '"><i class="fa fa-verde fa-pencil-square-o" aria-hidden="true"></i></a>' .
          '<form action="../control/RedeTermosControl.php" method="POST" class="form-group">' .
          '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirRede">' .
          '<button class="btn-excluir-atualizar" type="submit" name="idRede" value="' . $dados['redeTermos']['id'] . '">' .
          '<i class="fa fa-verde fa-trash-o" aria-hidden="true"></i></button></form>';
      } else {
        $btn_edicao = '';
      }
    } else {
      $btn_edicao = '';
    }
    return '<div class="row">
        <div class="col-xl-12">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="row">
                <p id="rede-nome">' . $dados['redeTermos']['nome'] . '</p>
                <div id="rede-botoes">
                ' . $btn_edicao . '
                </div>
              </div>
            </div>
            <hr id="rede-hr">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
            <p id="rede-descricao">descrição:</p>
            <p id="rede-descricao-texto">' . $dados['redeTermos']['descricao'] . '</p>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
            <p id="rede-termos">termos incluídos:</p>
            <div class="input-group">
            <div id="rede-termos-balao">' . $baloes_termos . '</div>
          </div>
          </div>
        </div>
      </div>';
  }
}
function titleRede()
{
    $id_url = $_SERVER['QUERY_STRING'];
    $url = explode("=", $id_url);
    if (!empty($url[1])) {
        $_SESSION['pesquisa'] = $url[1];
        $RedeTermosControl = new RedeTermosControl;
        $RedeTermos =  $RedeTermosControl->pesquisaRedeTermos($_SESSION['pesquisa']);
        return $RedeTermos[0]['nome'];
    } else {
        return "Rede de Termos";
    }
}
