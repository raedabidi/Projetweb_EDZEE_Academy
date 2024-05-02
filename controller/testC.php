<?php

require '../config.php';
include '../model/test.php';

class testC
{

    public function listtest()
    {
        $sql = "SELECT * FROM test";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletetest($ide)
    {
        $sql = "DELETE FROM test WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function searchTest($keyword) {
        $sql = "SELECT * FROM test WHERE nom_prenom LIKE '%$keyword%' OR type_reclamation LIKE '%$keyword%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function sortByField($tab, $field) {
        // Vérifier si $tab est un objet PDOStatement
        if ($tab instanceof PDOStatement) {
            // Convertir l'objet PDOStatement en tableau associatif
            $tab = $tab->fetchAll(PDO::FETCH_ASSOC);
        } elseif (!is_array($tab)) {
            // Si $tab n'est ni un objet PDOStatement ni un tableau, retourner une erreur
            throw new InvalidArgumentException('$tab doit être un tableau ou un objet PDOStatement.');
        }
    
        // Récupérer les valeurs du champ spécifié de tous les tests dans un tableau séparé
        $values = array_column($tab, $field);
    
        // Trier le tableau $tab en utilisant les valeurs du champ spécifié comme clés de tri
        array_multisort($values, SORT_ASC, $tab);
    
        // Retourner le tableau trié
        return $tab;
    }



    function addtest($test)
{
    $sql = "INSERT INTO test 
            VALUES (NULL, :nom_prenom, :type_reclamation, :descrip, :date_reclamation)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nom_prenom' => $test->getnom_prenom(),
            'type_reclamation' => $test->gettype_reclamation(),
            'descrip' => $test->getdescrip(),
            'date_reclamation' => date('Y-m-d H:i:s') // Assurez-vous de spécifier le format de la date
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



    function showtest($id)
    {
        $sql = "SELECT * from test where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $test = $query->fetch();
            return $test;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatetest($Id, $nomp, $type, $desc, $date)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE test SET 
                nom_prenom = :nom_prenom, 
                type_reclamation = :type_reclamation, 
                descrip = :descrip,
                date_reclamation = :date_reclamation
            WHERE id = :id'
        );
        $query->bindParam(':id', $Id, PDO::PARAM_STR);
        $query->bindParam(':nom_prenom', $nomp, PDO::PARAM_STR);
        $query->bindParam(':type_reclamation', $type, PDO::PARAM_STR);
        $query->bindParam(':descrip', $desc, PDO::PARAM_STR);
        $query->bindParam(':date_reclamation', $date, PDO::PARAM_STR);

        $query->execute();

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage(); // Afficher l'erreur en cas d'échec
    }
}
    function selectrec($userId) {
        
        try {
            $sql = "SELECT * FROM test WHERE id = :userId";
            $conn = config::getConnexion();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $userDetails;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
