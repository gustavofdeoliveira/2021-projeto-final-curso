<?php
include_once("../database/Connection.php");
require_once("../dao/CadastroDao.php");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tererê com Sociologia | Conta criada</title>
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
                        <div class="col-xl-7 col-sm-10 col-md-10 col-sm-offset-1 col-xl-offset-1">
                            <img id="img-logo-login" class="img-logo-cadastrar" src="../image/Logo-claro.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-xl-offset-1">
                            <p id="titulo-conta-criada">conta<br>criada!</p>
                            <p id="texto-conta-criada">acesse seu e-mail para realizar<br>a <span id="texto-conta-criada-negrito">confirmação</span> da sua conta.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-xl-offset-1">
                            <a id="btn-criar-conta-login" href="../view/Login.php">fazer login</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 d-none d-sm-block col-md-6 col-xl-6 col-lg-6 login-right">
                    <div class="col-lg-10 col-lg-offset-1">
                        <p id="titulo-login">Tudo<br> sobre<br>sociologia<br>em um só<br>lugar</p>
                        <p id="frase-login">participe da nossa comunidade,<br> aprenda de forma interativa</p>
                    </div>

                    <img class="img-login" src="../image/Bg-Login-Icon-Claro.png">
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