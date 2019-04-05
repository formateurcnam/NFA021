<?php
session_start();
echo "Bienvenue " .$_SESSION['prenom'] .' ' .$_SESSION['nom'];
if (isset($_POST['Envoyer'])) {
  extract($_POST);
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
    $date_msg = date('Y-m-d');
    $idcon = $_SESSION['nom'];
    $idcons = $bdd->prepare('SELECT id from conseiller  WHERE nom = ?');
    $idcons->execute(array($idcon));
    $conseiller = $idcons->fetch(PDO::FETCH_ASSOC);
    $id_conseiller = $conseiller['id'];
    $donnees = $bdd->prepare('INSERT INTO message VALUES(default, ?, ?, null, ?)');
    $donnees->execute(array($date_msg, $msg, $id_conseiller));
}
 catch (PDOException $e) {
    die('Erreur : ' .$e->getMessage());
 }
}
 ?>
<h1>Fenetre de discussion conseiller</h1>
<form action="" method="post">
  <input type="text" name="msg">
  <input type="submit" name="Envoyer">
</form>
