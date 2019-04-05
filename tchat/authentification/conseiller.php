<?php
session_start();
  if (isset($_POST['connexion'])) {
    extract($_POST);
    try {
      $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
      $donnees = $bdd->prepare('SELECT nom, prenom, mdp FROM  conseiller where nom = ? and prenom = ? and mdp = ?');
      $mdp = sha1($mdp);
      $donnees->execute(array($nom, $prenom, $mdp));

      if ($donnees->rowCount() == 1) {
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
      header('Location: ../tchat_conseiller.php');

    }else {
      header('Location: ../inscription/conseiller.php');
    }
  }
   catch (PDOException $e) {
      die('Erreur : ' .$e->getMessage());
   }
 }

?>

<h1>Authentification - Conseiller </h1>
<form action="" method="post">
  <input type="text" name="nom" placeholder="Votre nom"><br>
  <input type="text" name="prenom" placeholder="Votre prenom"><br>
  <input type="password" name="mdp" placeholder="Votre mot de passe"><br><br>
  <a href="../inscription/conseiller.php">Pas encore inscrit ?</a><br><br>
  <input type="submit" name="connexion" value="Se connecter >">
</form>
