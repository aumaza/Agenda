<?php   include "../core/connection/connection.php";
        include "../core/libs/lib_system.php";
        include "../core/libs/users/lib_users.php";



?>

<!DOCTYPE html>
<html lang="es">
<head>
  
  <title>Agenda - Blanquear Password</title>
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
    
      echo '<h1>Por favor Ingrese los datos solicitados para poder blanquear su Password</h1>
                <div class="col-sm-4"></div>
                
                <div class="col-sm-4">
                <hr>
                <form action="password.php" method="POST">
                    
                    <div class="form-group">
                    <label for="user">Usuario:</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="usuario_mecon">
                    </div>
                    
                    <br>
                    
                    <button type="submit" class="btn btn-default" id="update_password" name="update_password">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
                
                </form>
                <hr>';
      
      
      if(isset($_POST['update_password'])){
            
            $oneUser = new Users();
            
            $username = mysqli_real_escape_string($conn,$_POST['user']);
            
            if($username == ''){
                echo '<script> alert("Debe ingresar el usuario!!"); </script>';
            }else{
                $oneUser->resetPass($oneUser,$username,$conn,$dbase);
            }
           
      }
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
