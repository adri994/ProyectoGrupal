const validateEmail = (email) => {
    const emailRegex = /^(([^<>()\[\]\\.,:\s@"]+(\.[^<>()\[\]\\.,:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    if (emailRegex.test(email)) return true
    else return false
}

const validatePass = (pass) => {

    const passRegex = /([a-z A-Z]|[1-9]){8}$/

    if (passRegex.test(pass)) return true
    else return false
}

const validateNombres = (name) => {

    const passRegex = /^([a-z A-Z]{1}[a-zñáéíóú]+[\s]*)+$/

    if (passRegex.test(name)) return true
    else return false
}

const validatePhone = (phone) => {

    const phoneRegex = /^[9|6]{1}([\d]{2}[-]*){3}[\d]{2}$/

    if (phoneRegex.test(phone)) return true
    else return false
}


// añadido José Luis

const validateDni = (dni) => {

    const passRegexDni = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i
    const passRegexNie = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;

    if (passRegexDni.test(dni) || passRegexNie.test(dni)) return true
    else return false
}

const validateEstado = (estado) => {


    if (estado === 'curado' || estado === 'fallecido' || estado === 'contagiado') return true
    else return false
}

export { validateEmail, validatePass, validateNombres, validateDni, validatePhone, validateEstado };