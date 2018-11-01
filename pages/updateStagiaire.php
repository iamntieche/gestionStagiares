<?php 
	require_once('connexiondb.php');

	$idS=isset($_POST['idS'])?$_POST['idS']:0;
	$nom=isset($_POST['nom'])?$_POST['nom']:"";
    $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
    $civilite=isset($_POST['civilite'])?$_POST['civilite']:"M";
    $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:1;//fixe la filiere par defaut
    
    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:1;//$_FILES permet de recuperer la photo. ['name'] permet de recupere le nom du fichier
    //stockage du fichier dans un dossier temporaire
    $imageTemp=$_FILES['photo']['tmp_name'];//['tmp_name'] nom fichier temporaire
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);//cette fonction permet de copier le fichier physique dans le dossier de l'application
    //test
    //echo $nomPhoto ."<br>";
    //echo $imageTemp;
   $requete=" update stagiaire set nom=?, prenom=?, civilite=?,idFiliere=?, photo=?
                 where idStagiaire=? ";
	//créer un tableau de parametre
	$params= array($nom,$prenom,$civilite,$idFiliere,$nomPhoto,$idS);
	$resultat = $pdo->prepare($requete);
	$resultat->execute($params);

	//retour de page

	header('location:stagiaires.php');
?>