<?php

require '../config.php';

class CommsC
{

    public function listComments($orderBy) {
        $sql = "SELECT * FROM comms ORDER BY titre_commentaire $orderBy";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    function deleteComment($id_commentaire)
    {
        $sql = "DELETE FROM comms WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_commentaire', $id_commentaire);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addComment($comment)
    {
        $sql = "INSERT INTO comms (id_forum, titre_commentaire, date_commentaire, commentaire)  
                VALUES (:id_forum, :titre_commentaire, CURRENT_TIMESTAMP(), :commentaire)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_forum' => $comment->getid_forum(),
                'titre_commentaire' => $comment->gettitre_commentaire(),
                'commentaire' => $comment->getcommentaire(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showComment($id_commentaire)
    {
        $sql = "SELECT * FROM comms WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_commentaire', $id_commentaire);
            $query->execute();
            $comment = $query->fetch();
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateComment($comment, $id_commentaire)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE comms SET 
                    id_forum = :id_forum,
                    titre_commentaire = :titre_commentaire, 
                    date_commentaire = CURRENT_TIMESTAMP(), 
                    commentaire = :commentaire
                WHERE id_commentaire = :id_commentaire'
            );

            $query->execute([
                'id_commentaire' => $id_commentaire,
                'id_forum' => $comment->getid_forum(),
                'titre_commentaire' => $comment->gettitre_commentaire(),
                'commentaire' => $comment->getcommentaire(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage(); 
        }
    }

    public function searchCommentByTitle($title) {
        $sql = "SELECT * FROM comms WHERE titre_commentaire LIKE :titre_commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':titre_commentaire', '%' . $title . '%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function searchCommentByDate($date) {
        $sql = "SELECT * FROM comms WHERE date_commentaire = :date_commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':date_commentaire', $date);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Nouvelle méthode pour rechercher par contenu de commentaire
    public function searchCommentByContent($content) {
        $sql = "SELECT * FROM comms WHERE commentaire LIKE :commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':commentaire', '%' . $content . '%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Méthode pour ajouter un like à un commentaire
    function addLike($id_commentaire)
    {
        $sql = "UPDATE comms SET like_dislike = like_dislike + 1 WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_commentaire', $id_commentaire);

        try {
            $req->execute();
            // Retourner le nombre total de likes/dislikes après l'ajout
            echo $this->getLikeDislikeCount($id_commentaire);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Méthode pour ajouter un dislike à un commentaire
    function addDislike($id_commentaire)
    {
        $sql = "UPDATE comms SET like_dislike = like_dislike - 1 WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_commentaire', $id_commentaire);

        try {
            $req->execute();
            // Retourner le nombre total de likes/dislikes après l'ajout
            echo $this->getLikeDislikeCount($id_commentaire);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Méthode pour obtenir le nombre total de likes/dislikes pour un commentaire
    function getLikeDislikeCount($id_commentaire)
    {
        $sql = "SELECT like_dislike FROM comms WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_commentaire', $id_commentaire);

        try {
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
            return $result['like_dislike'];
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

}

?>
