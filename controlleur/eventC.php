<?php

require_once(__DIR__ . '/../config.php');

class EventC
{
    public function listEvents()
    {
        $sql = "SELECT * FROM events";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteEvent($id)
    {
        $sql = "DELETE FROM events WHERE id_event = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addEvent(Event $event)
    {
        $sql = "INSERT INTO events  
        VALUES (
            NULL, 
            :sujet,
            :date_debut,
            :date_fin,
            :nb_place,
            :detail
        )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'sujet' => $event->getSujet(),
                'date_debut' => $event->getDateDebut(),
                'date_fin' => $event->getDateFin(),
                'nb_place' => $event->getNbPlace(),
                'detail' => $event->getDetail()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showEvent($id)
    {
        $sql = "SELECT * FROM events WHERE id_event = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateEvent($event, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE events SET 
                    sujet = :sujet, 
                    date_debut = :date_debut, 
                    date_fin = :date_fin, 
                    nb_place = :nb_place,
                    detail = :detail
                WHERE id_event = :id_event'
            );

            $query->execute([
                'id_event' => $id,
                'sujet' => $event->getSujet(),
                'date_debut' => $event->getDateDebut(),
                'date_fin' => $event->getDateFin(),
                'nb_place' => $event->getNbPlace(),
                'detail' => $event->getDetail()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>