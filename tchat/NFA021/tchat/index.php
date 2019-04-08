<?php

    if (isset($_POST['client'])) {
    header("Location: authentification/client.php");
  }
  if (isset($_POST['conseiller'])) {
    header("Location: authentification/conseiller.php");
  }

 ?>



<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TCHAT</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <form action="index.php" method="post">

        <fieldset>
          <legend>Vous êtes :</legend>
          <input type="submit" name="client" value="Client"><br>
          <input type="submit" name="conseiller" value="Conseiller">
        </fieldset>
    </form>
  </body>
</html>
