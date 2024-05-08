<?php
include '../Controller/RessourcesC.php';

$error = "";

// create client
$test = null;

// create an instance of the controller
$RessourcesC = new RessourcesC();
if (isset($_POST["submit"])) {
    $IDR= $_POST['IDR'];
    $VID = $_POST['VID'];
    $IMG = $_POST['IMG'];
    $Type = $_POST['Type'];
    $DateAjout = $_POST['DateAjout'];

    $RessourcesC->AjouterRessource($IDR,$VID, $IMG, $Type, $DateAjout);
    header('Location:afficherRessource.php');
} else {
    $error = "Missing information";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var DateInput = document.getElementById("DateAjout").value;
            var today = new Date();
            var todayString = today.toISOString().slice(0,10);

            if (DateInput !== todayString) {
                alert("La date d'ajout doit être aujourd'hui.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <form action="" method="POST" onsubmit="return validateForm()">
        <a href="afficherRessource.php">Back to list </a>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
        <table>
            <tr style="display:none;">
                <td><label for="IDR">IDR :</label></td>
                <td><input type="text" id="IDR" name="IDR" value="IDR" /></td>
            </tr>
            <tr>
                <td><label for="VID">Video :</label></td>
                <td>
                    <input type="file" id="VID" name="VID" accept="video/*" />
                    <span id="erreurLien" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="IMG">Image :</label></td>
                <td>
                    <input type="file" id="IMG" name="IMG" accept="image/*" />
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
                <input name="submit" type="submit" value="save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>
    </form>
</body>
</html>
