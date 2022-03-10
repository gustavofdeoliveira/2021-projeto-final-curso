<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/PublicacaoDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/footer.php';
require_once __DIR__ . '../../components/mensagem.php';
require_once __DIR__ . '../../components/publicacoes-salvas.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu Espaço | Tereré com Sociologia</title>
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
    <div class="row">
      <div class="col-xl-12">
        <p id="titulo-criar-publicacao">Meu Espaço</p>
        <?= setMensagens() ?>

        <!-- <div class="row no-gutters">
            <div class="col-xl">
                <label id="sessao-meu-espaco">minhas anotações</label>
            </div>
            <div class="col-lg">
                <a href="../view/Nova-anotacao.php" class="adicionar-termos"><i class="fa fa-plus"></i> nova anotação</a>
            </div>
          </div> -->

        <!-- <div class="row">
            <div class="col-xl">
                <label id="sessao-meu-espaco">meus resumos</label>
            </div>
            <div class="col">
                <a href="../view/Adicionar-resumo.php" class="adicionar-termos"><i class="fa fa-plus"></i> novo resumo</a>
            </div>
          </div> -->

        <div class="row">
          <div class="col-xl-6 col-lg-6">
            <label id="sessao-meu-espaco">publicações salvas</label>
          </div>
          <div class="col-xl-6 col-lg-6">
            <a href="../view/Linha-tempo.php" class="adicionar-termos">Acessar Linha do Tempo</a>
          </div>
          <div class="row">
            <?= setPublicacoesSalvas() ?>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-lg-6">
            <label id="sessao-meu-espaco">termos salvos</label>
          </div>
          <div class="col-xl-6 col-lg-6">
            <a href="../view/Biblioteca.php" class="adicionar-termos">Acessar Biblioteca</a>
          </div>
        </div>

        <img id="icon-login-secundario" class="icon-login" src="../image/IMG-MEUESPACO.png">
      </div>
    </div>
  </main>
  <?= setFooter() ?>
  <script src="../javascript/bootstrap.bundle.min.js"></script>
  <script src="../javascript/scripts.js"></script>
  <script src="../javascript/script-bell.js"></script>

</body>

</html>