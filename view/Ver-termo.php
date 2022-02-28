<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/TermoDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/footer.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar rede de termos | Tereré com Sociologia</title>
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
<body id="dark-mode">
  <?= head() ?>
  <main id="telas-navbar">
    <form action="../control/RedeTermosControl.php" method="POST" class="form-group">
      <div id="ver-termo">
        <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <p id="termo-nome"></p>
                <div class="pull-right" id="rede-botoes">

                </div>
              </div>
              <hr id="rede-hr">
            </div>

            <div class="row">
              <div class="col-xl-12">
                <p id="rede-descricao-texto"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <p id="termo-rede">este termo está presente na(s) seguinte(s) rede(s) de termo: </p>
                <div id="rede-termos-balao"></div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4">
            <div class="row">
              <div id="publicacao-semelhantes">
              <button href="../view/Linha-tempo.php" id="termo-botao">Ir para Linha do Tempo de Publicações</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
  <?= setFooter() ?>
  <script src="../javascript/bootstrap.bundle.min.js">
  </script>
  <script src="../javascript/scripts.js"></script>
  <script src="../javascript/script-bell.js"></script>
  <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>