<?php 
if(!isset($_SESSION['user'])){
	require_once('connexiondb.php');

	$idf=isset($_GET['idF'])?$_GET['idF']:0;

    $requeteStag=" select count(*) countStag from stagiaire  where idFiliere=$idf";
	$resultatStag =$pdo->query($requeteStag);
	$tabCountStag=$resultatStag->fetch();//recuperation dans un tblo associatif
	$nbrStag=$tabCountStag['countStag'];//recupere la colonne countStag

if ($nbrStag==0) {
		$requete=" delete  from filiere  where idFiliere=? ";
		//créer un tableau de parametre
		$params= array($idf);
		$resultat = $pdo->prepare($requete);
		$resultat->execute($params);

		//retour de page
		header('location:filieres.php');
}else
{
	$msg=" Suppression impossible: Vous devez supprimer tout les stagiaires inscris dans cette filière";
	header("location:alerte.php?message=$msg");
}
}else{
	header('location:login.php');
}
	

	
?>