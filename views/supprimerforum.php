
<?php
include '../Model/Forum.php'; // Correction du chemin d'inclusion
include '../controller/ForumC.php'; // Correction du chemin d'inclusion

$errorMessage = "";
$successMessage = "";

// Supprimer le forum
if(isset($_GET['id_forum'])) { // Correction du nom de l'attribut
    $forumC = new ForumC(); // Correction du nom de la classe
    $id_forum = $_GET['id_forum']; // Correction du nom de l'attribut
    $forumC->deleteForum($id_forum); // Correction du nom de la méthode
    $successMessage = "Forum supprimé avec succès"; // Correction du message de succès
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Controle.js"></script>
    <link rel="stylesheet" href="Style.css">
    <title>Supprimer un forum</title> <!-- Correction du titre -->
</head>
<body>
    <div class="container my-5">
        <center><h1>Supprimer un Forum</h1></center> <!-- Correction du titre -->
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
                    <label class="col-form-label">ID du forum à supprimer:</label> <!-- Correction du texte -->
                    <input type="text" class="form-control" name="id_forum" placeholder="Entrez l'ID du forum à supprimer"> <!-- Correction du nom de l'attribut -->
                </div>
                <div class="col-sm-6 d-grid">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>