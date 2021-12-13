<?php
include_once("../database/conexao.php");
require_once("../dao/LoginDao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tererê com Sociologia | Entrar</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
</head>

<body class="background-login">

    <header>

    </header>
    <main>

        <div class="col-sm-12 col-xl-12 col-sm-12 col-lg-12 position-fixed-sm">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 login-fundo-branco">
                    <div class="row all-conteudo">
                        <div class="col-xl-10 col-sm-10 col-sm-offset-1 col-xl-offset-1">
                            <img class="img-logo-login" src="../image/Logo.png">
                        </div>
                    </div>
                    <form method="POST" action="../control/LoginControl.php">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1  col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-login" for="nmUsuario">E-mail | Nome de
                                        Usuário</label>
                                    <input class="form-control input-login" type="text" name="nomeUsuario">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-sm-offset-0 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-login" for="nmSenha">Senha</label>
                                    <input class="form-control input-login" type="password" name="Senha">
                                </div>
                            </div>
                        </div>
                        <div class="row btn-espacamento">
                            <div class="col-lg-8 col-lg-offset-2 col-md-offset-1 col-md-10 col-xl-8 col-xl-offset-2 col-sm-12 col-sm-offset-0">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3 col-md-offset-2 col-md-8 col-xl-5 col-lg-6 col-lg-8 col-lg-offset-2 col-xl-offset-0">
                                        <input type="hidden" name="acao" value="1">
                                        <input class="btn-login btn btn-lg" type="submit" value="Entrar">
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-2 col-md-offset-1 col-md-10 col-xl-7 col-lg-10 col-lg-offset-1 col-xl-offset-0 col-lg-6">
                                        <input id="checkbox-login" type="checkbox">
                                        <label for="checkbox-login" class="mantenha-conectado">Manter-se
                                            conectado</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row btn-espacamento">
                            <div class="col-xl-8 col-md-offset-1 col-sm-offset-1 col-lg-8 col-lg-offset-2 col-md-10 col-xl-offset-2">
                                <a class="login-esqueceu-senha" href="">Esqueceu a sua senha?</a>
                            </div>
                            <div class="col-xl-8 col-lg-offset-2 col-sm-offset-1 col-md-offset-1 col-xl-offset-2">
                                <p class="novo-registro">Ainda não tem uma conta? <br class="d-block d-sm-none"><a id="novo-registro"
                                        href="">Registrar-se</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-lg-offset-1">
                                <img class="img-login" src="../image/BG-LOGIN-ICON.png">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 d-none d-sm-block col-md-6 col-xl-6 col-lg-6 login-right">
                    <div class="col-lg-10 col-lg-offset-1">
                        <p id="titulo-login">Tudo<br> sobre<br>sociologia<br>em um só<br>lugar</p>
                        <p id="frase-login">participe da nossa comunidade,<br> aprenda de forma interativa</p>
                    </div>

                    <img class="img-login" src="../image/BG-LOGIN-ICON.png">
                </div>


            </div>
        </div>
    </main>
    <footer>

    </footer>
    <script src="../javascript/bootstrap.bundle.min.js"></script>
</body>

</html>