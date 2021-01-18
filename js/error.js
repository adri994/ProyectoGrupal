export const error = (form,mensaje) =>{

    if(form.lastElementChild.id !== 'alert-Error'){

        const fragment = document.createDocumentFragment();

        const div = document.createElement('div');

        div.setAttribute('id','alertError');
        div.classList.add('alert','alert-danger','alert-dismissible','text-center')

        div.textContent = mensaje;

        fragment.appendChild(div);

        form.appendChild(fragment);

    }
   
}