<?php

class Users{

    private $name = '';
    private $username = '';
    private $password = '';
    private $email = '';
    private $role = '';
    
    function __construct(){
        $this->name = '';
        $this->username = '';
        $this->password = '';
        $this->email = '';
        $this->role = '';    
    }
    
    // SETTERS
    private function setName($var){
        $this->name = $var;
    }
    
    private function setUserName($var){
        $this->username = $var;
    }

    private function setPassword($var){
        $this->password = $var;
    }
    
    private function setEmail($var){
        $this->email = $var;
    }
    
    private function setRole($var){
        $this->role = $var;
    }
    
    // GETTERS
    private function getName($var){
        return $this->name = $var;
    }
    
    private function getUserName($var){
        return $this->username = $var;
    }
    
    private function getPassword($var){
        return $this->password = $var;
    }
    
    private function getEmail($var){
        return $this->email = $var;
    }
    
    private function getRole($var){
        return $this->role = $var;
    }

    
    // METHODS
    
   public function listUsers($oneUser,$conn,$dbase){
        
        $enable = 'Habilitado';
        $disabled = 'Deshabilitado';
        
        if($conn)
        {
            $sql = "SELECT * FROM ag_usuarios";
                mysqli_select_db($conn,$dbase);
                $resultado = mysqli_query($conn,$sql);
            //mostramos fila x fila
            $count = 0;
            echo '<div class="container-fluid" style="margin-top:70px">
                    <div class="panel panel-default" >
                <div class="panel-heading"><span class="pull-center "><span class="glyphicon glyphicon-list-alt"></span> Listado de Usuarios';
                
            echo '</div><br>';

                    echo "<table class='table table-condensed table-hover' style='width:100%' id='usersTable'>";
                    echo "<thead>
                    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>User</th>
                    <th class='text-nowrap text-center'>Email</th>
                    <th class='text-nowrap text-center'>Permisos</th>
                    <th>&nbsp;</th>
                    </thead>";


            while($fila = mysqli_fetch_array($resultado)){
                    // Listado normal
                    echo "<tr>";
                    echo "<td align=center>".$oneUser->getName($fila['nombre'])."</td>";
                    echo "<td align=center>".$oneUser->getUserName($fila['user'])."</td>";
                    echo "<td align=center>".$oneUser->getEmail($fila['email'])."</td>";
                    if($oneUser->getRole($fila['role']) == 1){
                        echo "<td align=center>".$enable."</td>";
                    }else if($oneUser->getRole($fila['role']) == 0){
                        echo "<td align=center>".$disabled."</td>";
                    }
                    echo "<td class='text-nowrap'>";
                    if($oneUser->getUserName($fila['user']) != 'root_mecon'){
                            echo '<a data-toggle="modal" data-target="#modalUserAllow" href="#" data-id="'.$fila['id'].'" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-flash"></span> Cambiar Permisos</a>';
                    }
                    echo "</td>";
                    $count++;
                }

                echo "</table>";
                echo "<br>";
                echo '<button type="button" class="btn btn-primary">Cantidad de Usuarios:  '.$count.' </button>';
                echo '</div></div>';
                }else{
                echo 'Connection Failure...' .mysqli_error($conn);
                }

            mysqli_close($conn);

}
    
    
    
    
    public function changePassword($oneUser,$user_id,$conn,$dbase){
            
            echo '<div class="container">
                <h1>Cambio de Password</h1><hr>
                <p>Preste atención a los datos que recibe cada campo. <strong>Los Campos que muestran (*) son obligatorios</strong></p><hr>
                <div class="row">
                <form id="fr_update_password_ajax" method="POST">
                <input type="hidden" id="id" name="id" value="'.$user_id.'">
                    
                    <div class="col-sm-6" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                        <br><br><br><br>
                            <div class="form-group">
                            <label for="password_1">Password: (*)</label>
                            <input type="password" class="form-control" id="password_1" name="password_1" maxlength="15">
                            </div>
                            
                            <div class="form-group">
                            <label for="password_2">Repita Password: (*)</label>
                            <input type="password" class="form-control" id="password_2" name="password_2" maxlength="15">
                            </div>
                            <button type="submit" class="btn btn-default btn-block" id="update_password">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button><br><br><br><br>
                    </div>
                    </form>
                    <div class="col-sm-6" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;">
                         <div class="jumbotron">
                            <div class="alert alert-info">
                                <span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Importante!</strong>
                            </div>      
                            <p>Por razones de seguridad, al generar passwords no use datos filiatorios, tales como, fechas de cumpleaños, número de DNI. La cantidad de caracteres del password no puede ser inferior ni superior a 15</p>
                        </div>
                    </div>
                    
                    </div>
                    </div>';
    }
    
    
    
    
    // PERSISTENCE
    public function addUser($oneUser,$name,$email,$password_1,$password_2,$conn,$dbase){
        
        if($conn){
        
            if((strlen($password_1) == 15) && (strlen($password_2) == 15)){
            
                if(strcmp($password_1,$password_2) == 0){
                
                    
                
                mysqli_select_db($conn,$dbase);
                $sql = "select * from ag_usuarios where email = '$email' or nombre = '$name'";
                $query = mysqli_query($conn,$sql);
                $rows = mysqli_num_rows($query);
                
                if($rows == 0){
                
                    // se determina el dominio
                    $dominio = '_mecon';
                    
                    // se encripta el password
                    $passHash = password_hash($password_1, PASSWORD_BCRYPT);
                    
                    $user = substr($email,0,-13);
                    $username = $user.$dominio;
                    
                    $role = 1;
                    
                    $sql_2 = "INSERT INTO ag_usuarios ".
                            "(nombre,
                                user,
                                email,
                                password,
                                role)".
                            "VALUES ".
                            "($oneUSer->setName('$name'),
                            $oneUSer->setUserName('$username'),
                            $oneUser->setEmail('$email'),
                            $oneUser->setPassword('$passHash'),
                            $oneUser->setRole('$role'))";
                    $query_2 = mysqli_query($conn,$sql_2);
            
            
            
                    if($query_2){
                        echo 1; // se realizó la inserción en la base 
                    }else{
                        echo -1; // no se realizó la inserción del dato en la base
                    }
                
                
                }if($rows > 0){
                    echo 4; // el usuario ya existe            
                }
            
            }else{
                echo 11; // los password no coinciden
            }
        }else{
            echo 9; // alguno de los password no tiene 15 caracteres
        }
    }else{
        echo 7;
    }
    
        
    
    } // END OF FUNCTION
    
    
    
    
    
    ///////////////////////////////// SECCION REGENERACION PASSWORD ///////////////////////////////////

/*
** Funcion para generar archivo de password
*/


public function gentxt($username,$password){
  
  $fileName = "../core/gen_pass/$username.pass.txt"; 
  
  if (file_exists($fileName)){
  
    $file = fopen($fileName, 'w+');
    
    fwrite($file, $password);
    fclose($file);
    
    echo '<div class="alert alert-info" role="alert">
            Se ha generado su archivo de password. Descargue el archivo generado. Recuerde modificar su Password cuando ingrese nuevamente
         </div><hr>
            <a href="download_pass.php?file_name='.$fileName.'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Descargar</a>';
  
  }else{
  
      $file = fopen($fileName, 'w');
      fwrite($file, $password);
      fclose($file);
      
      echo '<div class="alert alert-info" role="alert">
            Se ha generado su archivo de password. Descargue el archivo generado. Recuerde modificar su Password cuando ingrese nuevamente
         </div><hr>
            <a href="download_pass.php?file_name='.$fileName.'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Descargar</a>';
      
  }
} // END OF FUNCTION


/*
** Funcion para generar password aleatorio
*/

public function genPass(){
    //Se define una cadena de caractares.
    //Os recomiendo desordenar las minúsculas, mayúsculas y números para mejorar la probabilidad.
    $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@";
    //Obtenemos la longitud de la cadena de caracteres
    $stringLong = strlen($string);
 
    //Definimos la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, puedes poner la longitud que necesites
    //Se debe tener en cuenta que cuanto más larga sea más segura será.
    $longPass=15;
 
    //Creamos la contraseña recorriendo la cadena tantas veces como hayamos indicado
    for($i=1 ; $i<=$longPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos = rand(0,$stringLong-1);
 
        //Vamos formando la contraseña con cada carácter aleatorio.
        $pass .= substr($string,$pos,1);
    }
    return $pass;
}


/*
** Funcion para blanquear password
*/

public function resetPass($oneUser,$username,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    $sql = "select * from ag_usuarios where user = '$username'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    
    if($rows > 0){

        $password = $oneUser->genPass();
        $passHash = password_hash($password, PASSWORD_BCRYPT);
        
        $sql_1 = "UPDATE ag_usuarios SET password = $oneUser->setPassword('$passHash') where user = '$username'";
        
        $query_2 = mysqli_query($conn,$sql_1);
        
        
        if($query_2){
        
            echo '<div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="alert alert-success" role="alert">
                                <span class="glyphicon glyphicon-ok"></span> Su Password fue blanqueada con Exito!
                            </div>
                        </div>
                    </div>
                 </div>';
                 $oneUser->gentxt($username,$password);
            
        }else{
            
            echo '<div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-remove"></span> Error al Blanquear Password
                            </div>";
                        </div>
                    </div>
                </div>';
            
        }
   
    }if($rows == 0){
        echo '<div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-ban-circle"></span> Usuario Inexistente. Primero Registrese!!!
                                </div>
                            </div>
                        </div>
                    </div>';
    }
} // END OF FUNCTION

public function updatePassword($oneUser,$user_id,$password_1,$password_2,$conn,$dbase){

    if($conn){
        
            if((strlen($password_1) == 15) && (strlen($password_2) == 15)){
            
                if(strcmp($password_1,$password_2) == 0){
                    
                    mysqli_select_db($conn,$dbase);
                    // se encrypta la contraseña
                    $passHash = password_hash($password_1, PASSWORD_BCRYPT);
                    $sql = "update ag_usuarios set
                            password = $oneUser->setPassword('$passHash')
                            where id = '$user_id'";
                    
                    $query = mysqli_query($conn,$sql);
                    
                    if($query){
                        echo 1; // registro actualizado correctamente
                    }else{
                        echo -1; // hubo un problema al actualizar el registro
                    }
                    

                }else{
                    echo 11; // los password no coinciden
                }    
            }else{
                echo 15; // los password deben tener 15 caracteres
            }
    }else{
        echo 7;
    }
} // END OF FUNCTION


public function changeAllow($oneUser,$id,$role,$conn,$dbase){
    
    if($conn){
    
    mysqli_select_db($conn,$dbase);
    $sql = "update ag_usuarios set
            role = $oneUser->setRole('$role')
            where id = '$id'";
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1;
    }else{
        echo -1;
    }
    }else{
        echo 7;
    }

} // END OF FUNCTION


public function modalChangeAllow(){
    
    echo '<div id="modalUserAllow" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-refresh"></span> Cambiar Permisos de Usuario</h4>
                </div>
                <div class="modal-body">
                    
                    <form id="frm_user_allow" method="POST">
                    <input type="hidden" class="form-control" name="bookId" id="bookId" value="bookId">
                        <div class="form-group">
                            <label for="permisos">Permisos:</label>
                            <select class="form-control" id="permisos" name="permisos">
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="0">Deshabilitar</option>
                                <option value="1">Habilitar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" id="cambiar_permiso">
                            <span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove-circle"></span> Cerrar</button>
                </div>
                </div>

            </div>
            </div>';

}


} // FIN DE LA CLASE


?>
