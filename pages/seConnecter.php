<?php 
    session_start();//obligatoire lorqu'on demarre avec les sessions

     require_once('connexiondb.php');
    
     $login=isset($_POST['login'])?$_POST['login']:"";
     $pwd=isset($_POST['pwd'])?$_POST['pwd']:"";
    
    
     $requete=" select * from utilisateur where login='$login'and pwd=MD5('$pwd')";
     $resultat=$pdo->query($requete);
    //test si l'user existe
     if($user=$resultat->fetch()){
         if($user['etat']==1){
             $_SESSION['user']=$user;//crée la session
              header('location:../index.php'); //ouverture d'une session
              }else{
                $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Votre compte est désactivé.<br> Veuillez contacter l'administrateur";
                header('location:login.php');
              }
        }else{
            $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Login ou Mot de passe incorrect!!!";
            header('location:login.php');
        }
?>