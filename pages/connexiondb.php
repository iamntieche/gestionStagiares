<?php 
  try{
  	$pdo= new PDO("mysql:host=localhost;dbname=gestion_stag","root",""); //object de con a la bd pr tt type de bd
  }catch(Exception $e){
      die('Erreur de connexion : '.$e->getMessage());
  }
    
?>