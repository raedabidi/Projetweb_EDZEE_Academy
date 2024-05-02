<?php
include "../controller/questionC.php";

$c = new questionC();
$tab = $c->listquestion();

?>

<center>
    <h1>List of question</h1>
    <h2>
        <a href="addquestion.php">Add question</a>
    </h2>
</center>
<table border="1" align="center" widfth="70%">
    <tr>
        <th>id question</th>
        <th>question</th>
        <th>Date</th>
        <th>nbrrep</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widfth=device-widfth, initial-scale=1.0">
    <title>Afficher les question</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Liste des questiond</h1>
            <hr>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                    <table class="table table-striped">
                        
</body>
                            <?php foreach ($tab as $question) { ?>
                               
        <tr>
            <td><?= $question['id']; ?></td>
            <td><?= $question['ques']; ?></td>
            <td><?= $question['prof']; ?></td>
            <td><?= $question['nbrrep']; ?></td>
            <td><?= $question['id_test']; ?></td>
            <td align="center">
                <form method="POST" action="updatequestion.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidfden" value=<?PHP echo $question['id']; ?> name="id">
                </form>
            </td>
            <td>
                <a href="deletequestion.php?id=<?php echo $question['id']; ?>">Delete</a>
            </td>
        </tr>
    
                            <?php } ?>
                        </body>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>