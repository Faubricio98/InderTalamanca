function guardarOficio(remit_of, desti_of, asunt_of) {
    var espacio_blanco = /[a-z]/i;  //Expresión regular
    if (!espacio_blanco.test(remit_of) || !espacio_blanco.test(desti_of) || !espacio_blanco.test(asunt_of)) {
        //codigo de alerta de espacio vacio
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Debe llenar todos los espacios antes de guardar',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    } else {
        parametros = { "remit_of": remit_of, "desti_of": desti_of, "asunt_of": asunt_of };
        $.ajax(
            {
                data: parametros,
                url: '?controlador=Oficio&accion=crearNuevoOficio',
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
                    newSpan.innerHTML = 'Guardando....';

                    div.appendChild(divSpin);
                    div.appendChild(newSpan);
                    document.getElementById('respuesta').innerHTML = '';
                    document.getElementById('respuesta').appendChild(div);
                }, //antes de enviar
                        
                success: function (response) {
                    document.getElementById('respuesta').innerHTML = '';
                    var newNumOficio = response.split('-');
                    if (newNumOficio.length == 7) {
                        //codigo de alerta de guardado
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: 'El oficio ha sido guardado con éxito',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            allowOutsideClick: false
                        }).then(() => {
                            Swal.fire({
                                icon: 'info',
                                title: 'Atención',
                                text: 'El número de oficio es: \n' + response,
                                showConfirmButton: true,
                                allowOutsideClick: false
                            })
                        });
                    } else {
                        if (response == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ha ocurrido un error al guardar. Revise la información que desea guardar',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            })
                        } else {
                            //codigo de alerta de que ha ocurrido un error inesperado
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ha ocurrido un error inesperado, infórmelo de inmediato',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            })
                        }
                    }
                } //se ha enviado
            }
        );
    }
}

