<?php

include '../Controller/testC.php';
//include '../model/test.php';
$error = "";

// create client
$test = null;
// create an instance of the controller
$testC = new testC();


if (
    isset($_POST["score_min"]) &&
    isset($_POST["score_max"]) &&
    isset($_POST["date"]) &&
    isset($_POST["duree"])
) {
    if (
        
        !empty($_POST["score_min"]) &&
        !empty($_POST["score_max"]) &&
        !empty($_POST["date"]) &&
        !empty($_POST["duree"])
    ) {
        
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $test = new test(
            null,
            $_POST['score_min'],
            $_POST['score_max'],
            $_POST['date'],
            $_POST['duree']
        );
        var_dump($test);

        $testC->updatetest($test, $_POST['id']);

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
    if (isset($_POST['id'])) {
        $test = $testC->showtest($_POST['id']);

    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="id">Id :</label></td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurid" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">score_min :</label></td>
                    <td>
                        <input type="text" id="score_min" name="score_min" value="<?php echo $test['score_min'] ?>" />
                        <span id="erreurscore_min" style="color: red"></span>
                    </td>
                </tr>
                
                <tr>
                    <td><label for="score_max">score_max :</label></td>
                    <td>
                        <input type="text" id="score_max" name="score_max" value="<?php echo $test['score_max'] ?>" />
                        <span id="erreurscore_max" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date">Date :</label></td>
                    <td>
                        <input type="text" id="date" name="date" value="<?php echo $test['date'] ?>" />
                        <span id="erreurdate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="duree">duree :</label></td>
                    <td>
                        <input type="text" id="duree" name="duree" value="<?php echo $test['duree'] ?>" />
                        <span id="erreurduree" style="color: red"></span>
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
</body>

</html>