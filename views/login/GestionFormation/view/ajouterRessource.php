<?php

include '../Controller/RessourcesC.php';

$error = "";

// create client
$test = null;

// create an instance of the controller
$RessourcesC = new RessourcesC();
if (isset($_POST["submit"])) {

    $Lien = $_POST['Lien'];
    $IMG = $_POST['IMG'];
    $Type = $_POST['Type'];
    $DateAjout = $_POST['DateAjout'];

    $RessourcesC->AjouterRessource($Lien, $IMG, $Type, $DateAjout);
    header('Location:afficherRessource.php');
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="afficherRessource.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <tr>
                <td><label for="Lien">Lien :</label></td>
                <td>
                    <input type="text" id="Lien" name="Lien" placeholder="" />
                    <span id="erreurLien" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="IMG">IMG :</label></td>
                <td>
                    <input type="text" id="IMG" name="IMG" placeholder="" />
                    <span id="erreurIMG" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Type">Type:</label></td>
                <td>
                    <input type="text" id="Type" name="Type" placeholder="" />
                    <span id="erreurType" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="DateAjout">Date Ajout :</label></td>
                <td>
                    <input type="date" id="DateAjout" name="DateAjout" placeholder="Date Ajout" />
                    <span id="erreurDateAjout" style="color: red"></span>
                </td>
            </tr>

            <td>
                <input name="submit" type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
 
</body>

</html>