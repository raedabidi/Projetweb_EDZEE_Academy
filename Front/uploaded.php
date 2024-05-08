<?php
// Répertoire où les fichiers sont stockés
$uploadDirectory = 'uploads/';

// Initialise un tableau pour stocker les noms de fichiers
$files = [];

// Vérifie si le répertoire existe et est accessible en lecture
if (is_dir($uploadDirectory) && is_readable($uploadDirectory)) {
    // Ouvre le répertoire
    if ($handle = opendir($uploadDirectory)) {
        // Parcourt chaque fichier dans le répertoire
        while (false !== ($entry = readdir($handle))) {
            // Exclut les fichiers système
            if ($entry != "." && $entry != "..") {
                // Ajoute le nom de fichier à la liste
                $files[] = $entry;
            }
        }
        // Ferme le gestionnaire de fichier
        closedir($handle);
    }
}

// Renvoie la liste des fichiers sous forme de JSON
echo json_encode($files);
?>