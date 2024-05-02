<?php

include '../Controller/questionC.php';
//include '../model/question.php';
$error = "";

// create client
$question = null;
// create an instance of the controller
$questionC = new questionC();


if (
    isset($_POST["ques"]) &&
    isset($_POST["prof"]) &&
    isset($_POST["nbrrep"]) &&
    isset($_POST["datecre"]) &&
    isset($_POST["id_test"])
) {
    if (
        
        !empty($_POST["ques"]) &&
        !empty($_POST["prof"]) &&
        !empty($_POST["nbrrep"]) &&
        !empty($_POST["datecre"]) &&
        !empty($_POST["id_test"])
    ) {
        
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $question = new question(
            null,
            $_POST['ques'],
            $_POST['prof'],
            $_POST['nbrrep'],
            $_POST['datecre']
            $_POST['id_test']
        );
        var_dump($question);

        $questionC->upnbrrepquestion($question, $_POST['id']);

        header('Location:listquestion.php');
    } else
        $error = "Missing inquestion";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="listquestion.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $question = $questionC->showquestion($_POST['id']);

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
                    <td><label for="nom">question :</label></td>
                    <td>
                        <input type="text" id="question" name="question" value="<?php echo $question['ques'] ?>" />
                        <span id="erreurquestion" style="color: red"></span>
                    </td>
                </tr>
                
                <tr>
                    <td><label for="prof">prof :</label></td>
                    <td>
                        <input type="text" id="prof" name="prof" value="<?php echo $question['prof'] ?>" />
                        <span id="erreurprof" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nbrrep">nbrrep :</label></td>
                    <td>
                        <input type="text" id="nbrrep" name="nbrrep" value="<?php echo $question['nbrrep'] ?>" />
                        <span id="erreurnbrrep" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="datecre">datecre :</label></td>
                    <td>
                        <input type="date" id="datecre" name="datecre" value="<?php echo $question['datecre'] ?>" />
                        <span id="erreurressources" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="datecre">id_test :</label></td>
                    <td>
                        <input type="text" id="datecre" name="datecre" value="<?php echo $question['id_test'] ?>" />
                        <span id="erreurressources" style="color: red"></span>
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