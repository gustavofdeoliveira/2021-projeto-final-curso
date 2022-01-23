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
                     '<form action="../control/UsuarioControl.php" method="POST" class="form-group">'+
                     '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="atualizaNivel">' +
                     '<button class="btn-excluir-atualizar" type="submit" name="Usuario" value="'+resultado[a]['id']+'" >' +
                     '<i class="fa fa-long-arrow-up" aria-hidden="true"></i></button></form>'+
                    
                     '<form action="../control/UsuarioControl.php" method="POST" class="form-group">'+
                     '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirUsuario">' +
                     '<button class="btn-excluir-atualizar" type="submit" name="Usuario" value="'+resultado[a]['id']+'">' +
                     '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>'
                );
            }
        }
    })
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
                     '<a href="../view/Editar-termo.php?id='+resultado[a]['id']+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
                    
                     '<form action="../control/TermoControl.php" method="POST" class="form-group">'+
                     '<input class="btn-excluir-atualizar"style="display:none" type="hidden" name="acao" value="excluirTermo">' +
                     '<button class="btn-excluir-atualizar" type="submit" name="Termo" value="'+resultado[a]['id']+'">' +
                     '<i class="fa fa-trash-o" aria-hidden="true"></i></button></form></td>'
                );
            }
        }
    })
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

var ids = [];
var result
var controleCampo = 1;
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