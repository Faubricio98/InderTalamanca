function cargarLineaTiempo(button) {
    parametros = { "num_p": button.id };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Proyecto&accion=saveNumProyecto',
            type: 'post',
            beforeSend: function () {}, //antes de enviar   
            success: function (response) {
                window.location.href = '?controlador=Proyecto&accion=mostrarLineaTiempo';
            } //se ha enviado
        }
    );
}

function timer() {
    var initTime = 5;
    // Update the count down every 1 second
    var x = setInterval(function () {
        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = initTime;
        initTime--;
        
        if (initTime < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Redirigiendo......";
            window.location.href = '?controlador=Index&accion=mostrar';
        }
    }, 1000);
}