<?php

class CadTime {
    private $CodTime;
    private $NomeTime;
    private $PaisTime;
    private $NomeTreina;
    private $AnoFunda;
    
    public function getCodTime() {
        return $this->CodTime;
    }

    public function setCodTime($CodT) {
        $this->CodTime = $CodT;
    }

    public function getNomeTime() {
        return $this->NomeTime;
    }

    public function setNomeTime($NomT) {
        $this->NomeTime = $NomT;
    }

    public function getPaisTime() {
        return $this->PaisTime;
    }

    public function setPaisTime($PaT) {
        $this->PaisTime = $PaT;
    }

    public function getNomeTreina() {
        return $this->NomeTreina;
    }

    public function setNomeTreina($NTreina) {
        $this->NomeTreina = $NTreina;
    }

    public function getAnoFunda() {
        return $this->AnoFunda;
    }

    public function setAnoFunda($AF) {
        $this->AnoFunda = $AF;
    }
}