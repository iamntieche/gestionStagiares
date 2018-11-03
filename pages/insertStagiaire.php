<?php 
    require_once('identifier.php');
	require_once('connexiondb.php');
	$nom=isset($_POST['nom'])?$_POST['nom']:"";
    $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
    $civilite=isset($_POST['civilite'])?$_POST['civilite']:"M";
    $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:1;//fixe la filiere par defaut
    
    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:1;//$_FILES permet de recuperer la photo. ['name'] permet de recupere le nom du fichier
    $imageTemp=$_FILES['photo']['tmp_name'];//['tmp_name'] nom fichier temporaire
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);//cette fonction permet de copier le fichier physique dans le dossier de l'application
    
    $requete=" insert into stagiaire(nom,prenom,civilite,IdFiliere,photo) values(?,?,?,?,?)";
    $params= array($nom,$prenom,$civilite,$idFiliere,$nomPhoto);
	$resultat = $pdo->prepare($requete);
	$resultat->execute($params);



	header('location:stagiaires.php');
?>