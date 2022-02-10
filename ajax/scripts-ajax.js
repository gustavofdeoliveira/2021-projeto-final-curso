var ids = [];
var ids_termos = [];
var nomes = [];
var result
var controleCampo = 1;
$(document).ready(function () {
    campo = document.getElementById("hiper-link");
    if (campo != null) {
        document.getElementById("hiper-link").insertAdjacentHTML('afterend', '<span id="resultado_pesquisa_termo"></span>');
    }
})

$(document).ready(function () {
    $.post('../ajax-php/listar-usuarios.php', function (resposta) {
        resultado = JSON.parse(resposta);
        listar_usuarios = document.getElementById('id-usuarios');
        if (listar_usuarios != null) {
            for (a = 0; a != resultado.length; a++) {
                var nivel = '';
                if (resultado[a]['nivel'] == 1) {
                    nivel = '<td class="texto-codigo">' + resultado[a]['nivel'] + ' - Administrador</td>';
                } if (resultado[a]['nivel'] == 2) {
                    nivel = '<td class="texto-codigo">' + resultado[a]['nivel'] + ' - Professor</td>';
                } if (resultado[a]['nivel'] == 3) {
                    nivel = '<td class="texto-codigo">' + resultado[a]['nivel'] + ' - Aluno</td>';
                }
                let data = new Date(resultado[a]['dataInclusao']);
                let dataInclusao = ((data.getDate())) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear();

                document.getElementById('id-usuarios').insertAdjacentHTML('afterend',
                    '<td class="texto-codigo">' + resultado[a]['id'] + '</td>' +
                    '<td class="texto-nome">' + resultado[a]['nome'] + '</td>' +
                    nivel + '<td class="texto-data">' + dataInclusao + '</td>' +
                    '<td style="text-align:center;display:flex">' +
                    '<form action="../control/UsuarioControl.php" method="POST" class="form-group">' +
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="atualizaNivel">' +
                    '<button class="btn-excluir-atualizar" type="submit" name="Usuario" value="' + resultado[a]['id'] + '" >' +
                    '<i class="fa fa-long-arrow-up" aria-hidden="true"></i></button></form>' +

                    '<form action="../control/UsuarioControl.php" method="POST" class="form-group">' +
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirUsuario">' +
                    '<button class="btn-excluir-atualizar" type="submit" name="Usuario" value="' + resultado[a]['id'] + '">' +
                    '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>'
                );
            }
        }
    })
})

$(document).ready(function () {
    $.post('../ajax-php/listar-rede.php', function (resposta) {
        resultado = JSON.parse(resposta);
        listar_redes = document.getElementById('id-redes');
        if (listar_redes != null) {
            for (a = 0; a != resultado.length; a++) {
                let data = new Date(resultado[a]['dataInclusao']);
                let dataInclusao = ((data.getDate())) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear();

                document.getElementById('id-redes').insertAdjacentHTML('afterend',
                    '<td class="texto-codigo">' + resultado[a]['id'] + '</td>' +
                    '<td class="texto-nome">' + resultado[a]['nome'] + '</td>' +
                    '<td class="texto-nome">' + resultado[a]['descricao'] + '</td>' +
                    '<td class="texto-data">' + dataInclusao + '</td>' +
                    '<td style="text-align:center;display:flex">' +

                    '<td style="text-align:center;display:flex">' +
                    '<a href="../view/Editar-rede-termo.php?id=' + resultado[a]['id'] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +

                    '<form action="../control/RedeTermosControl.php" method="POST" class="form-group">' +
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirRede">' +
                    '<button class="btn-excluir-atualizar" type="submit" name="idRede" value="' + resultado[a]['id'] + '">' +
                    '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>'
                );
            }
        }
    })
})

//Carrega termo para editar
$(document).ready(function () {
    var editar = document.getElementsByName("editar-termo");
    if (editar.length != 0) {
        var url = window.location.href;
        var valores_url = url.split("=");
        $.post('../ajax-php/editar-termo.php?id=' + valores_url[1], function (resposta) {
            resultado = JSON.parse(resposta);
            document.getElementById("idTermo").value = resultado["dados"][0]["id"];
            document.getElementById("nome").value = resultado["dados"][0]["nome"];
            document.getElementById("select-termo").value = resultado["dados"][0]["tipo"];
            document.getElementById("conceito").value = resultado["dados"][0]["conceito"];
            document.getElementById("nomeVariavel").value = resultado["dados"][0]["nomeVariavel"];
        })
    }
})

//Listar termos
$(document).ready(function () {
    $.post('../ajax-php/listar-termos.php', function (resposta) {
        resultado = JSON.parse(resposta);
        listar_termos = document.getElementById('id-termos');
        if (listar_termos != null) {
            for (a = 0; a != resultado.length; a++) {
                document.getElementById('id-termos').insertAdjacentHTML('afterend',
                    '<td class="texto-codigo">' + resultado[a]['id'] + '</td>' +
                    '<td class="texto-nome">' + resultado[a]['nome'] + '</td>' +
                    '<td class="texto-codigo">' + resultado[a]['tipo'] + '</td>' +
                    '<td class="texto-codigo">' + resultado[a]['conceito'] + '</td>' +

                    '<td style="text-align:center;display:flex">' +
                    '<a href="../view/Editar-termo.php?id=' + resultado[a]['id'] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +

                    '<form action="../control/TermoControl.php" method="POST" class="form-group">' +
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirTermo">' +
                    '<button class="btn-excluir-atualizar" type="submit" name="Termo" value="' + resultado[a]['id'] + '">' +
                    '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>'
                );
            }
        }
    })
})

//Lista publicações
$(document).ready(function () {
    $.post('../ajax-php/listar-publicacao.php', function (resposta) {
        resultado = JSON.parse(resposta);
        listar_publicacoes = document.getElementById('id-publicacao');
        if (listar_publicacoes != null) {
            for (a = 0; a != resultado.length; a++) {
                document.getElementById('id-publicacao').insertAdjacentHTML('afterend',
                    '<td class="texto-codigo">' + resultado[a]['id'] + '</td>' +
                    '<td class="texto-nome">' + resultado[a]['titulo'] + '</td>' +
                    
                    '<td class="texto-codigo">' + resultado[a]['categoria'] + '</td>' +

                    '<td style="text-align:center;display:flex">' +
                    '<a href="../view/Ver-publicacao.php?id=' + resultado[a]['id'] + '" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>' +
                    '<a href="../view/Editar-publicacao.php?id=' + resultado[a]['id'] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +

                    '<form action="../control/PublicacaoControl.php" method="POST" class="form-group">' +
                    '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirPublicacao">' +
                    '<button class="btn-excluir-atualizar" type="submit" name="idPublicacao" value="' + resultado[a]['id'] + '">' +
                    '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>'
                );
            }
        }
    })
})

//Carrega rede para editar
$(document).ready(function () {
    var editar = document.getElementsByName("editar-rede");
    if (editar.length != 0) {
        var url = window.location.href;
        var valores_url = url.split("=");
        $.post('../ajax-php/editar-rede.php?id=' + valores_url[1], function (resposta) {
            resultado = JSON.parse(resposta);
            console.log(resultado)
            document.getElementById("idRede").value = resultado["dados"][0]["id"];
            document.getElementById("nome").value = resultado["dados"][0]["nome"];
            document.getElementById("descricao").value = resultado["dados"][0]["descricao"];
            console.log(resultado)
            for (a = 0; a != resultado["dados"][1]["termos"].length; a++) {
                ids.push(resultado["dados"][1]["termos"][a]["id"]);
                document.getElementById("termos").value = ids;
                document.getElementById('termos-container').insertAdjacentHTML('afterbegin',

                    '<div class="balao" id="' + resultado["dados"][1]["termos"][a]["id"] +
                    '" value="' + resultado["dados"][1]["termos"][a]["nome"] + '">' +
                    resultado["dados"][1]["termos"][a]["nome"] +
                    '<input class="btn-excluir-atualizar"style="display:none" name="acao" value="excluirTermo" type="hidden">' +
                    '<button class="balao-fechar" type="submit" name="idTermo" value="' + resultado["dados"][1]["termos"][a]["id"] + '"><i class="fa fa-times" aria-hidden="true"></i></button></div>');
            }
        })
    }
})

//Carrega Termo
async function carrega_termos(value) {
    if (value.length >= 3) {
        const termos = await fetch('../ajax-php/busca-termo.php?termo=' + value);
        const resposta = await termos.json();
        var html = "<ul class='list-group'>";
        if (resposta['erro']) {
            html += "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-action' onclick='get_termo(" + JSON.stringify(resposta['dados'][i].id) + "," + JSON.stringify(resposta['dados'][i].nome) + ")'>" + resposta['dados'][i].nome + "</li>";
            }
        }
        html += "</ul>";
        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}
const id_input = '';
function passa_id_input(codigo_id) {
    id_iput = codigo_id;
}
//Carrega Termo hiperlink
async function carrega_termos_publicacao(value) {
    if (value.length >= 3) {
        const termos = await fetch('../ajax-php/busca-termo.php?termo=' + value);
        const resposta = await termos.json();
        var html = "<ul class='list-group'>";
        if (resposta['erro']) {
            html += "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-action' onclick='get_termo_publicacao(" + JSON.stringify(resposta['dados'][i].id) + "," + JSON.stringify(resposta['dados'][i].nome) + ")'>" + resposta['dados'][i].nome + "</li>";
            }
        }
        html += "</ul>";

        document.getElementById('resultado_pesquisa_termo').innerHTML = html;
    }
}

function get_termo_publicacao(id, nome) {
    document.getElementsByName('input-link').value = nome
    input_id = document.getElementsByName('input-link')
    document.getElementById(input_id[3]["id"]).value = nome;
    ids_termos.push(id);
    document.getElementById("termosId").value = ids_termos;
    document.getElementById('resultado_pesquisa_termo').innerHTML = '';
}

function get_termo(id, nome) {
    document.getElementById('termos-container').insertAdjacentHTML('afterbegin', '<div class="balao" id="' + id + '" value="' + nome + '">' + nome + '<div class="balao-fechar"  onclick="fecharBalao(' + id + ')"><i class="fa fa-times" aria-hidden="true"></i></div></div>');
    ids.push(id);
    document.getElementById("termos").value = ids;
    document.getElementById("termos_incluidos").value = '';
}

const fechar = document.querySelector('#termos_incluidos');
if (fechar != null) {
    document.addEventListener('click', function (event) {
        const validar_clique = fechar.contains(event.target);
        if (!validar_clique) {
            document.getElementById('resultado_pesquisa').innerHTML = '';
        }
    });
}
function fecharBalao(id) {
    termos = ids;
    var buscar = id;
    var indice = termos.indexOf(buscar);
    while (indice >= 0) {
        termos.splice(indice, 1);
        indice = termos.indexOf(buscar);
    }
    document.getElementsByName("termos").value = termos;
    document.getElementById(id).remove();
}

//Carrega rede de Termos
async function carrega_redes(value) {
    if (value.length >= 3) {
        const termos = await fetch('../ajax-php/busca-redeTermos.php?rede=' + value);
        const resposta = await termos.json();
        var html = "<ul class='list-group'>";
        if (resposta['erro']) {
            html += "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-action' onclick='get_rede(" + JSON.stringify(resposta['dados'][i].id) + "," + JSON.stringify(resposta['dados'][i].nome) + ")'>" + resposta['dados'][i].nome + "</li>";
            }
        }
        html += "</ul>";
        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}


var input = document.querySelector("#redeTermos");
function get_rede(id, nome) {
    document.getElementById('termos-container').insertAdjacentHTML('afterbegin', '<div class="rede-balao" id="' + id + '" value="' + nome + '">' + nome + '<div class="balao-fechar"  onclick="fecharRedeBalao(' + id + ')"><i class="fa fa-times" aria-hidden="true"></i></div></div>');
    ids.push(id);
    if (ids) {
        input.disabled = true;
    }
    document.getElementById("rede").value = ids;
    document.getElementById("redeTermos").value = '';
}

const fecharRede = document.querySelector('#redeTermos');
if (fecharRede != null) {
    document.addEventListener('click', function (event) {
        const validar_clique = fecharRede.contains(event.target);
        if (!validar_clique) {
            document.getElementById('resultado_pesquisa').innerHTML = '';
        }
    });
}

function fecharRedeBalao(id) {
    rede = ids;
    var buscar = id;
    var indice = rede.indexOf(buscar);
    while (indice >= 0) {
        rede.splice(indice, 1);
        indice = rede.indexOf(buscar);
    }
    document.getElementsByName("rede").value = rede;
    input.disabled = false;
    document.getElementById(id).remove();
}

//Carrega publicação
$(document).ready(function () {
    var url = window.location.href;
    var valores_url = url.split("=");
    $.post('../ajax-php/ver-publicacao.php?id=' + valores_url[1], function (resposta) {
        resultado = JSON.parse(resposta);
        var ver_publicacao = document.getElementById("ver-publicacao");
        if (ver_publicacao != null) {
            console.log(resultado);
            document.getElementById('titulo-publicacao').insertAdjacentHTML('afterbegin', resultado['dados']['publicacao']['titulo']);
            document.getElementById('categoria-publicacao').insertAdjacentHTML('afterbegin', "Publicação " + resultado['dados']['publicacao']['categoria']);
            document.getElementById('img-publicacao').src = resultado['dados']['publicacao']['imagem'];
            document.getElementById('texto-resumo').insertAdjacentHTML('afterbegin', "Publicação " + resultado['dados']['publicacao']['resumo']);
            document.getElementById('texto-publicacao').insertAdjacentHTML('afterbegin', resultado['dados']['publicacao']['texto']);
            if (resultado['dados']['redeTermos'][0]['nome'] != null) {
                document.getElementById('categoria-publicacao').insertAdjacentHTML('afterend', '<p id="rede-publicacao">' + resultado['dados']['redeTermos'][0]['nome'] + '</p>');
            }
            if (resultado['dados']['semelhantes'].length != 0) {
                document.getElementById('publicacao-semelhantes').insertAdjacentHTML('afterbegin', '<p id="texto-publicacao-semelhante">Publicações semelhantes</p>')
                for (a = 0; a != resultado['dados']['semelhantes'].length; a++) {
                    document.getElementById('texto-publicacao-semelhante').insertAdjacentHTML('afterend', '<img class="img-publicacao-semelhante" id="img-publicacao-semelhante" src="' + resultado['dados']['semelhantes'][a]['imagem'] + '">')
                    document.getElementById('img-publicacao-semelhante').insertAdjacentHTML('afterend', '<a class="titulo-publicacao-semelhante" target="_blank" href="//localhost/2021-projeto-final-curso/view/Ver-publicacao.php?id=' + resultado['dados']['semelhantes'][a]['id'] + '">' + resultado['dados']['semelhantes'][a]['titulo'] + '</a>')

                }
            }
        }
    })
})

//Carrega publicação para editar
$(document).ready(function () {
    var editar = document.getElementById("titulo");
     if (editar != null) {
    var url = window.location.href;
    var valores_url = url.split("=");
    $.post('../ajax-php/editar-publicacao.php?id=' + valores_url[1], function (resposta) {
        resultado = JSON.parse(resposta);
        console.log(resultado)
        document.getElementById("titulo").value = resultado["dados"][0]["titulo"];
        document.getElementById("select-termo").value = resultado["dados"][0]["categoria"];
        document.getElementById("resumo").value = resultado["dados"][0]["resumo"];
        document.getElementById("texto").innerHTML = resultado["dados"][0]["texto"];
        document.getElementById('texto').insertAdjacentHTML('afterbegin', resultado["dados"][0]["texto"]);
        var a = document.getElementById("textoArea");
         document.getElementById('termos-container').insertAdjacentHTML('afterbegin', 
         '<div class="rede-balao" id="' + resultado["dados"]['redeTermos']["id"] + '" value="' + resultado["dados"]['redeTermos']["nome"] + '">' + resultado["dados"]['redeTermos']["nome"] + '<div class="balao-fechar"  onclick="fecharRedeBalao(' + resultado["dados"]['redeTermos']["id"] + ')"><i class="fa fa-times" aria-hidden="true"></i></div></div>');
        document.getElementById("redeTermos").disabled = true;

     })
      }
 })

//Ver rede de termos
$(document).ready(function () {
    var url = window.location.href;
    var valores_url = url.split("=");
    $.post('../ajax-php/ver-rede-termos.php?id=' + valores_url[1], function (resposta) {
        resultado = JSON.parse(resposta);
        debugger
        var ver_rede_termos = document.getElementById("ver-rede-termos");
        if (ver_rede_termos != null) {
            console.log(resultado);
            document.getElementById('rede-nome').insertAdjacentHTML('afterbegin', resultado['dados']['redeTermos']['nome']);
            document.getElementById('rede-descricao-texto').insertAdjacentHTML('afterbegin', resultado['dados']['redeTermos']['descricao']);
            document.getElementById('rede-botoes').insertAdjacentHTML('afterbegin',
            '<div class="pull-right"><a href="../view/Editar-rede-termo.php?id=' + resultado['dados']['redeTermos']['id'] + '"><i class="fa fa-verde fa-pencil-square-o" aria-hidden="true"></i></a>' +
            '<form action="../control/RedeTermosControl.php" method="POST" class="form-group">' +
            '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirRede">' +
            '<button class="btn-excluir-atualizar" type="submit" name="idRede" value="' + resultado['dados']['redeTermos']['id'] + '">' +
            '<i class="fa fa-verde fa-trash-o" aria-hidden="true"></i></button></form></div>');

            for (a = 0; a != resultado['dados']['termos'].length; a++) {
                document.getElementById('rede-termos-balao').insertAdjacentHTML('afterbegin', 
                '<a id="rede-termo-balao" target="_blank" href="//localhost/2021-projeto-final-curso/view/Ver-publicacao.php?id=' + resultado['dados']['termos'][a]['id'] + '">' + resultado['dados']['termos'][a]['nome'] + '</a>')
               

            }

        }
    })
})