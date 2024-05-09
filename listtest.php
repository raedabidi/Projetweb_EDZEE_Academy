<?php
include "../controller/testC.php";

$c = new testC();

// Récupérer la valeur de tri
$tri = isset($_GET['tri']) ? $_GET['tri'] : '';

// Récupérer la valeur de recherche
$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

// Récupérer la liste des tests selon le critère de tri ou la chaîne de recherche
if (!empty($recherche)) {
    // Effectuer la recherche
    $tab = $c->rechercherTest($recherche);
} elseif (!empty($tri)) {
    // Tri selon le critère sélectionné
    $tab = $c->trierTests($tri);
} else {
    // Par défaut, afficher tous les tests
    $tab = $c->listtest();
}
?>

<center>
    <h1>List of test</h1>
    <h2><a href="addtest.php">Add test</a></h2>
    <form action="" method="GET">
        <select name="tri">
            <option value="">Sort by</option>
            <option value="id_form">id_form</option>
            <option value="id_test">id_test</option>
        </select>
        <input type="submit" value="Sort">
    </form>
    <form action="" method="POST">
        <input type="text" name="recherche" placeholder="Search by id_test">
        <input type="submit" value="Search">
    </form>
</center>

<table border="1" align="center" width="70%">
    <tr>
        <th>Id test</th>
        <th>titre</th>
        <th>difficulte</th>
        <th>id_form</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php
    foreach ($tab as $test) {
    ?>
        <tr>
            <td><?= $test['id_test']; ?></td>
            <td><?= $test['titre']; ?></td>
            <td><?= $test['difficulte']; ?></td>
            <td><?= $test['id_form']; ?></td>
            <td align="center">
                <form method="POST" action="updatetest.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?= $test['id_test']; ?> name="id_test">
                </form>
            </td>
            <td>
                <a href="deletetest.php?id_test=<?= $test['id_test']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
    
</table>
