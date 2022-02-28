<?php
include_once __DIR__ . '../../database/Connection.php';
require_once __DIR__ . '../../dao/UsuarioDao.php';
require_once __DIR__ . '../../components/header.php';
require_once __DIR__ . '../../components/table-listar-publicacao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar Publicações | Tereré com Sociologia</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive-theme.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css.map">
  <link rel="stylesheet" href="../css/bootstrap.css.map">
  <link rel="shortcut icon" href="../image/Logo-claro.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="../javascript/jquery.js"></script>
  <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
</head>


<body id="dark-mode">
  <?= head() ?>
  <main id="telas-navbar">
    <div class="row">
      <div class="col-xl-12">
        <div class="row">
          <div class="col-xl-12">
            <a href="../view/Cadastrar-publicacao.php" class="adicionar-termos"><i class="fa fa-plus"></i> adicionar nova publicação</a>
          </div>
        </div>
        <p id="titulo-cadastrar-rede">listar publicações</p>
        <div class="row">
          <div class="col-xl-9 col-lg-9 col-lg-md-9 col-sm-12">
            <form class="d-flex">
              <div class="input-group">
                <span class="input-group-text span-icon-buscar-usuarios" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input type="text" class="navbar-input-busca-usuarios form-control" placeholder="digite o nome da publicação" aria-describedby="basic-addon1">
              </div>
            </form>
          </div>
        </div>
        <?php
        if (!empty($_SESSION["msg_error"])) {
          echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-9  col-lg-9'>
                                <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle aria-hidden='true'></i> {$_SESSION["msg_error"]}</div>
                            </div></div>
                        ";
        }
        if (!empty($_SESSION["msg_sucess"])) {
          echo "<div class='row'>
                            <div class='col-sm-12  col-md-12  col-xl-12  col-lg-12'>
                                <div class='alert alert-success' role='alert'> <i class='fa fa-check-circle-o' aria-hidden='true'></i> {$_SESSION["msg_sucess"]}</div>
                            </div></div>
                        ";
        } ?>
        <div class="row ">
          <div class="col-xl-12">
            <div class="row">
              <table id="table-publicacoes">
                <thead>
                  <tr>
                    <td scope="col" style="width: 50px;">
                    <a href="javascript:sortThisTable(1)"><div class="listar-balao">id</div></a>
                    </td>
                    <td scope="col" style="width: 250px;">
                      <div class="listar-balao">título da publicação</div>
                    </td>
                    <td scope="col" style="width: 250px;">
                      <div class="listar-balao">tipo de publicação</div>
                    </td>
                    <td scope="col" style="width: 220px;">
                      <div class="listar-balao">data de cadastro</div>
                    </td>
                    <td style="width: 75px;text-align: center;">
                      <div class="row"></div>
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $tabela_publicacao = listarPublicacao();
                  echo $tabela_publicacao;
                  ?>
                </tbody>
              </table>
              <table border="1" cellpadding="5" cellspacing="0" id="sorteable">
                        <tbody><tr>
                                <th>Nome</th>
                                <th><a href="javascript:sortThisTable(1)"> Altura </a></th>
                                <th><a href="javascript:sortThisTable(2)"> Peso </a></th>
                                <th><a href="javascript:sortThisTable(3)"> Idade </a></th>
                                <th><a href="javascript:sortThisTable(4)"> Nota </a></th>
                        </tr>
                        
                        
                        
                <tr><td>Zézinho</td><td>1.56</td><td>55</td><td>14</td><td>9.2</td></tr><tr><td>Luizinho</td><td>1.58</td><td>58</td><td>13</td><td>9.7</td></tr><tr><td>Huguinho</td><td>1.60</td><td>57</td><td>12</td><td>10.0</td></tr></tbody></table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="../javascript/bootstrap.bundle.min.js"></script>
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
                sortIndex=0
                sortElm=0

                function sortTable(elm1,elm2){
                        elm1=sortElm.rows[elm1].cells[sortIndex].innerHTML
                        elm2=sortElm.rows[elm2].cells[sortIndex].innerHTML
                        result=parseFloat(elm1)-parseFloat(elm2)
                        return isNaN(result)?0:result
                }

                function sortThisTable(si){
                  debugger
                        sortIndex=si
                        sortElm=document.getElementById("sorteable")
                        rows=[]
                        for(var i=0;i<sortElm.rows.length-1;i++)
                                rows[i]=i+1
                        rows.sort(sortTable)
                        for(var i=0;i<rows.length;i++){
                                cells=sortElm.rows[rows[i]].cells
                                rows[i]=new Array()
                                for(var ii=0;ii<cells.length;ii++)
                                        rows[i][ii]=cells[ii].innerHTML
                        }
                        while(sortElm.rows.length>1)sortElm.deleteRow(1)
                        for(var i=rows.length-1;i>=0;i--){
                                var x=sortElm.insertRow(1)
                                for(var ii=rows[i].length-1;ii>=0;ii--){
                                        var xx=x.insertCell(0)
                                        xx.innerHTML=rows[i][ii]
                                }
                        }
                }

                </script>
  <script src="../javascript/scripts.js"></script>
  <script src="../javascript/script-bell.js"></script>
  <script src="../ajax/scripts-ajax.js"></script>
</body>

</html>