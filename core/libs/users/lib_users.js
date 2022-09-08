/*
** ACTUALIZA PASSWORD
*/
$(document).ready(function(){
    $('#update_password').click(function(){
        
        var datos = $('#fr_update_password_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"../libs/users/update_password.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Password actualizado Exitosamente!!");
                    $('#password_1').val('');
                    $('#password_2').val('');
                    console.log("Datos: " + datos);
                    window.location.href="main.php";
                }else if(r == -1){
                    alert("Error. Hubo un problema al intentar actualizar el Password");
                    $('#password_1').val('');
                    $('#password_2').val('');
                    $('#password_1').focus();
                    console.log("Datos: " + datos);
                }else if(r == 5){
                    alert("Error, Hay campos sin completar!!");
                    console.log("Datos: " + datos);
                }else if(r == 7){
                    alert("Error de conexion dentro de la funcion principal!!");                    
                }else if(r == 13){
                    alert("Error de conexion!!");                    
                }else if(r == 11){
                    alert("Los Password no Coinciden!!");
                    $('#password_1').val('');
                    $('#password_2').val('');
                    $('#password_1').focus();
                }else if(r == 15){
                    alert("El Password no puede tener menos ni más de 15 caracteres");
                    $('#password_1').val('');
                    $('#password_2').val('');
                    $('#password_1').focus();
                }
            }
        });

        return false;
    
});
}); 

/*
 * * CAMBIAR PERMISOS DE USUARIOS
 */
$(document).ready(function(){
    $('#cambiar_permiso').click(function(){
        var datos=$('#frm_user_allow').serialize();
        $.ajax({
            type:"POST",
            url:"../libs/users/cambiar_permiso_usuario.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Permiso de Usuario Cambiado Exitosamente!!");
                    console.log("Datos: " + datos);
                     window.location.reload();
                }else if(r==-1){
                    alert("Hubo un problema al intentar cambiar el Permiso de Usuario");
                }
            }
        });

        return false;
    });
});


/*
** FORMATEO DE TABLA
*/
$(document).ready(function(){
      $('#usersTable').DataTable({
      "order": [[1, "asc"]],
      "responsive": true,
      "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
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


$(document).ready(function(e) {
  $('#modalUserAllow').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data().id;
    $(e.currentTarget).find('#bookId').val(id);
  });
});

