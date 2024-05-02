<?php
    class ressources{
        private $IDR=null;
        private $Lien=null;
        private $IMG=null;
        private $Type=null;
        private $DateAjout=null;

        function __construct($IDR,$Lien,$IMG,$Type,$DateAjout){
            $this->IDR=$IDR;
            $this->Lien=$Lien;
            $this->IMG=$IMG;
            $this->Type=$Type;
            $this->DateAjout=$DateAjout;
        }

        function getIDR(){
            return $this->IDR;
        }

        function getLien(){
            return $this->Lien;
        }
        function getIMG(){
            return $this->IMG;
        }
        function getType(){
            return $this->Type;
        }
        function getDateAjout(){
            return $this->DateAjout;
        }

        function setIDR(int $IDR){
            $this->IDR=$IDR;
        }
        function setLien(string $Lien){
            $this->Lien=$Lien;
        }
        function setIMG(string $IMG){
            $this->IMG=$IMG;
        }
        function setType(string $Type){
            $this->Type=$Type;
        }
        function setDateAjout(string $DateAjout){
            $this->DateAjout=$DateAjout;
        }
    }
?>