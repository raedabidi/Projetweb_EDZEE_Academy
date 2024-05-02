<?php
include '../Model/Formation.php';
include '../Controller/FormationC.php';

$errorMessage = ""; 
$successMessage = "";

// Supprimer la formation
if(isset($_GET['IDF'])) {
    $FormationC = new FormationC();
    $IDF = $_GET['IDF'];
    $FormationC->SupprimerFormation($IDF);
    $successMessage = "Formation supprimée avec succès";
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
     <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> 
     <script src="Controle.js"></script>
     <link rel="stylesheet" href="Style.css">
    <title>Supprimer une formation</title>
</head>
<body>
    <div class="container my-5">
        <center><h1>Supprimer une Formation</h1></center>
        <hr>
        <?php if(!empty($errorMessage)) { ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php } ?>
        <?php if(!empty($successMessage)) { ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php } ?>
        <br>
        <form method="get" class="form">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <label class="col-form-label">ID de la formation à supprimer:</label>
                    <input type="text" class="form-control" name="IDF" placeholder="Entrez l'ID de la formation à supprimer">
                </div>
                <div class="col-sm-6 d-grid">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>