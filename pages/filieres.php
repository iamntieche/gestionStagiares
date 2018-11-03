<?php
	require_once('identifier.php');
//instancier le fichier de connexion a la bd. il existe 3 façon de se connecter a ala bd
  //  include("connexiondb.php");//copier-coller du fichier connexiondb.php
  //  require("connexiondb.php");//interpretation du fichier connexiondb.php et affiche le rt
	 require_once("connexiondb.php");//interpretation du fichier connexiondb.php et affiche le rt sans plus recompiler
  // $nomf=isset($_GET['nomF'])?($_GET['nomF']):"";  ce code joue le meme role que celui avec ? et :
   // $niveau=isset($_GET['niveau'])?($_GET['niveau']):"all";
    //recuperation des valeurs de l'url
  
if(isset($_GET['nomF']))
    	$nomf=$_GET['nomF'];
     else
     	$nomf="";
      
      if(isset($_GET['niveau']))
    	$niveau=$_GET['niveau'];
     else
     	$niveau="all";
     //test pagination
     $size=isset($_GET['size'])?($_GET['size']):6;
     $page=isset($_GET['page'])?($_GET['page']):1;
   $offset=($page-1)* $size;
    
  //requete en fonction des valeurs de l'url
	if($niveau=="all"){
		  $requete="select * from filiere 
		  			where nomFiliere like '%$nomf%' 
		  			limit $size
		  			offset $offset";
		  $reqcompte="select count(*) countF from filiere
		  				where nomFiliere like '%$nomf%' ";			
	}else{
		 $requete="select * from filiere 
	     			where nomFiliere like '%$nomf%'
	     			and niveau='$niveau'
	     			limit $size
	     			offset $offset";
	      $reqcompte="select count(*) countF from filiere
		  				where nomFiliere like '%$nomf%' 
		  				and niveau='$niveau'";	
	}
	  //executer la requete
	    $resultatF=$pdo->query($requete);
	    $resultatCount=$pdo->query($reqcompte);
	    $tab=$resultatCount->fetch();
	    $nbreFiliere=$tab['countF'];
	    $reste= $nbreFiliere % $size;
	    if ($reste===0) 
	    	$nbrePage= $nbreFiliere / $size;
	     else 
	     	$nbrePage= floor($nbreFiliere / $size)+1;//floor retourne la partie entiere d'un nombre decimal
   
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Gestion des filieres</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!--../css retour au repertoire css -->
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container"><!--container: permet d'appliquer une marge gauche et droite -->
		<div class="panel panel-success margetop">
			<div class="panel-heading">Rechercher des filières...</div>
			<div class="panel-body">
				<form method="get" action="filieres.php" class="form-inline">
					<div class="form-group">
						<input type="text" name="nomF" placeholder="Taper le nom de la filière" class="form-control" 
						value="<?php echo($nomf) ?>"/>
					</div>	
						<label for="niveau">Niveau :</label> 
						<select name="niveau" id="niveau" onchange="this.form.submit()">
							<option value="all" <?php if($niveau==="all") echo "selected" ?>>Tous les niveaux</option>
							<option value="m"   <?php if($niveau==="m") echo "selected" ?>>Master</option>
							<option value="l" 	<?php if($niveau==="l") echo "selected" ?>>Licence</option>
							<option value="ts" 	<?php if($niveau==="ts") echo "selected" ?>>Technicien Specialisé</option>
							<option value="t" 	<?php if($niveau==="t") echo "selected" ?>>Technicien</option>
							<option value="q" 	<?php if($niveau==="q") echo "selected" ?>>Qualification</option>
						</select>
						<button type="submit" class="btn btn-success">
							<span class="glyphicon glyphicon-search"></span> 
							Rechercher....
						</button>
						&nbsp &nbsp 
						<a href="nouvelleFiliere.php">
							<span class="glyphicon glyphicon-plus"></span>
					  		 Nouvelle Filière
						</a>
				</form>
			</div>
		</div>

		<div class="panel panel-primary ">
			<div class="panel-heading">Liste des filières  (<?php echo  $nbreFiliere ?> Filières)</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered"><!--table-striped: mise en forme du tableau-->
					<thead>
						<tr>
							<th>id filière</th><th>Nom filière</th><th>Niveau</th><th>Actions</th>
						</tr>
					</thead>
					<tbody>
							<?php while($filiere=$resultatF->fetch()){ ?> <!--$resultatF->fetch(): rt ds un tableau assoc-->
								<tr>
								    <td><?php echo $filiere['idFiliere']?></td>
								    <td><?php echo $filiere['nomFiliere']?></td>
								    <td><?php echo $filiere['niveau']?></td>
								    <td>
								    	<a href="editerFiliere.php?idF=<?php echo $filiere['idFiliere']?>">
								    		<span class="glyphicon glyphicon-edit"></span>
								    	</a>
								    	&nbsp &nbsp
								    	<a onClick="return confirm('êtes-vous sûre de vouloire supprimer cette filière')"
								    	 href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere']?>">
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
						 <a href="filieres.php?page= <?php echo $i ?>&nomF=<?php echo $nomf  ?>&niveau=<?php echo $niveau  ?>"><!--redirection en fct de i page les parametres nom et niveau permetent de n'avoir que la liste des filieres recherchées-->
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