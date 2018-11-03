<?php 
require_once('identifier.php');
	require_once('connexiondb.php');

	$idUser=isset($_POST['idUser'])?$_POST['idUser']:0;
	$login=isset($_POST['login'])?$_POST['login']:"";
    $email=isset($_POST['email'])?$_POST['email']:"";
    $role=isset($_POST['role'])?$_POST['role']:"M";

    $requete=" update utilisateur set login=?, email=?, role=?
     where idUser=? ";
        //créer un tableau de parametre
     $params= array($login,$email,$role,$idUser);
   
  
	$resultat = $pdo->prepare($requete);
	$resultat->execute($params);

	//retour de page

	header('location:utilisateurs.php');
?>