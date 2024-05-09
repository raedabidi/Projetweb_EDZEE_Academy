<?php
include "../controller/questionC.php";

$c = new questionC();

// Récupérer la valeur de tri
$tri = isset($_GET['tri']) ? $_GET['tri'] : '';

// Récupérer la valeur de recherche
$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

// Récupérer la liste des questions selon le critère de tri ou la chaîne de recherche
if (!empty($recherche)) {
    // Effectuer la recherche
    $tab = $c->rechercherQuestion($recherche);
} elseif (!empty($tri)) {
    // Tri selon le critère sélectionné
    $tab = $c->trierQuestions($tri);
} else {
    // Par défaut, afficher toutes les questions
    $tab = $c->listquestion();
}

if (isset($_GET['export']) && $_GET['export'] == 'pdf') {
    $c->exportPDF();
    exit(); // Arrêtez le script après avoir téléchargé le PDF
}
?>

<center>
    <h1>List of question</h1>
    <h2><a href="addquestion.php">Add question</a></h2>
    <h2><a href="?export=pdf">Export to PDF</a></h2>
    <form action="" method="GET">
        <select name="tri">
            <option value="">Sort by</option>
            <option value="idtest">idtest</option>
            <option value="id_question">id_question</option>
        </select>
        <input type="submit" value="Sort">
    </form>
    <form action="" method="POST">
        <input type="text" name="recherche" placeholder="Search by id_question">
        <input type="submit" value="Search">
    </form>
</center>

<table border="1" align="center" width="70%">
    <tr>
        <th>Id question</th>
        <th>quest</th>
        <th>datecreation</th>
        <th>idtest</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php
    foreach ($tab as $question) {
    ?>
        <tr>
            <td><?= $question['id_question']; ?></td>
            <td><?= $question['quest']; ?></td>
            <td><?= $question['datecreation']; ?></td>
            <td><?= $question['idtest']; ?></td>
            <td align="center">
                <form method="POST" action="updatequestion.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?= $question['id_question']; ?> name="id_question">
                </form>
            </td>
            <td>
                <a href="deletequestion.php?id_question=<?= $question['id_question']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
