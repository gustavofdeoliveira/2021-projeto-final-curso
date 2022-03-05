<?php
require_once __DIR__ . '/../control/PublicacaoControl.php';

function setPublicacoesRecentes()
{
    $variavel = "dataInclusao";
    $ordem = "DESC";
    $publicacaoControl = new PublicacaoControl();
    $publicacoes = $publicacaoControl->listagemIndex($variavel, $ordem);
    if (!empty($publicacoes)) {
        $publicacoes_index = "";
        for ($a = 0; $a != count($publicacoes); $a++) {
          $publicacoes_index .= 
          '<div class="col-xl-4">
            <form action="control/PublicacaoControl.php" method="POST" class="form-group">
            <input type="hidden"  name="acao" value="atualizarNumeroVisualizacao">
            <input type="hidden"  name="numeroVisualizacao" value="'.$publicacoes[$a]["numeroVisualizacao"].'">
              <div class="container-publicacao">
                <button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacoes[$a]['id'] . '">
                  <p>' . $publicacoes[$a]["titulo"] . '</p>
                  <img src="image/icons/ICON-ENTRAR.png">
                  <div class="overlay"></div>
                </button>
                <img class="container-publicacao-img" src="' . $publicacoes[$a]["imagem"] . '">
              </div>
              </form>
            </div>';
      }
        return $publicacoes_index;
    }else{
        return null;
    }
}
