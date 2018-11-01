<?php 
	require_once('connexiondb.php');

	$nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
	$niveau=isset($_POST['niveau'])?strtoupper($_POST['niveau']):"";

	$requete=" insert into filiere(nomFiliere,niveau) values(?,?)";
	//créer un tableau de parametre
	$params= array($nomf,$niveau);
	$resultat = $pdo->prepare($requete);
	$resultat->execute($params);

	//retour de page

	header('location:filieres.php')
?>