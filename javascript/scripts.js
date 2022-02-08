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
        document.getElementById('img-logo').src = '../image/Logo-noturno.png';
    }
    if (document.getElementById('img-logo-index')) {
        document.getElementById('img-logo-index').src = 'image/Logo-noturno.png';
    }
    if (document.getElementById('icon-login')) {
        document.getElementById('icon-login').src = '../image/Bg-Login-Icon-Noturno.png';
    }
    if (document.getElementById('icon-login-secundario')) {
        document.getElementById('icon-login-secundario').src = '../image/Bg-Login-Icon-Noturno.png';
    }
    if (document.getElementById('img-cadastro-finalizado')) {
        document.getElementById('img-cadastro-finalizado').src = '../image/Bg-Conta-Criada-Icon-Noturno.png';
    }
    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    document.body.classList.remove('darkmode');
    if (document.getElementById('img-logo')) {
        document.getElementById('img-logo').src = '../image/Logo-claro.png';
    }
    if (document.getElementById('img-logo-index')) {
        document.getElementById('img-logo-index').src = 'image/Logo-claro.png';
    }
    if (document.getElementById('icon-login')) {
        document.getElementById('icon-login').src = '../image/Bg-Login-Icon-Claro.png';
    }
    if (document.getElementById('icon-login-secundario')) {
        document.getElementById('icon-login-secundario').src = '../image/Bg-Login-Icon-Claro.png';
    }
    if (document.getElementById('img-cadastro-finalizado')) {
        document.getElementById('img-cadastro-finalizado').src = '../image/Bg-Conta-Criada-Icon-Claro';
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
            const message = customMessage(error)
            field.style.borderColor = "var(--cor_vermelha)"
            setCustomMessage(message)
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
    var p = password.value;
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
        const spanError = password.parentNode.querySelector("span.error")
        spanError.classList.add("active")
        spanError.innerHTML = msg;
        password.style.borderColor = "var(--cor_vermelha)"

    } else {
        const spanError = password.parentNode.querySelector("span.error")
        spanError.classList.remove("active")
        spanError.innerHTML = null;
        password.style.borderColor = "var(--cor_verde)"
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

function encodeImageFileAsURL() {
    var filesSelected = document.getElementById("img").files;
    if (filesSelected.length > 0) {
        debugger
        debugger
        var fileToLoad = filesSelected[0];
        var fileReader = new FileReader();
        fileReader.onload = function (fileLoadedEvent) {
            debugger
            var srcData = fileLoadedEvent.target.result; // <--- data: base64
            document.getElementById("file-img").value = srcData;

        }
        fileReader.readAsDataURL(fileToLoad);
    }
}

var inputFileToLoad = document.getElementById("img");
inputFileToLoad.addEventListener("change", function () {
    encodeImageFileAsURL()
});

var texto = document.getElementById("texto");
function pegaTexto() {
    document.getElementById("texto_publicacao").value = document.getElementById("texto").innerHTML;
}

function mudarAvatar(id) {
    document.getElementById("fotAvatar").src = "http://localhost/2021-projeto-final-curso/image/avatares/Avatar-" + id + ".png";
    document.getElementById("fotoAvatar").value = "http://localhost/2021-projeto-final-curso/image/avatares/Avatar-" + id + ".png";
}