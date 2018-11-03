<?php 
	
	session_start();
	//ce if permet d'empecher la suppression via l'url
	if(!isset($_SESSION['user'])){
		require_once('connexiondb.php');
		$idS=isset($_GET['idS'])?$_GET['idS']:0;
			$requete=" delete  from stagiaire  where idStagiaire=? ";
			$params= array($idS);
			$resultat = $pdo->prepare($requete);
			$resultat->execute($params);
			
			//retour de page
		header('location:stagiaires.php');
	}else{
		header('location:login.php');
	}	

	
?>