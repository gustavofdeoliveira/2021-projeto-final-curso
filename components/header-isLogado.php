<?php
require_once __DIR__ . '/header-notificacao.php';
require_once __DIR__ . '/header-nivel.php';
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/2021-projeto-final-curso/config.php');

function verifica_login($usuario)
{
    if ($usuario != null) {
        $fotoAvatar = $usuario['fotoAvatar'];
    } else {
        $usuario = '';
    }

    if (empty($usuario)) {
        return  '
            <li class="nav-item">
                <a class="nav-link btn-navbar-login" href="' . $_SESSION['SERVIDOR'] . '/view/Login.php">Fazer Login</a></li>';
    } else {
        $_SESSION['notificacao'] = array(0 => array('nome' => '@natan_pastore', 'texto' => 'comentou na sua publicação'), 1 => array('nome' => '@franco_harlos', 'texto' => 'respondeu o seu comentário'), 2 => array('nome' => '@ju_kashima', 'texto' => 'respondeu o seu comentário'), 3 => array('nome' => '@natan_pastore', 'texto' => 'comentou na sua publicação'), 4 => array('nome' => '@franco_harlos', 'texto' => 'respondeu o seu comentário'), 5 => array('nome' => '@ju_kashima', 'texto' => 'respondeu o seu comentário'));;

        $notificacoes = $_SESSION["notificacao"];

        if (isset($notificacoes)) {
            $numeroNotificacoes = count($_SESSION["notificacao"]);
        }
        return   '
        <li class="nav-item dropdown nav-meu-espaco">
            <div class="d-flex">
                <img src="' . $usuario["fotoAvatar"] . '" alt="Foto de Perfil" class="rounded-circle">
                <a class="nav-link nav-meu-espaco" href="' . $_SESSION['SERVIDOR'] . '/view/Meu-espaco.php">Meu espaço</a>               
                <div class="wrapper">
                    <div class="notification" id="notification">' .
            $notificacao = verifica_notificacao($notificacoes, $numeroNotificacoes) .
            '</div>
                </div>';
    }
}
