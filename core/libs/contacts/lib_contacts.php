<?php

class Contacts{

    // properties
    private $name = '';
    private $lastname = '';
    private $email = '';
    private $telephone_1 = '';
    private $telephone_2 = '';
    private $cellphone = '';
    private $office_number = '';
    private $charge = '';
    private $organism = '';
    
    // CONSTRUCTOR
    function __construct(){
        $this->name = '';
        $this->lastname = '';
        $this->telephone_1 = '';
        $this->telephone_2 = '';
        $this->cellphone = '';
        $this->office_number = '';
        $this->charge = '';
        $this->organism = '';    
    }
    
    // SETTERS
    private function setName($var){
        $this->name = $var;
    }
    
    private function setLastName($var){
        $this->lastname = $var;
    }
    
    private function setEmail($var){
        $this->email = $var;
    }
    
    private function setTelephone1($var){
        $this->telephone_1 = $var;
    }
    
    private function setTelephone2($var){
        $this->telephone_2 = $var;
    }
    
    private function setCellphone($var){
        $this->cellphone = $var;
    }
    
    private function setOfficeNumber($var){
        $this->office_number = $var;
    }
    
    private function setCharge($var){
        $this->charge = $var;
    }
    
    private function setOrganism($var){
        $this->organism = $var;
    }

    // GETTERS
    private function getName($var){
        return $this->name = $var;
    }
    
    private function getLastName($var){
        return $this->lastname = $var;
    }
    
    private function getEmail($var){
        return $this->email = $var;
    }
    
    private function getTelephone1($var){
        return $this->telephone_1 = $var;
    }
    
    private function getTelephone2($var){
        return $this->telephone_2 = $var;
    }
    
    private function getCellphone($var){
        return $this->cellphone = $var;
    }
    
    private function getOfficeNumber($var){
        return $this->office_number = $var;
    }
    
    private function getCharge($var){
        return $this->charge = $var;
    }
    
    private function getOrganism($var){
        return $this->organism = $var;
    }

    
    // METHODS
    // LIST
   
    public function listContacts($oneContact,$varsession,$lastName,$nroOff,$conn,$dbase){
    
    
           if($conn){
                
                $mensaje = 'Campo Incompleto';
                
                if($lastName != ''){
                    $sql = "select * from ag_contactos where apellido = '$lastName'";
                    mysqli_select_db($conn,$dbase);
                    $query = mysqli_query($conn,$sql);
                }
                if(($lastName == '') && ($nroOff != '')){
                    $sql = "select * from ag_contactos where nro_oficina = '$nroOff'";
                    mysqli_select_db($conn,$dbase);
                    $query = mysqli_query($conn,$sql);                
                }
                if(($lastName == '') && ($nroOff == '')){
                    $sql = "select * from ag_contactos";
                    mysqli_select_db($conn,$dbase);
                    $query = mysqli_query($conn,$sql);                
                }
                //mostramos fila x fila
                $count = 0;
                echo '<div class="panel panel-info">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Listado de Contactos</div>
                        
                        <div class="panel-body">
                        <div class="table-responsive"><br>';
                        
                        echo "<table class='display compact' style='width:100%' id='contactosTable'>";
                        echo "<thead>
                        <th class='text-nowrap text-center'>Apellido</th>
                        <th class='text-nowrap text-center'>Nombre</th>
                        <th class='text-nowrap text-center'>Email</th>
                        <th class='text-nowrap text-center'>Telefono 1</th>
                        <th class='text-nowrap text-center'>Telefono 2</th>
                        <th class='text-nowrap text-center'>Móvil</th>
                        <th class='text-nowrap text-center'>Nro. Oficina</th>
                        <th class='text-nowrap text-center'>Cargo</th>
                        <th class='text-nowrap text-center'>Organismo / Dirección</th>
                        <th>&nbsp;</th>
                        </thead>";


                while($fila = mysqli_fetch_array($query)){
                        // Listado normal
                        echo "<tr>";
                        if(($oneContact->getLastName($fila['apellido'])) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{                        
                            echo "<td align=center>".$oneContact->getLastName($fila['apellido'])."</td>";
                        }
                        if(($oneContact->getName($fila['nombre'])) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getName($fila['nombre'])."</td>";
                        }
                        if($oneContact->getEmail($fila['email']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getEmail($fila['email'])."</td>";
                        }
                        if($oneContact->getTelephone1($fila['telefono_1']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getTelephone1($fila['telefono_1'])."</td>";
                        }
                        if($oneContact->getTelephone2($fila['telefono_2']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getTelephone2($fila['telefono_2'])."</td>";
                        }
                        if($oneContact->getCellphone($fila['movil']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getCellphone($fila['movil'])."</td>";
                        }
                        if($oneContact->getOfficeNumber($fila['nro_oficina']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getOfficeNumber($fila['nro_oficina'])."</td>";
                        }
                        if($oneContact->getCharge($fila['cargo']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getCharge($fila['cargo'])."</td>";
                        }
                        if($oneContact->getOrganism($fila['organismo']) == ''){
                            echo "<td align=center style='background-color:#e74c3c'><font color='white' />".$mensaje."</td>";
                        }else{
                            echo "<td align=center>".$oneContact->getOrganism($fila['organismo'])."</td>";
                        }
                        echo "<td class='text-nowrap'>";
                        echo '<form <action="main.php" method="POST">
                                <input type="hidden" name="id" value="'.$fila['id'].'">
                                
                                <button type="submit" class="btn btn-success btn-sm" name="edit_contact" data-toggle="tooltip" data-placement="left" title="Editar Datos del Contacto">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</button>';
                                if($varsession == 'root_mecon'){
                                    echo '<a data-toggle="modal" data-target="#modalContactDelete" href="#" data-id="'.$fila['id'].'" class="btn btn-danger btn-sm">
                                    <span class="glyphicon glyphicon-trash"></span> Eliminar</a>';
                                }
                    
             echo '</form>';
                        echo "</td>";
                        $count++;
                    }

                    echo "</table>";
                    echo "<hr>";
                    echo '<div class="alert alert-info"><span class="glyphicon glyphicon-option-vertical"></span> Cantidad de Registros:  '.$count.' </div><hr>';
                    echo '</div></div>';
                    
                    }else{
                    echo 'Connection Failure...';
                    }

                //mysqli_close($conn);

    } // FIN DEL METODO LISTAR
    

    // FORMS
    public function formAddContact(){
    
        echo '<div class="container">
                <h1>Nuevo Contacto</h1><hr>
                <p>Preste atención a los datos que recibe cada campo. <strong>Los Campos que muestran (*) son obligatorios</strong></p><hr>
                <div class="row">
                <form id="fr_new_contact_ajax" method="POST">
                
                    <div class="col-sm-4" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                            
                            <div class="form-group">
                            <label for="name">Nombre: (*)</label>
                            <input type="text" class="form-control" id="name" name="name">
                            </div>
                            
                            <div class="form-group">
                            <label for="lastname">Apellido: (*)</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                            
                            <div class="form-group">
                            <label for="email">Email: (*)</label>
                            <input type="email" class="form-control" id="email" name="email">
                            </div>
                    
                    </div>
                    
                    <div class="col-sm-4" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                            
                            <div class="form-group">
                            <label for="telephone_1">Teléfono 1: (*)</label>
                            <input type="text" class="form-control" id="telephone_1" name="telephone_1">
                            </div>
                            
                            <div class="form-group">
                            <label for="telephone_2">Teléfono 2: (*)</label>
                            <input type="text" class="form-control" id="telephone_2" name="telephone_2">
                            </div>
                            
                            <div class="form-group">
                            <label for="cellphone">Móvil: (*)</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone">
                            </div>
                    
                    </div>
                    
                    <div class="col-sm-4" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                    
                            <div class="form-group">
                            <label for="office_number">Nro. Oficina: (*)</label>
                            <input type="text" class="form-control" id="office_number" name="office_number">
                            </div>
                            
                            <div class="form-group">
                            <label for="charge">Cargo: (*)</label>
                            <input type="text" class="form-control" id="charge" name="charge">
                            </div>
                            
                            <div class="form-group">
                            <label for="organism">Organismo: (*)</label>
                            <input type="text" class="form-control" id="organism" name="organism">
                            </div>
                            
                    </div>
                    
                    <button type="submit" class="btn btn-default btn-block" id="insert_contact">
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                    <hr>
                </form>
                
                </div>
                </div>';
                
    } // END OF FUNCTION
    
    
     public function formEditContact($id,$conn,$dbase){
        
        mysqli_select_db($conn,$dbase);
        $sql = "select * from ag_contactos where id = '$id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        
    
        echo '<div class="container">
                <h1>Editar Contacto</h1><hr>
                <p>Preste atención a los datos que recibe cada campo. <strong>Los Campos que muestran (*) son obligatorios</strong></p><hr>
                <div class="row">
                <form id="fr_update_contact_ajax" method="POST">
                <input type="hidden" id="id" name="id" value="'.$id.'">
                
                    <div class="col-sm-4" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                            
                            <div class="form-group">
                            <label for="name">Nombre: (*)</label>
                            <input type="text" class="form-control" id="name" name="name" value="'.$row['nombre'].'">
                            </div>
                            
                            <div class="form-group">
                            <label for="lastname">Apellido: (*)</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="'.$row['apellido'].'">
                            </div>
                            
                            <div class="form-group">
                            <label for="email">Email: (*)</label>
                            <input type="email" class="form-control" id="email" name="email" value="'.$row['email'].'">
                            </div>
                    
                    </div>
                    
                    <div class="col-sm-4" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                            
                            <div class="form-group">
                            <label for="telephone_1">Teléfono 1: (*)</label>
                            <input type="text" class="form-control" id="telephone_1" name="telephone_1" value="'.$row['telefono_1'].'">
                            </div>
                            
                            <div class="form-group">
                            <label for="telephone_2">Teléfono 2: (*)</label>
                            <input type="text" class="form-control" id="telephone_2" name="telephone_2" value="'.$row['telefono_2'].'">
                            </div>
                            
                            <div class="form-group">
                            <label for="cellphone">Móvil: (*)</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone" value="'.$row['movil'].'">
                            </div>
                    
                    </div>
                    
                    <div class="col-sm-4" style="background-color:#f2f4f4; border: 2px solid black; border-radius: 5px;"><br>
                    
                            <div class="form-group">
                            <label for="office_number">Nro. Oficina: (*)</label>
                            <input type="text" class="form-control" id="office_number" name="office_number" value="'.$row['nro_oficina'].'">
                            </div>
                            
                            <div class="form-group">
                            <label for="charge">Cargo: (*)</label>
                            <input type="text" class="form-control" id="charge" name="charge" value="'.$row['cargo'].'">
                            </div>
                            
                            <div class="form-group">
                            <label for="organism">Organismo: (*)</label>
                            <input type="text" class="form-control" id="organism" name="organism" value="'.$row['organismo'].'" >
                            </div>
                            
                    </div>
                    
                    <button type="submit" class="btn btn-default btn-block" id="update_contact">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
                    <hr>
                </form>
                
                </div>
                </div>';
                
    } // END OF FUNCTION
    
    
    
    // PERSISTENCE
    public function addContact($oneContact,$name,$lastname,$email,$telephone_1,$telephone_2,$cellphone,$office_number,$charge,$organism,$conn,$dbase){
        
        
        if($conn){
        
        mysqli_select_db($conn,$dbase);
        $sql = "select * from ag_contactos where nombre = '$name' and apellido = '$lastname'";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);
        
        if($rows == 0){
        
            $sql_1 = "insert into ag_contactos".
                     "(nombre,
                       apellido,
                       email,
                       telefono_1,
                       telefono_2,
                       movil,
                       nro_oficina,
                       cargo,
                       organismo)".
                      "VALUES ".
                      "($oneContact->setName('$name'),
                        $oneContact->setLastName('$lastname'),
                        $oneContact->setEmail('$email'),
                        $oneContact->setTelephone1('$telephone_1'),
                        $oneContact->setTelephone2('$telephone_2'),
                        $oneContact->setCellphone('$cellphone'),
                        $oneContact->setOfficeNumber('$office_number'),
                        $oneContact->setCharge('$charge'),
                        $oneContact->setOrganism('$organism')
                        )";
                    
                    $query_1 = mysqli_query($conn,$sql_1);
                    
                    if($query_1){
                        echo 1; // insert ok
                    }else{
                        echo -1; // insert failure
                    }
        
        }
        if($rows > 0){
            echo 4; // contacto existente
        }
        }else{
            echo 7; // connection failure
        }
        
    } // END OF FUNCTION
    
    public function updateContact($oneContact,$id,$name,$lastname,$email,$telephone_1,$telephone_2,$cellphone,$office_number,$charge,$organism,$conn,$dbase){
    
        if($conn){
        
        mysqli_select_db($conn,$dbase);
        $sql = "update ag_contactos set
                nombre = $oneContact->setName('$name'),
                apellido = $oneContact->setLastName('$lastname'),
                email = $oneContact->setEmail('$email'),
                telefono_1 = $oneContact->setTelephone1('$telephone_1'),
                telefono_2 = $oneContact->setTelephone2('$telephone_2'),
                movil = $oneContact->setCellphone('$cellphone'),
                nro_oficina = $oneContact->setOfficeNumber('$office_number'),
                cargo = $oneContact->setCharge('$charge'),
                organismo = $oneContact->setOrganism('$organism')
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
    
    
    public function deleteContact($id,$conn,$dbase){
    
        if($conn){
        
            mysqli_select_db($conn,$dbase);
            $sql = "delete from ag_contactos where id = '$id'";
            $query = mysqli_query($conn,$sql);
            
            if(query){
                echo 1;
            }else{
                echo -1;
            }
        }else{
            echo 7;
        }
    }
    
    
    public function modalDeleteContact(){
    
    echo '<div id="modalContactDelete" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-trash"></span> Borrar Contacto</h4>
                </div>
                <div class="modal-body">
                    
                    <form id="fr_delete_contact_ajax" method="POST">
                    <input type="hidden" class="form-control" name="bookId" id="bookId" value="bookId">
                        <p>Desea eliminar el contacto</p>
                        <button type="submit" class="btn btn-success" id="delete_contact">
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

} // END OF FUNCTION

} // END OF CLASS


?>
