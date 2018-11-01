<?php
//instancier le fichier de connexion a la bd. il existe 3 façon de se connecter a ala bd
  //  include("connexiondb.php");//copier-coller du fichier connexiondb.php
  //  require("connexiondb.php");//interpretation du fichier connexiondb.php et affiche le rt
    require_once("connexiondb.php");//interpretation du fichier connexiondb.php et affiche le rt sans plus recompiler
  // $nomf=isset($_GET['nomF'])?($_GET['nomF']):"";  ce code joue le meme role que celui avec ? et :
   // $niveau=isset($_GET['niveau'])?($_GET['niveau']):"all";
    //recuperation des valeurs de l'url
    /*

if(isset($_GET['nomPrenom']))
    	$nomPrenom=$_GET['nomPrenom'];
     else
     	$nomPrenom="";
      
      if(isset($_GET['idfiliere']))
    	$idfiliere=$_GET['idfiliere'];
     else
     	$idfiliere=0;
    */
  
$requeteFiliere=" select * from filiere";


$nomPrenom=isset($_GET['nomPrenom'])?($_GET['nomPrenom']):"";
$idfiliere=isset($_GET['idfiliere'])?($_GET['idfiliere']):0;

     //test pagination
     $size=isset($_GET['size'])?($_GET['size']):5;
     $page=isset($_GET['page'])?($_GET['page']):1;
   $offset=($page-1)* $size;
    
  //requete en fonction des valeurs de l'url
	if($idfiliere==0){
		  $requeteStagiaire="select idStagiaire,nom,prenom,nomFiliere,photo,civilite 
				  	from stagiaire as s, filiere as f 
		  			where s.idFiliere=f.idFiliere
		  			and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
		  			order by idStagiaire
		  			limit $size
		  			offset $offset";
		  $reqcompte="select count(*) countS from stagiaire
		  				where nom like '%$nomPrenom%' or prenom like '%$nomPrenom%' ";			
	}else{
		 $requeteStagiaire="select idStagiaire,nom,prenom,nomFiliere,photo,civilite 
				  	from stagiaire as s, filiere as f 
		  			where s.idFiliere=f.idFiliere
		  			and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
		  			and f.idFiliere=$idfiliere
		  			order by idStagiaire
		  			limit $size
		  			offset $offset";
	      $reqcompte="select count(*) countS from stagiaire
		  				where (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%') 
		  				and idFiliere=$idfiliere "; 
	}
	  //executer la requete
	    $resultatFiliere=$pdo->query($requeteFiliere);
	    $resultatStagiaire=$pdo->query($requeteStagiaire);

	    $resultatCount=$pdo->query($reqcompte);
	    $tab=$resultatCount->fetch();
	    $nbreStagiaires=$tab['countS'];
	    $reste= $nbreStagiaires % $size;
	    if ($reste===0) 
	    	$nbrePage= $nbreStagiaires / $size;
	     else 
	     	$nbrePage= floor($nbreStagiaires / $size)+1;//floor retourne la partie entiere d'un nombre decimal
   
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Gestion des stagiaires</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-success margetop">
			<div class="panel-heading">Rechercher des Stagiaires...</div>
			<div class="panel-body">
				<form method="get" action="stagiaires.php" class="form-inline">
					<div class="form-group">
						<input type="text" name="nomPrenom" 
						placeholder="Taper le nom et prenom" class="form-control" 
						value="<?php echo($nomPrenom) ?>"/>
					</div>	
						<label for="idfiliere">Filière :</label> 
						<select name="idfiliere" id="idfiliere" onchange="this.form.submit()">
							<option value=0>Toutes les filières</option>
							<?php while ($filiere=$resultatFiliere->fetch()) {?>
								<option value="<?php echo $filiere['idFiliere'] ?>"
									<?php if ($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
									<?php echo $filiere['nomFiliere'] ?>	
								</option>
							<?php } ?>
						</select>
					   <button type="submit" class="btn btn-success">
							<span class="glyphicon glyphicon-search"></span> 
							Rechercher....
						</button>
						&nbsp &nbsp 
						<a href="nouveauStagiaire.php">
							<span class="glyphicon glyphicon-plus"></span>
					  		 Nouveau stagiaire
						</a>
				</form>
			</div>
		</div>

		<div class="panel panel-primary ">
			<div class="panel-heading">Liste des Stagiares  (<?php echo  $nbreStagiaires ?> Filières)</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered"><!--table-striped: mise en forme du tableau-->
					<thead>
						<tr>
							<th>id Stagiare</th><th>Nom </th><th>Prenom </th><th>Filière</th>
							<th>Photo</th><th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php while($stagiaire=$resultatStagiaire->fetch()){ ?> <!--$resultatF->fetch(): rt ds un tableau assoc-->
								<tr>
								    <td><?php echo $stagiaire['idStagiaire']?></td>
								    <td><?php echo $stagiaire['nom']?></td>
								    <td><?php echo $stagiaire['prenom']?></td>
								    <td><?php echo $stagiaire['nomFiliere']?></td>
								    <td>
									<img src="../images/<?php echo $stagiaire['photo']?>"
									 width="50px" height="50px" class="img-circle">
									</td><!-- img affiche l'image correspondant au nom de la photo dans la bd-->
								    <td>
								    	<a href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire']?>">
								    		<span class="glyphicon glyphicon-edit"></span>
								    	</a>
								    	&nbsp &nbsp
								    	<a onClick="return confirm('êtes-vous sûre de vouloire supprimer le Stagiare')"
								    	 href="supprimerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire']?>">
								    		<span class="glyphicon glyphicon-trash"></span>
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
	 <a href="stagiaires.php?page= <?php echo $i ?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $idfiliere ?>">
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