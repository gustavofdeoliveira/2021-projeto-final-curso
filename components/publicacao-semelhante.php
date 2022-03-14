<?php
require_once __DIR__ . '../../control/PublicacaoControl.php';

function setPublicacaoSemelhante()
{
    $variavel = "numeroVisualizacao";
    $ordem = "DESC";
    $publicacaoControl = new PublicacaoControl();
    $publicacao = $publicacaoControl->listagemIndex($variavel, $ordem);
    if (!empty($publicacao)) {
        $semalhantes_titulo = '<p id="texto-publicacao-semelhante">Publicações relevantes</p>';
        $semalhantes = '';
        for ($a = 0; $a != count($publicacao); $a++) {
            $semalhantes .= '<img class="img-publicacao-semelhante" id="img-publicacao-semelhante" src="' . $publicacao[$a]['imagem'] . '"><a class="titulo-publicacao-semelhante" target="_blank" href="//localhost/Terere-com-Sociologia/view/Ver-publicacao.php?id=' . $publicacao[$a]['id'] . '">' . $publicacao[$a]['titulo'] . '</a>';
        }
        return $semalhantes_titulo . $semalhantes;
    }
}
