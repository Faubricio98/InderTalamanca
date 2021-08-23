//guardar usuario
function guardarUsuario() {
    var espacio_blanco = /[a-z]/i;  //Expresión regular
    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var pass1 = document.getElementById('passConfirm').value;
    var checkAdmin = document.getElementById('checkAdmin');
    var admin = 0;
    if (checkAdmin.checked) {
        admin = 1;
    }

    if (!espacio_blanco.test(nombre) || !espacio_blanco.test(apellidos) ||
        !espacio_blanco.test(email) || !espacio_blanco.test(pass) ||
        !espacio_blanco.test(pass1)) {
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
        if (pass != pass1) {
            //codigo de alerta de contraseñas diferentes
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Las contraseñas deben ser iguales para poder guardar',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        } else { 
            var parametros = {
                "nombre": nombre, "apellidos": apellidos,
                "email": email, "pass": pass, "admin": admin
            };
            $.ajax(
                {
                    data: parametros,
                    url: '?controlador=Administrador&accion=registrarUsuario',
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
                        newSpan.innerHTML = 'Registrando usuario....';

                        div.appendChild(divSpin);
                        div.appendChild(newSpan);
                        document.getElementById('respuesta').innerHTML = '';
                        document.getElementById('respuesta').appendChild(div);
                    }, //antes de enviar   
                    success: function (response) {
                        document.getElementById('respuesta').innerHTML = '';
                        if (response == -1) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: 'El correo electrónico que intenta registrar ya existe en el sistema',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        } else { 
                            if (response == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Atención',
                                    text: 'Ha ocurrido un error al registrar al usuario, revise la información del usuario y vuelva a intentarlo',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            } else { 
                                if (response == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Guardado',
                                        text: 'El usuario ha sido registrado',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                } else { 
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Ha ocurrido un error inesperado, infórmelo de inmediato',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                }
                            }
                        }
                    } //se ha enviado
                }
            );
        }
    }
}

//editar usuario
function editarUsuario() {
    var espacio_blanco = /[a-z]/i;  //Expresión regular
    var id = document.getElementById('idUser').innerHTML;
    var nom = document.getElementById('nombre').value;
    var apels = document.getElementById('apellidos').value;
    var email = document.getElementById('email').value;
    var admin = 0;
    if (document.getElementById('checkAdmin').checked) {
        admin = 1;
    }

    if (!espacio_blanco.test(nom) || !espacio_blanco.test(apels) || !espacio_blanco.test(email)) {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'No debe dejar espacios vacíos',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    } else {
        var parametros = {
            "id": id,
            "nom": nom,
            "apels": apels,
            "email": email,
            "admin": admin
        };

        $.ajax({
            data: parametros,
            url: '?controlador=Administrador&accion=editarUsuario',
            type: 'post',
            beforeSend: function () {
                var div = document.createElement('div');
                div.setAttribute('class', 'd-flex align-items-center justify-content-center')
                var divSpin = document.createElement('div');
                divSpin.setAttribute('class', 'spinner-grow text-primary');
                divSpin.setAttribute('style', 'width: 2em; height: 2em;');
                divSpin.setAttribute('role', 'status')
                var newSpan = document.createElement('strong');
                //newSpan.setAttribute('class', 'sr-only');
                newSpan.innerHTML = 'Editando usuario....'
                div.appendChild(divSpin);
                div.appendChild(newSpan);
                document.getElementById('respuesta').innerHTML = '';
                document.getElementById('respuesta').appendChild(div);
            }, //antes de enviar   
            success: function (response) {
                document.getElementById('respuesta').innerHTML = '';
                //alert(response);
                if (response == -1) {
                    //error al editar
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al editar, inténtelo de nuevo',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                } else {
                    if (response == 0) {
                        //el correo ya existe en otro usuario
                        //llamada para cargar la tabla
                        Swal.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: 'El correo que intenta ingresar ya está registrado para otro usuario',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    } else {
                        if (response == 1) {
                            //editado con éxito
                            cargarTablaEditar();
                            Swal.fire({
                                icon: 'success',
                                title: 'Guardado',
                                text: 'El usuario ha sido editado con éxito',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $('#modalAddProgress').modal('hide');
                        } else {
                            //error inesperado
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ha ocurrido un error inesperado, infórmelo de inmediato',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    }
                }
            } //se ha enviado
        });
    }
}

function cargarModalEditUser(button) {
    var parametros = { "id": button.id };
    $.ajax({
        data: parametros,
        url: '?controlador=Administrador&accion=buscarUsuarioById',
        type: 'post',
        beforeSend: function () {}, //antes de enviar   
        success: function (response) {
            var data = response.split('|');
            document.getElementById('idUser').innerHTML = data[0];
            document.getElementById('nombre').value = data[1];
            document.getElementById('apellidos').value = data[2];
            document.getElementById('email').value = data[3];
            document.getElementById('checkAdmin').checked = false;
            if (data[4] == 1) {
                document.getElementById('checkAdmin').checked = true;
            }
        } //se ha enviado
    });
}

function cargarTablaEditar() {
    $.ajax(
        {
            url: '?controlador=Administrador&accion=listarUsuario',
            type: 'post',
            beforeSend: function () {}, //antes de enviar   
            success: function (response) {
                $('#tablaContenido tr').remove(); // Eliminar contenido de la tabla
                var row = response.split("|");
                for (var i = 0; i < row.length; i++) {
                    var col = row[i].split(",");
                    var admin = '<td> <i class="fi-br-cross"></i> </td>';
                    if (col[4] == 1) {
                        admin = '<td> <i class="fi-br-check"></i> </td>';
                    }
                    var info =
                        '<tr>' +
                        '<th scope="row">' + col[0] + '</th>' +
                        '<th>'             + col[1] + '</th>' +
                        '<th>'             + col[2] + '</th>' +
                        '<th>'             + col[3] + '</th>' +
                        admin +
                        '<td> <i id="'     + col[0] +'" onclick="cargarModalEditUser(this)" style="color: #2eabcf;" class="fi-br-edit" data-toggle="modal" data-target="#modalAddProgress"></i> </td>'+
                        '</tr>';
                    document.getElementById("tablaContenido").innerHTML += info;
                }
            } //se ha enviado
        }
    );
}

//eliminar usuario
function eliminarUsuario(button) {
    var id = button.id;

    Swal.fire({
        icon: 'question',
        title: '¿Desea eliminar al usuario?',
        showDenyButton: true,
        confirmButtonText: "Eliminar",
        denyButtonText: "Cancelar",
        allowOutsideClick: false
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var parametros = { "id": id };
            $.ajax({
                data: parametros,
                url: '?controlador=Administrador&accion=eliminarUsuario',
                type: 'post',
                beforeSend: function () {}, //antes de enviar   
                success: function (response) {
                    if (response == 1) {
                        cargarTablaEliminar();
                        Swal.fire('Eliminado', '', 'success');
                    } else {
                        if (response == 0) {
                            Swal.fire('Error', 'Error al eliminar, inténtelo de nuevo', 'error');
                        } else {
                            Swal.fire('Error', 'Error inesperado, infórmelo de inmediato', 'error');
                        }
                    }
                } //se ha enviado
            });
        }
    })
}

function cargarTablaEliminar() {
    $.ajax(
        {
            url: '?controlador=Administrador&accion=listarUsuario',
            type: 'post',
            beforeSend: function () {}, //antes de enviar   
            success: function (response) {
                $('#tablaContenido tr').remove(); // Eliminar contenido de la tabla
                var row = response.split("|");
                for (var i = 0; i < row.length; i++) {
                    var col = row[i].split(",");
                    var admin = '<td> <i class="fi-br-cross"></i> </td>';
                    if (col[4] == 1) {
                        admin = '<td> <i class="fi-br-check"></i> </td>';
                    }
                    var info =
                        '<tr>' +
                        '<th scope="row">' + col[0] + '</th>' +
                        '<th>'             + col[1] + '</th>' +
                        '<th>'             + col[2] + '</th>' +
                        '<th>'             + col[3] + '</th>' +
                        admin +
                        '<td> <i id="'     + col[0] +'" onclick="eliminarUsuario(this)" style="color: red;" class="fi-br-trash"></i> </td>' +
                        '</tr>';
                    document.getElementById("tablaContenido").innerHTML += info;
                }
            } //se ha enviado
        }
    );
}