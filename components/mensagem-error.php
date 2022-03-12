<?php
function setMensagemError()
{
    $mensagem = '<div class="row">
    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
        <p id="error-titulo">Algo não deu certo :(</p>
        <p id="error-mensagem">Ops! Parece que o que você tentou procurar não foi encontrado... Você pode tentar de novo após se certificar de que digitou corretamente o que você gostaria de pesquisar.</p>
        <a id="btn-voltar" href="../index.php">voltar para a página inicial</a>
        <div class="d-xl-flex d-lg-flex d-md-flex">
            <img class="img-error" src="../image/Bg-Icon-Error.png">
            <p id="error-fala">São os <span>interesses</span> [...] que dominam imediatamente a <span>ação dos homens</span>.</p>
        </div>
    </div>
</div>';
    return $mensagem;
}
