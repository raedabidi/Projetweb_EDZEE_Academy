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
