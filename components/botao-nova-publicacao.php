<?php
require_once __DIR__ . '../../dao/UsuarioDao.php';

function setButaoPublicacao()
{
    $usuario = $_SESSION['usuarioAutenticado'];
    if (!empty($usuario)) {
        if ($usuario['nivelAcesso'] == 1 || $usuario['nivelAcesso'] == 2) {
            return '<div class="col-xl-4 col-lg-4 col-md-4">
                        <a href="../view/Cadastrar-publicacao.php" class="adicionar-termos pull-right"><i class="fa fa-plus"></i> nova publicação</a>
                    </div> ';
        }
    }
}
