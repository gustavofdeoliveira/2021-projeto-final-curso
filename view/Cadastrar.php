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
    <title>Criar conta | Tereré com Sociologia</title>
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
                            <img id="img-logo" class="img-logo-cadastrar" src="../image/Logo-claro.png">
                        </div>
                    </div>
                    <form action="../control/UsuarioControl.php" method="POST" class="form-group">
                        <div class="row">
                            <div class="col-xl-8 col-xl-offset-2 col-sm-offset-1 col-lg-offset-2 col-md-10 col-md-offset-1">
                                <p id="titulo-criar-conta">crie a<br> sua conta</p>
                                <p id="possui-conta">Já faz parte do blog? <a id="fazer-login" href="Login.php">Fazer login</a></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-criar-conta" for="nomeCompleto">nome completo</label>
                                    <div class="input-group">
                                        <input required class="input-criar-conta form-control" type="text" name="nomeCompleto">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-sm-offset-0 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-criar-conta" for="email">e-mail</label>
                                    <div class="input-group">
                                        <input required class="input-criar-conta form-control" type="text" onkeyup="validacaoEmail(email)" id="email" name="email">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-xl-8 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="form-label label-criar-conta" for="nomeUsuario">nome de usuário</label>
                                    <div class="input-group input-group-criar-conta">
                                        <div class="input-group-prepend">
                                            <div class="input-group-nomeUsuario">@</div>
                                        </div>
                                        <input type="text" required class="input-criar-conta-nomeusuario form-control" name="nomeUsuario">
                                        <span class="error span-error"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-sm-offset-0 col-md-8 col-md-offset-1 col-xl-6 col-xl-offset-2 col-lg-8 col-lg-offset-2">
                                <div class="form-group input-senha">
                                    <label class="form-label label-criar-conta" for="senha">senha</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input required class="input-criar-conta form-control" id="senha" type="password" onkeyup="senhaValida(senha)" name="senha">
                                        <span id="error" class="error span-error"></span>
                                        <div class="input-group-addon" onclick="mostrar()" >
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </div>
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
                            <div class="col-lg-6 col-lg-offset-2 col-md-offset-1 col-md-10 col-xl-8 col-xl-offset-2 col-sm-12 col-sm-offset-0 col-sm-offset-0">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3 col-sm-offset-0 col-md-offset-0 col-md-8 col-xl-5 col-lg-6 col-lg-8 col-lg-offset-0 col-xl-offset-0">
                                        <input type="hidden" name="acao" value="cadastro">
                                        <input class="btn-criar-conta btn btn-lg" type="submit" value="criar conta">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 login-right d-hidden">
                    <div class="col-lg-10 col-lg-offset-1">
                        <p id="titulo-login">Tudo<br> sobre<br>sociologia<br>em um só<br>lugar</p>
                        <p id="frase-login">participe da nossa comunidade,<br> aprenda de forma interativa</p>
                    </div>

                    <img id="icon-login" class="icon-login" src="../image/Bg-Login-Icon-Claro.png">
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