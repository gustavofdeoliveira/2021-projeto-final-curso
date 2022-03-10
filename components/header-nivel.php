<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'/2021-projeto-final-curso/config.php');

function verifica_nivel($usuario)
{
    if(!empty($usuario)){
    $isAdmin = '';
    if ($usuario["nivelAcesso"] == 3) {
        $nivel = '
    <div class="nav-left">
        <a href="'.$_SESSION['SERVIDOR'].'view/Meus-dados.php" class="btn-tools"><span class="ion-ios-home-outline"></span>Meus Dados</a>
        <a class="btn-tools"><span class="ion-ios-list-outline"></span>Sugerir Termo</a>
        <a class="btn-tools" id="modalAvatar"><span class="ion-ios-list-outline"></span>Alterar Avatar</a> 
        <a class="btn-tools" id="dark-mode-toggle"><span class="ion-ios-list-outline"></span>
        <div class="d-flex modo-noturno">
        <div class="texto-modo-noturno">Modo noturno</div>
            <div class="dark-light">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
            </div>
        </div>     
    </a>
        <a><span class="ion-ios-list-outline"></span>
            <form action="'.$_SESSION['SERVIDOR'].'/control/UsuarioControl.php" method="POST" class="form-group">
                <div class="d-flex pull-right btn-sair">
                    <input type="hidden" name="acao" value="sair">
                    <input class="input-sair" type="submit" value="Sair">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                </div>
            </form>
        </a>
        
          </div>
          </div>
          </div>              
    </div>';
    }
    if ($usuario["nivelAcesso"] == 1 || $usuario["nivelAcesso"] == 2) {
        $nivel = '
    <div class="nav-left">
        <div id="texto-usuario">Usuário</div>
            <a href="'.$_SESSION['SERVIDOR'].'/view/Meus-dados.php" class="btn-tools"><span class="ion-ios-home-outline"></span>Meus Dados</a>';
        if ($usuario["nivelAcesso"] == 1) {
            $isAdmin = '
    <a href="'.$_SESSION['SERVIDOR'].'/view/Listar-usuarios.php" class="btn-tools"><span class="ion-ios-home-outline"></span>Listar Usuários</a>';
        }
        $restante1 = '
    <a class="btn-tools" id="dark-mode-toggle"><span class="ion-ios-list-outline"></span>
        <div class="d-flex modo-noturno">
        <div class="texto-modo-noturno">Modo noturno</div>
            <div class="dark-light">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
            </div>
        </div>     
    </a>
    <a class="btn-tools" id="modalAvatar">
    <span class="ion-ios-list-outline"></span>Alterar Avatar</a> 
        <div id="texto-usuario">Publicações</div>
    <a href="'.$_SESSION['SERVIDOR'].'/view/Cadastrar-publicacao.php" class="btn-tools">
        <span class="ion-ios-list-outline"></span>+ Nova Publicação
    </a>
    <a href="'.$_SESSION['SERVIDOR'].'/view/Listar-publicacao.php" class="btn-tools">
        <span class="ion-ios-list-outline"></span>Listar Publicações
    </a>
    <div id="texto-usuario">Termos</div>
        <a href="'.$_SESSION['SERVIDOR'].'/view/Cadastrar-termo.php" class="btn-tools">
            <span class="ion-ios-list-outline"></span>+ Novo Termo
        </a>
        <a href="'.$_SESSION['SERVIDOR'].'/view/Listar-termos.php" class="btn-tools">
            <span class="ion-ios-list-outline"></span>Listar Termos
        </a>
        <a href="'.$_SESSION['SERVIDOR'].'/view/Ver-sugestoes" class="btn-tools">
            <span class="ion-ios-list-outline"></span>Ver Sugestões
        </a>
    <div id="texto-usuario">Rede de Termos</div>
        <a href="'.$_SESSION['SERVIDOR'].'/view/Cadastrar-rede-termo.php" class="btn-tools">
            <span class="ion-ios-list-outline"></span>+ Nova Rede
        </a>
        <a href="'.$_SESSION['SERVIDOR'].'/view/Listar-redes.php" class="btn-tools">
            <span class="ion-ios-list-outline"></span>Listar Redes
        </a>                   
        <a>
            <span class="ion-ios-list-outline"></span>
                <form action="'.$_SESSION['SERVIDOR'].'./control/UsuarioControl.php" method="POST" class="form-group">
                    <div class="d-flex pull-right btn-sair">
                        <input type="hidden" name="acao" value="sair">
                        <input class="input-sair" type="submit" value="Sair">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </div>
                </form>
        </a>                           
</div>';
    }else{
        $restante1 = '';
    }
    return $nivel.$isAdmin.$restante1;
}
}