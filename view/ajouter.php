<?php

include '../Controller/FormationC.php';


$error = "";

// create client
$test = null;

// create an instance of the controller
$FormationC = new FormationC();
if ( isset($_POST["submit"]) ) {
        
            
           
            $Titre=$_POST['Titre'];
            $Description=$_POST['Description'];
            $Status=$_POST['Status'];
            $Ressource=$_POST['Ressource'];
            $Prix=$_POST['Prix'];
            $Date = $_POST['Date'];
            $Lieu = $_POST['Lieu'];
            $FormationC->AjouterFormation($IDF, $Titre, $Description, $Status, $Ressource, $Prix, $Date, $Lieu);
        header('Location:afficher.php');
    }



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
   
     <script>
        function validateForm() {
            var Titre = document.getElementById("Titre").value;
            var DateInput = document.getElementById("Date").value;
            var regex = /^[a-zA-Z\s]*$/; 
            if (!Titre.trim()) {
            alert("Le titre de formation ne peut pas être vide.");
            return false;
        }

        // Vérifier si le titre ne contient que des lettres et des espaces
        if (!Titre.trim()) {
            alert("Le titre de formation ne peut pas être vide.");
            return false;
        }

        // Vérifier si le titre ne contient que des lettres et des espaces
        if (!regex.test(Titre)) {
            alert("Le titre de formation ne doit contenir que des lettres.");
            return false;
        }

        // Vérifier si le titre contient plus d'un chiffre
        if ((Titre.match(/\d/g) || []).length > 1) {
            alert("Le titre de formation ne doit contenir au maximum qu'un seul chiffre.");
            return false;
        }

        // Vérifier la redondance du titre
        var existingTitles = <?php echo json_encode($FormationC->getAllTitles()); ?>;
        if (existingTitles.includes(Titre)) {
            alert("Le titre de formation existe déjà dans le tableau.");
            return false;
        }
            
           
            var DateInput = new Date(document.getElementById("Date").value);
            var today = new Date();
            var todayString = today.toISOString().slice(0,10);

            if ( DateInput.toISOString().slice(0,10) !== todayString) {
                alert("La date d'ajout doit être aujourd'hui.");
                return false;
            }
            if ((Titre.match(/\d/g) || []).length > 1) {
            alert("Le titre de formation ne doit contenir au maximum qu'un seul chiffre.");
            return false;
        }

        // Vérifier si le titre est vide ou ne contient que des espaces
      

            return true;
        }
    </script>
</head>

<body>
    

    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

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
    <div class="main-block">
      <h1>Ajouter une formation</h1>
      <form action="/"></form>
        <table>
         
            <tr>
                <td><label for="Titre">Titre :</label></td>
                <td>
                    <input type="text" id="Titre" name="Titre" placeholder="" />
                    <span id="erreurTitre" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Description">Description:</label></td>
                <td>
                    <input type="text" id="Description" name="Description" placeholder="" />
                    <span id="erreurDescription" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Status">Status :</label></td>
                <td>
                    <input type="text" id="Status" name="Status" placeholder="Status" />
                    <span id="erreurStatus" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Ressource">Ressource :</label></td>
                <td>
                    <input type="text" id="Ressource" name="Ressource" />
                    <span id="erreurRessource" style="color: red"></span>
                    <div id="SE" class="invalid-feedback">La Ressource est invalide</div>
                </td>
            </tr>
            <tr>
                <td><label for="Prix">Prix :</label></td>
                <td>
                    <input type="number" id="Prix" name="Prix" placeholder="Prix" />
                    <span id="erreurPrix" style="color: red"></span>
                </td>
            </tr>
            <tr>
               <td><label for="Date">Date :</label></td>
            <td>
        <input type="date" id="Date" name="Date" />
        <span id="erreurDate" style="color: red"></span>
    </td>
</tr>
<tr>
    <td><label for="Lieu">Lieu :</label></td>
    <td>
        <input type="text" id="Lieu" name="Lieu" placeholder="Lieu" />
        <span id="erreurLieu" style="color: red"></span>
    </td>
</tr>

<div class="btn-block">
        
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>
        
        <p>By clicking Register, you agree on our <a href="https://www.w3docs.com/privacy-policy">Privacy Policy for W3Docs</a>.</p>
          <button type="submit" href="/">Submit</button>
          <form action="" method="POST" onsubmit="return validateForm()">
<a href="afficher.php"></a>
          <button type="submit" href="afficher.php">Back </button>
    <a href="afficher.php">Back to list </a>
        </div>
    </form>
   
</body>

</html>