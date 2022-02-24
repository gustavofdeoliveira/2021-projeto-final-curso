<?php
require_once __DIR__ . '/../control/PublicacaoControl.php';

function listarPublicacao(){
    $publicacaoControl = new PublicacaoControl();
    $publicacao = $publicacaoControl->listarPublicacao();
    $tabela_publicacao = '';
    for ($a = 0; $a != count($publicacao); $a++) {
        $data_inclusao = new DateTime($publicacao[$a]['dataInclusao']);
        $tabela_publicacao .= '<tr id="id-redes">' .
            '<td class="texto-codigo">' . $publicacao[$a]["id"] . '</td>' .
            '<td class="texto-nome">' . $publicacao[$a]["titulo"] . '</td>' .
            '<td class="texto-codigo">' . $publicacao[$a]["categoria"]. '</td>' .
            '<td class="texto-codigo">' . $data_inclusao->format('d/m/Y') . '</td>' .
            '<td style="text-align:center;display:flex">' .
            '<a href="../view/Ver-publicacao.php?id=' . $publicacao[$a]['id'] .
            '" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>' .

            '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
            '<input class="btn-excluir-atualizar" style="display:none" type="hidden" name="idPublicacao" value="' . $publicacao[$a]['id'] . '">' .
            '<button class="btn-excluir-atualizar" type="submit" name="acao" value="pesquisarPublicacao">' .
            '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></form>'.

            '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' .
            '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirTermo">' .
            '<button class="btn-excluir-atualizar" type="submit" name="Termo" value="' . $publicacao[$a]['id'] . '">' .
            '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>' .
            '</tr>';
    }
    return $tabela_publicacao;
}