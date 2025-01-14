//modo moturno

let darkMode = localStorage.getItem('darkMode');
const darkModeToggle = document.querySelector('#dark-mode-toggle');
if (darkModeToggle != null) {
    darkModeToggle.addEventListener('click', () => {
        darkMode = localStorage.getItem('darkMode');
        if (darkMode !== 'enabled') {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
    });
}

const enableDarkMode = () => {
    document.body.classList.add('darkmode');
    if (document.getElementById('img-logo')) {
        document.getElementById('img-logo').src = 'http://localhost/Terere-com-Sociologia/image/Logo-noturno.png';
    }
    if (document.getElementById('img-logo-index')) {
        document.getElementById('img-logo-index').src = 'http://localhost/Terere-com-Sociologia/image/Logo-noturno.png';
    }
    if (document.getElementById('icon-login')) {
        document.getElementById('icon-login').src = 'http://localhost/Terere-com-Sociologia/image/Bg-Login-Icon-Noturno.png';
    }
    if (document.getElementById('icon-login-secundario')) {
        document.getElementById('icon-login-secundario').src = 'http://localhost/Terere-com-Sociologia/image/Bg-Login-Icon-Noturno.png';
    }
    if (document.getElementById('img-cadastro-finalizado')) {
        document.getElementById('img-cadastro-finalizado').src = 'http://localhost/Terere-com-Sociologia/image/Bg-Conta-Criada-Icon-Noturno.png';
    }
    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    document.body.classList.remove('darkmode');
    if (document.getElementById('img-logo')) {
        document.getElementById('img-logo').src = 'http://localhost/Terere-com-Sociologia/image/Logo-claro.png';
    }
    if (document.getElementById('img-logo-index')) {
        document.getElementById('img-logo-index').src = 'http://localhost/Terere-com-Sociologia/image/Logo-claro.png';
    }
    if (document.getElementById('icon-login')) {
        document.getElementById('icon-login').src = 'http://localhost/Terere-com-Sociologia/image/Bg-Login-Icon-Claro.png';
    }
    if (document.getElementById('icon-login-secundario')) {
        document.getElementById('icon-login-secundario').src = 'http://localhost/Terere-com-Sociologia/image/Bg-Login-Icon-Claro.png';
    }
    if (document.getElementById('img-cadastro-finalizado')) {
        document.getElementById('img-cadastro-finalizado').src = 'http://localhost/Terere-com-Sociologia/image/Bg-Conta-Criada-Icon-Claro';
    }
    localStorage.setItem('darkMode', null);
}

if (darkMode === 'enabled') {
    enableDarkMode();
}
var msg = [];
var statusEmail = '';
const fields = document.querySelectorAll("[required]")
var emailVerificado;
function ValidateField(field) {
    // logica para verificar se existem erros
    function verifyErrors() {
        let foundError = false;
        if (field.id == "senha" || field.id == "email" && field.value != null || field.value != "") {
            const spanError = field.parentNode.querySelector("span.error")
            spanError.innerHTML = '';
            if (field.id == "senha") {
                erro = senhaValida(field);
            } else if (field.id == "email") {
                erro = validacaoEmail(field);

                if (erro == null || erro == "E-mail inválido") {
                    foundError = "valueMissing";
                }
            }
        } else {
            for (let error in field.validity) {
                // se não for customError
                // então verifica se tem erro
                if (field.validity[error] && !field.validity.valid) {
                    foundError = error
                }
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
                valueMissing: msg,
            },
            email: {
                valueMissing: statusEmail,
            }
        }
        if (field.type == "textarea") {
            return messages[field.type]
        } else {
            return messages[field.type][typeError]
        }
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
            if (field.id == "senha_atual") {
                field.style.borderColor = "#fff"
            } else {
                const message = customMessage(error)
                field.style.borderColor = "var(--cor_vermelha)"
                setCustomMessage(message)
            }

        } else {
            field.style.borderColor = "var(--cor_verde)"
            setCustomMessage()
        }
    }
}

function customValidation(event) {
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

document.querySelector("form")
    .addEventListener("submit", event => {
        console.log("enviar o formulário")

    })

//ocultar e mostrar senha
function mostrar() {
    if ($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass("fa-eye");
        $('#show_hide_password i').removeClass("fa-eye-slash");
    } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass("fa-eye");
        $('#show_hide_password i').addClass("fa-eye-slash");
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
        statusEmail = "E-mail válido"
        spanError.innerHTML = "E-mail válido";
        field.style.borderColor = "var(--cor_verde)"
        return statusEmail;
    }
    else if (dominio) {
        const spanError = field.parentNode.querySelector("span.error")
        spanError.classList.add("active")
        statusEmail = "E-mail inválido";
        spanError.innerHTML = statusEmail;
        field.style.borderColor = "var(--cor_vermelha)"
        return statusEmail;
    }
}

function senhaValida(password) {
    msg = '';
    var p = password;
    var letrasMaiusculas = /[A-Z]/;
    var letrasMinusculas = /[a-z]/;
    var numeros = /[0-9]/;
    var caracteresEspeciais = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
    if (p.length < 8) {
        msg = msg + "A senha deve possuir no mínimo 8 caracteres </br>";
    }
    var auxMaiuscula = 0;
    var auxMinuscula = 0;
    var auxNumero = 0;
    var auxEspecial = 0;
    for (var i = 0; i < p.length; i++) {
        if (letrasMaiusculas.test(p[i]))
            auxMaiuscula++;
        else if (letrasMinusculas.test(p[i]))
            auxMinuscula++;
        else if (numeros.test(p[i]))
            auxNumero++;
        else if (caracteresEspeciais.test(p[i]))
            auxEspecial++;
    }
    if (auxMaiuscula == 0) {
        msg = msg + "A senha deve possuir no mínimo 1 letra maiuscula </br>";
    }
    if (auxMinuscula == 0) {
        msg = msg + "A senha deve possuir no mínimo 1 letra minuscula </br>";
    }
    if (auxNumero == 0) {
        msg = msg + "A senha deve possuir no mínimo 1 número</br>";
    }
    if (auxEspecial == 0) {
        msg = msg + "A senha deve possuir no mínimo 1 caractere especial</br>";
    }

    if (msg) {
        const spanError = document.getElementById("error-senha")
        spanError.classList.add("active")
        spanError.innerHTML = msg;

    } else {
        const spanError = document.getElementById("error-senha")
        spanError.classList.remove("active")
        spanError.innerHTML = null;

        if (document.getElementById("senhaNova")) {
            var input = document.getElementById("senhaNova")
        } if (document.getElementById("senha")) {
            var input = document.getElementById("senha")
        }
        input.style.borderColor = "var(--cor_verde)"
    }
    return msg;
}

function ativaCampo(campo) {
    campo.disabled = false;
}

function habilitaCampoTermo() {
    document.getElementById("nome").disabled = false;
    document.getElementById("conceito").disabled = false;
    document.getElementById("nomeVariavel").disabled = false;
}

function habilitaCampoDados() {
    document.getElementById("nomeCompleto").disabled = false;
    document.getElementById("nomeUsuario").disabled = false;
    document.getElementById("email").disabled = false;
}
function habilitaCampoRedes() {
    document.getElementById("nome").disabled = false;
    document.getElementById("descricao").disabled = false;
}
function habilitaCampoPublicacao() {
    document.getElementById("titulo").disabled = false;
    document.getElementById("resumo").disabled = false;
}

var texto = document.getElementById("texto");
function pegaTexto() {
    debugger
    document.getElementById("texto_publicacao").value = document.getElementById("texto").innerHTML;
}

function mudarAvatar(id) {
    document.getElementById("fotAvatar").src = "http://localhost/Terere-com-Sociologia/image/avatares/Avatar-" + id + ".png";
    document.getElementById("fotoAvatar").value = "http://localhost/Terere-com-Sociologia/image/avatares/Avatar-" + id + ".png";
}

function validaSubmiti() {
    habilitaCampoPublicacao();
    pegaTexto();
}

function filtraUsuario(filter) {
    var filter = filter.toUpperCase();
    var tbody = document.getElementById("table-tbody")
    var tr = tbody.getElementsByTagName("tr");

    for (a = 0; a != tr.length; a++) {
        var elements = tr[a].children[1].innerHTML;
        if (elements.toUpperCase().indexOf(filter) > -1) {
            tr[a].style.display = "";
        } else {
            tr[a].style.display = "none";
        }
    }
}

function validaFormulario(event) {
    const spanError = document.getElementById("error-senha")
    var novaSenha = document.getElementById("senhaNova").value

    if (spanError.innerHTML != "") {
        event.preventDefault();
    }
    if (novaSenha == "") {
        event.preventDefault();
    }
}

function validaFormularioCadastro(event) {
    const spanError = document.getElementById("error-senha")
    if (spanError.innerHTML != "") {
        event.preventDefault();
    }
}
function validaCampoPublicacao(input) {
    debugger
    if (input.id == "titulo") {
        if(input.value.length == 0){
            document.getElementById("error-titulo").innerHTML = "";
            document.getElementById("error-titulo-caracters").innerHTML = 0 + "/255";
            document.getElementById("error-obrigatorio").classList.remove("d-none");
            document.getElementById("error-titulo-caracters").style.color = "var(--cor_vermelha)";

        }
        if (input.value.length <= 25) {
            document.getElementById("error-titulo").innerHTML = "Mínimo 25 caracteres";
            document.getElementById("error-obrigatorio").classList.add("d-none");
            document.getElementById("error-titulo-caracters").innerHTML = input.value.length + "/255";
            document.getElementById("error-titulo-caracters").style.color = "var(--cor_vermelha)";

        }if(input.value.length > 255){
            document.getElementById("error-titulo").innerHTML = "Limite atingido";
            document.getElementById("error-titulo-caracters").style.color = "var(--cor_vermelha)";
        }
        if (input.value.length >= 25 && input.value.length < 255) {
            document.getElementById("error-titulo").innerHTML = "";
            document.getElementById("error-titulo-caracters").innerHTML = input.value.length + "/255";
            document.getElementById("error-titulo-caracters").style.color = "var(--cor_verde)";
        }
        
    }
    if(input.id == "resumo"){
        if(input.value.length == 0){
            document.getElementById("error-comentario").innerHTML = "Campo obrigatório";
            document.getElementById("error-comentario-caracters").innerHTML = 0 + "/300";
            document.getElementById("error-comentario-caracters").style.color = "var(--cor_vermelha)";
        }
        if(input.value.length > 300){
            document.getElementById("error-comentario").innerHTML = "Limite atingido";
            document.getElementById("error-comentario-caracters").style.color = "var(--cor_vermelha)";
            document.getElementById("error-comentario-caracters").innerHTML = input.value.length + "/300";
        }
        if (input.value.length <= 30) {
            document.getElementById("error-comentario").innerHTML = "Mínimo 30 caracteres";
            document.getElementById("error-comentario-caracters").innerHTML = input.value.length + "/300";
            document.getElementById("error-comentario-caracters").style.color = "var(--cor_vermelha)";
        }
        if (input.value.length >= 30 && input.value.length < 300) {
            document.getElementById("error-comentario").innerHTML = "";
            document.getElementById("error-comentario-caracters").innerHTML = input.value.length + "/300";
            document.getElementById("error-comentario-caracters").style.color = "var(--cor_verde)";
        }
    }
    if(input.id == "texto"){
        if(input.outerText.length == 0){
            document.getElementById("error-texto").innerHTML = "Campo obrigatório";
            document.getElementById("error-texto-caracters").innerHTML = 0 + "/300";
            document.getElementById("error-texto-caracters").style.color = "var(--cor_vermelha)";
        }
        if (input.outerText.length <= 100) {
            document.getElementById("error-texto").innerHTML = "Mínimo 100 caracteres";
            document.getElementById("error-texto-caracters").innerHTML = input.outerText.length;
            document.getElementById("error-titulo-caracters").style.color = "var(--cor_vermelha)";
        }if (input.outerText.length >= 100) {
            document.getElementById("error-texto").innerHTML = "";
            document.getElementById("error-texto-caracters").innerHTML = input.outerText.length;
            document.getElementById("error-texto-caracters").style.color = "var(--cor_verde)";
        }
    }
}

function validaFormularioPublicacao(event){
    debugger
    titulo = document.getElementById("error-titulo").innerHTML;
    resumo = document.getElementById("error-comentario").innerHTML;
    texto = document.getElementById("error-texto").innerHTML;
    var categoria = document.getElementById("select-termo").value;
    if(categoria == "" || categoria == "Selecionar..."){
        document.getElementById("error-categoria").innerHTML = "Campo obrigatório";
        event.preventDefault();
    }
    if(titulo == ""){
        document.getElementById("error-comentario").innerHTML = "Campo obrigatório";
    }
    if(texto.length <= 36){
        document.getElementById("error-texto").innerHTML = "Campo obrigatório";
    }
    if(resumo == ""){
        document.getElementById("error-comentario").innerHTML = "Campo obrigatório";
    }
    if (titulo != "" || resumo != "" || texto != "" ||categoria == "" || categoria == "Selecionar..."){
        event.preventDefault();
    }
}