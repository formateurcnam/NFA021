<?php
session_start();
  if (isset($_POST['connexion'])) {
    extract($_POST);
    try {
      $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
      $donnees = $bdd->prepare('SELECT pseudo, mdp FROM  client where pseudo = ? and mdp = ?');
      $mdp = sha1($mdp);
      $donnees->execute(array($pseudo, $mdp));

      if ($donnees->rowCount() == 1) { 
        $_SESSION['auth'] = $pseudo;
      header('Location: ../tchat.php');

    }else {
      header('Location: ../inscription/client.php');
    }
  }
   catch (PDOException $e) {
      die('Erreur : ' .$e->getMessage());
   }
 }

?>

<h1>Authentification - Client </h1>
<form action="" method="post">
  <input type="text" name="pseudo" placeholder="Votre pseudo"><br>
  <input type="password" name="mdp" placeholder="Votre mot de passe"><br><br>
  <a href="../inscription/client.php">Pas encore inscrit ?</a><br><br>
  <input type="submit" name="connexion" value="Se connecter >">
</form>
JJ
