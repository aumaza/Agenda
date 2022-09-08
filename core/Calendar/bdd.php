<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=agenda;charset=utf8', 'root', 'slack142');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}