<?php
require_once __DIR__ . '/../control/PublicacaoControl.php';

function setPublicacaoConteudista()
{
    $categoria = "Publicação Conteudista";
    $publicacaoControl = new PublicacaoControl();
    $publicacoes = $publicacaoControl->listagemLinhaTempo($categoria);
    
    if (!empty($publicacoes)) {
        $publicacoes_index = "";
        for ($a = 0; $a != count($publicacoes); $a++) {
            $publicacoes_index .=
            '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <form action="../control/PublicacaoControl.php" method="POST" class="form-group">
              <input type="hidden"  name="acao" value="atualizarNumeroVisualizacao">
              <input type="hidden"  name="numeroVisualizacao" value="' . $publicacoes[$a]["numeroVisualizacao"] . '">
                <div class="container-publicacao">
                  <button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' . $publicacoes[$a]['id'] . '">
                    <p>' . $publicacoes[$a]["titulo"] . '</p>
                    <img src="../image/icons/ICON-ENTRAR.png">
                    <div class="overlay"></div>
                  </button>
                  <img class="container-publicacao-img" src="' . $publicacoes[$a]["imagem"] . '">
                </div>
                </form>
              </div>';
      }
        return '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div id="carousel-item">
           ' . $publicacoes_index. '
          </div>
        </div>
      </div>';
    } else {
        return null;
    };
}
