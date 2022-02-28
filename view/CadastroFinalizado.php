<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/UsuarioDao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta criada! | Tereré com Sociologia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="background-login">

    <main>

        <div class="col-sm-12 col-xl-12 col-sm-12 col-lg-12 position-fixed-sm">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 login-fundo-branco">
                    <div class="row all-conteudo">
                        <div class="col-xl-7 col-sm-10 col-lg-10 col-lg-offset-1 col-md-10 col-sm-offset-1 col-xl-offset-1">
                            <img id="img-logo" class="img-logo-cadastrar" src="../image/Logo-claro.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-xl-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-sm-10 col-sm-offset-1 col-lg-offset-1">
                            <p id="titulo-conta-criada">conta<br>criada!</p>
                            <p id="texto-conta-criada">agora volte a tela inicial<br>pra fazer o seu login:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-xl-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-1">
                            <a id="btn-criar-conta-login" href="../view/Login.php">fazer login</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 d-hidden col-md-6 col-xl-6 col-lg-6 login-right">
                    <div class="row">
                        <div class="col-lg-10 col-xl-10 col-xl-1 col-lg-offset-1">
                            <p id="titulo-cadastro-finalizado">Toda educação humana deve preparar cada um a viver para os outros.</p>

                        </div>
                    </div>

                    <img id="img-cadastro-finalizado" class="img-cadastro-finalizado" src="../image/Bg-Conta-Criada-Icon-Claro.png">

                </div>

            </div>
        </div>
    </main>
    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script src="../javascript/bootstrap.bundle.min.js.map"></script>
    <script src="../javascript/scripts.js"></script>
    <script src="../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
</body>

</html>