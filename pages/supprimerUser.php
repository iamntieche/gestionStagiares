<?php 
  if(!isset($_SESSION['user'])){
	require_once('connexiondb.php');
	$idUser=isset($_GET['idUser'])?$_GET['idUser']:0;
		$requete=" delete  from utilisateur  where idUser=? ";
		$params= array($idUser);
		$resultat = $pdo->prepare($requete);
		$resultat->execute($params);
        
		//retour de page
	header('location:utilisateurs.php');	
  }else{
	header('location:login.php');
  }
	
?>