var ids = [];
var result
var controleCampo = 1;
$(document).ready(function () {
    $.post('../ajax-php/listar-usuarios.php', function (resposta) {
        resultado = JSON.parse(resposta);
        for (a = 0; a != resultado.length; a++) {
            if (document.getElementById('id')) {
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

                document.getElementById('id').insertAdjacentHTML('afterend',
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
        for (a = 0; a != resultado.length; a++) {
            if (document.getElementById('id-redes')) {
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
    if (editar) {
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

$(document).ready(function () {
    $.post('../ajax-php/listar-termos.php', function (resposta) {
        resultado = JSON.parse(resposta);
        for (a = 0; a != resultado.length; a++) {
            if (document.getElementById('id-termos')) {
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

//Carrega rede para editar
$(document).ready(function () {
    var editar = document.getElementsByName("editar-rede");
    if (editar) {
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
                    '<input class="btn-excluir-atualizar"style="display:none" name="acao" value="excluirTermo" type="hidden">'+
                    '<button class="balao-fechar" type="submit" name="idTermo" value="'+ resultado["dados"][1]["termos"][a]["id"]+'"><i class="fa fa-times" aria-hidden="true"></i></button></div>');
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