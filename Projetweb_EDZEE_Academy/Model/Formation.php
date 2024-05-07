<?php
    class formation {
        private $IDF = null;
        private $Titre = null;
        private $Description = null;
        private $Status = null;
        private $Ressource = null;
        private $Prix = null;
        private $Date = null; // Ajout de l'attribut Date
        private $Lieu = null; // Ajout de l'attribut Lieu

        function __construct($IDF, $Titre, $Description, $Status, $Ressource, $Prix, $Date, $Lieu) {
            $this->IDF = $IDF;
            $this->Titre = $Titre;
            $this->Description = $Description;
            $this->Status = $Status;
            $this->Ressource = $Ressource;
            $this->Prix = $Prix;
            $this->Date = $Date;
            $this->Lieu = $Lieu;
        }

        // Méthodes getters
        function getIDF() {
            return $this->IDF;
        }

        function getTitre() {
            return $this->Titre;
        }

        function getDescription() {
            return $this->Description;
        }

        function getStatus() {
            return $this->Status;
        }

        function getRessource() {
            return $this->Ressource;
        }

        function getPrix() {
            return $this->Prix;
        }

        function getDate() { // Méthode pour obtenir la date
            return $this->Date;
        }

        function getLieu() { // Méthode pour obtenir le lieu
            return $this->Lieu;
        }

        // Méthodes setters
        function setIDF(string $IDF) {
            $this->IDF = $IDF;
        }

        function setTitre(string $Titre) {
            $this->Titre = $Titre;
        }

        function setDescription(string $Description) {
            $this->Description = $Description;
        }

        function setStatus(int $Status) {
            $this->Status = $Status;
        }

        function setRessource(string $Ressource) {
            $this->Ressource = $Ressource;
        }

        function setPrix(string $Prix) {
            $this->Prix = $Prix;
        }

        function setDate($Date) { // Méthode pour définir la date
            $this->Date = $Date;
        }

        function setLieu($Lieu) { // Méthode pour définir le lieu
            $this->Lieu = $Lieu;
        }
    }
?>
