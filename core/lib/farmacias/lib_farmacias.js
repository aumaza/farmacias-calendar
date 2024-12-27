// ESTRUCTURA TABLE FARMACIAS
 $(document).ready(function(){
      $('#farmaciasTable').DataTable({
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
                messageTop: 'Listado de Farmacias',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                messageTop: 'Listado de Farmacias',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                messageTop: 'Listado de Farmacias',
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
                messageTop: 'Listado de Farmacias',
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


// ESTRUCTURA TABLE TURNOS FARMACIAS
 $(document).ready(function(){
      $('#turnosFarmaciasTable').DataTable({
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
                messageTop: 'Listado de Turnos Farmacias',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                messageTop: 'Listado de Turnos Farmacias',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                messageTop: 'Listado de Turnos Farmacias',
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
                messageTop: 'Listado de Turnos Farmacias',
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

// GUARDAR FARMACIA
$(document).ready(function(){
    $('#add_farmacia').click(function(){

        const form = document.querySelector('#fr_add_farmacia_ajax');

        const nombre_farmacia = document.querySelector('#nombre_farmacia');
        const direccion_farmacia = document.querySelector('#direccion_farmacia');
        const telefono_1 = document.querySelector('#telefono_1');
        const telefono_2 = document.querySelector('#telefono_2');
        const email = document.querySelector('#email');
        const obra_social = document.querySelector('#obra_social');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('nombre_farmacia', nombre_farmacia.value);
        formData.append('direccion_farmacia', direccion_farmacia.value);
        formData.append('telefono_1', telefono_1.value);
        formData.append('telefono_2', telefono_2.value);
        formData.append('email', email.value);
        formData.append('obra_social', obra_social.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"../lib/farmacias/add_farmacia.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro Agregado Exitosamente</p></div>';
                     document.getElementById('messageNewFarmacia').innerHTML = mensaje;
                     console.log(values);
                     $('#nombre_farmacia').val('');
                     $('#direccion_farmacia').val('');
                     $('#telefono_1').val('');
                     $('#telefono_2').val('');
                     $('#email').val('');
                     $('#obra_social').val('');
                     $('#nombre_farmacia').focus();
                     //setTimeout(function() { window.location.reload(); }, 2000);
                     setTimeout(function() {
                         //$(".close").click();

                         var form = $('<form action="#" method="post">' +
                            '<input type="hidden" name="farmacias" />' +
                            '</form>');
                            $('body').append(form);
                            form.submit();

                        }, 3000);
                     console.log("Atención: Registro guardado exitosamente!!");

                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar guardar el registro</p></div>';
                        document.getElementById('messageNewFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Ocurrió un error al intentar guardar el registro!!");

                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Registro Existente</p></div>';
                        document.getElementById('messageNewFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        $('#nombre_farmacia').val('');
                        $('#direccion_farmacia').val('');
                        $('#telefono_1').val('');
                        $('#telefono_2').val('');
                        $('#email').val('');
                        $('#obra_social').val('');
                        $('#nombre_farmacia').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Registro existente!!");

                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Hay campos sin completar</p></div>';
                        document.getElementById('messageNewFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        console.log("Atención: Hay campos sin completar");
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageNewFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Sin conexion a la base de datos!!");
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});


// GUARDAR FECHA FARMACIA
$(document).ready(function(){
    $('#cargar_fecha_turno').click(function(){

        const form = document.querySelector('#fr_cargar_turno_farmacia_ajax');

        const id = document.querySelector('#id');
        const fecha_turno = document.querySelector('#fecha_turno');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('id', id.value);
        formData.append('fecha_turno', fecha_turno.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"../lib/farmacias/add_turno_farmacia.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro Agregado Exitosamente</p></div>';
                     document.getElementById('messageNewTurnoFarmacia').innerHTML = mensaje;
                     console.log(values);
                     $('#fecha_turno').val('');
                     $('#fecha_turno').focus();
                     //setTimeout(function() { window.location.reload(); }, 2000);
                     setTimeout(function() {$(".close").click();}, 3000);
                     console.log("Atención: Registro guardado exitosamente!!");

                            if(confirm("Desea cargar más turnos para esta Farmacia?") == true) {
                                var mensaje = '<br><div class="alert alert-info alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Por favor seleccione una nueva fecha</p></div>';
                                document.getElementById('messageNewTurnoFarmacia').innerHTML = mensaje;
                            }else{
                                var form = $('<form action="#" method="post">' +
                                            '<input type="hidden" name="turnos" />' +
                                            '</form>');
                                            $('body').append(form);
                                            form.submit();
                            }

                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar guardar el registro</p></div>';
                        document.getElementById('messageNewTurnoFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Ocurrió un error al intentar guardar el registro!!");

                    }else if(r == 9){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Turno Existente pra dicha Farmacia</p></div>';
                        document.getElementById('messageNewTurnoFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        $('#fecha_turno').val('');
                        $('#fecha_turno').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Registro existente!!");

                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Hay campos sin completar</p></div>';
                        document.getElementById('messageNewTurnoFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        console.log("Atención: Hay campos sin completar");
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageNewTurnoFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Sin conexion a la base de datos!!");
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});

// EDITAR FARMACIA
$(document).ready(function(){
    $('#edit_farmacia').click(function(){

        const form = document.querySelector('#fr_edit_farmacia_ajax');

        const id = document.querySelector('#id');
        const nombre_farmacia = document.querySelector('#nombre_farmacia');
        const direccion_farmacia = document.querySelector('#direccion_farmacia');
        const telefono_1 = document.querySelector('#telefono_1');
        const telefono_2 = document.querySelector('#telefono_2');
        const email = document.querySelector('#email');
        const obra_social = document.querySelector('#obra_social');

        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);

        formData.append('id', id.value);
        formData.append('nombre_farmacia', nombre_farmacia.value);
        formData.append('direccion_farmacia', direccion_farmacia.value);
        formData.append('telefono_1', telefono_1.value);
        formData.append('telefono_2', telefono_2.value);
        formData.append('email', email.value);
        formData.append('obra_social', obra_social.value);

         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"../lib/farmacias/editar_farmacia.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registro Actualizado Exitosamente</p></div>';
                     document.getElementById('messageEditFarmacia').innerHTML = mensaje;
                     console.log(values);
                     //setTimeout(function() { window.location.reload(); }, 2000);
                     setTimeout(function() {
                         //$(".close").click();

                         var form = $('<form action="#" method="post">' +
                            '<input type="hidden" name="farmacias" />' +
                            '</form>');
                            $('body').append(form);
                            form.submit();

                        }, 3000);
                     console.log("Atención: Registro actualizado exitosamente!!");

                     }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar actualizar el registro</p></div>';
                        document.getElementById('messageEditFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Ocurrió un error al actualizar guardar el registro!!");

                    }else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Hay campos sin completar</p></div>';
                        document.getElementById('messageEditFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        console.log("Atención: Hay campos sin completar");
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageEditFarmacia').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                        console.log("Atención: Sin conexion a la base de datos!!");
                    }

                    else if(r == ''){
                        //console.log(formData);
                    }
            },

        });

        return false;
    });
});



/*
** restar año
*/

function restarAnio(value){

    var anio = parseInt(value);
    var nuevo_anio = anio - 1;
    document.getElementById('nuevo_anio').innerHTML = nuevo_anio;
    console.log(nuevo_anio);

}

/*
** sumar año
*/
function sumarAnio(value){

    var anio = parseInt(value);
    var nuevo_anio = anio + 1;
    document.getElementById('nuevo_anio').innerHTML = nuevo_anio;
    console.log(nuevo_anio);

}
/*
** restar mes
*/
function restarMes(value){

    var mes = parseInt(value);
    var nuevo_mes = mes - 1;
    document.getElementById('nuevo_mes').innerHTML = nuevo_mes;
    console.log(nuevo_mes);

}

// CALLERS
 function callCalendar(id_farmacia){
    console.log(id_farmacia);
    var ancho = 1200;
    var alto = 1000;
    var left = (screen.width / 2) - (ancho / 2);
    var top = (screen.height / 2) - (alto / 2);
    let params = `scrollbars=yes,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=${ancho},height=${alto},left=${left},top=${top}`;
    window.open("../lib/farmacias/make_calendar.php?id_farmacia="+id_farmacia+"", "calendar", params);

}

/*
** sumar mes
*/

function sumarMes(value){

    var mes = parseInt(value);
    var nuevo_mes = mes + 1;
    document.getElementById('nuevo_mes').innerHTML = nuevo_mes;
    console.log(nuevo_mes);

}

function cambiarAnio(value){

    //var anio = parseInt(value);
    document.getElementById('nuevo_anio').innerText = value;
    console.log(value);

}

function cambiarMes(value){

    //var mes = parseInt(value);
    document.getElementById('nuevo_mes').innerText = value;
    console.log(value);

}
