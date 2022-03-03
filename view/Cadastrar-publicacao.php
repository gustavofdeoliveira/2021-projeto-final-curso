<?php
include_once __DIR__ . '../../database/Connection.php"';
require_once __DIR__ . '../../dao/PublicacaoDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/footer.php';
require_once __DIR__ . '../../components/mensagem.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Publicação | Tereré com Sociologia</title>
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
  <script src='https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js'></script>
</head>


<body id="dark-mode">
  <?= head() ?>
  <main id="telas-navbar">
    <form action="../control/PublicacaoControl.php" method="POST" enctype="multipart/form-data" class="form-group">
      <div class="row">
        <div class="col-xl-12">
          <p id="titulo-criar-publicacao">criar publicação</p>
          <?=setMensagens()?>
          <div class="row">
            <div class="col-xl-12">
              <div class="form-group">
                <label class="form-label label-criar-publicacao" for="titulo">título</label>
                <div class="input-group">
                  <input required class="input-criar-conta form-control" type="text" name="titulo">
                  <span class="error"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6 col-lg-6">
              <div class="form-group" x-data="{ fileName: '' }">
                <label class="form-label label-criar-categoria" for="imagem">imagem</label>
                <div class="input-group">
                  <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="imagem" id="imagem" class="d-none">
                  <input type="text" class="input-imagem form-control form-control-lg" x-model="fileName">
                  <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()"><i class="fa fa-image"></i> Carregar</button>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6">
              <div class="input-group">
                <label class="form-label label-criar-categoria" for="categoria">categoria</label>
                <select required class="custom-select" id="select-termo" name="categoria">
                  <option selected>Selecionar...</option>
                  <option value="Publicação Conteudista">Publicação Conteudista</option>
                  <option value="Atualidade Sociológica">Atualidade Sociológica</option>
                </select>
                <span class="error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="form-group">
                <label class="form-label label-criar-publicacao" for="resumo">resumo</label>
                <div class="input-group">
                  <textarea class="textarea input-criar-conta form-control" type="text" name="resumo"></textarea>
                  <span class="error"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="form-group">
                <label class="form-label label-criar-publicacao" for="redeTermos">rede de termos <span id="texto-opcional">(opcional)</span></label>
                <div class="input-group">
                  <input class="input-criar-conta form-control" type="text" id="redeTermos" onkeyup="carrega_redes(this.value)" name="redeTermos">
                  <span id="resultado_pesquisa"></span>
                  <div class="rede-container" id="termos-container"></div>
                  <p id="texto-alerta">deixar esse campo vazio pode reduzir o alcance da sua publicação</p>
                  <input type="hidden" name="rede" class="form-control" id="rede">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="form-group">
                <label class="form-label label-criar-publicacao" for="termos">texto</label>
                <div class="input-group">
                  <input class="form-control" type="hidden" id="termosId" name="termosId">
                  <input class="form-control" type="hidden" id="texto_publicacao" name="texto_publicacao">
                  <textarea class="form-control" type="text" id="textoArea" name="textoArea"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <p id="text-revisar-publicacão">revise seus textos<br>antes de publicar</p>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-8 col-lg-6 col-lg-offset-3 col-xl-4 col-xl-offset-4 col-sm-offset-2 col-md-offset-3">
              <input type="hidden" name="acao" value="cadastrarPublicacao">
              <input class="btn-publicar btn btn-lg" type="submit" onclick="pegaTexto()" value="publicar">
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
  <?= setFooter() ?>
  <script src="../plugins/build/ckeditor.js"></script>
  <script src="../plugins/build/ckeditor.js.map"></script>
  <script>
    ClassicEditor
      .create(document.querySelector('#textoArea'), {
        licenseKey: '',
      })
      .then(editor => {
        window.editor = editor;
      })
      .catch(error => {
        console.error('Oops, something went wrong!');
        console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
        console.warn('Build id: cuyvxs49p0ly-mzl2w7i12yeq');
        console.error(error);
      });
  </script>
  <script src="../javascript/bootstrap.bundle.min.js"></script>
  <script src="../javascript/scripts.js"></script>
  <script src="../javascript/script-bell.js"></script>
  <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>