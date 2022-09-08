<?php   session_start();
        include "../../connection/connection.php";
        include "lib_users.php";
        
        $oneUser = new Users();
        
        if($conn){
            
            $id = mysqli_real_escape_string($conn,$_POST['bookId']);
            $role = mysqli_real_escape_string($conn,$_POST['permisos']);
                       
            if(($role == '') || ($id == '')){
                echo 3;
            }else{
                $oneUser->changeAllow($oneUser,$id,$role,$conn,$dbase);
            }
        }else{
            echo 13; // sin conexion
        }
        
?>
