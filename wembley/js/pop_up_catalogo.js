


document.addEventListener('DOMContentLoaded', function () {

    const agregar_no_sesion = document.querySelector('#agregar_no_sesion');
    const btn_cancelar_agregar_no_sesion = document.querySelector('.cancelar_btn');
    const pop_up_catalogo = document.querySelector('.pop_up_catalogo');

    btn_cancelar_agregar_no_sesion.addEventListener('click',function(){
        pop_up_catalogo.classList.add('hidden')
    });

    agregar_no_sesion.addEventListener('click', function(){
        pop_up_catalogo.classList.remove('hidden')
    });




});

