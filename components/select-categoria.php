<?php
function verificaSelect()
{
    if (!empty($_SESSION['publicacao'])) {
        if ($_SESSION['publicacao'][0]['categoria'] == 'Publicação Conteudista') {
            $categoria = "Publicação Conteudista";
            $publicacao = "<option selected>Publiçacão Conteudista</option>";
            $atualidade = "<option>Atualidade Sociológica</option>";
        }
        if ($_SESSION['publicacao'][0]['categoria'] == 'Atualidade Sociológica') {
            $categoria = "Atualidade Sociológica";
            $atualidade = "<option selected>Atualidade Sociológica</option>";
            $publicacao = "<option>Publicação Conteudista</option>";
        }
        return '<select required class="custom-select" id="select-termo" name="categoria" value="' . $categoria . '">' . $publicacao . '
    ' . $atualidade . '
  </select>';
    }
}
