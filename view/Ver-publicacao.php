<?php
include_once("../database/Connection.php");
require_once("../dao/UsuarioDao.php");
require_once __DIR__ . '../../components/header.php';
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicação | Tereré com Sociologia</title>
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
        <div id="ver-publicacao">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <p id="titulo-publicacao"></p>
                            <div class="row">
                                <p id="texto-resumo"></p>
                            </div>
                            <div class="row">
                                <div id="categoria-rede"></div>
                                <p id="categoria-publicacao"></p>
                            </div>
                            <div class="row">
                                <img id="img-publicacao" class="img-publicacao" src="">
                            </div>
                            <div class="row">
                                <p id="texto-publicacao"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="row">
                        <div id="publicacao-semelhantes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../javascript/bootstrap.bundle.min.js">
    </script>
    <script src="../javascript/scripts.js"></script>
    <script src="../javascript/script-bell.js"></script>
    <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>