<?php

class CadJoga {
    private $CPFJoga;
    private $NomeJoga;
    private $NascJoga;
    private $NascionalJoga;
    private $AlturaJoga;
    private $PosicaoJoga;
    private $NomeTime;
    private $PernaJoga;
    
    
    public function getCPFJoga() {
        return $this->CPFJoga;
    }

    public function setCPFJoga($CpJ) {
        $this->CPFJoga = $CpJ;
    }

    public function getNomeJoga() {
        return $this->NomeJoga;
    }

    public function setNomeJoga($Nomj) {
        $this->NomeJoga = $Nomj;
    }

    public function getNascJoga() {
        return $this->NascJoga;
    }

    public function setNascJoga($Nj) {
       
        $this->NascJoga = $Nj;
    }

    public function getNascionalJoga() {
        return $this->NascionalJoga;
    }

    public function setNascionalJoga($NaJ) {
        $this->NascionalJoga = $NaJ;
    }

    public function getAlturaJoga() {
        return $this->AlturaJoga;
    }

    public function setAlturaJoga($AJ) {
     
        $this->AlturaJoga = $AJ;
    }

    public function getPosicaoJoga() {
        return $this->PosicaoJoga;
    }

    public function setPosicaoJoga($PJ) {
        $this->PosicaoJoga = $PJ;
    }

    public function getNomeTime() {
        return $this->NomeTime;
    }

    public function setNomeTime($NT) {
        $this->NomeTime = $NT;
    }

    public function getPernaJoga() {
        return $this->PernaJoga;
    }

    public function setPernaJoga($PeJ) {
        $this->PernaJoga = $PeJ;
    }
}