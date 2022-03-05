<?php
require_once __DIR__ . '/../control/UsuarioControl.php';

function listarUsuarios()
{
    $UsuarioControl = new UsuarioControl();
    $usuarios = $UsuarioControl->listarUsuario();
    $tabela_usuarios = '';
    for ($a = 0; $a != count($usuarios); $a++) {
        if ($usuarios[$a]['nivel'] == 1) {
            $nivel = '<td class="texto-codigo">Administrador</td>';
        }
        if ($usuarios[$a]['nivel'] == 2) {
            $nivel = '<td class="texto-codigo"> Professor</td>';
        }
        if ($usuarios[$a]['nivel'] == 3) {
            $nivel = '<td class="texto-codigo">Aluno</td>';
        }
        $data_inclusao = new DateTime($usuarios[$a]['dataInclusao']);
        $tabela_usuarios .= '<tr id="id-redes">' .
            '<td class="texto-codigo">' . $usuarios[$a]["id"] . '</td>' .
            '<td class="texto-nome">' . $usuarios[$a]["nome"] . '</td>' .
            $nivel .
            '<td class="texto-data">' . $data_inclusao->format('d/m/Y'). '</td>' .
            '<td style="text-align:center;display:flex">' .
            
            '<form action="../control/UsuarioControl.php" method="POST" class="form-group">' .
            '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="atualizaNivel">' .
            '<button class="btn-excluir-atualizar" type="submit" name="Usuario" value="' . $usuarios[$a]['id'] . '" >' .
            '<i class="fa fa-long-arrow-up" aria-hidden="true"></i></button></form>' .

            '<form action="../control/UsuarioControl.php" method="POST" class="form-group">' .
            '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirUsuario">' .
            '<button class="btn-excluir-atualizar" type="submit" name="Usuario" value="' . $usuarios[$a]['id'] . '">' .
            '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>';
    }
    return $tabela_usuarios;
}
