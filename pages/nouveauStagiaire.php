<?php 
	require_once('identifier.php');
     require_once('connexiondb.php');
    //Select des Stagiaires
    $requeteF=" select * from filiere ";
    $resultatF=$pdo->query($requeteF);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Nouveau stagiaire</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-primary margetop">
			<div class="panel-heading">les infos du nouveau Stagiaire</div>
			<div class="panel-body">
				<form method="post" action="insertStagiaire.php" class="form" enctype="multipart/form-data">
 
					
					<div class="form-group">
						<label for="nom">Nom :</label> 
						<input type="text" name="nom" 
                        placeholder="Taper le nom du stagiaire" class="form-control"/>
					</div>	

                    <div class="form-group">
						<label for="prenom">Prenom :</label> 
						<input type="text" name="prenom" 
                        placeholder="Prénom" class="form-control"/>
					</div>

                    <div class="form-group">
						<label for="civilite">Civilite :</label> <br>
                       <label> 
                            <input type="radio" name="civilite" value="F" checked />F
                        </label><br>
                        <label> 
                                <input type="radio" name="civilite" value="M"/>M
                        </label>
                       
						
					</div>	
					
					  <div class="form-group">
							<label for="idFiliere">Filiere :</label> 
							<select name="idFiliere" id="idFiliere">
								<?php while($filiere=$resultatF->fetch()) {?>
                                    <option value=" <?php echo $filiere['idFiliere'] ?>"> <!-- permet de selectionner la filiere encours-->
                                        <?php echo $filiere['nomFiliere'] ?>
                                    </option>
                                <?php }?>
							</select>
						</div> 
                        
                        <div class="form-group">
                                <label for="photo">Photo :</label> 
                                <input type="file" name="photo"/>
					    </div>
						<button type="submit" class="btn btn-success">
							<span class="glyphicon glyphicon-save"></span>
							Enregister
						</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>