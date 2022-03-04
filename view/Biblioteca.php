<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/UsuarioDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/footer.php';
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
          <div class="row">
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="A">A</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="B">B</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="C">C</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="D">D</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="E">E</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="F">F</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="G">G</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="H">H</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="I">I</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="J">J</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="K">K</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="L">L</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="M">M</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="N">N</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="O">O</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="P">P</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="Q">Q</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="R">R</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="S">S</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="T">T</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="U">U</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="V">V</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="W">W</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="X">X</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-vermelho" type="submit" name="letraPesquisa" value="Y">Y</button>
            </form>
            <form action="../control/TermoControl.php" method="POST" class="form-group d-contents">
              <input class="btn-excluir-atualizar" style="display:none" type="hidden" name="acao" value="OrdenarTermo">
              <button class="btn-excluir-atualizar balao-verde" type="submit" name="letraPesquisa" value="Z">Z</button>
            </form>
          </div>
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