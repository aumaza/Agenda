<?php

/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/agenda/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/agenda/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/css/scrolling-nav.css" >
		
	<link rel="stylesheet" href="/agenda/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/Chart.js/Chart.css" >
	
	<link rel="stylesheet" href="/agenda/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/dataTables/buttons.dataTables.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/css/buttons.dataTables.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/css/buttons.bootstrap.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/css/jquery.dataTables-1.11.5.min.css" >
	<link rel="stylesheet" href="/agenda/skeleton/dataTables/fixedColumns.dataTables.min.css" >
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    
    <script src="/agenda/skeleton/js/jquery-3.4.1.min.js"></script>
    <script src="/agenda/skeleton/js/jquery-3.5.1.min.js"></script>
	<script src="/agenda/skeleton/js/bootstrap.min.js"></script>
	
	<script src="/agenda/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/agenda/skeleton/dataTables/DataTables/js/jquery.dataTables1.min.js"></script>
	<script src="/agenda/skeleton/dataTables/DataTables/js/dataTables.fixedColumns.min.js"></script>
	
	<script src="/agenda/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/agenda/skeleton/js/dataTables.select.min.js"></script>
	<script src="/agenda/skeleton/js/dataTables.buttons.min.js"></script>
	<script src="/agenda/skeleton/dataTables/DataTables/js/dataTables.dateTime.min.js"></script>
	<script src="/agenda/skeleton/dataTables/DataTables/js/buttons.colVis.min.js"></script>
	
	<script src="/agenda/skeleton/js/jszip.min.js"></script>
	<script src="/agenda/skeleton/js/pdfmake.min.js"></script>
	<script src="/agenda/skeleton/js/vfs_fonts.js"></script>
	<script src="/agenda/skeleton/js/buttons.html5.min.js"></script>
	<script src="/agenda/skeleton/js/buttons.bootstrap.min.js"></script>
	<script src="/agenda/skeleton/js/buttons.print.min.js"></script>
	
	<script src="/agenda/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/agenda/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/agenda/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/agenda/skeleton/Chart.js/Chart.js"></script>';
}

/*
** Funcion de validación de ingreso
*/
function logIn($user,$pass,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass;
	
	$sql_1 = "select password from ag_usuarios where user = '$user'";
	$query_1 = mysqli_query($conn,$sql_1);
	while($row = mysqli_fetch_array($query_1)){
        $hash = $row['password'];
	}
	
    
    
	$sql = "SELECT * FROM ag_usuarios where user = '$user' and role = 1";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM ag_usuarios where user = '$user' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	
	
	if(!$q && !$retval){	
			echo '<div class="alert alert-danger" role="alert">';
			echo "Error de Conexion..." .mysqli_error($conn);
			echo "</div>";
			echo '<a href="#"><br><br>
                    <button type="submit" class="btn btn-primary">Aceptar</button></a>';	
			exit;			
			
			}
		
			if(($user = mysqli_fetch_assoc($retval)) && (password_verify($pass,$hash))){
				

				echo '<div class="alert alert-danger" role="alert">';
				echo "<strong>Atención!  </strong>" .$_SESSION["user"];
				echo "<br>";
				echo '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span><strong> Usuario Bloqueado. Contacte al Administrador.</strong>';
				echo "</div>";
				exit;
			}

			else if(($user = mysqli_fetch_assoc($q)) && (password_verify($pass,$hash))){

				if(strcmp($_SESSION["user"], 'root') == 0){

				echo "<br>";
				echo '<div class="alert alert-success" role="alert">';
				echo '<img src="lodding.gif"  class="img-reponsive img-rounded avatar">';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=core/main/main.php "/>';
				
			}else{
				echo '<div class="alert alert-success" role="alert">';
				echo '<img src="lodding.gif"  class="img-reponsive img-rounded avatar">';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=core/main/main.php "/>';
				
			}
			}else{
				echo '<div class="alert alert-danger" role="alert">';
				echo '<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Usuario o Contraseña Incorrecta. Reintente Por Favor....';
				echo "</div>";
				}
}


function logOut($nombre){
    
    echo ' <div class="jumbotron">
                <h1>Hasta Luego '.$nombre.'</h1>
                <img src="lodding_1.gif"  class="img-reponsive img-rounded">
                <meta http-equiv="refresh" content="4;URL=../../logout.php "/>
            </div>';

}

?>
