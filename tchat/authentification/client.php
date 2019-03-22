<?php
  if (isset($_POST['connexion'])) {
    extract($_POST);
    try {
      $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
      $donnees = $bdd->prepare('SELECT count(*) FROM  client where pseudo = ?');
      $donnees->execute(array($pseudo));
      $psd = $donnees->fetch();

     if ($psd == 0) {
        session_start();
        $_SESSION['auth'] = $pseudo;
        $_SESSION['flash']['success'] = "Vous êtes bien connecté au tchat";
        header('Location: ../tchat.php');

    }else {
      die("pseudo ou mot de passe incorrect");
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
