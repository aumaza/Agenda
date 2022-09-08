<?php   session_start();
        
        error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', 1);
        
        include "../connection/connection.php";
        include "../libs/lib_system.php";
        include "../libs/users/lib_users.php";
        include "../libs/contacts/lib_contacts.php";
        
        $varsession = $_SESSION['user'];
	
            $sql = "select id, nombre from ag_usuarios where user = '$varsession'";
            mysqli_select_db($conn,$dbase);
            $query = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($query)){
                $nombre = $row['nombre'];
                $user_id = $row['id'];
            }
	
   
    
	if($varsession == null || $varsession == ''){
        echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                <title>AGENDA [ Dirección de Presupuesto y Evaluación de Gastos en Personal ]</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">';
                skeleton();
                echo '</head><body>';
                echo '<br><div class="container">
                        <div class="alert alert-danger" role="alert">';
                echo '<p align="center"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Su sesión a caducado. Por favor, inicie sesión nuevamente</p>';
                echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Iniciar</button></a>';	
                echo "</div></div>";
                die();
                echo '</body></html>';
	}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>AGENDA [ Panel del Usuario ]</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" type="{{ url_for('static', filename='icons/actions/bookmarks-organize.png')}}" />
  <?php skeleton(); ?>
  

  
  
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
    
    .avatar {
        vertical-align: middle;
        horizontal-align: right;
        width: 50px;
        height: 50px;
        border-radius: 60%;
    }
    
  </style>
</head>
<body onload="nobackbutton();">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="main.php"><button class="btn btn-info navbar-btn">
         <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dirección de Presupuesto y Evaluación de Gastos en Personal</button></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contactos
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <form action="main.php" method="POST">
          <li><button type="submit" class="btn btn-default btn-block" name="add_contact"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Contacto</button></li>
          <li><button type="submit" class="btn btn-default btn-block" name="list_contacts"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Listar Contactos</button></li>
        </form>
        </ul>
      </li>
     </ul>
     
     <?php
     
     if($varsession == 'root_mecon'){
     
        echo '<ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <form action="main.php" method="POST">
                    <li><button type="submit" class="btn btn-default btn-block" name="list_users"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Listar Usuarios</button></li>
                    </form>
                    </ul>
                </li>
            </ul>';
     }
     
     ?>
      
      <form class="navbar-form navbar-left" action="main.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Buscar por Apellido" name="lastname">
        </div>
        <button type="submit" class="btn btn-warning" name="search_lastname">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
        
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Buscar por Nro. Oficina" name="office_number">
        </div>
        <button type="submit" class="btn btn-warning" name="search_office_number">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
      </form>
      
      <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $nombre; ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <form action="main.php" method="POST">
          <li><button type="submit" class="btn btn-default btn-block" name="change_password"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Cambiar Password</button></li>
          <li><button type="submit" class="btn btn-danger btn-block" name="logout" ><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Salir</button></li>
        </form>
        </ul>
      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <hr>
    
    <div class="col-sm-12"> 
          
      
       
       <div class="col-sm-12">
        
        <?php
      
            if($conn){
                
                // SALIR DEL SISTEMA
                if(isset($_POST['logout'])){
                    logOut($nombre);
                }
                
                // =================================================================================================================== //
                // CONTACTS SPACE
                $oneContact = new Contacts();
                
                if(isset($_POST['add_contact'])){
                    $oneContact->formAddContact();
                }
                if(isset($_POST['list_contacts']) || isset($_POST['search_lastname']) || isset($_POST['search_office_number'])){
                    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
                    $nroOff = mysqli_real_escape_string($conn,$_POST['office_number']);
                    $oneContact->listContacts($oneContact,$varsession,$lastname,$nroOff,$conn,$dbase);
                }
                if(isset($_POST['edit_contact'])){
                    $id = mysqli_real_escape_string($conn,$_POST['id']);
                    $oneContact->formEditContact($id,$conn,$dbase);
                }
                
                $oneContact->modalDeleteContact();
                
                // ====================================================================================================================== //
                // USERS SPACE
                $oneUser = new Users();
                
                // CAMBIO DE PASSWORD DE USUSARIO LOGUEADO
                if(isset($_POST['change_password'])){
                    $oneUser->changePassword($oneUser,$user_id,$conn,$dbase);
                }
                if(isset($_POST['list_users'])){
                    $oneUser->listUsers($oneUser,$conn,$dbase);
                }
                
                $oneUser->modalChangeAllow();
                
            
            
            
            
            
            
            }else{
                echo 'Conexion Error';
            }
        
        
        
        
        ?>
   
      </div>
      
     
      
    </div>
  
  </div>
</div>

 <script type="text/javascript" src="main.js"></script>
 <script type="text/javascript" src="../libs/contacts/lib_contacts.js"></script>
 <script type="text/javascript" src="../libs/users/lib_users.js"></script>


</body>
</html>
