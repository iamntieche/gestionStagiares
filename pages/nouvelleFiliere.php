<?php
require_once('identifier.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Nouvelle Filière</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-primary margetop">
			<div class="panel-heading">Veuillez saisir les données de la nouvelle filière</div>
			<div class="panel-body">
				<form method="post" action="insertFiliere.php" class="form">

					<div class="form-group">
						<label for="niveau">Nom de la Filière :</label> 
						<input type="text" name="nomF" placeholder="Taper le nom de la filière" class="form-control" />
					</div>	
					
					  <div class="form-group">
							<label for="niveau">Niveau :</label> 
							<select name="niveau" id="niveau">
								<option value="m">Master</option>
								<option value="l">Licence</option>
								<option value="ts" selected>Technicien Specialisé</option>
								<option value="t">Technicien</option>
								<option value="q">Qualification</option>
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