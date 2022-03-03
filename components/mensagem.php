<?php
function setMensagens(){
    
    if (!empty($_SESSION["msg_error"])) {
        return "<div class='row'>
            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle aria-hidden='true'></i> {$_SESSION["msg_error"]}</div>
            </div></div>
        ";
    } if (!empty($_SESSION["msg_sucess"])) {
        return "<div class='row'>
            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                <div class='alert alert-success' role='alert'> <i class='fa fa-check-circle-o' aria-hidden='true'></i> {$_SESSION["msg_sucess"]}</div>
            </div></div>
        ";
    } 
}