<?php   include "../core/connection/connection.php";
        include "../core/libs/users/lib_users.php";
        
        if($conn){
            
            $oneUser = new Users();
            
            $name = mysqli_real_escape_string($conn,$_POST['nombre']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
            $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);
            
            if(($name == '') || ($email == '') || ($password_1 == '') || ($password_2 == '')){
                echo 5; // hay campos sin completar
            }else{
                $oneUser->addUser($oneUser,$name,$email,$password_1,$password_2,$conn,$dbase);
            }
        
        
        }else{
            echo 13; // no hay conexion
        }




?>
