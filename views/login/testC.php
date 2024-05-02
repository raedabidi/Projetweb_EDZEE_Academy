<?php

require 'config.php';
include 'test.php';

class testC
{

    public function listtest()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function verificationCompte($email, $mot_passe) {
        // Préparez la requête SQL pour rechercher l'utilisateur en fonction de l'email
        $sql = "SELECT * FROM user WHERE email = :email";
        
        // Obtenez une connexion à la base de données
        $db = config::getConnexion();
    
        try {
            // Préparez et exécutez la requête
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            // Récupérez les résultats de la requête
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Vérifiez si un utilisateur avec cet email existe
            if ($user) {
                // Vérifiez si le mot de passe correspond
                if (password_verify($mot_passe, $user['mpd'])) {
                    // Le mot de passe correspond, retournez les informations de l'utilisateur
                    return $user;
                } else {
                    // Le mot de passe ne correspond pas
                    return null;
                }
            } else {
                // Aucun utilisateur avec cet email trouvé
                return null;
            }
        } catch (Exception $e) {
            // En cas d'erreur, affichez un message d'erreur
            die('Error:' . $e->getMessage());
        }
    }
    
    public function searchTest($keyword) {
        $sql = "SELECT * FROM user WHERE nom LIKE '%$keyword%' OR email LIKE '%$keyword%' OR role LIKE '%$keyword%'";
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
        $sql = "DELETE FROM user WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
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
        $sql = "INSERT INTO user 
        VALUES (NULL,:nom,:prenom,:role,:numero,:email,:mpd,:date_naissance)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                
                'nom' => $test->getnom(),
                'prenom' => $test->getprenom(),
                'role' => $test->getrole(),
                'numero' => $test->getnumero(),
                'email' => $test->getemail(),
                'mpd' => $test->getmot_passe(),
                'date_naissance' => $test->getdate_naissance()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showtest($id)
    {
        $sql = "SELECT * from user where id = $id";
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

    function updatetest($nomp, $prenom, $role, $num, $email, $mpd, $date)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE user SET 
                nom = :nom, 
                prenom = :prenom, 
                role = :role,
                numero = :numero,
                email = :email,
                mpd = :mpd,
                date_naissance = :date_naissance

            WHERE id = :id'
        );
        
        $query->bindParam(':nom', $nomp, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':role', $role, PDO::PARAM_STR);
        $query->bindParam(':numero', $num, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mpd', $mpd, PDO::PARAM_STR);
        $query->bindParam(':date_naissance', $date, PDO::PARAM_STR);

        $query->execute();

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage(); 
    }
}
    function selectrec($userId) {
        
        try {
            $sql = "SELECT * FROM user WHERE id = :userId";
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
