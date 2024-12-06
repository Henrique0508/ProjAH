<?php

class CadJogo {
    private $CodJogo;
    private $TimeCasa;
    private $TimeVisit;
    private $GolCasa;
    private $GolVist;
    private $DataJogo;
    private $LocalJogo;
    private $Publico;
    private $Vencedor;
    
    public function getCodJogo() {
        return $this->CodJogo;
    }

    public function setCodJogo($CodJ) {
        $this->CodJogo = $CodJ;
    }

    public function getTimeCasa() {
        return $this->TimeCasa;
    }

    public function setTimeCasa($TCasa) {
        $this->TimeCasa = $TCasa;
    }

    public function getTimeVisit() {
        return $this->TimeVisit;
    }

    public function setTimeVisit($TVisit) {
        $this->TimeVisit = $TVisit;
    }

    public function getGolCasa() {
        return $this->GolCasa;
    }

    public function setGolCasa($GCasa) {
        $this->GolCasa = $GCasa;
    }

    public function getGolVist() {
        return $this->GolVist;
    }

    public function setGolVist($GVist) {
        $this->GolVist = $GVist;
    }

    public function getDataJogo() {
        return $this->DataJogo;
    }

    public function setDataJogo($DJogo) {
        $this->DataJogo = $DJogo;
    }

    public function getLocalJogo() {
        return $this->LocalJogo;
    }

    public function setLocalJogo($LJogo) {
        $this->LocalJogo = $LJogo;
    }

    public function getPublico() {
        return $this->Publico;
    }

    public function setPublico($Pub) {
        $this->Publico = $Pub;
    }

    public function getVencedor() {
        return $this->Vencedor;
    }

    public function setVencedor($Venc) {
        $this->Vencedor = $Venc;
    }
}