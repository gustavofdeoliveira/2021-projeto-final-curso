const fields = document.querySelectorAll("[required]")
var emailVerificado;
function ValidateField(field) {
    debugger
    // logica para verificar se existem erros
    function verifyErrors() {
        let foundError = false;
        for (let error in field.validity) {
            // se não for customError
            // então verifica se tem erro
            if (field.validity[error] && !field.validity.valid) {
                foundError = error
            }
        }
        return foundError;
    }
    function customMessage(typeError) {
        const messages = {
            text: {
                valueMissing: "Campo obrigatório"
            },
            password: {
                valueMissing: "Campo obrigatório",
            }
        }
        return messages[field.type][typeError]
    }

    function setCustomMessage(message) {
        const spanError = field.parentNode.querySelector("span.error")
        if (message) {
            spanError.classList.add("active")
            spanError.innerHTML = message
        } else {
            spanError.classList.remove("active")
            spanError.innerHTML = ""
        }
    }
    return function () {
        const error = verifyErrors()
        if (error) {
            const message = customMessage(error)
            field.style.borderColor = "#AF3320"
            setCustomMessage(message)
        } else {
            field.style.borderColor = "#1B3A02"
            setCustomMessage()
        }
    }
}

function customValidation(event) {
    debugger;
    const field = event.target
    const validation = ValidateField(field)
    validation()
}
for (field of fields) {

    field.addEventListener("invalid", event => {
        // eliminar o bubble
        event.preventDefault()
        customValidation(event)
    })
    field.addEventListener("blur", customValidation)
}

if (emailVerificado == true) {
    document.querySelector("form")
        .addEventListener("submit", event => {
            debugger
            console.log("enviar o formulário")

        })
}
//modo moturno

// check for saved 'darkMode' in localStorage
let darkMode = localStorage.getItem('darkMode');
const darkModeToggle = document.querySelector('#dark-mode-toggle');

const enableDarkMode = () => {
    // 1. Add the class to the body
    document.body.classList.add('darkmode');
    // 2. Update darkMode in localStorage
    if (document.getElementById('img-logo')) {
        document.getElementById('img-logo').src = '../image/Logo-noturno.png';
    }
    if (document.getElementById('img-logo-index')) {
        document.getElementById('img-logo-index').src = 'image/Logo-noturno.png';
    }
    if (document.getElementById('img-login')) {
        document.getElementById('img-login').src = '../image/Bg-Login-Icon-Noturno.png';
    }
    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    // 1. Remove the class from the body
    document.body.classList.remove('darkmode');
    // 2. Update darkMode in localStorage 
    if (document.getElementById('img-logo')) {
        document.getElementById('img-logo').src = '../image/Logo-claro.png';
    }
    if (document.getElementById('img-logo-index')) {
        document.getElementById('img-logo-index').src = 'image/Logo-claro.png';
    }
    if (document.getElementById('img-login')) {
        document.getElementById('img-login').src = '../image/Bg-Login-Icon-Claro.png';
    }
    localStorage.setItem('darkMode', null);
}

// If the user already visited and enabled darkMode
// start things off with it on
if (darkMode === 'enabled') {
    enableDarkMode();
}

// When someone clicks the button
darkModeToggle.addEventListener('click', () => {
    // get their darkMode setting
    darkMode = localStorage.getItem('darkMode');

    // if it not current enabled, enable it
    if (darkMode !== 'enabled') {
        enableDarkMode();
        // if it has been enabled, turn it off  
    } else {
        disableDarkMode();
    }
});

async function carrega_termos(value) {

    if (value.length >= 3) {
        const termos = await fetch('../ajax/busca-termo.php?termo=' + value);
        const resposta = await termos.json();

        var html = "<ul class='list-group'>";

        if (resposta['erro']) {
            html += "<li class='list-group-item disabled'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-action' onclick='get_id_usuario(" + JSON.stringify(resposta['dados'][i].nome) + ")'>" + resposta['dados'][i].nome + "</li>";
            }

        }
        html += "</ul>";

        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}

var nomes = [];
var result
var controleCampo = 1;
function get_id_usuario(nome) {
    document.getElementById('termos-container').insertAdjacentHTML('afterbegin', '<div class="balao" id="termo' + controleCampo + '" value="' + nome + '">' + nome + '<div class="balao-fechar"  onclick="fecharBalao(' + controleCampo + ')"><i class="fa fa-times" aria-hidden="true"></i></div></div>')
    controleCampo;
    nomes.push(nome);
    debugger
    document.getElementById("termos").value =  JSON.stringify(nomes);
    document.getElementsByName("termos").value = JSON.stringify(nomes);
    document.getElementById("outrostermos").value = '';
}

const fechar = document.querySelector('#outrostermos');

document.addEventListener('click', function (event) {
    const validar_clique = fechar.contains(event.target);
    if (!validar_clique) {
        document.getElementById('resultado_pesquisa').innerHTML = '';
    }
});

function fecharBalao(id) {
    debugger
    termos = JSON.parse(document.getElementsByName("termos").value);
    var buscar = document.getElementById('termo' + id).textContent;
    var indice = termos.indexOf(buscar);
    while (indice >= 0) {
        termos.splice(indice, 1);
        indice = termos.indexOf(buscar);
    }
    document.getElementsByName("termos").value = termos;
    document.getElementById('termo' + id).remove();
}

//ocultar e mostrar senha
function mostrar() {
    if ($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass("fa-eye-slash");
        $('#show_hide_password i').removeClass("fa-eye");
    } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass("fa-eye-slash");
        $('#show_hide_password i').addClass("fa-eye");
    }

};

//Validar email
function validacaoEmail(field) {
    usuario = field.value.substring(0, field.value.indexOf("@"));
    dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);
    if ((usuario.length >= 1) &&
        (dominio.length >= 3) &&
        (usuario.search("@") == -1) &&
        (dominio.search("@") == -1) &&
        (usuario.search(" ") == -1) &&
        (dominio.search(" ") == -1) &&
        (dominio.search(".") != -1) &&
        (dominio.indexOf(".") >= 1) &&
        (dominio.lastIndexOf(".") < dominio.length - 1)) {
        const spanError = field.parentNode.querySelector("span.error")
        spanError.classList.add("valido")
        spanError.innerHTML = "E-mail válido";
        emailVerificado = true;
    }
    else if (dominio) {
        const spanError = field.parentNode.querySelector("span.error")
        spanError.classList.add("active")
        spanError.innerHTML = "E-mail inválido";
        field.style.borderColor = "#AF3320";


    }

}


function validaSenha() {
    debugger
    var senha = document.getElementById('senha').value;
    errors = [];
    if (senha.length < 8) {
        errors.push("Sua senha deve possuir no mínimo 8 caracteres.<br>");
    }
    if (senha.search(/[A-Z]/) <= 0) {
        errors.push("Sua senha deve possuir uma letra maiúscula.<br>");
    }
    if (senha.search(/[!|@|#|$|%|^|&|*|(|)|-|_]/) <= 0) {
        errors.push("Sua senha deve possuir um caractere especial.<br>");
    }
    if (senha.search(/[0-9]/i) <= 0) {
        errors.push("Sua senha deve possuir um número.");
    }
    if (errors.length > 0) {
        const spanError = field.parentNode.querySelector("span.error")
        spanError.classList.add("active")
        spanError.innerHTML = errors.join("\n");
        return false;
    }
    return true;
}
