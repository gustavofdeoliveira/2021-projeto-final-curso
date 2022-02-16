<?php
function verifica_configuracao($usuario,$SERVIDOR){
    if(!empty($usuario)){
        return'
        <div class="header-tools ion-ios-navicon pull-right">
            <i class="fa fa-cog" aria-hidden="true"></i>
        </div> 
        <div class="sidebar">
            <div class="sidebar-overlay animated fadeOut"></div>
                <div class="sidebar-content">
                    <p id="configuracao">Configurações</p>'
                     . $nivel = verifica_nivel($usuario, $SERVIDOR) .'
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
                        <img src="' . $usuario["fotoAvatar"] . '" id="fotAvatar" alt="Foto de Perfil" class="rounded-circle img-trocar-avatar">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-lg-6">
                        <p id="texto-trocar-foto">quer trocar de avatar?</p>
                        <p id="texto-avatar-explicativo">clique no que você deseja usar.</p>
                        <input type="hidden" id="fotoAvatar" name="fotoAvatar">
                        <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(3)">
                            <img src="'.$SERVIDOR.'/image/avatares/Avatar-3.png" id="3" alt="Foto do Avatar"  class="rounded-circle img-icone-avatar">
                            <p id="avatar-nome">Émile<br><span>Durkheim</span></p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(6)">
                            <img src="'.$SERVIDOR.'/image/avatares/Avatar-6.png" id="6" alt="Foto do Avatar" class="rounded-circle img-icone-avatar">
                            <p id="avatar-nome">Max<br><span>Weber</span></p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(4)">
                            <img src="'.$SERVIDOR.'/image/avatares/Avatar-4.png" id="4" alt="Foto do Avatar" class="rounded-circle img-icone-avatar">
                            <p id="avatar-nome">Karl<br><span>Marx</span></p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(5)">
                            <img src="'.$SERVIDOR.'/image/avatares/Avatar-5.png" id="5" alt="Foto do Avatar" class="rounded-circle img-icone-avatar">
                            <p id="avatar-nome">Simone de<br><span>Beauvoir</span></p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(2)">
                            <img src="'.$SERVIDOR.'/image/avatares/Avatar-2.png" id="2" alt="Foto do Avatar" class="rounded-circle img-icone-avatar">
                            <p id="avatar-nome">Auguste<br><span>Comte</span></p>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="escolher-avatar" onclick="mudarAvatar(1)">
                            <img src="'.$SERVIDOR.'/image/avatares/Avatar-1.png" id="1" alt="Foto do Avatar" class="rounded-circle img-icone-avatar">
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
            </form>';
    }
}