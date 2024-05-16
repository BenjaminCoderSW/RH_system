<!-- Este archivo lo usamos es unicamente un boton para retroceder a la ultima pagina o vista, es un boton html de back 
con funcionamiento, lo usamos en: user_update, -->
<a href="#" class="btn btn-secondary btn-back"> <-- Regresar </a>

<script type="text/javascript">
    // Seleccionamos ese boton mediante su clase .btn-back y lo almacenamos en btn_back
    let btn_back = document.querySelector(".btn-back");

    // Una vez seleccionado se le va asignar un evento a ese elemento
    btn_back.addEventListener('click', function(e){
        e.preventDefault();
        // Redirecciona a la ultima pagina que hemos visto en el navegador, retrocede por ese es el boton de back
        window.history.back();
    });
</script>