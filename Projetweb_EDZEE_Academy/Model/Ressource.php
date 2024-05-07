<?php
    class fressource{
        private $IDR=null;
        private $VID=null;
        private $IMG=null;
        private $Type=null;
        private $DateAjout=null;

        function __construct($IDR,$VID,$IMG,$Type,$DateAjout){
            $this->IDR=$IDR;
            $this->VID=$VID;
            $this->IMG=$IMG;
            $this->Type=$Type;
            $this->DateAjout=$DateAjout;
        }

        function getIDR(){
            return $this->IDR;
        }

        function getVID(){
            return $this->VID;
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
        function setVID(string $VID){
            $this->VID=$VID;
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