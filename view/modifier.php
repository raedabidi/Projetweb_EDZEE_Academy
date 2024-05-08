<?php
include '../Controller/FormationC.php';
$error = "";

// Créer une instance du contrôleur
$FormationC = new FormationC();

if (
    isset($_POST["IDF"]) &&
    isset($_POST["Titre"]) &&
    isset($_POST["Description"]) &&
    isset($_POST["Ressource"]) &&
    isset($_POST["Status"]) &&
    isset($_POST["Prix"])&&
    isset($_POST["Date"]) &&
    isset($_POST["Lieu"]) 
) {
    if (
        !empty($_POST['IDF']) &&
        !empty($_POST['Titre']) &&
        !empty($_POST["Description"]) &&
        !empty($_POST["Ressource"]) &&
        !empty($_POST["Status"]) &&
        !empty($_POST["Prix"])&&
        !empty($_POST["Date"])&&
        !empty($_POST["Lieu"])
    ) {
        $IDF = $_POST['IDF'];
        $Titre = $_POST['Titre'];
        $Description = $_POST['Description'];
        $Ressource = $_POST['Ressource'];
        $Status = $_POST['Status'];
        $Prix = $_POST['Prix'];
        $Date = $_POST['Date'];
        $Lieu = $_POST['Lieu'];

        // Créer un nouvel objet formation
        $formation = new formation($IDF, $Titre, $Description, $Ressource, $Status, $Prix, $Date, $Lieu);

        // Mettre à jour l'enregistrement en utilisant la méthode formationC
        $FormationC->ModifierFormation($formation, $IDF);

        // Rediriger vers index.php après la mise à jour réussie
        header('Location: afficher.php');
        exit();
    } else {
        $error = "Informations manquantes";
    }
}

// S'il y a une erreur, il est préférable de la gérer et éventuellement de l'afficher à l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <a href="page aceuill0.php" class="back_btn"><img src="back.png"> Retour</a>
        <h2>Modifier une formation</h2>
        <p class="erreur_message">
            <?php 
            // Afficher le message d'erreur s'il y a une erreur
            echo $error;
            ?>
        </p>
     
        <form action="" method="POST">
        <style>
      html, body {
      display: flex;
      justify-content: center;
      height: 100%;
      }
      body, div, h1, form, input, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #666;
      }
      h1 {
      padding: 10px 0;
      font-size: 32px;
      font-weight: 300;
      text-align: center;
      }
      p {
      font-size: 12px;
      }
      hr {
      color: #a9a9a9;
      opacity: 0.3;
      }
      .main-block {
      max-width: 800px; 
      min-height: 460px; 
      padding: 10px 0;
      margin: auto;
      border-radius: 5px; 
      border: solid 1px #ccc;
      box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
      background: #ebebeb; 
      }
      form {
      margin: 0 30px;
      }
      .account-type, .gender {
      margin: 15px 0;
      }
      input[type=radio] {
      display: none;
      }
      label#icon {
      margin: 0;
      border-radius: 5px 0 0 5px;
      }
      label.radio {
      position: relative;
      display: inline-block;
      padding-top: 10px;
      margin-right: 20px;
      text-indent: 30px;
      overflow: visible;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 9px;
      height: 4px;
      top: 8px;
      left: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      input[type=text], input[type=password] {
      width: calc(100% - 57px);
      height: 36px;
      margin: 13px 0 0 -5px;
      padding-left: 10px; 
      border-radius: 0 5px 5px 0;
      border: solid 1px #cbc9c9; 
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #fff; 
      }
      input[type=password] {
      margin-bottom: 15px;
      }
      #icon {
      display: inline-block;
      padding: 9.3px 15px;
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #1c87c9;
      color: #fff;
      text-align: center;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 100%;
      padding: 10px 0;
      margin: 10px auto;
      border-radius: 5px; 
      border: none;
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #26a9e0;
      }
    </style>
            <label>ID Formation</label>
            <input type="text" name="IDF" value="<?php echo isset($_POST['IDF']) ? $_POST['IDF'] : ''; ?>" placeholder="ID Formation" required="">
            <label>Titre</label>
            <input type="text" name="Titre" value="<?php echo isset($_POST['Titre']) ? $_POST['Titre'] : ''; ?>" placeholder="Titre" required="">
            <label>Description</label>
            <input type="text" name="Description" value="<?php echo isset($_POST['Description']) ? $_POST['Description'] : ''; ?>" placeholder="Description" required="">
            <label>Ressource</label>
            <input type="text" name="Ressource" value="<?php echo isset($_POST['Ressource']) ? $_POST['Ressource'] : ''; ?>" placeholder="Ressource" required="">
            <label>Status</label>
            <input type="text" name="Status" value="<?php echo isset($_POST['Status']) ? $_POST['Status'] : ''; ?>" placeholder="Status" required="">
            <label>Prix</label>
            <input type="number" name="Prix" value="<?php echo isset($_POST['Prix']) ? $_POST['Prix'] : ''; ?>" placeholder="Prix" required="">
            <label>Date</label>
            <input type="date" name="Date" value="<?php echo isset($_POST['Date']) ? $_POST['Date'] : ''; ?>" placeholder="Date" required="">
            <label>Lieu</label>
            <input type="text" name="Lieu" value="<?php echo isset($_POST['Lieu']) ? $_POST['Lieu'] : ''; ?>" placeholder="Lieu" required="">
            <input type="submit" value="Modifier" name="button">
           
        </form>
    </div>
</body>
</html>