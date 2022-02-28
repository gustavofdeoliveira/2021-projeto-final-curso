<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/UsuarioDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/footer.php';
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca | Tereré com Sociologia</title>
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
      <di class="col-xl-12">
        <div class="row">
          <p id="texto-biblioteca">Biblioteca</p>

          <p>Encontre todos os termos de sociologia aqui, separados por ordem alfabética</p>

          <a class="balao-vermelho" href="">A</a>
          <a class="balao-verde" href="">B</a>
          <a class="balao-vermelho" href="">C</a>
          <a class="balao-verde" href="">D</a>
          <a class="balao-vermelho" href="">E</a>
          <a class="balao-verde" href="">F</a>
          <a class="balao-vermelho" href="">G</a>


          <a class="balao-verde" href="">H</a>
          <a class="balao-vermelho" href="">I</a>
          <a class="balao-verde" href="">J</a>
          <a class="balao-vermelho" href="">K</a>
          <a class="balao-verde" href="">L</a>
          <a class="balao-vermelho" href="">M</a>
          <a class="balao-verde" href="">N</a>

          <a class="balao-vermelho" href="">O</a>
          <a class="balao-verde" href="">P</a>


          <a class="balao-vermelho" href="">Q</a>
          <a class="balao-verde" href="">R</a>
          <a class="balao-vermelho" href="">S</a>
          <a class="balao-verde" href="">T</a>
          <a class="balao-vermelho" href="">U</a>


          <a class="balao-verde" href="">V</a>
          <a class="balao-vermelho" href="">W</a>
          <a class="balao-verde" href="">X</a>
          <a class="balao-vermelho" href="">Y</a>
          <a class="balao-verde" href="">Z</a>



        </div>
      </di>
    </div>
  </main>
  <?= setFooter() ?>
  <script src="../javascript/bootstrap.bundle.min.js">
  </script>
  <script src="../javascript/scripts.js"></script>
  <script src="../javascript/script-bell.js"></script>
</body>

</html>