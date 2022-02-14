<?php
include_once __DIR__ .'../database/Connection.php';
require_once __DIR__ .'../dao/TermoDao.php';
require_once __DIR__ . '../../components/header.php';
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Termo | Tereré com Sociologia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../javascript/jquery.js"></script>
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
</head>


<body id="dark-mode">
<?= head() ?>
    <main id="telas-navbar" name="editar-termo">
        <form action="../control/TermoControl.php" method="POST" class="form-group">
            <div class="row">
                <div class="col-xl-12">
                    <p id="titulo-cadastrar-rede">editar termo</p>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="nome">nome</label>
                                <div class="input-group">
                                    <input class="input-criar-conta form-control" type="hidden" style="display: none;" id="idTermo" name="idTermo">
                                    <input required class="input-criar-conta form-control" type="text" id="nome" name="nome" disabled>
                                    <i class="editar fa fa-pencil-square-o" aria-hidden="true" onclick="ativaCampo(nome)"></i>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-categoria" for="tipoTermo">tipo de termo</label>
                                <select required class="custom-select" id="select-termo" name="tipoTermo">
                                    <option selected>Selecionar...</option>
                                    <option value="conceito">Conceito (ex: Ação Social, Fato Social, Etnocentrismo)</option>
                                    <option value="teórico">Teórico (ex: Durkheim, Weber, Comte)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="conceito">definição</label>
                                <div class="input-group">
                                    <textarea required class="textarea form-control" rows="4" type="text" id="conceito" name="conceito" value="<?php $termo["conceito"]?>" disabled></textarea>
                                    <i class="editar fa fa-pencil-square-o" aria-hidden="true" onclick="ativaCampo(conceito)"></i>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="nomeVariavel">variações de nome <span id="texto-opcional">(opcional)</span></label>
                                <div class="input-group">
                                    <input class="input-criar-conta form-control" type="text" id="nomeVariavel" name="nomeVariavel" disabled>
                                    <i class="editar fa fa-pencil-square-o" aria-hidden="true" onclick="ativaCampo(nomeVariavel)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <p id="consideracao">considerações<br>importantes</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <ul>
                                <li id="texto-estilo">verifique se suas <span>alterações</span> não vão defasar o significado do termo</li>
                                <li id="texto-estilo"><span>revise seus textos</span>, eles devem ser redigidos na norma-padrão da língua portuguesa</li>
                                <li id="texto-estilo">seu texto deve ter <span>caráter didático e descritivo</span>, abstendo-se de opiniões</li>
                            </ul>
                        </div>
                    </div>
                    <?php

                    if (!empty($_SESSION["msg_error"])) {
                        echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                                <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle aria-hidden='true'></i> {$_SESSION["msg_error"]}</div>
                            </div></div>
                        ";
                    } else if (!empty($_SESSION["msg_sucess"])) {
                        echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                                <div class='alert alert-success' role='alert'> <i class='fa fa-check-circle-o' aria-hidden='true'></i> {$_SESSION["msg_sucess"]}</div>
                            </div></div>
                        ";
                    } ?>
                    <div class="row">
                        <div class="col-xl-10 col-sm-12 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-offset-0">
                            <input type="hidden" name="acao" value="editarTermo">
                            <input class="btn-adicionar-termo btn btn-lg" type="submit" onclick="habilitaCampoTermo()" value="salvar alterações">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="../javascript/bootstrap.bundle.min.js">
    </script>
    <script src="../javascript/scripts.js"></script>
    <script src="../javascript/script-bell.js"></script>
    <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>