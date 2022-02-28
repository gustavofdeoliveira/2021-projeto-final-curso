<?php
require_once __DIR__ . '/../control/RedeTermosControl.php';

function listarRede(){
    $redeControl = new RedeTermosControl();
    $redes = $redeControl->listarRedeTermos();
    $tabela_redes = '';
    for ($a = 0; $a != count($redes); $a++) {
        $data_inclusao = new DateTime($redes[$a]['dataInclusao']);
        $tabela_redes .= '<tr id="id-publicacao">' .
            '<td class="texto-codigo">' . $redes[$a]["id"] . '</td>' .
            '<td class="texto-nome">' . $redes[$a]["nome"] . '</td>' .
            '<td class="texto-codigo">' . $data_inclusao->format('d/m/Y') . '</td>' .
            '<td style="text-align:center;display:flex">' .
            '<a href="../view/Ver-rede-termo.php?id=' . $redes[$a]['id'] .
            '" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>' .
            '<a href="../view/Editar-rede-termo.php?id=' . $redes[$a]['id'] .
            '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' .
            '<form action="../control/RedeTermosControl.php" method="POST" class="form-group">' .
            '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirRede">' .
            '<button class="btn-excluir-atualizar" type="submit" name="idRede" value="' . $redes[$a]['id'] . '">' .
            '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>' .
            '</tr>';
    }
    return $tabela_redes;
}