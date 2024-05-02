<?php

include '../Controller/testC.php';


$error = "";

// create client
$test = null;

// create an instance of the controller
$testC = new testC();
if (
   
    isset($_POST["nom_prenom"]) &&
    isset($_POST["type_reclamation"]) &&
    isset($_POST["descrip"]) 
) {
    if (
       
        !empty($_POST['nom_prenom']) &&
        !empty($_POST["type_reclamation"]) &&
        !empty($_POST["descrip"])
    ) {
        $test = new test(
            null,
            $_POST['nom_prenom'],
            $_POST['type_reclamation'],
            $_POST['descrip'],
            date('Y-m-d H:i:s') // Format AAAA-MM-JJ HH:MM:SS
        );
        
        $testC->addtest($test);
        header('Location:listtest.php');
    } else
        $error = "Missing information";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="form">
        
        <h2 class="title">Ajouter une Reclamation</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <form action="" method="POST">
  <label class="form-label">Nom Prenom</label>
  <input type="text" name="nom_prenom" id="nom" class="form-input" placeholder="Nom" required onblur="validateNom(this.value)">
  <div id="nomError" class="form-error"></div>

  <label class="form-label">Type reclamation</label>
  <select name="type_reclamation" class="form-select" required>
    <option value="">Sélectionner un type</option>
    <option value="panne Technique">Panne Technique</option>
    <option value="Probleme inscription">Problème d'inscription</option>
    <option value="Autre Probleme">Autre Problème</option>
  </select>

  <label class="form-label">Description</label>
  <input type="text" name="descrip" id="descrip" class="form-input" placeholder="" required>
  <div id="descripError" class="form-error"></div>
  <input class=form-button type="submit" value="Ajouter" name="button">
</form>
<script>
    function validateDescription(description) {
        var descriptionError = document.getElementById("descripError");
        if (/^\d/.test(description)) {
            descriptionError.textContent = "La description ne peut pas commencer par un chiffre.";
            return false;
        } else if (description.length > 1000) {
            descriptionError.textContent = "La description ne peut pas dépasser 1000 caractères.";
            return false;
        } else {
            descriptionError.textContent = "";
            return true;
        }
    }

    var descriptionInput = document.getElementById("descrip");
    descriptionInput.addEventListener("input", function() {
        validateDescription(this.value);
    });
</script>

            
           
            
    </div>
    <script>
    function validateNom(nom) {
        var nomRegex = /^[a-zA-Z\s]+$/;
        var nomError = document.getElementById("nomError");
        if (nom.length > 3 && nomRegex.test(nom)) {
            nomError.textContent = "";
            return true;
        } else {
            nomError.textContent = "Le nom doit contenir au moins 4 lettres et ne doit contenir que des lettres et des espaces.";
            return false;
        }
    }
</script>
<style>
  .form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
  }

  .form-input {
    display: block;
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
  }

  .form-input:hover {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .form-select {
    display: block;
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
  }

  .form-select:hover {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .form-error {
    color: red;
  }

  .form-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 40px;
    transition: background-color 0.3s ease;
  }

  .form-button:hover {
    background-color: #0056b3;
  }
 
  .title {
    font-size: 24px;
    color: var(--title-color);
    margin-bottom: 20px;
    text-align: center;
    text-transform: uppercase;
    background-color: var(--title-background-color);
    padding: 10px;
    border-radius: 4px;
  }

</style>
</body>
</html>