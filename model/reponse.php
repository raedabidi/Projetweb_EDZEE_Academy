<?php


class reponse
{
    private ?string $idr = null;
    private ?string $contenu = null;
    private ?string $date_reponse = null;
    private ?string $utilisateur = null;
    private ?string $id_reclamation = null;

    public function __construct($idr, $contenu, $date_reponse, $utilisateur, $id_reclamation)
    {
        $this->idr = $idr;
        $this->contenu = $contenu;
        $this->date_reponse = $date_reponse;
        $this->utilisateur = $utilisateur;
        $this->id_reclamation = $id_reclamation;
    }

    public function getIdr()
    {
        return $this->idr;
    }

    public function setIdr($idr)
    {
        $this->idr = $idr;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getDateReponse()
    {
        return $this->date_reponse;
    }

    public function setDateReponse($date_reponse)
    {
        $this->date_reponse = $date_reponse;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    public function getIdReclamation()
    {
        return $this->id_reclamation;
    }

    public function setIdReclamation($id_reclamation)
    {
        $this->id_reclamation = $id_reclamation;
    }
}