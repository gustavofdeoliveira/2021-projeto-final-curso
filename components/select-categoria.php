<?php
function verificaSelect()
{
    if ($_SESSION['publicacao'][0]['categoria'] == 'Publicacão Conteudista') {
        $categoria = "Publicacão Conteudista";
        $publicacao = "selected";
        $atualidade = "";
    }
    if ($_SESSION['publicacao'][0]['categoria'] == 'Atualidade Sociológica') {
        $categoria = "Atualidade Sociológica";
        $atualidade = "selected";
        $publicacao = "";
    }
    return '<select required class="custom-select" id="select-termo" name="categoria" value="' . $categoria . '">
    <option' . $publicacao . '>Publicacão Conteudista</option>
    <option' . $atualidade . '>Atualidade Sociológica</option>
  </select>';
}
