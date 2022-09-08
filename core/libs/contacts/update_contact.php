<?php   include "../../connection/connection.php";
        include "lib_contacts.php";
       
        
        if($conn){
         
            $oneContact = new Contacts();
            
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $name = mysqli_real_escape_string($conn,$_POST['name']);
            $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $telephone_1 = mysqli_real_escape_string($conn,$_POST['telephone_1']);
            $telephone_2 = mysqli_real_escape_string($conn,$_POST['telephone_2']);
            $cellphone = mysqli_real_escape_string($conn,$_POST['cellphone']);
            $office_number = mysqli_real_escape_string($conn,$_POST['office_number']);
            $charge = mysqli_real_escape_string($conn,$_POST['charge']);
            $organism = mysqli_real_escape_string($conn,$_POST['organism']);
            
            if(($id == '') || ($name == '') || ($lastname == '') || ($email == '') || ($telephone_1 == '') || ($telephone_2 == '') || ($cellphone == '') || ($office_number == '') || ($charge == '') || ($organism == '')){
                echo 5; // hay campos sin completar
            }else{
                $oneContact->updateContact($oneContact,$id,$name,$lastname,$email,$telephone_1,$telephone_2,$cellphone,$office_number,$charge,$organism,$conn,$dbase);
            }
        
        
        }else{
            echo 13; // no hay conexion 
        }
