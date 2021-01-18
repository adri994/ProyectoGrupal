import {validateEmail,validatePass,validateNombres,validateDni} from "./Exp_regulares.js";
import {error} from "./error.js";



const form = document.getElementById('login-form');



form.addEventListener('click',(e)=>{

    switch (e.target.dataset.action) {
        case 'usuario':

            const validarEmail = validateEmail(document.getElementById('email').value);
            const validarPass = validatePass(document.getElementById('password').value);

            if(validarEmail && validarPass){

                e.target.setAttribute('type','submit');

            }else{

                error(document.getElementById('login-box'),"Email y contraseña no son válidos");
            }
            
            break;
        
        case 'paciente':
            // añadido José Luis
            var dni=document.getElementById('dni').value.toUpperCase();
            document.getElementById('dni').value=dni;
            const validarDni = validateDni(dni);

            if(validarDni){

                e.target.setAttribute('type','submit');

            }else{

                error(document.getElementById('login-box'),"DNI no válido");
            }
            
            break;
    
        default:
            break;
    }
    
})  

// Muestra el servidor de correo 
var URLsearch = window.location.search;
if(URLsearch == '?enviado!') {
    window.open('http://localhost:5000', '_blank');
}









