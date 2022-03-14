<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/Terere-com-Sociologia/config.php');

function verifica_notificacao(array $notificacoes, $numeroNotificacoes)
{
    $notificacaoTotal = '';
    for ($i = 0; $i != count($notificacoes); $i++) {
        $nome = $notificacoes[$i]["nome"];
        $texto = $notificacoes[$i]["texto"];

        $notificacaoTotal .=   '<div class="list-item noti">
                        <a id="noticacao-item" href="#" class="text fl">
                        <p class="name fl">"' . $nome . '"<span id="texto-notificacao">"' . $texto . '"</span></p></a></div>';
    }
    if ($numeroNotificacoes != 0) {
        $notificacao =  '<i class="fa fa-bell"></i> 
                            <div class="notify-count count1 common-count" count="' . $numeroNotificacoes . '">
                                <div class="value numero-notificacoes">' . $numeroNotificacoes . '</div>
                            </div>';
        $notificacaoRestante = '</div>
            <div class="notification-dropdown dd">
                <div class="header">
                    <div class="container">
                        <div class="text fl">Notificações</div>
                    </div>
                </div>
                <div class="items">'.$notificacaoTotal;
        
    } else {
        $notificacao = '<i class="fa fa-bell-o"></i>';
    }
    return $notificacao.$notificacaoRestante;
}
