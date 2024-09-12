


document.addEventListener('DOMContentLoaded', function () {
    const editarBtn = document.querySelector('.boton_editar_informacion_personal');
    const editarDomBtn = document.querySelector('.boton_editar_domicilio');

    const cancelarBtn = document.querySelector('.boton_cancelar');
    const cancelarDOMBtn = document.querySelector('.boton_cancelar_dom');

    const contenedor_formulario_informacion_personal = document.querySelector('.contenedor_formulario_informacion_personal');
    const contenedor_formulario_domicilio = document.querySelector('.contenedor_formulario_domicilio');


    editarBtn.addEventListener('click', function () {
        contenedor_formulario_informacion_personal.classList.remove('hidden');
    });
    editarDomBtn.addEventListener('click', function () {
        contenedor_formulario_domicilio.classList.remove('hidden');
    });

    cancelarBtn.addEventListener('click', function(){

        contenedor_formulario_informacion_personal.classList.add('hidden');

    });
    
    cancelarDOMBtn.addEventListener('click', function(){
        contenedor_formulario_domicilio.classList.add('hidden');
    });

});

