<?php
require_once __DIR__ . "../../control/RedeTermosControl.php";

function retornaBalao()
{
    if (!empty($_SESSION['id_rede']) AND $_SESSION['id_rede'] !=0) {
        $RedeTermosControl = new RedeTermosControl;
        $rede_publicacao = $RedeTermosControl->pesquisaRedeTermos($_SESSION['id_rede']);
        return '<div class="rede-balao" id="' . $rede_publicacao[0]['id'] . '" value="' . $rede_publicacao[0]['nome'] . '">' . $rede_publicacao[0]['nome'] . '<div class="balao-fechar"  onclick="fecharRedeBalao(' . $rede_publicacao[0]['id'] . ')"><i class="fa fa-times" aria-hidden="true"></i></div></div>';
    }else{
        return '';
    }
}
