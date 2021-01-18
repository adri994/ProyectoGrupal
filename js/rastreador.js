import { validateEmail, validateNombres, validateDni, validatePhone, validateEstado } from "./Exp_regulares.js";

const newPaciente = document.getElementById('newPaciente');
const buscar = document.getElementById('buscar');
const seccion = document.getElementById('infoRastreador');
const aviso = document.getElementById('infoModal');
const inputs = document.querySelectorAll('input');
let url;
let vista;

var validacion = {
    dni: false,
    nombre: false,
    apellido_1: false,
    apellido_2: false,
    email: false,
    phone: false,
    estado: false,

}

var { dni, email, nombre, apellido_1, apellido_2, phone, estado } = validacion;
/* Evento */


addEventListener('load', (e) => {


    const data = new FormData();

    data.append('envio', '1');

    const config = {
        method: 'POST',
        body: data
    };


    fetch("./bddsx/config.php", config)
        .then(res => res.json())
        .then(resp => url = resp)
})

aviso.addEventListener('click', (e) => {

    if (e.target.id === 'cerrar') cargaPaciente();
    aviso.firstElementChild.remove();
})


newPaciente.addEventListener('click', (e) => {
    resetValidate();
    formPaciente();
})

buscar.addEventListener('click', (e) => {
    modificarValidate();
    cargaPaciente();

})

const cargaPaciente = () => {
    const [url1, acceso] = url;
    vista = `${url1}serv_usu.php?cas=${acceso}&accion=lista&filtro=`;


    fetch(vista)
        .then(response => response.json())
        .then(res => tablaPaciente(res))
}

seccion.addEventListener('click', (e) => {

    if (e.target.id === 'nuevoPaciente') crearPaciente(e);
    else if (e.target.id === 'updatePaciente') actualizarPaciente();
    else if (e.target.parentNode.classList[0] === 'dataPaciente') vistaPaciente(e.target.parentNode.id);
    else if (e.target.id === 'cerrar') cargaPaciente();
    else if (e.target.id === 'cerra') console.log(seccion.lastElementChild.remove());



})

seccion.addEventListener('keyup', (e) => {
    validarCampo(e.target);
})
seccion.addEventListener('change', e => {
    validarCampo(e.target);
})

/* Renderizar */


const formPaciente = () => {
    seccion.classList.remove('text-center');
    const [url1, acceso] = url;
    seccion.innerHTML = `
    <div id="login-box" class="col-md-6">
        <form id="login-form" method="post">
            <h3 class="text-center text-info">Agregar Paciente</h3>
            <div class="form-group input_forma">
                <label for="email" class="text-info">Dni</label><br>
                <input type="text" name="dni" id="dni" class="form-control" required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="email" class="text-info">Email</label><br>
                <input type="email" name="email" id="email" class="form-control" required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            
            <div class="form-group input_forma">
                <label for="nombre" class="text-info">Nombre</label><br>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="apellido1" class="text-info">Apellido1</label><br>
                <input type="text" name="apellido_1" id="apellido_1" class="form-control" required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="apellido2" class="text-info">Apellido2</label><br>
                <input type="text" name="apellido_2" id="apellido_2" class="form-control" required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="telefono" class="text-info">Teléfono</label><br>
                <input type="text" name="telefono" id="telefono" class="form-control" required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>  
            <div class="form-group">
            <label for="telefono" class="text-info">Estado</label><br>
                <select class="form-control" name='estado' id='estado' required>
                    <option value=''>---Seleccionar---</option>
                    <option value='contagiado'>Contagiado</option>
                    <option value='fallecido'>Fallecido</option>
                    <option value='curado'>Curado</option>
                </select>
            </div>                  
            <div class="form-group">
                <button id='nuevoPaciente' type="button" value='alta' name="submit" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Nuevo</button>
            </div>
        </form>
    </div>

    `;


}



const modal = (resp) => {
    const [mensaje, id] = resp;
    aviso.innerHTML = `
<div class="modal fade show pantalla" id="myModal" arial-modal='true' style='display:block;'>
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
  
            <div class="modal-body ">
                <h2 class='text-center text-success text-uppercase h5'>${mensaje}</h2>
            </div>
      
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id=${id}>Close</button>
            </div>
    
        </div>
    </div>
</div>
    `;
}



const tablaPaciente = (pacientes) => {
    seccion.classList.add('text-center');
    seccion.innerHTML = `
    <table class="table table-hover" id='listado'></table>`;
    document.getElementById('listado').innerHTML += `
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>1 Apellido</th>
                <th>2 Apellido</th>
                <th>Estado</th>
            </tr>
        </thead>
    `

    pacientes.forEach(e => {
        document.getElementById('listado').innerHTML += `
            <tr id=${e.dni} class='dataPaciente'>
                <td class='paciente'>${e.dni}</td>
                <td class='paciente'>${e.nombre}</td>
                <td class='paciente'>${e.apellido_1}</td>
                <td class='paciente'>${e.apellido_2}</td>
                <td class='paciente'>${e.estado}</td>
                
            </tr>
            `
    });

    seccion.innerHTML += "</table>"
}

const datoPaciente = async(dni) => {
    const response = await fetch(`${url}serv_usu.php?accion=datos&dni=${dni}`);
    const data = await response.json();
    vistaPaciente(data);

}

const vistaPaciente = async(dni) => {
    seccion.classList.remove('text-center');

    const [url1, acceso] = url;

    let urlext = `${url1}serv_usu.php?accion=datos&cas=${acceso}&dni=${dni}`;

    const x = await fetch(urlext);
    const res = await x.json();

    seccion.innerHTML = `
    <div id="login-box" class="col-md-6">
        <form id="login-form" method="post">
            <h3 class="text-center text-info">Modificar Paciente</h3>
            <div class="form-group">
                <label for="email" class="text-info">Dni</label><br>
                <input type="text" name="dni" id="dni" class="form-control" disabled value=${res[0].dni} >
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="email" class="text-info">Email</label><br>
                <input type="email" name="email" id="email" class="form-control" value=${res[0].email} >
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            
            <div class="form-group input_forma">
                <label for="nombre" class="text-info">Nombre</label><br>
                <input type="text" name="nombre" id="nombre" class="form-control" value=${res[0].nombre} required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="apellido1" class="text-info">Apellido1</label><br>
                <input type="text" name="apellido_1" id="apellido_1" class="form-control" value=${res[0].apellido_1} required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="apellido2" class="text-info">Apellido2</label><br>
                <input type="text" name="apellido_2" id="apellido_2" class="form-control" value=${res[0].apellido_2} >
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>
            <div class="form-group input_forma">
                <label for="telefono" class="text-info">Teléfono</label><br>
                <input type="text" name="telefono" id="telefono" class="form-control" value=${res[0].telefono} required>
                <i class="formulario__validacion-estado fas fa-times-circle show error"></i>
            </div>                   
            <div class="form-group input_forma">
                <button id='updatePaciente' type="button" value="${res[0].codigo_acceso}" name="submit" class="btn btn-info btn-md" >Grabar</button>
            </div>
        </form>
    </div>
    `;

}


const crearPaciente = async(e) => {

    if (dni && email && nombre && apellido_1 && apellido_2 && phone && estado) {
        const [url1, acceso] = url;
        const data = new FormData();

        data.append('nombre', `${document.getElementById('nombre').value}`);
        data.append('apellido_1', `${document.getElementById('apellido_1').value}`);
        data.append('apellido_2', `${document.getElementById('apellido_2').value}`);
        data.append('dni', `${document.getElementById('dni').value}`);
        data.append('email', `${document.getElementById('email').value}`);
        data.append('telefono', `${document.getElementById('telefono').value}`);
        data.append('estado', `${document.getElementById('estado').value}`);
        data.append('accion', `alta`);
        data.append('cas', `${acceso}`);

        const config = {
            method: 'POST',
            body: data
        };




        try {
            const ft = await fetch(`${url1}serv_usu.php`, config);
            const text = await ft.json();
            await modal(text);
        } catch (error) {
            await modal(error);
        }
    } else {
        modal(['Error: Unos de los Campos es invalido.', 'cerra']);

    }

}

const actualizarPaciente = async() => {

    if (email && nombre && apellido_1 && apellido_2 && phone) {
        const [url1, acceso] = url;
        const data = new FormData();

        data.append('nombre', `${document.getElementById('nombre').value}`);
        data.append('apellido_1', `${document.getElementById('apellido_1').value}`);
        data.append('apellido_2', `${document.getElementById('apellido_2').value}`);
        data.append('email', `${document.getElementById('email').value}`);
        data.append('telefono', `${document.getElementById('telefono').value}`);
        data.append('codigo', `${document.getElementById('updatePaciente').value}`);
        data.append('accion', `actualizar_paciente`);
        data.append('cas', `${acceso}`);

        const config = {
            method: 'POST',
            body: data
        };

        try {
            const ft = await fetch(`${url1}serv_usu.php`, config);
            const text = await ft.json();
            await modal(text);
        } catch (error) {
            await modal(error);
        }

    } else {
        modal(['Error: Unos de los Campos es invalido.', 'cerra']);
    }


}

/* Validacion */


const resetValidate = () => {
    dni = email = nombre = apellido_1 = apellido_2 = phone = estado = false;

}

const modificarValidate = () => {

    dni = email = nombre = apellido_1 = apellido_2 = phone = estado = true;



}

const validarCampo = (campo) => {

    const icons = document.querySelector(`#${campo.id}+i`)
    switch (campo.id) {
        case 'dni':
            const isDNI = validateDni(campo.value);
            icons.classList.replace('show', 'face');
            cambioIcono(icons, isDNI);
            dni = isDNI;
            break;
        case 'nombre':
            const isName = validateNombres(campo.value);
            icons.classList.replace('show', 'face');
            cambioIcono(icons, isName);
            nombre = isName;
            break;
        case 'apellido_1':
            const isApellido_1 = validateNombres(campo.value);
            icons.classList.replace('show', 'face');
            cambioIcono(icons, isApellido_1);
            apellido_1 = isApellido_1;
            break;
        case 'apellido_2':
            const isApellido_2 = validateNombres(campo.value);
            icons.classList.replace('show', 'face');
            cambioIcono(icons, isApellido_2);
            apellido_2 = isApellido_2;
            break;
        case 'email':
            const isEmail = validateEmail(campo.value);
            icons.classList.replace('show', 'face');
            cambioIcono(icons, isEmail);
            email = isEmail;
            break;
        case 'telefono':
            const isTelefono = validatePhone(campo.value);
            icons.classList.replace('show', 'face');
            cambioIcono(icons, isTelefono);
            phone = isTelefono;
            break;
        case 'estado':
            const isEstado = validateEstado(campo.value);
            estado = isEstado;
            break;

        default:
            break;
    }

}

const cambioIcono = (icono, validar) => {
    if (validar) {
        icono.classList.replace('fa-times-circle', 'fa-check-circle');
        icono.classList.replace('error', 'valido');
    } else {
        icono.classList.replace('fa-check-circle', 'fa-times-circle');
        icono.classList.replace('valido', 'error');
    }
}