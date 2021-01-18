//ser_ext='http://192.168.0.57/vcserver/';
//ser_ext = 'http://192.168.1.10/covid/';
ser_ext = 'http://192.168.1.17/servidor/';

//ser_ext = 'http://192.168.1.17/covid/';
// >>>>>>> a627c3cd3f767d1795d94756e27ffde74022d76a
//      FUNCIONES PARA RASTREADOR



cod_acc_serv = 'a2b7878e96994cfdf318';


//      FUNCIONES PARA MEDICO Y ADMINISTRADOR

function lista(id) { // terminada

    document.getElementById("adicional").innerHTML = "";
    document.getElementById("seccion").innerHTML = "";

    var url;
    var titulo;
    if (id == "") { // listado completo de pacientes
        url = ser_ext + "serv_usu.php?accion=lista&cas=" + cod_acc_serv + "&filtro=";
        titulo = "Listado de pacientes";
    } else { // listado de mis pacientes
        url = ser_ext + "serv_usu.php?accion=lista&cas=" + cod_acc_serv + "&filtro=id&valor=" + id;
        titulo = "Listado de mis pacientes";
    }

    document.getElementById('titulo').innerHTML = titulo;

    fetch(url)
        .then(response => response.json())
        .then(res => {
            if (res.length > 0) {

                document.getElementById("seccion").innerHTML = listadosMedico(res);

            } else { alert('No coincide con ningún registro'); }
        })
}

function busqueda() { // terminada
    var formulario = new Array();
    formulario = [document.getElementById('dni').value, document.getElementById('codigo_acceso').value, document.getElementById('apellido_1').value, document.getElementById('apellido_2').value, document.getElementById('nombre').value, document.getElementById('contagiado').checked, document.getElementById('curado').checked, document.getElementById('fallecido').checked];
    var url = ser_ext + "serv_usu.php?accion=lista&cas=" + cod_acc_serv + "&filtro=";

    if (formulario[0] != "") { // busqueda por dni
        url += "dni&valor=" + formulario[0].toUpperCase();
        fetch(url)
            .then(response => response.json())
            .then(res => {
                if (res.length > 0) {
                    document.getElementById("seccion").innerHTML = listadosMedico(res);

                    document.getElementById('titulo').innerHTML = "Paciente";
                } else { alert('No coincide con ningún registro'); }
            })
    } else {
        if (formulario[1] != "") { // busqueda por código de acceso
            url += "codigo_acceso&valor=" + formulario[1].toLowerCase();
            fetch(url)
                .then(response => response.json())
                .then(res => {
                    if (res.length > 0) {
                        document.getElementById("seccion").innerHTML = listadosMedico(res);

                        document.getElementById('titulo').innerHTML = "Paciente";
                    } else { alert('No coincide con ningún registro'); }
                })
        } else {
            if (formulario[2] != "") { // busquda por apellidos
                url += "apellidos&valor=" + formulario[2] + "," + formulario[3] + "," + formulario[4];
                fetch(url)
                    .then(response => response.json())
                    .then(res => {
                        if (res.length > 0) {
                            document.getElementById("seccion").innerHTML = listadosMedico(res);

                            document.getElementById('titulo').innerHTML = "Pacientes";
                        } else { alert('No coincide con ningún registro'); }
                    })
            } else {
                if (formulario[5] || formulario[6] || formulario[7]) { // busqueda por estado
                    url += "estado&valor=" + formulario[5] + "," + formulario[6] + "," + formulario[7];
                    console.log(url);
                    fetch(url)
                        .then(response => response.json())
                        .then(res => {
                            if (res.length > 0) {
                                document.getElementById("seccion").innerHTML = listadosMedico(res);

                                document.getElementById('titulo').innerHTML = "Pacientes según criterio";
                            } else { alert('No coincide con ningún registro'); }
                        })
                } else {

                }

            }
        }
    }
    limpiaFormMedico();

}

async function datosPaciente(dni) { // terminado

    // datos del paciente
    var url = ser_ext + "serv_usu.php?accion=datos&cas=" + cod_acc_serv + "&dni=" + dni;
    var respuesta = "";
    const x = await fetch(url);
    const res = await x.json();

    document.getElementById("nombreApell").innerHTML += res[0].nombre + " " + res[0].apellido_1 + " " + res[0].apellido_2;
    document.getElementById("dni").innerHTML += res[0].dni;
    document.getElementById("telefono").innerHTML += res[0].telefono;
    document.getElementById("email").innerHTML += res[0].email;
    document.getElementById("cap").innerHTML += res[0].codigo_acceso;
    document.getElementById("estado").innerHTML += res[0].estado;
}

function historial(dni) { // Presenta el listado de notas del paciente

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = this.responseText;
            document.getElementById("adicional").innerHTML = respuesta;
        }
    };
    xhttp.open("GET", 'data_source/notas_usuario.php?dni=' + dni, true);
    xhttp.send();

}


//          FUNCIONES AUXILIARES

function limpiaAlta() { //terminado
    document.getElementById("dni").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("apellido_1").value = "";
    document.getElementById("apellido_2").value = "";
    document.getElementById("email").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("nota").value = "";
    document.getElementById("id_usuario").value = "";
    alert("Paciente añadido/modificado");
}

function limpiaFormMedico() { //terminado
    document.getElementById('dni').value = "";
    document.getElementById('codigo_acceso').value = "";
    document.getElementById('apellido_1').value = "";
    document.getElementById('apellido_2').value = "";
    document.getElementById('nombre').value = "";
    document.getElementById('contagiado').checked = false;
    document.getElementById('curado').checked = false;
    document.getElementById('fallecido').checked = false;
}

function listadosMedico(res) { // terminado
    var respuesta = `<table class="table table-hover" id='listado'>`;
    respuesta += `
        <thead>
            <tr class="text-center">
                <th colspan='2'>Apellidos</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Código de acceso</th>
                <th>Estado actual</th>
            </tr>
        </thead>
        <tbody>
    `;
    for (i = 0; i < res.length; i++) {
        respuesta += `

                <tr id='editable' class='text-center' onclick='window.location.replace("editar_paciente.php?dni=${res[i].dni}")'>
                    <td>${res[i].apellido_1}</td>
                    <td>${res[i].apellido_2}</td>
                    <td>${res[i].nombre}</td>
                    <td>${res[i].dni}</td>
                    <td>${res[i].codigo_acceso}</td>
                    <td>${res[i].estado}</td>
                </tr>
        `;
    }
    respuesta += `</tbody></table>`;
    return respuesta;
}

function editar(dni, nota, estado, id_nota) { // Pasa a la ventana de edición, donde se carga el formulario de nuevas notas y el listado de notas (historial).


    if (nota != null) {
        document.getElementById("nota").value = nota;
        document.getElementById("bot_modif").value = "Actualizar";
        document.getElementById("bot_modif").title = "Actualizar la nota";
        document.getElementById("id_nota").value = id_nota;

        switch (estado) {
            case 'contagiado':
                document.getElementById("est_cont").checked = true;
                break;
            case 'curado':
                document.getElementById("est_cur").checked = true;
                break;
            case 'fallecido':
                document.getElementById("est_fall").checked = true;
                break;
        }
    } else {
        historial(dni);
    }

}


function confirmar() { // Devuelve una alerta para el caso de pulsar el boton salir, si hay algún dato en la nota.
    if (document.getElementById("nota").value == "") {
        window.location.replace("medico.php");
    } else {
        var opcion = confirm('Se dispone a salir sin guardar.\n\n¿Quiere salir y descartar los cambios?');
        if (opcion == true) {
            window.location.replace("medico.php");
        }
    }
};