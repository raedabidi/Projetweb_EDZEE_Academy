<?php
// Inclure le fichier de configuration de la base de données et initialiser la connexion
require_once '../config.php';

// Vérifier si l'ID du commentaire est défini dans la requête POST
if (isset($_POST['commentId'])) {
    $commentId = $_POST['commentId'];

    // Écrire la requête SQL pour mettre à jour la colonne "like_dislike" à -1 pour le commentaire donné
    $sql = "UPDATE comms SET like_dislike = like_dislike - 1 WHERE id_commentaire = :commentId";

    // Préparer la requête
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo 'Disliked!';
    } else {
        echo 'Error: Unable to dislike the comment.';
    }
} else {
    echo 'Error: No comment ID provided.';
}
?>
