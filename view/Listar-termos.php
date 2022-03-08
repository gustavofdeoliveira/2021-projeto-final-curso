<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/UsuarioDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/table-listar-termos.php';
require_once __DIR__ . '../../components/footer.php';
require_once __DIR__ . '../../components/mensagem.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Termos | Tereré com Sociologia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../javascript/jquery.js"></script>
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
</head>


<body id="dark-mode">
    <?= head() ?>
    <main id="telas-navbar">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <a href="../view/Cadastrar-termo.php" class="adicionar-termos"><i class="fa fa-plus"></i> adicionar novo termo</a>
                    </div>
                </div>
                <p id="titulo-cadastrar-rede">listar termos</p>
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-lg-md-9 col-sm-12">
                        <form class="d-flex">
                            <div class="input-group">
                                <span class="input-group-text span-icon-buscar-usuarios" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="navbar-input-busca-usuarios form-control" placeholder="digite o nome do termo" aria-describedby="basic-addon1">
                            </div>
                        </form>
                    </div>
                </div>
                <?= setMensagens() ?>
                <div class="row ">
                    <div class="col-xl-12">
                        <div class="row">
                            <table id="table">
                                <thead>
                                    <tr>
                                        <td scope="col" style="width: 50px;">
                                            <div class="listar-balao">id</div>
                                        </td>
                                        <td scope="col" style="width: 280px;">
                                            <div class="listar-balao">nome</div>
                                        </td>
                                        <td scope="col" style="width: 100px;">
                                            <div class="listar-balao">tipo</div>
                                        </td>
                                        <td scope="col" style="width: 220px;">
                                            <div class="listar-balao">data de cadastro</div>
                                        </td>
                                        <th style="width: 75px;text-align: center;">
                                            <div class="row"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tabela_termos = listarTermos();
                                    echo $tabela_termos; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?= setFooter() ?>
    <script src="../javascript/bootstrap.bundle.min.js">
    </script>
    <script src="../javascript/scripts.js"></script>
    <script src="../javascript/script-bell.js"></script>
    <script src="../ajax/scripts-ajax.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
                }
            });
        });
    </script>
</body>

</html>