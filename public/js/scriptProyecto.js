function guardarProyecto() {
    if (document.getElementById('selectNoOficio').value == 0) {
        //si no se ha seleccionado no. oficio
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Seleccione un número de oficio antes de guardar',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
        });
    } else { 
        var oficio = document.getElementById('selectNoOficio').value;
        var nombre = document.getElementById('nombreProy').value;
        var actividad = document.getElementById('actividad').value;
        var tipo = document.getElementById('tipoActividad').value;
        var beneficiarios = document.getElementById('beneficiarios').value;
        var inversion = document.getElementById('inversion').value;
        var espacio_blanco = /[a-z]/i;  //Expresión regular

        if (!espacio_blanco.test(nombre) || !espacio_blanco.test(actividad) || !espacio_blanco.test(tipo) || !espacio_blanco.test(beneficiarios)) {
            //codigo de alerta de espacio vacio
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Debe llenar todos los espacios antes de guardar',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        } else { 
            if (isNaN(parseFloat(inversion)) && isFinite(inversion)) {
                //codigo de alerta de variable númérica con valor de texto
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Solo debe ingresar números en el espacio de "Inversión"',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
            } else { 
                //todos los valores son correctos
                parametros = {
                    "oficio": oficio,
                    "nombre": nombre,
                    "actividad": actividad,
                    "tipo": tipo,
                    "beneficiario": beneficiarios,
                    "inversion": inversion
                };
                $.ajax(
                    {
                        data: parametros,
                        url: '?controlador=Proyecto&accion=crearNuevoProyecto',
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
                            var newNumProyecto = response.split('-');
                            if (newNumProyecto.length == 7) {
                                //codigo de alerta de guardado
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Guardado',
                                    text: 'El proyecto ha sido guardado con éxito',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    allowOutsideClick: false
                                }).then(() => {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Atención',
                                        text: 'El número de proyecto es: ' + response,
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
                                    if (response == -1) {
                                        //codigo de alerta de que ha ocurrido un error inesperado
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'El número de oficio no existe, verifique la información. Si el error persiste, comuníquelo de inmediato',
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
                            }
                        } //se ha enviado
                    }
                );
            }
        }
    }
}

function cargarModalProy(button) {
    parametros = { "num_proyecto": button.id };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Proyecto&accion=buscarProyecto',
            type: 'post',
            beforeSend: function () {}, //antes de enviar   
            success: function (response) {
                var array = response.split('|');
                document.getElementById('noProyecto').innerHTML = array[0];
                document.getElementById('noOficio').innerHTML = array[1];
                document.getElementById('feProyecto').innerHTML = array[2];
                document.getElementById('nombreProy').value = array[3];
                document.getElementById('actividad').value = array[4];
                document.getElementById('tipoActividad').value = array[5];
                document.getElementById('beneficiarios').value = array[6];
                document.getElementById('inversion').value = array[7];
                if (array[8] == -1) {
                    document.respuesta.optradio[3].checked = true;
                } else { 
                    if (array[8] == 0) {
                        document.respuesta.optradio[0].checked = true;
                    } else { 
                        if (array[8] == 1) {
                            document.respuesta.optradio[1].checked = true;
                        } else { 
                            document.respuesta.optradio[2].checked = true;
                        }
                    }
                }
            } //se ha enviado
        }
    );
}

function actualizarProyecto() {
    var espacio_blanco = /[a-z]/i;  //Expresión regular
    var num_p = document.getElementById('noProyecto').innerText;
    var num_o = document.getElementById('noOficio').innerText;
    var nom_p = document.getElementById('nombreProy').value;
    var act_p = document.getElementById('actividad').value;
    var tip_a = document.getElementById('tipoActividad').value;
    var ben_p = document.getElementById('beneficiarios').value;
    var inv_p = document.getElementById('inversion').value;
    var res_p = -2;
    if (document.respuesta.optradio[3].checked) {
        res_p = -1;
    } else { 
        if (document.respuesta.optradio[0].checked) {
            res_p = 0;
        } else { 
            if (document.respuesta.optradio[1].checked) {
                res_p = 1;
            } else { 
                res_p = 2;
            }
        }
    }
    var inf_c = document.getElementById('cambio').value;

    if (!espacio_blanco.test(nom_p) || !espacio_blanco.test(act_p) || !espacio_blanco.test(tip_a) || !espacio_blanco.test(ben_p) || !espacio_blanco.test(inf_c)) {
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Debe llenar todos los espacios antes de guardar',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
        });
    } else { 
        if (isNaN(parseFloat(inv_p)) && isFinite(inv_p)) {
            //codigo de alerta de variable númérica con valor de texto
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Solo debe ingresar números en el espacio de "Inversión"',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        } else { 
            //todos los datos son correctos, se puede realizar el cambio
            parametros = {
                "num_p": num_p,
                "num_o": num_o,
                "nom_p": nom_p,
                "act_p": act_p,
                "tip_a": tip_a,
                "ben_p": ben_p,
                "inv_p": inv_p,
                "res_p": res_p,
                "inf_c": inf_c
            };
            $.ajax(
                {
                    data: parametros,
                    url: '?controlador=Proyecto&accion=agregarAvanceProyecto',
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
                        if (response > 0) {
                            //codigo de alerta de guardado
                            Swal.fire({
                                icon: 'success',
                                title: 'Guardado',
                                text: 'El avance del proyecto ha sido guardado con éxito',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                allowOutsideClick: false
                            });
                            $('#modalAddProgress').modal('hide');
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
}