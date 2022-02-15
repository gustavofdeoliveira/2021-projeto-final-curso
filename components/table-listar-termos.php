<?php
require_once __DIR__ . '/../control/TermoControl.php';

function listarTermos()
{
    $termoControl = new TermoControl();
    $termos = $termoControl->listarTermo();
    $tabela_termos = '';
    for ($a = 0; $a != count($termos); $a++) {
        $tabela_termos .= '<tr id="id-termos">' .
            '<td class="texto-codigo">' . $termos[$a]["id"] . '</td>' .
            '<td class="texto-nome">' . $termos[$a]["nome"] . '</td>' .
            '<td class="texto-codigo">' . $termos[$a]["tipo"] . '</td>' .
            '<td class="texto-codigo">' . $termos[$a]["conceito"] . '</td>' .
            '<td style="text-align:center;display:flex">' .
            '<a href="../view/Ver-termo.php?id=' . $termos[$a]['id'] .
            '" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>' .
            '<a href="../view/Editar-termo.php?id=' . $termos[$a]['id'] .
            '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' .
            '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
            '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirTermo">' .
            '<button class="btn-excluir-atualizar" type="submit" name="Termo" value="' . $termos[$a]['id'] . '">' .
            '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>' .
            '</tr>';
    }
    return $tabela_termos;
}
