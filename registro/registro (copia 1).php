<?php   include "../core/connection/connection.php";
        include "../core/libs/lib_system.php";
        include "../core/libs/users/lib_users.php";



?>

<!DOCTYPE html>
<html lang="es">
<head>
  
  <title>Agenda - Registro de Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="icons/actions/bookmarks-organize.png" />
  <?php skeleton(); ?>
  
  
 
  
  <style>
   /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
  input { 
    text-align: center; 
  }
  
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Dirección de Presupuesto y Evaluación de Gastos en Personal</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav">
        <li><a href="../password/password.php"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Olvidé mi Password</a></li>
        <li><a href="../#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a></li>
      </ul>
      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <hr>
    
    <div class="col-sm-12"> 
    
    <?php 
    
    if($conn){
    
      echo '<h1>Por favor Ingrese los datos solicitados para poder generar su Usuario</h1>
                <div class="col-sm-4"></div>
                
                <div class="col-sm-4">
                <hr>
                <form id="fr_add_new_user_ajax" method="POST">
                    
                    <div class="form-group">
                    <label for="user">Nombre y Apellido:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    
                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email">
                    </div>
                    
                    <div class="form-group">
                    <label for="password_1">Password:</label>
                    <input type="password" class="form-control" id="password_1" name="password_1" maxlength="15">
                    </div>
                    
                    <div class="form-group">
                    <label for="password_2">Repita Password:</label>
                    <input type="password" class="form-control" id="password_2" name="password_2" maxlength="15">
                    </div>
                    <br>
                    
                    <button type="submit" class="btn btn-default" id="add_user">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrarse</button>
                
                </form>
                <hr>';
      }else{
        echo '<div class="alert alert-info">
               <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span><strong> Importante!</strong> No hay Conexion con la Base de Datos</a>
              </div>';
      
      }
      ?>
      </div>
      
     
      
    </div>
  
  </div>
</div>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
<script src="registro.js"></script>

</body>
</html>
