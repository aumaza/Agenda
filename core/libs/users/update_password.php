<?php   include "../../connection/connection.php";
        include "lib_users.php";
       
        
        if($conn){
         
            $oneUser = new Users();
            
            $user_id = mysqli_real_escape_string($conn,$_POST['id']);
            $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
            $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);
                        
            if(($user_id == '') || ($password_1 == '') || ($password_2 == '')){
                echo 5; // hay campos sin completar
            }else{
                $oneUser->updatePassword($oneUser,$user_id,$password_1,$password_2,$conn,$dbase);
            }
        
        
        }else{
            echo 13; // no hay conexion 
        }
