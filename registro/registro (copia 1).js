/*
** GUARDA NUEVO REGISTRO
*/

$(document).ready(function(){
    $('#add_user').click(function(){
        
        var datos = $('#fr_add_new_user_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"new_user.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Registro Guardado Exitosamente!!");
                    $('#nombre').val('');
                    $('#email').val('');
                    $('#password_1').val('');
                    $('#password_2').val('');
                    console.log("Datos: " + datos);
                }else if(r == -1){
                    alert("Error. Hubo un problema al intentar guardar el registro");
                    console.log("Datos: " + datos);
                }else if(r == 5){
                    alert("Error, Hay campos sin completar!!");
                    console.log("Datos: " + datos);
                }else if(r == 4){
                    alert("Atención. Usuario Existente. Si olvidó su Password, diríjase a 'Olvidé mi Password'");
                    $('#nombre').val('');
                    $('#email').val('');
                    $('#password_1').val('');
                    $('#password_2').val('');
                    console.log("Datos: " + datos);
                }else if(r == 7){
                    alert("Error de conexion dentro de la funcion principal!!");                    
                }else if(r == 13){
                    alert("Error de conexion!!");                    
                }else if(r == 9){
                    alert("El Password debe tener 15 caracteres!!");
                    $('#password_1').val('');
                    $('#password_2').val('');
                    $('#password_1').focus();
                }else if(r == 11){
                    alert("Los Password no Coinciden!!");
                    $('#password_1').val('');
                    $('#password_2').val('');
                    $('#password_1').focus();
                }
                
                
            }
        });

        return false;
    
});
}); 
