<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/RedeTermosDao.php';
require_once __DIR__ . '../../components/header.php';
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Rede de Termos | Tereré com Sociologia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../javascript/jquery.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

</head>


<body id="dark-mode" name="editar-rede">
    <?= head() ?>
    <main id="telas-navbar">
        <form action="../control/RedeTermosControl.php" method="POST" class="form-group">
            <div class="row">
                <div class="col-xl-12">
                    <p id="titulo-cadastrar-rede">cadastrar rede de termos</p>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colunas-esquerda">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="nome">nome</label>
                                <div class="input-group">
                                    <input class="input-criar-conta form-control" type="hidden" id="idRede" name="idRede">
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
                                <label class="form-label label-criar-publicacao" for="descricao">breve descrição</label>
                                <div class="input-group">
                                    <textarea required class="textarea form-control" rows="4" type="text" id="descricao" name="descricao" disabled></textarea>
                                    <i class="editar fa fa-pencil-square-o" aria-hidden="true" onclick="ativaCampo(descricao)"></i>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="termos_incluidos">termos incluídos</label>
                                <div class="input-group">
                                    <div class="balao-container" id="termos-container"></div>
                                    <input class="input-criar-conta termos form-control" rows="6" onkeyup="carrega_termos(this.value)" type="text" name="termos_incluidos" id="termos_incluidos">
                                    <span id="resultado_pesquisa"></span>
                                    <input required type="hidden" name="termos" class="form-control" id="termos">
                                    <span class="error" id="error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colunas-direita">
                    <div class="row">
                        <div class="col-xl-12">
                            <p id="consideracao">considerações<br>importantes</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <ul>
                                <li id="texto-estilo">verifique se suas <span>alterações</span> não vão defasar o significado da rede de termos</li>
                                <li id="texto-estilo"><span>revise seus textos</span>, eles devem ser redigidos na norma-padrão da língua portuguesa</li>
                                <li id="texto-estilo">certifique-se de que os termos incluídos na rede <span>estejam correlacionados e que essa relação seja compreensível</span> a partir dos </li>
                                <li id="texto-estilo">seus textos devem ter <span>caráter didático e descritivo</span>, abstendo-se de opiniões</li>
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
                            <input type="hidden" name="acao" value="atualizarRede">
                            <input class="btn-adicionar btn btn-lg" type="submit" value="salvar alterações" onclick="habilitaCampoRedes()">
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