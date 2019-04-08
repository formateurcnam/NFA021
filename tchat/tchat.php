<?php
session_start();
echo "bienvenue " .$_SESSION['auth'];
if (isset($_POST['Envoyer'])) {
  extract($_POST);
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '' );
    date_default_timezone_set("Europe/Brussels");
    $date_msg = date('Y-m-d H:i:s');
    $pseudo = $_SESSION['auth'];
    $idcli = $_SESSION['auth'];
    $idclient = $bdd->prepare('SELECT id from client  WHERE pseudo = ?');
    $idclient->execute(array($idcli));
    $client = $idclient->fetch(PDO::FETCH_ASSOC);
    $id_client = $client['id'];
    $donnees = $bdd->prepare('INSERT INTO message VALUES(default, ?, ?, ?, ?, null)');
    $donnees->execute(array($pseudo, $date_msg, $msg, $id_client));
    $message = $bdd->query('SELECT pseudo, date_heure, libelle FROM message order by date_heure desc limit 5');


}
 catch (PDOException $e) {
    die('Erreur : ' .$e->getMessage());
 }
}
 ?>
<h1>Fenetre de discussion client</h1>
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
