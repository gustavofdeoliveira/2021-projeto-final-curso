<?php


function setFooter()
{
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/2021-projeto-final-curso/config.php');
    return '<footer>
    <hr>
    <div class="row" style="justify-content: center;">
      <div class="col-lg-2 col-xl-2">
        <a class="navbar-brand pull-right" href="' . $SERVIDOR . '/index.php"><img id="img-logo" class="navbar-footer-img-logo" src="image/Logo-claro.png"></a>
      </div>
      <div class="col-lg-8 col-xl-8">
        <nav class="navbar navbar-expand-lg w-100">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row">
                  <ul class="navbar-footer">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="' . $SERVIDOR . '/index.php">Início</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="' . $SERVIDOR . '/view/Linha-tempo.php">Linha do Tempo</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="' . $SERVIDOR . '/view/Sobre-Nos.php">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="' . $SERVIDOR . '/view/Biblioteca.php">Biblioteca</a>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>
        <p id="navbar-footer-frase">@Tereré com Sociologia. 2022. Um projeto do IFPR - Campus Foz do Iguaçu</p>
      </div>

      <div class="col-lg-3">

      </div>
    </div>
  </footer>';
}
