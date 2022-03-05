<?php
include_once __DIR__ . '/database/Connection.php';
require_once __DIR__ . '/dao/UsuarioDao.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/footer.php';
require_once __DIR__ . '/components/publicacoes-relevantes.php';
require_once __DIR__ . '/components/publicacoes-recentes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tereré com Sociologia</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive-theme.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css.map">
  <link rel="stylesheet" href="css/bootstrap.css.map">
  <link rel="shortcut icon" href="image/Logo-claro.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="javascript/jquery.js"></script>
  <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
</head>


<body id="dark-mode">
  <?= head() ?>

  <main id="telas-navbar">
    <div class="row">
      <div class="col-xl-8">
        <div class="row">
          <p id="sessao-linha-tempo"><span id="texto-linha-tempo"> Mais </span> Relevantes <img src="image/icons/ICON-LIVRO.png"> </p>
        </div>
        <div class="row">
          <div class="container-publicacoes-relevantes">
            <?= setPublicacoesReleavantes() ?>
          </div>
        </div>
      </div>

      <div class="col-xl-4">
        <p id="sessao-linha-tempo">Resumos<span id="texto-linha-tempo"> da Comunidade </span><img src="image/icons/ICON-LIVRO.png"> </p>
      </div>

      <div class="col-xl-8">
        <p id="sessao-linha-tempo"><span id="texto-linha-tempo"> Publicações </span> Recentes <img src="image/icons/ICON-LIVRO.png"> </p>
        <div class="container-publicacoes-relevantes">
          <?= setPublicacoesRecentes() ?>

        </div>
      </div>

    </div>

    <div class="row">
      <p id="texto-slogan">Tudo sobre <br> <span id="texto-slogan-alt">sociologia</span> em <br> um só lugar</p>
      <p id="texto-slogan-menor">participe da nossa comunidade, <br> aprenda de forma interativa</p>
    </div>

  </main>

  <?= setFooter() ?>

  <script src="javascript/bootstrap.bundle.min.js"></script>
  <script src="javascript/scripts.js"></script>
  <script src="javascript/script-bell.js"></script>
  <script src="javascript/scripts.js"></script>
</body>

</html>