<?php

class forum
{
    private ?string $titre_forum = null;
    private ?string $date_forum = null;
    private ?string $matiere_forum = null;
    private ?string $desc_forum = null; // Nouvelle propriété

    public function __construct($n, $p, $a, $d) // Ajouter le paramètre $d pour la description
    {
        $this->titre_forum = $n;
        $this->date_forum = $p;
        $this->matiere_forum = $a;
        $this->desc_forum = $d; // Initialiser la description
    }

    public function gettitre_forum()
    {
        return $this->titre_forum;
    }

    public function settitre_forum($titre_forum)
    {
        $this->titre_forum = $titre_forum;
        return $this;
    }

    public function getdate_forum()
    {
        return $this->date_forum;
    }

    public function setdate_forum($date_forum)
    {
        $this->date_forum = $date_forum;
        return $this;
    }

    public function getmatiere_forum()
    {
        return $this->matiere_forum;
    }

    public function setmatiere_forum($matiere_forum)
    {
        $this->matiere_forum = $matiere_forum;
        return $this;
    }

    public function getdesc_forum() // Ajouter la méthode getter pour la description
    {
        return $this->desc_forum;
    }

    public function setdesc_forum($desc_forum) // Ajouter la méthode setter pour la description
    {
        $this->desc_forum = $desc_forum;
        return $this;
    }
}

?>
