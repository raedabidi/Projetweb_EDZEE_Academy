<?php

require '../config.php';

class ForumC
{

    public function listforum($orderBy) {
        $sql = "SELECT * FROM forum ORDER BY titre_forum $orderBy";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    function deleteforum($ide)
    {
        $sql = "DELETE FROM forum WHERE id_forum = :id_forum";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_forum', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addforum($forum)
    {
        $sql = "INSERT INTO forum (titre_forum, date_forum, matiere_forum, desc_forum)  
                VALUES (:titre_forum, CURRENT_TIMESTAMP(), :matiere_forum, :desc_forum)"; // Ajout de la colonne desc_forum
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre_forum' => $forum->gettitre_forum(),
                'matiere_forum' => $forum->getmatiere_forum(),
                'desc_forum' => $forum->getdesc_forum(), // Ajout de la valeur de la description
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showforum($id_forum)
    {
        $sql = "SELECT * from forum where id_forum = $id_forum";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $forum = $query->fetch();
            return $forum;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateforum($forum, $id_forum)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE forum SET 
                    titre_forum = :titre_forum, 
                    date_forum = :date_forum, 
                    matiere_forum = :matiere_forum,
                    desc_forum = :desc_forum
                WHERE id_forum = :id_forum'
            );

            // Récupérer la date actuelle
            $date_forum = date("Y-m-d"); // Format: Année-Mois-Jour

            $query->execute([
                'id_forum' => $id_forum,
                'titre_forum' => $forum->gettitre_forum(),
                'date_forum' => $date_forum, // Utilisation de la date actuelle
                'matiere_forum' => $forum->getmatiere_forum(),
                'desc_forum' => $forum->getdesc_forum(), // Ajout de la description
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage(); // Affichage du message d'erreur pour le débogage
        }
    }

    public function searchForumByMatiere($matiere) {
        $sql = "SELECT * FROM forum WHERE matiere_forum LIKE :matiere";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':matiere', '%' . $matiere . '%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Nouvelle méthode pour rechercher par description
    public function searchForumByDesc($desc) {
        $sql = "SELECT * FROM forum WHERE desc_forum LIKE :desc_forum";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':desc_forum', '%' . $desc . '%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getMatiereStatistics() {
        $sql = "SELECT matiere_forum, COUNT(*) AS count FROM forum GROUP BY matiere_forum";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $statistics = $query->fetchAll(PDO::FETCH_ASSOC);
            return $statistics;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    

}
?>