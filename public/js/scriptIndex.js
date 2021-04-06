function logInUser(user_name, user_pass) { 
    parametros = { "user_name": user_name, "user_pass": user_pass };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Usuario&accion=logUsuarioIn',
            type: 'post',
            beforeSend: function () {
                var div = document.createElement('div');
                div.setAttribute('class', 'd-flex align-items-center justify-content-center');

                var divSpin = document.createElement('div');
                divSpin.setAttribute('class', 'spinner-grow text-primary');
                divSpin.setAttribute('style', 'width: 2em; height: 2em;');
                divSpin.setAttribute('role', 'status');

                var newSpan = document.createElement('strong');
                //newSpan.setAttribute('class', 'sr-only');
                newSpan.innerHTML = 'Iniciando sesión....';

                div.appendChild(divSpin);
                div.appendChild(newSpan);
                document.getElementById('respuesta').innerHTML = '';
                document.getElementById('respuesta').appendChild(div);
            }, //antes de enviar
                    
            success: function (response) {
                var div = document.createElement('div');
                div.setAttribute('class', 'd-flex align-items-center justify-content-center');
                var newSpan = document.createElement('strong');
                document.getElementById('respuesta').innerHTML = '';

                if (response == 0) {
                    newSpan.innerHTML = 'Usuario o contraseña incorrectos';
                    div.appendChild(newSpan);
                    document.getElementById('respuesta').appendChild(div);
                } else {
                    newSpan.innerHTML = 'Cargando.....';
                    div.appendChild(newSpan);
                    document.getElementById('respuesta').appendChild(div);
                    window.sessionStorage.setItem("initCount", 0);
                    window.location.href = '?controlador=Usuario&accion=mostrar';
                }
                //$("#respuesta").html(response);
            } //se ha enviado
        }
    );
}

function logOutUser() { 
    $.ajax(
        {
            url: '?controlador=Usuario&accion=logUsuarioOut',
            type: 'post',
            beforeSend: function () {}, //antes de enviar   
            success: function (response) {
                window.location.href = 'index.php';
            } //se ha enviado
        }
    );
}