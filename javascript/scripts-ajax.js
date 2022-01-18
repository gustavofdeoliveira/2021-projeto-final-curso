
$(document).ready(function () {
    debugger
    $.post('../ajax/listar-usuarios.php', function (resposta) {
        resultado = JSON.parse(resposta);
        for (a = 0; a <= resultado.length; a++) {
            if (document.getElementById('listar-balao-codigo')) {
                document.getElementById('listar-balao-codigo').insertAdjacentHTML('afterend', '<div class="row"><p id="texto-codigo">' + resultado[a]['id'] + '</p></div>');
                document.getElementById('listar-balao-nome').insertAdjacentHTML('afterend', '<div class="row"><p id="texto-nome">' + resultado[a]['nome'] + '</p></div>');
                if (resultado[a]['nivel'] == 1) {
                    document.getElementById('listar-balao-nivel').insertAdjacentHTML('afterend', '<div class="row"><p id="texto-codigo">' + resultado[a]['nivel'] + ' - Administrador</p></div>');
                } if (resultado[a]['nivel'] == 2) {
                    document.getElementById('listar-balao-nivel').insertAdjacentHTML('afterend', '<div class="row"><p id="texto-codigo">' + resultado[a]['nivel'] + ' - Professor</p></div>');
                } if (resultado[a]['nivel'] == 3) {
                    document.getElementById('listar-balao-nivel').insertAdjacentHTML('afterend', '<div class="row"><p id="texto-codigo">' + resultado[a]['nivel'] + ' - Aluno</p></div>');
                }
                debugger
                let data = new Date(resultado[a]['dataInclusao']);
                let dataInclusao = ((data.getDate())) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear();
                document.getElementById('listar-balao-data').insertAdjacentHTML('afterend', '<div class="row"><p id="texto-codigo">' + dataInclusao + '</p></div>');
            }
        }
    })

})

async function carrega_termos(value) {

    if (value.length >= 3) {
        const termos = await fetch('../ajax/busca-termo.php?termo=' + value);
        const resposta = await termos.json();

        var html = "<ul class='list-group'>";

        if (resposta['erro']) {
            html += "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-action' onclick='get_id_usuario(" + JSON.stringify(resposta['dados'][i].id) + "," + JSON.stringify(resposta['dados'][i].nome) + ")'>" + resposta['dados'][i].nome + "</li>";
            }

        }
        html += "</ul>";

        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}

var ids = [];
var result
var controleCampo = 1;
function get_id_usuario(id, nome) {
    document.getElementById('termos-container').insertAdjacentHTML('afterbegin', '<div class="balao" id="' + id + '" value="' + nome + '">' + nome + '<div class="balao-fechar"  onclick="fecharBalao(' + id + ')"><i class="fa fa-times" aria-hidden="true"></i></div></div>');
    ids.push(id);
    debugger
    document.getElementById("termos").value = ids;
    document.getElementById("termos_incluidos").value = '';
}

const fechar = document.querySelector('#termos_incluidos');

document.addEventListener('click', function (event) {
    const validar_clique = fechar.contains(event.target);
    if (!validar_clique) {
        document.getElementById('resultado_pesquisa').innerHTML = '';
    }
});

function fecharBalao(id) {
    debugger
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
