<?php

require_once(__DIR__ . '/../config.php');

class LocationC
{
    public function listLocations()
    {
        $sql = "SELECT * FROM locations";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteLocation($id)
    {
        $sql = "DELETE FROM locations WHERE id_location = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addLocation(Location $location)
    {
        $sql = "INSERT INTO locations  
        VALUES (
            NULL, 
            :emplacement,
            :capacite,
            :categorie
        )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'emplacement' => $location->getEmplacement(),
                'capacite' => $location->getCapacite(),
                'categorie' => $location->getCategorie()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showLocation($id)
    {
        $sql = "SELECT * FROM locations WHERE id_location = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $location = $query->fetch();
            return $location;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateLocation($location, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE locations SET 
                    emplacement = :emplacement, 
                    capacite = :capacite, 
                    categorie = :categorie
                WHERE id_location = :id_location'
            );

            $query->execute([
                'id_location' => $id,
                'emplacement' => $location->getEmplacement(),
                'capacite' => $location->getCapacite(),
                'categorie' => $location->getCategorie()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function filterLocationNomAZ()
{
    $sql = "SELECT * FROM locations ORDER BY emplacement ASC";
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

public function filterLocationNomZA()
{
    $sql = "SELECT * FROM locations ORDER BY emplacement DESC";
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
public function searchLocation($recherche)
{
    $sql = "SELECT * FROM locations
        WHERE emplacement LIKE :recherche 
        OR capacite LIKE :recherchee 
        OR categorie LIKE :rechercheee";

    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':recherche', '%' . $recherche . '%');
        $query->bindValue(':recherchee', '%' . $recherche . '%');
        $query->bindValue(':rechercheee', '%' . $recherche . '%');
        $query->execute();
        $locations = $query->fetchAll();
        return $locations;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
}

?>