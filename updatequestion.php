<?php

include '../Controller/questionC.php';
//include '../model/question.php';
$error = "";

// create client
$question = null;
// create an instance of the controller
$questionC = new questionC();


if (
    isset($_POST["id_question"]) &&
    isset($_POST["quest"]) &&
    isset($_POST["datecreation"]) &&
    isset($_POST["idtest"])
) {
    if (
        
        !empty($_POST["id_question"]) &&
        !empty($_POST["quest"]) &&
        !empty($_POST["datecreation"]) &&
        !empty($_POST["idtest"])
    ) {
        
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $question = new question(
            null,
            $_POST['id_question'],
            $_POST['quest'],
            $_POST['datecreation'],
            $_POST['idtest']
        );
        var_dump($question);

        $questionC->updatequestion($question, $_POST['id_question']);

        header('Location:listquestion.php');
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
    <button><a href="listquestion.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_question'])) {
        $question = $questionC->showquestion($_POST['id_question']);

    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="id_question">id_question :</label></td>
                    <td>
                        <input type="text" id="id_question" name="id_question" value="<?php echo $question['id_question'] ?>" />
                        <span id="erreurid_question" style="color: red"></span>
                    </td>
                </tr>
                
                <tr>
                    <td><label for="quest">quest :</label></td>
                    <td>
                        <input type="text" id="quest" name="quest" value="<?php echo $question['quest'] ?>" />
                        <span id="erreurquest" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="datecreation">datecreation :</label></td>
                    <td>
                        <input type="date" id="datecreation" name="datecreation" value="<?php echo $question['datecreation'] ?>" />
                        <span id="erreurdatecreation" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="idtest">idtest :</label></td>
                    <td>
                        <input type="text" id="idtest" name="idtest" value="<?php echo $question['idtest'] ?>" />
                        <span id="erreuridtest" style="color: red"></span>
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