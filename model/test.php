<?php
class test
{
    private ?string $id = null;
    private ?string $nom_prenom = null;
    private ?string $type_reclamation = null;
    private ?string $descrip = null;
    private ?string $date_reclamation = null;

    public function __construct($id , $a, $b, $c, $d)
    {
        $this->id= $id;
        $this->nom_prenom = $a;
        $this->type_reclamation = $b;
        $this->descrip = $c;
        $this->date_reclamation = $d;
    }


    public function getid()
    {
        return $this->id;
    }

    public function setid($i)
    {
        return $this->id=$i;
    }

    
    public function getnom_prenom()
    {
        return $this->nom_prenom;
    }


    public function setnom_prenom($a)
    {
        $this->nom_prenom = $a;

        return $this;
    }

    public function gettype_reclamation()
    {
        return $this->type_reclamation;
    }


    public function settype_reclamation($a)
    {
        $this->type_reclamation = $a;

        return $this;
    }

    public function getdescrip()
    {
        return $this->descrip;
    }


    public function setdescrip($c)
    {
        $this->descrip = $c;

        return $this;
    }



    public function getdate_reclamation()
    {
        return $this->date_reclamation;
    }


    public function setdate_reclamation($d)
    {
        $this->date_reclamation = $d;

        return $this;
    }
    

}
