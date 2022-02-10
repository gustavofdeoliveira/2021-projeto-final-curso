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
    <title>Meus Dados | Tereré com Sociologia</title>
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
        <div class="col-xl-12">
            <div class="row">
                <form action='../control/UsuarioControl.php' method='POST' class="d-flex">
                    <?php
                    echo "    
                    <div class='col-xl-5 col-lg-5'>
                        <div class='row pull-right'>
                            <img src='{$usuario['fotoAvatar']}' alt='Foto de Usuário' class='rounded-circle img-meus-dados'>
                        </div>
                    </div> 
                    <div class='col-xl-7 col-lg-7'>
                        <p id='meus-dados'>meus dados</p>
                        <div class='row'>
                            <div class='col-xl-9 col-lg-9'>
                                <div class='form-group'>
                                    <label class='form-label label-criar-publicacao' for='nomeCompleto'>nome completo</span></label>
                                    <div class='input-group'>
                                        <input class='input-criar-conta form-control' value='{$usuario['nomeCompleto']}' type='text' id='nomeCompleto' name='nomeCompleto' disabled>
                                        <i class='editar fa fa-pencil-square-o' aria-hidden='true' onclick='ativaCampo(nomeCompleto)'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xl-7 col-lg-8'>
                                <div class='form-group'>
                                    <label class='form-label label-criar-publicacao' for='nomeUsuario'>nome de usuário</span></label>
                                    <div class='input-group'>
                                        <input class='input-criar-conta form-control' type='text' id='nomeUsuario' value='{$usuario['nomeUsuario']}' name='nomeUsuario' disabled>
                                        <i class='editar fa fa-pencil-square-o' aria-hidden='true' onclick='ativaCampo(nomeUsuario)''></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xl-9 col-lg-9'>
                                <div class='form-group'>
                                    <label class='form-label label-criar-publicacao' for='email'>e-mail</span></label>
                                    <div class='input-group'>
                                        <input class='input-criar-conta form-control' type='text' value='{$usuario['email']}' id='email' name='email' disabled>
                                        <i class='editar fa fa-pencil-square-o' aria-hidden='true' onclick='ativaCampo(email)'></i>
                                    </div>
                                </div>
                            </div>
                        "; ?>
                    <div class="row ">
                        <div class="col-xl-10 col-lg-9 col-md-12">
                            <div class="row d-flex">
                                <div class="col-xl-5 col-lg-6 col-md-6">
                                    <button id="alterarSenha" type="button" class="btn-alterar-senha">alterar senha
                                    </button>
                                </div>
                                <div class="col-xl-5 col-lg-6 col-md-6">
                                    <button id="excluirConta" type="button" class="btn-excluir-conta">excluir conta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (!empty($_SESSION["msg_error"])) {
                        echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
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
                    <div class="row">
                        <div class="col-lg-9 col-xl-9">
                            <input type="hidden" name="acao" value="atualizarUsuario">
                            <input class="btn-salvar-alteracao btn btn-lg" type="submit" onclick="habilitaCampoDados()" value="salvar alterações">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form action="../control/UsuarioControl.php" method="POST" class="form-group">
            <div class="col-xl-8 col-xl-offset-2 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" id="modal-avatar">
                <div class="row">
                    <div class="col-xl-12">
                        <button id="fechar-modal-avatar" type="button" class="btn-fechar-senha">X
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-xl-offset-1 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12 col-lg-6 d-flex-smm">
                                <p id="texto-avatar-atual">seu avatar atual:</p>
                                <?php
                                echo "
                  <img src='{$usuario['fotoAvatar']}' id='fotAvatar' alt='Foto de Perfil' class='rounded-circle img-trocar-avatar'>";
                                ?>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12 col-lg-6">
                                <p id="texto-trocar-foto">quer trocar de avatar?</p>
                                <p id="texto-avatar-explicativo">clique no que você deseja usar.</p>
                                <input type="hidden" id="fotoAvatar" name="fotoAvatar">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(3)">
                                        <img src='../image/avatares/Avatar-3.png' id='3' alt='Foto do Avatar' class='rounded-circle img-icone-avatar'>
                                        <p id="avatar-nome">Émile<br><span>Durkheim</span></p>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(6)">
                                        <img src='../image/avatares/Avatar-6.png' id='6' alt='Foto do Avatar' class='rounded-circle img-icone-avatar'>
                                        <p id="avatar-nome">Max<br><span>Weber</span></p>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(4)">
                                        <img src='../image/avatares/Avatar-4.png' id='4' alt='Foto do Avatar' class='rounded-circle img-icone-avatar'>
                                        <p id="avatar-nome">Karl<br><span>Marx</span></p>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(5)">
                                        <img src='../image/avatares/Avatar-5.png' id='5' alt='Foto do Avatar' class='rounded-circle img-icone-avatar'>
                                        <p id="avatar-nome">Simone de<br><span>Beauvoir</span></p>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(2)">
                                        <img src='../image/avatares/Avatar-2.png' id='2' alt='Foto do Avatar' class='rounded-circle img-icone-avatar'>
                                        <p id="avatar-nome">Auguste<br><span>Comte</span></p>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(1)">
                                        <img src='../image/avatares/Avatar-1.png' id='1' alt='Foto do Avatar' class='rounded-circle img-icone-avatar'>
                                        <p id="avatar-nome">Zygmund<br><span>Bauman</span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="acao" value="atualizarAvatar">
                                        <input class="btn-salvar-avatar btn btn-lg" type="submit" value="alterar avatar de perfil">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        </div>


    </main>
    <div class="container">

        <div class="col-xl-4 col-xl-offset-4 col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" id="modal-senha">
            <div class="row">
                <div class="col-xl-12">
                    <button id="fechar-modal-senha" type="button" class="btn-fechar-senha">X
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 col-xl-offset-1 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <p id="texto-senha">alterar senha</p>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-nova-senha" for="senha">senha atual</label>
                                <div class="input-group" id="show_hide_password">
                                    <input required class="input-nova-senha form-control" type="password" name="senha">
                                    <div class="input-group-addon-senha" onclick="mostrar()">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </div>
                                    <span class="error"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group input-senha">
                                <label class="form-label label-nova-senha" for="senhaNova">nova senha</label>
                                <div class="input-group" id="show_hide_password">
                                    <input required class="input-nova-senha form-control" id="senhaNova" type="password" onkeyup="senhaValida(senhaNova)" name="senhaNova">
                                    <span id="error" class="error span-error"></span>
                                    <div class="input-group-addon-senha" onclick="mostrar()">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group input-senha">
                                <label class="form-label label-nova-senha" for="cofirmaSenha">confirmar nova senha</label>
                                <div class="input-group" id="show_hide_password">
                                    <input required class="input-nova-senha form-control" id="cofirmaSenha" type="password" name="cofirmaSenha">
                                    <span id="error" class="error span-error"></span>
                                    <div class="input-group-addon-senha" onclick="mostrar()">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <input type="hidden" name="acao" value="atualizarUsuario">
                            <input class="btn-salvar-alteracao btn btn-lg" type="submit" value="salvar alteração">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="../control/UsuarioControl.php" method="POST" class="form-group">
            <div class="col-xl-4 col-xl-offset-4 col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" id="modal-conta">
                <div class="row">
                    <div class="col-xl-12">
                        <button id="fechar-modal-conta" type="button" class="btn-fechar-senha">X
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-xl-offset-1 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                        <p id="texto-excluir">excluir conta</p>
                        <div class="row">
                            <p id="descricao-excluir">poxa, que pena que<br><span>você está indo embora!</span></p>
                        </div>
                        <div class="row">
                            <p id="descricao-excluir">antes de sair, confirme<br>que é você mesmo que<br>está excluindo sua conta:</p>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="form-label label-excluir-conta" for="senhaExcluir">confirme sua senha</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="input-nova-senha form-control" type="password" name="senhaExcluir">
                                        <div class="input-group-addon-senha" onclick="mostrar()">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </div>
                                        <span class="error"></span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                        if (!empty($_SESSION["msg_error"])) {
                            echo "<div class='row'>
                        <div class='col-xl-12'>
                            <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle aria-hidden='true'></i> {$_SESSION["msg_error"]}</div>
                        </div></div>";
                        } ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <input type="hidden" name="acao" value="excluirUsuario">
                                <input class="btn-excluir btn btn-lg" type="submit" value="excluir minha conta">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="../javascript/bootstrap.bundle.min.js">
    </script>
    <script src="../javascript/scripts.js"></script>
    <script src="../javascript/script-bell.js"></script>
</body>

</html>