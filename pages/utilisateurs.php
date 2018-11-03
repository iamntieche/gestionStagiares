<?php
	require_once('identifier.php');
    require_once("connexiondb.php");
	$login=isset($_GET['login'])?($_GET['login']):"";
     //test pagination
     $size=isset($_GET['size'])?($_GET['size']):5;
     $page=isset($_GET['page'])?($_GET['page']):1;
   	$offset=($page-1)* $size;
    
  //requete en fonction des valeurs de l'url

		  $requeteUser="select * from utilisateur where login like '%$login%'";
		  $reqcompte="select count(*) countUser from utilisateur";			
	  
		  //executer la requete
	    $resultatUser=$pdo->query($requeteUser);
	    $resultatCount=$pdo->query($reqcompte);
		
		$tab=$resultatCount->fetch();
	    $nbrUser=$tab['countUser'];
	    $reste= $nbrUser % $size;
	    if ($reste===0) 
	    	$nbrePage= $nbrUser / $size;
	     else 
	     	$nbrePage= floor($nbrUser / $size)+1;//floor retourne la partie entiere d'un nombre decimal
   
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Gestion des Utilisateurs</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-success margetop">
			<div class="panel-heading">Rechercher des Utilisateurs</div>
			<div class="panel-body">
				<form method="get" action="utilisateurs.php" class="form-inline">
					<div class="form-group">
						<input type="text" name="login" 
						placeholder="login " class="form-control" 
						value="<?php echo $login ?>"/>
					</div>	
					 
					   <button type="submit" class="btn btn-success">
							<span class="glyphicon glyphicon-search"></span> 
							Rechercher....
						</button>
						&nbsp &nbsp  
				</form>
			</div>
		</div>

		<div class="panel panel-primary ">
			<div class="panel-heading">Liste des utilisateurs  (<?php echo  $nbrUser ?> Utilisateurs)</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered"><!--table-striped: mise en forme du tableau-->
					<thead>
						<tr>
							<th>login </th><th>Email</th><th>Role</th>
							 <th>Actions</th>
						</tr>
					</thead>
					<tbody>  
						<?php while($user=$resultatUser->fetch()){ ?> <!--$resultatF->fetch(): rt ds un tableau assoc-->
								<tr class="<?php echo $user['etat']==1?'success':'danger'?>">
								    <td><?php echo $user['login']?></td>
								    <td><?php echo $user['email']?></td>
								    <td><?php echo $user['role']?></td>
								    <td>
								    	<a href="editerUser.php?idUser=<?php echo $user['iduser']?>">
								    		<span class="glyphicon glyphicon-edit"></span>
								    	</a>
								    	&nbsp; &nbsp;
								    	<a onClick="return confirm('êtes-vous sûre de vouloire supprimer cet utilisateur?')"
								    	 href="supprimerUser.php?idUser=<?php echo $user['iduser']?>">
								    		<span class="glyphicon glyphicon-trash"></span>
								    	</a>
										&nbsp; &nbsp;
										<!--action sur les boutons activer et desactiver user-->
				<a href="activerUser.php?idUser=<?php echo $user['iduser']?>&etat=<?php echo $user['etat']?>">
												<?php 
													if($user['etat']==1)
														echo '<span class="glyphicon glyphicon-remove"></span>';
													else 
													echo '<span class="glyphicon glyphicon-ok"></span>';
												?>
										</a>
								    </td>
							    </tr>
							<?php } ?>
					</tbody>
				</table>
				<div>
					<ul class="pagination"> <!--nav nav-pills: permet de ranger une liste de doé sur 1 ligne-->
						<?php for ($i=1; $i <=$nbrePage ; $i++){ ?>
						   <li class="<?php if($i==$page) echo 'active' ?>">
	 <a href="utilisateurs.php?page= <?php echo $i ?>&login=<?php echo $login ?>">
						   			<?php echo $i?>	
						   		</a>
						   </li> 
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>