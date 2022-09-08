<?php   include "../../connection/connection.php";
        include "lib_contacts.php";
       
        
        if($conn){
         
            $oneContact = new Contacts();
            
            $id = mysqli_real_escape_string($conn,$_POST['bookId']);
                        
            if(($id == '')){
                echo 5; // hay campos sin completar
            }else{
                $oneContact->deleteContact($id,$conn,$dbase);
            }
        
        
        }else{
            echo 13; // no hay conexion 
        }
