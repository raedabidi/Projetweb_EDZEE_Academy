<?php
include '../Model/Ressource.php';
include '../Controller/RessourcesC.php';

$errorMessage = ""; 
$successMessage = "";

// Supprimer la ressource
if(isset($_GET['IDR'])) {
    $RessourcesC = new RessourcesC();
    $IDR = $_GET['IDR'];
    $RessourcesC->SupprimerRessource($IDR);
    $successMessage = "Ressource supprimée avec succès";
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
     <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> 
     <script src="Controle.js"></script>
     <link rel="stylesheet" href="style.css">
    <title>Supprimer une ressource</title>
</head>
<body>
    <div class="container my-5">
        <center><h1>Supprimer une Ressource</h1></center>
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
                    <label class="col-form-label">ID de la ressource à supprimer:</label>
                    <input type="text" class="form-control" name="IDR" placeholder="Entrez l'ID de la ressource à supprimer">
                </div>
                <div class="col-sm-6 d-grid">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>