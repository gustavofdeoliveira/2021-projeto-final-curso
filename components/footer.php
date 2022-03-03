<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/2021-projeto-final-curso/config.php');

function setFooter()
{
    return '<footer>
    <hr>
    <div class="row" style="justify-content: center;">
      <div class="col-lg-2 col-xl-2">
        <a class="navbar-brand pull-right" href="' . $_SESSION['SERVIDOR'] . '/index.php"><img id="img-logo" class="navbar-footer-img-logo" src="' . $_SESSION['SERVIDOR'] . '/image/Logo-claro.png"></a>
      </div>
      <div class="col-lg-8 col-xl-8">
        <nav class="navbar navbar-expand-lg w-100">
          <div class="container-fluid footer-container">
            <div class=" navbar-collapse" id="navbarNavDropdown">
              <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row">
                  <ul class="navbar-footer">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="' . $_SESSION['SERVIDOR'] . '/index.php">Início</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="' . $_SESSION['SERVIDOR'] . '/view/Linha-tempo.php">Linha do Tempo</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="' . $_SESSION['SERVIDOR'] . '/view/Sobre-Nos.php">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="' . $_SESSION['SERVIDOR'] . '/view/Biblioteca.php">Biblioteca</a>
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
