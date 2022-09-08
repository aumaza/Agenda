// ESTRUCTURA TABLE

 $(document).ready(function(){
    
    // RENDERIZADO DE TABLA PRINCIPAL
    
      $('#contactosTable').DataTable({
        "order": [[0, "asc"]],
        "responsive":     true,
        "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "dom":  "Bfrtip",
        
        buttons: [
            
            {
                extend: 'excel',
                text: 'Export Excel',
                messageTop: 'Listado de Todos los Contactos',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                messageTop: 'Listado de Todos los Contactos',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                messageTop: 'Listado de Todos los Contactos',
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
                messageTop: 'Listado de Todos los Contactos',
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


/*
** GUARDA NUEVO REGISTRO
*/
$(document).ready(function(){
    $('#insert_contact').click(function(){
        
        var datos = $('#fr_new_contact_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"../libs/contacts/new_contact.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Registro Guardado Exitosamente!!");
                    $('#name').val('');
                    $('#lastname').val('');
                    $('#email').val('');
                    $('#telephone_1').val('');
                    $('#telephone_2').val('');
                    $('#cellphone').val('');
                    $('#office_number').val('');
                    $('#charge').val('');
                    $('#organism').val('');
                    $('#name').focus();
                    console.log("Datos: " + datos);
                }else if(r == -1){
                    alert("Error. Hubo un problema al intentar guardar el registro");
                    console.log("Datos: " + datos);
                }else if(r == 5){
                    alert("Error, Hay campos sin completar!!");
                    console.log("Datos: " + datos);
                }else if(r == 4){
                    alert("Atención. Contacto Existente. Antes de añadir un contacto verifique si existe");
                    $('#name').val('');
                    $('#lastname').val('');
                    $('#email').val('');
                    $('#telephone_1').val('');
                    $('#telephone_2').val('');
                    $('#cellphone').val('');
                    $('#office_number').val('');
                    $('#charge').val('');
                    $('#organism').val('');
                    $('#name').focus();
                    console.log("Datos: " + datos);
                }else if(r == 7){
                    alert("Error de conexion dentro de la funcion principal!!");                    
                }else if(r == 13){
                    alert("Error de conexion!!");                    
                }
            }
        });

        return false;
    
});
});

/*
** ACTUALIZA REGISTRO
*/
$(document).ready(function(){
    $('#update_contact').click(function(){
        
        var datos = $('#fr_update_contact_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"../libs/contacts/update_contact.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Registro actualizado Exitosamente!!");
                    console.log("Datos: " + datos);
                    window.location.href="main.php";
                }else if(r == -1){
                    alert("Error. Hubo un problema al intentar actualizar el registro");
                    console.log("Datos: " + datos);
                }else if(r == 5){
                    alert("Error, Hay campos sin completar!!");
                    console.log("Datos: " + datos);
                }else if(r == 7){
                    alert("Error de conexion dentro de la funcion principal!!");                    
                }else if(r == 13){
                    alert("Error de conexion!!");                    
                }
            }
        });

        return false;
    
});
});
 
/*
** ELIINA DE  BASE EL REGISTRO
*/

$(document).ready(function(){
    $('#delete_contact').click(function(){
        
        var datos = $('#fr_delete_contact_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"../libs/contacts/delete_contact.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Registro Eliminado Exitosamente!!");
                    window.location.href="main.php";
                }else if(r == -1){
                    alert("Error. Hubo un problema al intentar Eliminar el Registro");
                    console.log("Datos: " + datos);
                }else if(r == 5){
                    alert("No se envió correctamente el ID del registro!!");
                    console.log("Datos: " + datos);
                }else if(r == 13){
                    alert("Error de conexion!!");                    
                }else if(r == 7){
                    alert("Error de conexion en la función principal!!");
                }
                
            }
        });

        return false;
    
});
});

$(document).ready(function(e) {
  $('#modalContactDelete').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data().id;
    $(e.currentTarget).find('#bookId').val(id);
  });
});
