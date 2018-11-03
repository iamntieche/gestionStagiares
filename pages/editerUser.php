<?php 
	require_once('identifier.php');
     require_once('connexiondb.php');
    $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;
    $requeteUser=" select * from utilisateur where iduser=$idUser";
    $resultatUser=$pdo->query($requeteUser);
    $user=$resultatUser->fetch();
    
    $login=$user['login'];
    $email=$user['email'];
    $role= strtoupper($user['role']);//convertie le resultat en majuscule
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Edition d'un utilisateur</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-primary margetop">
			<div class="panel-heading">Edition de l'utilisateur</div>
			<div class="panel-body">
				<form method="post" action="updateUser.php" class="form" >

					<div class="form-group">
						<label for="idUser">id  : <?php echo $idUser ?></label> 
						<input type="hidden" name="idUser" class="form-control" value="<?php echo $idUser ?>" />
					</div>

					<div class="form-group">
						<label for="login">Login :</label> 
						<input type="text" name="login" 
                        placeholder="Login" class="form-control" 
						 value="<?php echo $login ?>"/>
					</div>	

                    <div class="form-group">
						<label for="email">Email :</label> 
						<input type="text" name="email" 
                        placeholder="exemple@gmail.com" class="form-control" 
						 value="<?php echo $email ?>"/>
					</div>

					 <div class="form-group">
						<select name="role" class="form-control">
							<option value="ADMIN" <?php if($role=="ADMIN") echo "selected" ?> >Administrateur</option>
							<option value="VISITEUR" <?php if($role=="VISITEUR") echo "selected" ?>>Visiteur</option>
						</select>
					</div>
                        
						<button type="submit" class="btn btn-success">
							<span class="glyphicon glyphicon-save"></span>
							Enregister
						</button>
                        &nbsp; &nbsp;
                            <a href="modifierPwd.php?iduser=<?php echo $iduser?>">Changer le mot de passe</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>