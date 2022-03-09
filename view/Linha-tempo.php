<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/UsuarioDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/footer.php';
require_once __DIR__ . '../../components/botao-nova-publicacao.php';
require_once __DIR__ . '../../components/atualidades-sociologicas.php';
require_once __DIR__ . '../../components/publicacoes-conteudistas.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Linha Tempo | Tereré com Sociologia</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive-theme.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css.map">
  <link rel="stylesheet" href="../css/bootstrap.css.map">
  <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="../javascript/jquery.js"></script>
  <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<body id="dark-mode">
  <?= head() ?>
  <main id="telas-navbar">
    <div class="row">
      <div class="col-xl-12 col-lg-12 d-flex">
        <div class="col-xl-8 col-lg-8">
          <p id="linha-tempo">Linha do tempo</p>
          <p id="linha-info">Encontre todas as nossas publicações aqui</p>
        </div>
        <?= setButaoPublicacao() ?>
      </div>
    </div>
    <div class="row">
      <label id="sessao-linha-tempo">Atualidades <span id="texto-linha-tempo"> Sociológicas </span> </label>
      <p id="linha-info-menor">a sociologia se encontrando com o que há no seu dia-a-dia.</p>
      <?= setAtualidadesSociologicas() ?>

    </div>
    <div class="row">
      <label id="sessao-linha-tempo"><span id="texto-linha-tempo"> Publicações </span> Conteudistas </label>
      <p id="linha-info-menor">aprofunde-se na teoria de diversos teóricos e conceitos.</p>
      <?= setPublicacaoConteudista() ?>
    </div>
    <!-- <div class="row">
      <label id="sessao-linha-tempo">Resumos <span id="texto-linha-tempo"> da Comunidade </span> </label>
      <p id="linha-info-menor">fixe o que você aprendeu com representações visuais.</p>

    </div> -->

  </main>
  <?= setFooter() ?>
  <script src="../javascript/bootstrap.bundle.min.js">
  </script>
  <script src="../javascript/scripts.js"></script>
  <script src="../javascript/script-bell.js"></script>
  <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>