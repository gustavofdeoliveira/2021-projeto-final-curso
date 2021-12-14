const fields = document.querySelectorAll("[required]")
function ValidateField(field) {
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
        debugger
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
            debugger
            field.style.borderColor = "#AF3320 !important"
            setCustomMessage(message)
        } else {
            field.style.borderColor = "#1B3A02 !important"
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
