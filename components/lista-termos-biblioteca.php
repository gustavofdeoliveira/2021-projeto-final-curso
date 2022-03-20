<?php
require_once __DIR__ . '../../dao/UsuarioDao.php';
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));
require_once __DIR__ . '../../components/mensagem-error-biblioteca.php';


function listaTermosBiblioteca()
{
    if (!empty($_SESSION["termos_biblioteca"])) {
        $termos = $_SESSION["termos_biblioteca"];
        $termo = '';
        $conn = Connection::conectar();

        for ($a = 0; $a != count($termos); $a++) {
            if (!empty($_SESSION['usuarioAutenticado'])) {
                $sql = "SELECT * FROM `usuarios_termos_salvos` WHERE `id_termo` = :id_termo AND `id_usuario`= :id_usuario";
                $result = $conn->prepare($sql);
                $result->bindParam(':id_termo', $termos[$a]['id']);
                $result->bindParam(':id_usuario', $_SESSION['usuarioAutenticado']['idUsuario']);

                $result->execute();
                $result->fetch(PDO::FETCH_ASSOC);
                if (($result) and ($result->rowCount() == 0)) {
                    $btn_salvar = '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                        '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="salvarTermo"><button class="btn-excluir-atualizar" type="submit" name="idTermo" value="' . $termos[$a]['id'] . '">' .
                        '<i class="fa fa-verde fa-bookmark-o" aria-hidden="true"></i></button></form>';
                } else {
                    $btn_salvar = '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                        '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="removerTermo"><button class="btn-excluir-atualizar" type="submit" name="idTermo" value="' . $termos[$a]['id'] . '">' .
                        '<i class="fa fa-verde fa-bookmark" aria-hidden="true"></i></button></form>';
                }

                if ($_SESSION['usuarioAutenticado']['nivelAcesso'] == 1 || $_SESSION['usuarioAutenticado']['nivelAcesso'] == 2) {
                    $btn_edicao =
                        '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                        '<input class="btn-excluir-atualizar" style="display:none" type="hidden" name="idTermo" value="' . $termos[$a]['id'] . '">' .
                        '<button class="btn-excluir-atualizar" type="submit" name="acao" value="verTermo">' .
                        '<i class="fa fa-verde fa-pencil-square-o" aria-hidden="true"></i></button></form>' .

                        '<form action="../control/TermoControl.php" method="POST" class="form-group">' .
                        '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirTermo">' .
                        '<button class="btn-excluir-atualizar" type="submit" name="Termo" value="' . $termos[$a]['id'] . '">' .
                        '<i class="fa fa-verde fa-trash-o" aria-hidden="true"></i></button></form>';
                }else{
                    $btn_edicao = "";
                }
                
            } else {
                $btn_edicao = "";
                $btn_salvar = "";
            }
            $termo .= '<div class="d-flex"><a id="nome-termo" href="../view/Ver-termo.php?id='.$termos[$a]["id"].'"><li id="nome-termo">' . $termos[$a]["nome"] . '</li></a><div class="pull-right d-flex" style="margin-left:auto">' . $btn_salvar . $btn_edicao . '</div></div> ';
        }

        return '<div class="col-xl-8 col-lg-8">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <p id="letra">' . $_SESSION["letra_pesquisa"] . '</p>
                        <hr id="rede-hr">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        ' . $termo . '
                    </div>
                </div>
            </div>';
    }if(empty($_SESSION["termos_biblioteca"])){
        $mensagemError = setMensagemErrorBiblioteca();
        return $mensagemError;
    }
}
