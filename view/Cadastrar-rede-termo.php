<?php
include_once("../database/Connection.php");
require_once("../dao/RedeTermosDao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar rede de termos | Tereré com Sociologia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../javascript/jquery.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

</head>


<body id="dark-mode">
<header>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 ">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="col-xl-3 col-md-4 col-sm-10 col-sm-offset-1 col-lg-3">
            <a class="navbar-brand" href="../index.php"><img id="img-logo" class="navbar-img-logo" src="../image/Logo-claro.png"></a>
          </div>
          <div class=" col-xl-9 col-md-8 col-sm-10 col-sm-offset-1 col-lg-9">
            <form class="d-flex">
              <div class="input-group input-group-navbar">
                <span class="input-group-text span-icon-buscar" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input type="text" class="navbar-input-busca form-control" placeholder="descubra algo incrível..." aria-describedby="basic-addon1">
              </div>
              <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
            </form>
          </div>
        </nav>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 ">
        <nav class="navbar navbar-expand-lg w-100">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="../index.php">Início</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="#">Linha do Tempo</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="../view/Sobre-Nos.php">Sobre Nós</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="#">Biblioteca</a>
                    </li>
                    <?php
                    if (!empty($_SESSION["usuarioAutenticado"])) {
                      $usuario = $_SESSION["usuarioAutenticado"];
                      echo " 
                                            <li class='nav-item dropdown nav-meu-espaco'>
                                                <div class='d-flex'>
                                                    <img src='{$usuario['fotoAvatar']}' alt='Foto de Perfil' class='rounded-circle'>
                                                    <a class='nav-link nav-meu-espaco' href='../view/'  role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                    Meu espaço</a>                  
                                                    <div class='wrapper'>
                                                        <div class='notification' >";
                      $_SESSION['notificacao'] = array(0 => array('nome' => '@natan_pastore', 'texto' => 'comentou na sua publicação'), 1 => array('nome' => '@franco_harlos', 'texto' => 'respondeu o seu comentário'), 2 => array('nome' => '@ju_kashima', 'texto' => 'respondeu o seu comentário'), 3 => array('nome' => '@natan_pastore', 'texto' => 'comentou na sua publicação'), 4 => array('nome' => '@franco_harlos', 'texto' => 'respondeu o seu comentário'), 5 => array('nome' => '@ju_kashima', 'texto' => 'respondeu o seu comentário'));
                      $numeroNotificacoes = count($_SESSION['notificacao']);
                      if ($numeroNotificacoes) {
                        echo "<i class='fa fa-bell'></i> 
                                                            <div class='notify-count count1 common-count' count='{$numeroNotificacoes}'>
                                                                <div class='value numero-notificacoes'>{$numeroNotificacoes}</div>
                                                            </div>
                                                            ";
                      } else {
                        echo "<i class='fa fa-bell-o'></i>";
                      }
                      echo "</div>
                                                        <div class='notification-dropdown dd'>
                                                            <div class='header'>
                                                                <div class='container'>
                                                                    <div class='text fl'>Notificações</div>
                                                                </div>
                                                            </div>
                                                            <div class='items'>";
                      for ($i = 0; $i != count($_SESSION['notificacao']); $i++) {
                        $nome = $_SESSION['notificacao'][$i]['nome'];
                        $texto = $_SESSION['notificacao'][$i]['texto'];

                        echo "<div class='list-item noti'>
                                                                        <a id='noticacao-item' href='#' class='text fl'>
                                                                        <p class='name fl'>" . $nome . "<span id='texto-notificacao'>" . $texto . "</span></p></a></div>";
                      }
                      echo "</div></div></div></div>
                                                </li>";
                    } ?>
                    <?php
                    if (empty($_SESSION["usuarioAutenticado"])) {
                      echo "
                                            <li class='nav-item'>
                                            <a class='nav-link btn-navbar-login' href='../view/Login.php'>Fazer Login</a>
                                        </li>";
                    } ?>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>
        <?php
        $usuario = $_SESSION["usuarioAutenticado"];
        if ($usuario != null) {
          echo "
                    <div class='header-tools ion-ios-navicon pull-right'>
                        <i class='fa fa-cog' aria-hidden='true'></i>
                    </div> 
                    <div class='sidebar'>
                    <div class='sidebar-overlay animated fadeOut'></div>
                        <div class='sidebar-content'>
                            <p id='configuracao'>Configurações</p>";
          if ($usuario['nivelAcesso'] == 3) {
            echo "
                            <div class='nav-left'>
                                <a href='../view/Meus-dados.php' class='btn-tools'><span class='ion-ios-home-outline'></span>Meus Dados</a>
                                <a class='btn-tools'><span class='ion-ios-list-outline'></span>Sugerir Termo</a>
                                <a class='btn-tools' id='dark-mode-toggle'><span class='ion-ios-list-outline'></span>
                                    <div class='d-flex modo-noturno'>
                                        <div class='texto-modo-noturno'>Modo noturno</div>
                                        <div class='dark-light'>
                                            <svg viewBox='0 0 24 24' stroke='currentColor' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z' />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                
                                <a><span class='ion-ios-list-outline'></span>
                                    <form action='../control/UsuarioControl.php' method='POST' class='form-group'>
                                        <div class='d-flex pull-right btn-sair'>
                                            <input type='hidden' name='acao' value='sair'>
                                            <input class='input-sair' type='submit' value='Sair'>
                                            <i class='fa fa-sign-out' aria-hidden='true'></i>
                                        </div>
                                    </form>
                                </a>
                                
                            </div>";
          }
          if ($usuario['nivelAcesso'] == 1 || $usuario['nivelAcesso'] == 2) {
            echo "
                            <div class='nav-left'>
                            <div id='texto-usuario'>Usuário</div>
                                <a href='../view/Meus-dados.php' class='btn-tools'><span class='ion-ios-home-outline'></span>Meus Dados</a>";
            if ($usuario['nivelAcesso'] == 1) {
              echo "
                                <a href='../view/Listar-usuarios.php' class='btn-tools'><span class='ion-ios-home-outline'></span>Listar Usuários</a>";
            }
            echo "
                                <a class='btn-tools' id='dark-mode-toggle'><span class='ion-ios-list-outline'></span>
                                    <div class='d-flex modo-noturno'>
                                        <div class='texto-modo-noturno'>Modo noturno</div>
                                        <div class='dark-light'>
                                            <svg viewBox='0 0 24 24' stroke='currentColor' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z' />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <div id='texto-usuario'>Publicações</div>
                                <a href='../view/Cadastrar-publicacao.php' class='btn-tools'><span class='ion-ios-list-outline'></span>+ Nova Publicação</a>
                                <a href='../view/Listar-publicacao.php' class='btn-tools'><span class='ion-ios-list-outline'></span>Listar Publicações</a>
                                <div id='texto-usuario'>Termos</div>
                                <a href='../view/Cadastrar-termo.php' class='btn-tools'><span class='ion-ios-list-outline'></span>+ Novo Termo</a>
                                <a href='../view/Listar-termos.php' class='btn-tools'><span class='ion-ios-list-outline'></span>Listar Termos</a>
                                <a href='' class='btn-tools'><span class='ion-ios-list-outline'></span>Ver Sugestões</a>
                                <div id='texto-usuario'>Rede de Termos</div>
                                <a href='../view/Cadastrar-rede-termo.php' class='btn-tools'><span class='ion-ios-list-outline'></span>+ Nova Rede</a>
                                <a href='../view/Listar-redes.php' class='btn-tools'><span class='ion-ios-list-outline'></span>Listar Redes</a>
                                
                                <a><span class='ion-ios-list-outline'></span>
                                    <form action='../control/UsuarioControl.php' method='POST' class='form-group'>
                                        <div class='d-flex pull-right btn-sair'>
                                            <input type='hidden' name='acao' value='sair'>
                                            <input class='input-sair' type='submit' value='Sair'>
                                            <i class='fa fa-sign-out' aria-hidden='true'></i>
                                        </div>
                                    </form>
                                </a>
                                
                            </div>";
          }
          echo "</div></div>";
        }?>
      </div>
    </div>
  </header>
    <main id="telas-navbar">
        <form action="../control/RedeTermosControl.php" method="POST" class="form-group">
            <div class="row">
                <div class="col-xl-12">
                    <p id="titulo-cadastrar-rede">cadastrar rede de termos</p>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colunas-esquerda">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="nome">nome</label>
                                <div class="input-group">
                                    <input required class="input-criar-conta form-control" type="text" name="nome">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="form-label label-criar-publicacao" for="descricao">breve descrição</label>
                                <div class="input-group">
                                    <textarea required class="textarea form-control" rows="4" type="text" name="descricao"></textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <form action="../control/TermoControl.php" method="POST" class="form-group" id="pesquisa-temo">
                                <div class="form-group">
                                    <label class="form-label label-criar-publicacao" for="termos_incluidos">termos incluídos</label>

                                    <div class="input-group">
                                        <div class="balao-container" id="termos-container"></div>
                                        <input class="input-criar-conta termos form-control" rows="6" onkeyup="carrega_termos(this.value)" type="text" name="termos_incluidos" id="termos_incluidos">
                                        <span id="resultado_pesquisa"></span>
                                        <input required type="hidden" name="termos" class="form-control" id="termos">
                                        <span class="error" id="error"></span>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colunas-direita">
                    <div class="row">
                        <div class="col-xl-12">
                            <p id="consideracao">considerações<br>importantes</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <ul>
                                <li id="texto-estilo">verifique se a rede de termos que você quer cadastrar <span>já não foi cadastrada</span></li>
                                <li id="texto-estilo"><span>revise seus textos</span>, eles devem ser redigidos na norma-padrão da língua portuguesa</li>
                                <li id="texto-estilo">certifique-se de que os termos incluídos na rede <span>estejam correlacionados e que essa relação seja compreensível</span> a partir dos </li>
                                <li id="texto-estilo">seus textos devem ter <span>caráter didático e descritivo</span>, abstendo-se de opiniões</li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if (!empty($_SESSION["msg_error"])) {
                        echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                                <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle aria-hidden='true'></i> {$_SESSION["msg_error"]}</div>
                            </div></div>
                        ";
                    } else if (!empty($_SESSION["msg_sucess"])) {
                        echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                                <div class='alert alert-success' role='alert'> <i class='fa fa-check-circle-o' aria-hidden='true'></i> {$_SESSION["msg_sucess"]}</div>
                            </div></div>
                        ";
                    } ?>
                    <div class="row">
                        <div class="col-xl-10 col-sm-12 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-offset-0">
                            <input type="hidden" name="acao" value="redeTermos">
                            <input class="btn-adicionar btn btn-lg" type="submit" value="adicionar rede">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="../javascript/bootstrap.bundle.min.js">
    </script>
    <script src="../javascript/scripts.js"></script>
    <script src="../javascript/script-bell.js"></script>
    <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>