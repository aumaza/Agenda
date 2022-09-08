<?php   session_start();
        include "core/connection/connection.php";
        include "core/libs/lib_system.php";



?>

<!DOCTYPE html>
<html lang="es">
<head>
  
  <title>Agenda - Home</title>
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
  
  .avatar {
        vertical-align: middle;
        horizontal-align: right;
        width: 45px;
        height: 45px;
        border-radius: 60%;
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
        <li><a href="password/password.php"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Olvidé mi Password</a></li>
        <li><a href="https://cas.gde.gob.ar/" target="_blank"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> GDE</a></li>
        <li><a href="https://intranet.mecon.gob.ar/" target="_blank"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Intranet</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-star"></span> Version 0.04-beta</a></li>
      </ul>
      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <hr>
    
    <div class="col-sm-12"> 
      <h1>Agenda</h1>
       <div class="col-sm-4"></div>
       
       <div class="col-sm-4">
       <hr>
       <form action="index.php" method="POST">
        <div class="form-group">
          <label for="user">Usuario:</label>
          <input type="text" class="form-control" id="user" name="user" placeholder="usuario_mecon" >
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" name="pwd">
        </div><br>
        
        <button type="submit" class="btn btn-default" name="ingresar">
            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Ingresar</button>
      
      </form>
      <hr>
      
      <div class="alert alert-info">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><strong> Importante!</strong> Si aún no tiene un usuario regístrese <a href="registro/registro.php"><strong>aquí</strong></a>
     </div>
     
     <?php 
      
      if(isset($_POST['ingresar'])){
      
        if($conn){
        
            $user = mysqli_real_escape_string($conn,$_POST['user']);
            $pass = mysqli_real_escape_string($conn,$_POST['pwd']);
            logIn($user,$pass,$conn,$dbase);
            
        
        }else{
            echo '<div class="alert alert-info">
                    <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span><strong> Importante!</strong> No hay Conexion con la Base de Datos</a>
                  </div>';
        }
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

</body>
</html>
