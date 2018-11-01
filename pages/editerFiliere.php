<?php 
     require_once('connexiondb.php');
    $idf=isset($_GET['idF'])?$_GET['idF']:0;
    $requete=" select * from filiere where idFiliere=$idf";
    $resultat=$pdo->query($requete);
    $filiere=$resultat->fetch();
    $nomf=$filiere['nomFiliere'];
    $niveau=strtolower($filiere['niveau']); //strtolower : permet de convertir un texte en minuscule

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Edition d'une filière</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-primary margetop">
			<div class="panel-heading">Edition de la filière</div>
			<div class="panel-body">
				<form method="post" action="updateFiliere.php" class="form">

					<div class="form-group">
						<label for="niveau">id de la Filière : <?php echo $idf ?></label> 
						<input type="hidden" name="idF" class="form-control" value="<?php echo $idf ?>" />
					</div>

					<div class="form-group">
						<label for="niveau">Nom de la Filière :</label> 
						<input type="text" name="nomF" placeholder="Taper le nom de la filière" class="form-control" 
						 value="<?php echo $nomf ?>"/>
					</div>	
					
					  <div class="form-group">
							<label for="niveau">Niveau :</label> 
							<select name="niveau" id="niveau">
								<option value="m" <?php if ($niveau=="m") echo " selected" ?> >Master</option>
								<option value="l" <?php if ($niveau=="l") echo " selected" ?> >Licence</option>
								<option value="ts"<?php if ($niveau=="ts") echo " selected" ?> >Technicien Specialisé</option>
								<option value="t" <?php if ($niveau=="t") echo " selected" ?> >Technicien</option>
								<option value="q" <?php if ($niveau=="q") echo " selected" ?> >Qualification</option>
							</select><br>
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