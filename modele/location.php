<?php

class Location {
    // Attributs
    private $id_location;  // identifiant de l'emplacement
    private $emplacement;   // emplacement
    private $capacite;     // capacité de l'emplacement
    private $categorie;    // catégorie de l'emplacement

    // Constructeur sans paramètres
    public function __construct() {}

    // Méthode pour définir les valeurs des attributs
    public function setValues($emplacement, $capacite, $categorie) {
        $this->emplacement = $emplacement;
        $this->capacite = $capacite;
        $this->categorie = $categorie;
    }

    // Getter et setter pour chaque attribut

    public function getIdLocation() {
        return $this->id_location;
    }

    public function getEmplacement() {
        return $this->emplacement;
    }

    public function setEmplacement($emplacement) {
        $this->emplacement = $emplacement;
    }

    public function getCapacite() {
        return $this->capacite;
    }

    public function setCapacite($capacite) {
        $this->capacite = $capacite;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    // Méthode pour sauvegarder les données dans la base de données
    public function save() {
        try {
            $db = $GLOBALS['db'];
            // Préparer la requête SQL
            $query = "INSERT INTO locations (emplacement, capacite, categorie) VALUES (?, ?, ?)";

            // Préparer la déclaration SQL
            $statement = $db->prepare($query);

            // Lier les valeurs
            $statement->bindParam(1, $this->emplacement);
            $statement->bindParam(2, $this->capacite);
            $statement->bindParam(3, $this->categorie);

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