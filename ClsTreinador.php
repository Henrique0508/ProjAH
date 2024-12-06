<?php

class CadTreinador {
    private $CPFTreina;
    private $NomeTreina;
    private $NomeTime;
    private $NascTreina;
    private $NacionalTreina;
    
    public function getCPFTreina() {
        return $this->CPFTreina;
    }

    public function setCPFTreina($CPFT) {
        $this->CPFTreina = $CPFT;
    }

    public function getNomeTreina() {
        return $this->NomeTreina;
    }

    public function setNomeTreina($NomT) {
        $this->NomeTreina = $NomT;
    }

    public function getNomeTime() {
        return $this->NomeTime;
    }

    public function setNomeTime($NT) {
        $this->NomeTime = $NT;
    }

    public function getNascTreina() {
        return $this->NascTreina;
    }

    public function setNascTreina($NascT) {
        $this->NascTreina = $NascT;
    }

    public function getNacionalTreina() {
        return $this->NacionalTreina;
    }

    public function setNacionalTreina($NacT) {
        $this->NacionalTreina = $NacT;
    }
}