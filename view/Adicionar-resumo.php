<?php
include_once("../database/Connection.php");
//require_once("../dao/ResumoDao.php");
require_once __DIR__ . '../../components/header.php';
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Adicionar resumo | Tereré com Sociologia</title>
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
   <main id="telas-navbar">
       <form action="../control/ResumoControl.php" method="POST" class="form-group">
           <div class="row">
               <div class="col-xl-12">
                   <p id="titulo-cadastrar-rede">adicionar resumo</p>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                   <div class="row">
                       <div class="col-xl-12">
                           <div class="form-group">
                               <label class="form-label label-criar-publicacao" for="nome">título</label>
                               <div class="input-group">
                                   <input required class="input-criar-conta form-control" type="text" name="nome">
                                   <span class="error"></span>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-xl-12">
                           <div class="form-group">
                               <label class="form-label label-criar-publicacao" for="conceito">breve definição</label>
                               <div class="input-group">
                                   <textarea required class="textarea form-control" rows="4" type="text" name="conceito"></textarea>
                                   <span class="error"></span>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-xl-12">
                           <div class="form-group">
                               <label class="form-label label-criar-publicacao" for="redeTermos">rede de termos <span id="texto-opcional">(opcional)</span></label>
                               <div class="input-group">
                                   <input class="input-criar-conta form-control" type="text" id="redeTermos" onkeyup="carrega_redes(this.value)" name="redeTermos">
                                   <span id="resultado_pesquisa"></span>
                                   <div class="rede-container" id="termos-container"></div>
                                   <input type="hidden" name="rede" class="form-control" id="rede">
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-xl-12">
                           <form action="../control/TermoControl.php" method="POST" class="form-group" id="pesquisa-temo">
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
                           </form>
                       </div>
                   </div>
           </div>
           <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                   <div class="row">
                       <div class="col-xl-12">
                           <div class="input-group">
                            <label class="form-label label-criar-publicacao" for="imagem">resumo <span id="texto-opcional">(faça upload do seu arquivo .jpg ou .png)</span></label>
                                <div class="input-group">
                                    <input class="input-criar-conta form-control" type="hidden" id="file-img" name="file-img">
                                    <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="img" id="img" class="d-none">
                                    <input type="text" class="input-imagem form-control form-control-lg" x-model="fileName">
                                    <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()"><i class="fa fa-image"></i> Carregar</button>
                                </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-xl-12">
                           <p id="consideracao">considerações<br>importantes</p>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-xl-12">
                           <ul>
                               <li id="texto-estilo">seu resumo deve estar <span> completamente legível </span> e em <span> boa qualidade </span></li>
                               <li id="texto-estilo"><span>revise seus textos</span>, procure não se desviar da norma-padrão da língua portuguesa</li>
                               <li id="texto-estilo">extrapole a sua <span>criatividade</span>! amamos ver novas disposições e formas de representar o conteúdo do seu resumo :)</li>
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
                   } if (!empty($_SESSION["msg_sucess"])) {
                       echo "<div class='row'>
                           <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                               <div class='alert alert-success' role='alert'> <i class='fa fa-check-circle-o' aria-hidden='true'></i> {$_SESSION["msg_sucess"]}</div>
                           </div></div>
                       ";
                   } ?>
                   <div class="row">
                       <div class="col-xl-12">
                           <input type="hidden" name="acao" value="inserirResumo">
                           <input class="btn-adicionar-termo btn btn-lg" type="submit" value="compartilhar resumo">
                       </div>
                   </div>
           </div>   
       </form>
   </main>
 
   <script src="../javascript/bootstrap.bundle.min.js">
   </script>
   <script src="../javascript/scripts.js"></script>
   <script src="../javascript/script-bell.js"></script>
</body>
 
</html>
