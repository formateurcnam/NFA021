<?php
if (isset($_POST['envoyer'])) {
  extract($_POST);
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
    $donnees = $bdd->prepare('INSERT INTO conseiller VALUES(defauLt, ?, ?, ?,?)');
    $psw = password_hash($mdp, PASSWORD_BCRYPT);
    if ($mdp == $mdp2) {
      $donnees->execute(array($nom, $prenom,   $mail,$psw));
      echo "Votre compte  à bien été créé";
      header('Location: ../authentification/conseiller.php');
    }else {
      echo "mot de passe non valide";
    }

    }

 catch (PDOException $e) {
    die('Erreur : ' .$e->getMessage());
 }
}
?>
<h1>Conseiller</h1>
<form action="" method="post">
     <input type="text" name="nom" placeholder="Nom" required> <br/>
     <input type="text" name="prenom" placeholder="Prénom" required> <br/>
     <input type="email" name="mail" placeholder="Mail" required> <br/>
     <input type="password" name="mdp" placeholder="Mot de passe" required><br>
     <input type="password" name="mdp2" placeholder="Confirmation mot de passe" required><br><br>
     <input type="submit" name="envoyer" value="Envoyer >">
</form>
