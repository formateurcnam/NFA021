<?php
session_start();
echo "Bienvenue " .$_SESSION['prenom'] .' ' .$_SESSION['nom'];
if (isset($_POST['Envoyer'])) {
  extract($_POST);
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
    date_default_timezone_set("Europe/Brussels");
    $date_msg = date('Y-m-d H:i:s');
    $pseudo = $_SESSION['prenom'];
    $idcon = $_SESSION['nom'];
    $idcons = $bdd->prepare('SELECT id from conseiller  WHERE nom = ?');
    $idcons->execute(array($idcon));
    $conseiller = $idcons->fetch(PDO::FETCH_ASSOC);
    $id_conseiller = $conseiller['id'];
    $donnees = $bdd->prepare('INSERT INTO message VALUES(default, ?, ?, ?, null, ?)');
    $donnees->execute(array($pseudo, $date_msg, $msg, $id_conseiller));
    $message = $bdd->query('SELECT pseudo, date_heure, libelle FROM message order by date_heure desc limit 5');
}
 catch (PDOException $e) {
    die('Erreur : ' .$e->getMessage());
 }
}
 ?>
<h1>Fenetre de discussion conseiller</h1>
<?php
  while (isset($_POST['Envoyer']) and $donnees = $message->fetch(PDO::FETCH_ASSOC)) {
    echo $donnees['date_heure'] ." " ."<strong>" .$donnees['pseudo'] ."</strong>"." : " .$donnees['libelle'] ."</br>";


  }
 ?>
 <hr>
<form action="" method="post">
  <input type="text" name="msg">
  <input type="submit" name="Envoyer">
</form>
