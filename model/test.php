<?php
class test
{
    private ?int $id = null;
    private ?int $score_min = null;
    private ?int $score_max = null;
    private ?string $date = null;
    private ?string $duree = null;

    public function __construct($id , $n, $a, $p, $d)
    {
        $this->id= $id;
        $this->score_min = $n;
        $this->score_max = $a;
        $this->date = date('Y-m-d H:i:s');
        $this->duree = $d;
    }


    public function getid()
    {
        return $this->id;
    }


    public function getscore_min()
    {
        return $this->score_min;
    }


    public function setscore_min($score_min)
    {
        $this->score_min = $score_min;

        return $this;
    }


    

    public function getscore_max()
    {
        return $this->score_max;
    }


    public function setscore_max($score_max)
    {
        $this->score_max = $score_max;

        return $this;
    }
    public function getdate()
    {
        return $this->date;
    }


    public function setdate($date)
    {
        $this->date = $date;

        return $this;
    }



    public function getduree()
    {
        return $this->duree;
    }


    public function setduree($duree)
    {
        $this->duree = $duree;

        return $this;
    }
}
