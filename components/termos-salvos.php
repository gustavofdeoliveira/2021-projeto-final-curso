<?php
require_once __DIR__ . '/../control/TermoControl.php';

function setTermos()
{
    $termoControl = new TermoControl();
    $termos = $termoControl->listagemTermosSalvos();
    if (!empty($termos)) {
        $termos_salvos = '';
        for ($a = 0; $a != count($termos); $a++) {
            $termos_salvos .= '<a id="rede-termo-balao" target="_blank" href="//localhost/2021-projeto-final-curso/view/Ver-termo.php?id=' . $termos[$a]['id'] . '">' . $termos[$a]['nome'] . '</a>';
        }
        return $termos_salvos;
    }
}
