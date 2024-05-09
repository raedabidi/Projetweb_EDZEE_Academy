<?php

include '../Controller/testC.php';
//include '../model/test.php';
$error = "";

// create client
$test = null;
// create an instance of the controller
$testC = new testC();


if (
    isset($_POST["id_test"]) &&
    isset($_POST["titre"]) &&
    isset($_POST["difficulte"]) &&
    isset($_POST["id_form"])
) {
    if (
        
        !empty($_POST["id_test"]) &&
        !empty($_POST["titre"]) &&
        !empty($_POST["difficulte"]) &&
        !empty($_POST["id_form"])
    ) {
        
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $test = new test(
            null,
            $_POST['id_test'],
            $_POST['titre'],
            $_POST['difficulte'],
            $_POST['id_form']
        );
        var_dump($test);

        $testC->updatetest($test, $_POST['id_test']);

        header('Location:listtest.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="listtest.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_test'])) {
        $test = $testC->showtest($_POST['id_test']);

    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="id_test">id_test :</label></td>
                    <td>
                        <input type="text" id="id_test" name="id_test" value="<?php echo $test['id_test'] ?>" />
                        <span id="erreurid_test" style="color: red"></span>
                    </td>
                </tr>
                
                <tr>
                    <td><label for="titre">titre :</label></td>
                    <td>
                        <input type="text" id="titre" name="titre" value="<?php echo $test['titre'] ?>" />
                        <span id="erreurtitre" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="difficulte">difficulte :</label></td>
                    <td>
                        <input type="text" id="difficulte" name="difficulte" value="<?php echo $test['difficulte'] ?>" />
                        <span id="erreurdifficulte" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="id_form">id_form :</label></td>
                    <td>
                        <input type="text" id="id_form" name="id_form" value="<?php echo $test['id_form'] ?>" />
                        <span id="erreurid_form" style="color: red"></span>
                    </td>
                </tr>


                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
    <script>
        function validateForm() {
            var titre = document.getElementById("titre").value;
            var difficulte = document.getElementById("difficulte").value;
            var id_form = document.getElementById("id_form").value;

            var erreurtitre = document.getElementById("erreurtitre");
            var erreurdifficulte = document.getElementById("erreurdifficulte");
            var erreurid_form = document.getElementById("erreurid_form");

            erreurtitre.innerHTML = "";
            erreurdifficulte.innerHTML = "";
            erreurid_form.innerHTML = "";

            var isValid = true;

            // Validation du champ "titre"
            if (titre === "") {
                erreurtitre.innerHTML = "Veuillez saisir un titre.";
                isValid = false;
            } else if (!/^[A-Z][a-zA-Z\s]*$/.test(titre)) {
                erreurtitre.innerHTML = "Le titre doit commencer par une majuscule.";
                isValid = false;
            }

            // Validation du champ "id_form"
            if (id_form === "") {
                erreurid_form.innerHTML = "Veuillez saisir un id_form.";
                isValid = false;
            } else if (id_form.length !== 4) {
                erreurid_form.innerHTML = "L'id_form doit avoir une longueur de 4 caractères.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>