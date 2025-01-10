// ESTRUCTURA TABLE
 $(document).ready(function(){
      $('#usuariosTable').DataTable({
        "order": [[0, "asc"]],
        "responsive":     true,
        "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "deferRender": true,
        "dom":  "Bfrtip",
        buttons: [
            {
                extend: 'excel',
                text: 'Export Excel',
                messageTop: 'Listado de Usuarios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                messageTop: 'Listado de Usuarios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                messageTop: 'Listado de Usuarios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'print',
                text: 'Imprimir',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '8pt' );


                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
                messageTop: 'Listado de Usuarios',
                autoPrint: false,
                exportOptions: {
                    columns: ':visible',
                }

            },
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "fixedColumns": true,
      "language":{
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });
});


 // ACTUALIZAR ESTADO DE USUARIO
$(document).ready(function(){
    $('#edit_role_user').click(function(){

        const form = document.querySelector('#fr_edit_role_ajax');

        const id_user = document.querySelector('#id_user');
        const role = document.querySelector('#role');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('id_user', id_user.value);
        formData.append('role', role.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"update_user_role.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Estado Actualizado Exitosamente</p></div>';
                     document.getElementById('messageRoleUser').innerHTML = mensaje;
                     console.log(values);
                     setTimeout(function() { window.close(); }, 3000);
                     //setTimeout(function() { $(".close").click(); }, 2000);
                     setTimeout(function() { window.opener.location.reload(); }, 2000);
                    }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar agregar el registro</p></div>';
                        document.getElementById('messageRoleUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageRoleUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});


 // ACTUALIZAR PASSWORD
$(document).ready(function(){
    $('#update_password').click(function(){

        const form = document.querySelector('#fr_mis_datos_ajax');

        const password_1 = document.querySelector('#password_1');
        const password_2 = document.querySelector('#password_2');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('password_1', password_1.value);
        formData.append('password_2', password_2.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"../lib/usuarios/update_password.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Password Actualizado Exitosamente</p></div>';
                     document.getElementById('messagePassUpdate').innerHTML = mensaje;
                     console.log(values);
                     $('#password_1').val('');
                     $('#password_2').val('');
                     setTimeout(function() { $(".close").click(); }, 2000);
                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar actualizar su password</p></div>';
                        document.getElementById('messagePassUpdate').innerHTML = mensaje;
                        console.log(formData);
                        $('#password_1').val('');
                        $('#password_2').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 3){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Los Passwords no coinciden</p></div>';
                        document.getElementById('messagePassUpdate').innerHTML = mensaje;
                        console.log(formData);
                        $('#password_1').val('');
                        $('#password_2').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Los Passwords deben tener entre 10 y 15 caracteres</p></div>';
                        document.getElementById('messagePassUpdate').innerHTML = mensaje;
                        console.log(formData);
                        $('#password_1').val('');
                        $('#password_2').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Debe ingresar los passwords</p></div>';
                        document.getElementById('messagePassUpdate').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messagePassUpdate').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});


// ACTUALIZAR AVATAR
$(document).ready(function(){
    $('#update_avatar').click(function(){

        const form = document.querySelector('#fr_change_avatar_ajax');

        const id = document.querySelector('#id');
        const file = document.querySelector('#my_file');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('id', id.value);
        formData.append('file', file.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"update_avatar.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Avatar Actualizado Exitosamente</p></div>';
                     document.getElementById('messageAvatarUpdate').innerHTML = mensaje;
                     console.log(values);
                     $('#file').val('');
                     setTimeout(function() { $(".close").click(); }, 2000);
                     setTimeout(function() { window.opener.location.reload(); }, 3000);
                     setTimeout(function() { window.close(); }, 4000);
                     }else if(r == 2){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Sólo se ha subido el archivo sin impactar en la base de datos!</p></div>';
                        document.getElementById('messageAvatarUpdate').innerHTML = mensaje;
                        console.log(formData);
                        $('#file').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 3){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> El directorio de alojamiento no tiene permisos. Contacte al Administrador</p></div>';
                        document.getElementById('messageAvatarUpdate').innerHTML = mensaje;
                        console.log(formData);
                        $('#file').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 4){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sólo se permiten archivos con extension JPG / PNG</p></div>';
                        document.getElementById('messageAvatarUpdate').innerHTML = mensaje;
                        console.log(formData);
                        $('#file').val('');
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Por favor seleccione un archivo</p></div>';
                        document.getElementById('messageAvatarUpdate').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageAvatarUpdate').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});


 // CALLERS
 function callEditEstado(id){
    var ancho = 600;
    var alto = 500;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=yes,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    open("../lib/usuarios/form_editar_usuario_estado.php?id="+id+"", "edit_estado_usuario", params);

}

function callChangeAvatar(id){
    var ancho = 500;
    var alto = 450;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    open("../lib/usuarios/form_change_avatar.php?id="+id+"", "change_avatar_usuario", params);

}


// FUNCTIONS
function enablePassword(){

    document.getElementById('password_1').disabled = false;
    document.getElementById('password_2').disabled = false;
    var  enableButton = `<button type="button" class="btn btn-danger" id="enableButton" onclick="disabledPassword();">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Deshabilitar cambio de Password</button>`;
    document.getElementById('enableButton').innerHTML = enableButton;

}

function disabledPassword(){
    document.getElementById('password_1').disabled = true;
    document.getElementById('password_2').disabled = true;

}



