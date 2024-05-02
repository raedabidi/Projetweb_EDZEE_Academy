<?php

class Event {
    // Attributs
    private $id_event;   // identifiant de l'événement
    private $sujet;      // sujet de l'événement
    private $date_debut; // date de début de l'événement
    private $date_fin;   // date de fin de l'événement
    private $nb_place;   // nombre de places disponibles
    private $detail;     // détail de l'événement

    // Constructeur sans paramètres
    public function __construct() {}

    // Méthode pour définir les valeurs des attributs
    public function setValues($sujet, $date_debut, $date_fin, $nb_place, $detail) {
        $this->sujet = $sujet;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->nb_place = $nb_place;
        $this->detail = $detail;
    }

    // Getter et setter pour chaque attribut

    public function getIdEvent() {
        return $this->id_event;
    }

    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function setDateDebut($date_debut) {
        $this->date_debut = $date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    public function setDateFin($date_fin) {
        $this->date_fin = $date_fin;
    }

    public function getNbPlace() {
        return $this->nb_place;
    }

    public function setNbPlace($nb_place) {
        $this->nb_place = $nb_place;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    // Méthode pour sauvegarder les données dans la base de données
    public function save() {
        try {
            $db = $GLOBALS['db'];
            // Préparer la requête SQL
            $query = "INSERT INTO events (sujet, date_debut, date_fin, nb_place, detail) VALUES (?, ?, ?, ?, ?)";

            // Préparer la déclaration SQL
            $statement = $db->prepare($query);

            // Lier les valeurs
            $statement->bindParam(1, $this->sujet);
            $statement->bindParam(2, $this->date_debut);
            $statement->bindParam(3, $this->date_fin);
            $statement->bindParam(4, $this->nb_place);
            $statement->bindParam(5, $this->detail);

            // Exécuter la requête
            $result = $statement->execute();

            // Fermer la connexion à la base de données
            $db = null;

            return $result;
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur de base de données : " . $e->getMessage();
            return false;
        }
    }
}

?>