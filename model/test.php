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
    

    public function __construct($id , $a, $b, $d, $e, $f)
    {
        $this->id= $id;
        $this->nom = $a;
        $this->prenom = $b;
        
        $this->numero = $d;
        $this->email = $e;
        $this->mot_passe = $f;
        
        
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
    
}
