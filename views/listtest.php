<?php
include "../controller/testC.php";


$c = new testC();

// Si un terme de recherche est spécifié
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultats = $c->rechercherFormationParid($id);
} else {
    // Sinon, afficher tous les tests
    $resultats = $c->listtest();
}

// Si l'utilisateur a choisi de trier par score maximal
if (isset($_GET['tri']) && $_GET['tri'] == 'score_max') {
    $resultats = $c->trierscore_max();
}

// Si l'utilisateur a choisi de trier par durée
if (isset($_GET['tri']) && $_GET['tri'] == 'duree') {
    $resultats = $c->trierduree();
}

?>




<center>
    <h1>List of test</h1>
    <h2>
        <a href="addtest.php">Add test</a>
    </h2>

    <!-- Formulaire de recherche -->
    <form action="" method="GET">
        <input type="text" name="id" placeholder="Search by ID">
        <input type="submit" value="Search">
    </form>

    <!-- Formulaire de tri -->
    <form action="" method="GET">
        <select name="tri">
            <option value="">Sort by</option>
            <option value="score_max">Score Max</option>
            <option value="duree">Duration</option>
        </select>
        <input type="submit" value="Sort">
    </form>
    <a href="generate_pdf.php" target="_blank">Generate PDF</a>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id test</th>
        <th>score_min</th>
        <th>score_max</th>
        <th>Date</th>
        <th>duree</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($resultats as $test) { ?>
        <tr>
            <td><?= $test['id']; ?></td>
            <td><?= $test['score_min']; ?></td>
            <td><?= $test['score_max']; ?></td>
            <td><?= $test['date']; ?></td>
            <td><?= $test['duree']; ?></td>
            <td align="center">
                <form method="POST" action="updatetest.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $test['id']; ?> name="id">
                </form>
            </td>
            <td>
                <a href="deletetest.php?id=<?php echo $test['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
