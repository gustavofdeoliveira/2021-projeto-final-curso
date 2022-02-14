

<?php
require_once __DIR__ . '/../dao/UsuarioDao.php';
require_once __DIR__ . '/header-nivel.php';
require_once __DIR__ . '/header-notificacao.php';
require_once __DIR__ . '/header-isLogado.php';
require_once __DIR__ . '/header-configuracao.php';

function head(): string
{
  include_once __DIR__ . '/config.php';
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/2021-projeto-final-curso/config.php');

  if ($_SESSION['usuarioAutenticado']) {
    $usuario = $_SESSION['usuarioAutenticado'];
    $fotoAvatar = $usuario['fotoAvatar'];
  } else {
    $usuario = '';
    $fotoAvatar = '';
  }  
  return '<header>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 ">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="col-xl-3 col-md-4 col-sm-10 col-sm-offset-1 col-lg-3">
                    <a class="navbar-brand" href="'.$SERVIDOR.'/index.php"><img id="img-logo" class="navbar-img-logo" src="'.$SERVIDOR.'/image/Logo-claro.png"></a>
                </div>
                <div class=" col-xl-9 col-md-8 col-sm-10 col-sm-offset-1 col-lg-9">
                    <form class="d-flex">
                        <div class="input-group input-group-navbar">
                            <span class="input-group-text span-icon-buscar" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="navbar-input-busca form-control" placeholder="descubra algo incrível..." aria-describedby="basic-addon1">
                        </div>
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
                                        <a class="nav-link" aria-current="page" href="'.$SERVIDOR.'/index.php">Início</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="'.$SERVIDOR.'/view/Linha-tempo.php">Linha do Tempo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="'.$SERVIDOR.'/view/Sobre-Nos.php">Sobre Nós</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="'.$SERVIDOR.'/view/Biblioteca.php">Biblioteca</a>
                                    </li>' 
                                    . $isLogado = verifica_login($usuario, $SERVIDOR). ' 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            </div>
                </div>
            </div>
        </li>
        
    '.$configuracoes = verifica_configuracao($usuario,$SERVIDOR).'
</header>';
}
