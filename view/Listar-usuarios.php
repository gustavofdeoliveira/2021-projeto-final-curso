<?php
include_once("../database/Connection.php");
require_once("../dao/UsuarioDao.php");
require_once('../components/header.php');
require_once("../components/tabela-listar-usuarios.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários | Tereré com Sociologia</title>
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
            <div class="col-xl-12">
                <p id="titulo-cadastrar-rede">listar usuários</p>
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-lg-md-9 col-sm-12">
                        <form class="d-flex">
                            <div class="input-group">
                                <span class="input-group-text span-icon-buscar-usuarios" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="navbar-input-busca-usuarios form-control" placeholder="digite o nome do usuário" aria-describedby="basic-addon1">
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if (!empty($_SESSION["msg_error"])) {
                    echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-9  col-lg-9'>
                                <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle aria-hidden='true'></i> {$_SESSION["msg_error"]}</div>
                            </div></div>
                        ";
                }
                if (!empty($_SESSION["msg_sucess"])) {
                    echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                                <div class='alert alert-success' role='alert'> <i class='fa fa-check-circle-o' aria-hidden='true'></i> {$_SESSION["msg_sucess"]}</div>
                            </div></div>
                        ";
                } ?>
                <div class="row ">
                    <div class="col-xl-12">
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <td scope="col" style="width: 50px;">
                                            <div class="listar-balao">id</div>
                                        </td>
                                        <td scope="col" style="width: 300px;">
                                            <div class="listar-balao">nome</div>
                                        </td>
                                        <td scope="col" style="width: 180px;">
                                            <div class="listar-balao">nível de acesso</div>
                                        </td>
                                        <td scope="col" style="width: 180px;">
                                            <div class="listar-balao">data de cadastro</div>
                                        </td>
                                        <th style="width: 75px;text-align: center;">
                                            <div class="row"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $tabela_usuarios = listarUsuarios ();
                                    echo $tabela_usuarios; ?>
                                </tbody>
                            </table>
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