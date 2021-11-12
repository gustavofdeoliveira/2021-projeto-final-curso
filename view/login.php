<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Entrar | </title>

</head>
<style>

</style>

<body class="bg-login">
    <main>
        <div class="container col-lg-3">
            <form action="" method="POST" class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label label-login" for="nmLogin">E-mail | Nome de Usuário</label>
                            <input required class="form-control input-login" type="text" name="nmLogin">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label label-login" for="nmSenha">Senha</label>
                            <input required class="form-control input-login" type="text" name="nmSenha">
                            <span class="error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="hidden" name="acao" value="1">
                                <input class="btn btn-entrar" type="submit" value="Entrar">
                            </div>
                            <div class="col-lg-9">
                                <div class="form-check">
                                    <input class="form-check-input input-manter" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label label-manter" for="flexCheckDefault">
                                        Manter-se conectado
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </main>
</body>
<script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>