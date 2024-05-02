<?php
class question
{
    private ?int $id = null;
    private ?string $ques = null;
    private ?string $prof = null;
    private ?string $nbrrep = null;
    private ?string $datecre = null;
    private ?string $test = null;
    public static function gettestfromquestion()
    {
        try {
            $pdo = config::getConnexion();
            $sql = "SELECT test.test
                FROM test
                JOIN question ON test.test = question.test";

            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'question');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __construct($id , $n, $a, $p, $d, $f)
    {
        $this->id= $id;
        $this->ques = $n;
        $this->prof = $a;
        $this->nbrrep = $p;
        $this->datecre = $d;
        $this->test = $f;
    }


    public function getid()
    {
        return $this->id;
    }


    public function getquestion()
    {
        return $this->question;
    }


    public function setques($ques)
    {
        $this->ques = $ques;

        return $this;
    }


    

    public function getprof()
    {
        return $this->prof;
    }


    public function setprof($prof)
    {
        $this->prof = $prof;

        return $this;
    }
    public function getnbrrep()
    {
        return $this->nbrrep;
    }


    public function setnbrrep($nbrrep)
    {
        $this->nbrrep = $nbrrep;

        return $this;
    }



    public function getdatecre()
    {
        return $this->datecre;
    }


    public function setdatecre($datecre)
    {
        $this->datecre = $datecre;

        return $this;
    }

    public function gettest()
    {
        return $this->test;
    }


    public function settest($test)
    {
        $this->test = $test;

        return $this;
    }
}
