<?php

include '../Controller/FormationC.php';


$error = "";

// create client
$test = null;

// create an instance of the controller
$FormationC = new FormationC();
if ( isset($_POST["submit"]) ) {
        
            
            $IDF=$_POST['IDF'];
            $Titre=$_POST['Titre'];
            $Description=$_POST['Description'];
            $Status=$_POST['Status'];
            $Ressource=$_POST['Ressource'];
            $Prix=$_POST['Prix'];
            $Date = $_POST['Date'];
            $Lieu = $_POST['Lieu'];
            $FormationC->AjouterFormation($IDF, $Titre, $Description, $Status, $Ressource, $Prix, $Date, $Lieu);
        header('Location:afficher.php');
    } else
        $error = "Missing information";



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style1.css">
    <script>
        
        function validateForm() {
            var Titre = document.formation["formation"]["Titre"].value;
           
            var regex = /^[a-zA-Z\s]*$/; 
            if (!regex.test(Titre)) {
                alert("Le titre de formation ne doit contenir que des lettres.");
                return false;
            }

           

            return true; 
        }
    </script>
</head>

<body>
<form action="" method="POST" onsubmit="return validateForm()">
    <a href="afficher.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
        <tr>
                <td><label for="IDF">IDF :</label></td>
                <td>
                    <input type="text" id="IDF" name="IDF" placeholder="" />
                    <span id="erreurIDF" style="color: red"></span>
                </td>
            </tr>
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

            <td>
                <input name="submit"type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
    <script>
        function validateForm() {
            var Titre = document.getElementById("Titre").value;
           
            if (Titre.trim() === '' ) {
                alert("Veuillez remplir tous les champs.");
                return false;
            }
            var letters = /^[A-Za-z\s]+$/;
            if (!Titre.match(letters) ) {
                alert("Le champ 'Titre' doit contenir uniquement des lettres et des espaces.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>