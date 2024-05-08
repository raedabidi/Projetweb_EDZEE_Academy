<?php

class comms
{
    private ?int $id_commentaire = null;
    private ?int $id_forum = null;
    private ?string $titre_commentaire = null;
    private ?string $date_commentaire = null;
    private ?string $commentaire = null;
    private ?int $like_dislike = null;

    public function __construct($i, $f_i, $b, $a, $m, $ld)
    {
        $this->id_commentaire = $i;
        $this->id_forum = $f_i;
        $this->titre_commentaire = $b;
        $this->date_commentaire = $a;
        $this->commentaire = $m;
        $this->like_dislike = $ld;
    }

    public function getid_commentaire()
    {
        return $this->id_commentaire;
    }

    public function setid_commentaire($id_commentaire)
    {
        $this->id_commentaire = $id_commentaire;
        return $this;
    }

    public function getid_forum()
    {
        return $this->id_forum;
    }

    public function setid_forum($id_forum)
    {
        $this->id_forum = $id_forum;
        return $this;
    }

    public function gettitre_commentaire() // Ajout du getter pour titre_commentaire
    {
        return $this->titre_commentaire;
    }

    public function settitre_commentaire($titre_commentaire) // Ajout du setter pour titre_commentaire
    {
        $this->titre_commentaire = $titre_commentaire;
        return $this;
    }

    public function getdate_commentaire()
    {
        return $this->date_commentaire;
    }

    public function setdate_commentaire($date_commentaire)
    {
        $this->date_commentaire = $date_commentaire;
        return $this;
    }

    public function getcommentaire()
    {
        return $this->commentaire;
    }

    public function setcommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getlike_dislike()
    {
        return $this->like_dislike;
    }

    public function setlike_dislike($like_dislike)
    {
        $this->like_dislike = $like_dislike;
        return $this;
    }
}

?>
