<?php 
     require_once('connexiondb.php');
    $message=isset($_GET['message'])?$_GET['message']:"Erreur";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Alerte</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-danger margetop">
			<div class="panel-heading"><h4>Erreur:</h4> </div>
			<div class="panel-body">
				<h3><?php echo  $message ?></h3>
				<!--$_SERVER['HTTP_REFERER']: recupere l-URL de la page précedente-->
				<h4><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"> Retour >>></a></h4>
			</div>
		</div>
	</div>
</body>
</html>