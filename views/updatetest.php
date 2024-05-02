
<?php

include '../Controller/testC.php';
//include '../model/test.php';
$error = "";

// create client


$c= new testC();


if (isset($_GET['id']))
 {
    
        $Id = $_GET['id'];
        $tab = $c->selectrec($Id);
        if($tab) {
            $id = $tab['id'];
            $nomp = $tab['nom_prenom'];
            $type = $tab['type_reclamation'];
            $desc = $tab['descrip'];
            $date = $tab['date_reclamation'];
    
        }
       

        
    } 
    else
    $error = "Missing information";




?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
<a href="listtest.php" class="button-link">Back to list</a>
   

    <div id="error">
        <?php echo $error; ?>
    </div>

    
        <form action="codeupdate.php" method="POST">
            <table>
               
                <tr>
                    <td><label for="nom_prenom">Nom Prenom :</label></td>
                    <td>
                        <input type="text" id="nom_prenom" name="nom_prenom" value="<?php echo $nomp;?>" />
                        <span id="erreur" style="color: red"></span>
                    </td>
                </tr>
                
                <tr>
                    <td><label for="type">Type :</label></td>
                    <td>
                        <input type="text" id="type_reclamation" name="type_reclamation" value="<?php echo $type ; ?>" />
                        <span id="erreur" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Description :</label></td>
                    <td>
                        <input type="text" id="descrip" name="descrip" value="<?php echo $desc ?>" />
                        <span id="erreurdate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_reclamation">duree :</label></td>
                    <td>
                        <input type="text" id="date_reclamation" name="date_reclamation" value="<?php echo $date ?>" />
                        <span id="erreurduree" style="color: red"></span>
                    </td>
                </tr>


                <td>
                    <input type="submit" name ="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
        <style>
form {
  display: flex;
  flex-direction: column;
  width: 400px;
  margin: 150px auto; /* Ajustez la marge selon vos besoins */
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 4px;
  background-color: #f1f1f1;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ajout d'une ombre */
}

.form-label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: #333;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 10px;
  color: #555;
}

input[type="text"],
input[type="submit"],
input[type="reset"] {
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: box-shadow 0.3s ease;
}

input[type="text"]:hover {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.button-link {
  display: inline-block;
  background-color: #2bc48a;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  text-decoration: none;
  font-weight: bold;
  cursor: pointer;
}

.button-link:hover {
    background-color: #1e8d5a;
}

input[type="submit"],
input[type="reset"] {
  background-color: #2bc48a;
  color: #fff;
  border: none;
  cursor: pointer;
  padding: 10px 20px;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #1e8d5a;
}

span {
  color: red;
}
</body>

</html>