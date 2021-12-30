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
    <title>Tererê com Sociologia | Cadastrar-se</title>
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

        <div class="col-sm-12 col-xl-12 col-sm-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 login-fundo-branco">
                    <div class="row all-conteudo">
                        <div class="col-xl-6 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 col-md-9 col-md-offset-1 col-xl-offset-2">
                            <img id="img-logo-login" class="img-logo-cadastrar" src="../image/Logo-claro.png">
                        </div>
                    </div>
                    <form action="../control/CadastroControl.php" method="POST" class="form-group">
                        <div class="row">
                            <div class="col-xl-8 col-xl-offset-2 col-sm-offset-1 col-lg-offset-2 col-md-10 col-md-offset-1">
                                <p id="titulo-criar-conta">crie a<br> sua conta</p>
                                <p id="possui-conta">Já faz parte do blog? <a id="fazer-login" href="">Fazer login</a></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-criar-conta" for="nomeCompleto">nome completo</label>
                                    <input required class="input-criar-conta form-control" type="text" name="nomeCompleto">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-sm-offset-0 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-criar-conta" for="email">e-mail</label>
                                    <input required class="input-criar-conta form-control" onkeypress="validacaoEmail(email)" type="text" name="email">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-criar-conta" for="nomeUsuario">nome de usuário</label>
                                    <div class="input-group input-nome-usuario">
                                        <div class="input-group-prepend">
                                            <div class="input-group-nomeUsuario"><i class="fa fa-at" aria-hidden="true"></i></div>
                                        </div>
                                        <input type="text" required class="input-criar-conta-nomeusuario form-control" name="nomeUsuario">
                                        <span class="error"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-sm-offset-0 col-md-8 col-md-offset-1 col-xl-6 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group input-senha">
                                    <label class="form-label label-criar-senha" for="senha">senha</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input required class="input-criar-senha form-control" type="password" name="senha">
                                        <div class="input-group-addon" onclick="mostrar()">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </div>
                                        <span class="error"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php

                        if (!empty($_SESSION["msg_error"])) {
                            echo "
                            <div class='col-sm-10 col-sm-offset-1 col-sm-offset-0 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2'>
                                <div class='alert alert-danger' role='alert'>{$_SESSION["msg_error"]}                      </div>
                            </div>
                        ";
                        } ?>
                        <input name="theme" type="checkbox" class="toggle-dark-mode" />
                        <div class="row btn-espacamento">
                            <div class="col-lg-6 col-lg-offset-2 col-md-offset-1 col-md-10 col-xl-8 col-xl-offset-2 col-sm-8 col-sm-offset-1 col-sm-offset-0">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-1 col-md-offset-0 col-md-8 col-xl-5 col-lg-6 col-lg-8 col-lg-offset-0 col-xl-offset-0">
                                        <input type="hidden" name="acao" value="1">
                                        <input class="btn-criar-conta btn btn-lg" type="submit" value="criar conta">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <button id="dark-mode-toggle" class="dark-mode-toggle">mudar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-sm-12 d-none d-sm-block col-md-6 col-xl-6 col-lg-6 login-right d-none d-sm-block">
                    <div class="col-lg-10 col-lg-offset-2">
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