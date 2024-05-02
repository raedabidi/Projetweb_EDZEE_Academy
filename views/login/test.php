<?php
class test
{
    private $id = null;
    private $nom = null;
    private $prenom = null;
    private $role = null;
    private $numero = null;
    private $email = null;
    private $mot_passe = null;
    private $date_naissance = null;

    public function __construct($id , $a, $b, $c, $d, $e, $f, $g)
    {
        $this->id= $id;
        $this->nom = $a;
        $this->prenom = $b;
        $this->role = $c;
        $this->numero = $d;
        $this->email = $e;
        $this->mot_passe = $f;
        $this->date_naissance = $g;
        
    }


    public function getid()
    {
        return $this->id;
    }
    
    public function getnom()
    {
        return $this->nom;
    }


    public function setnom($a)
    {
        $this->nom = $a;

        return $this;
    }


    

    public function getprenom()
    {
        return $this->prenom;
    }


    public function setprenom($b)
    {
        $this->prenom = $b;

        return $this;
    }
    public function getrole()
    {
        return $this->role;
    }


    public function setrole($c)
    {
        $this->role = $c;

        return $this;
    }



    public function getnumero()
    {
        return $this->numero;
    }


    public function setnumero($d)
    {
        $this->numero = $d;

        return $this;
    }
    public function getemail()
    {
        return $this->email;
    }


    public function setemail($e)
    {
        $this->email = $e;

        return $this;
    }
    public function getmot_passe()
    {
        return $this->mot_passe;
    }


    public function setmot_passe($f)
    {
        $this->mot_passe = $f;

        return $this;
    }
    public function getdate_naissance()
    {
        return $this->date_naissance;
    }


    public function setdate_naissance($f)
    {
        $this->date_naissance = $f;

        return $this;
    }
}
