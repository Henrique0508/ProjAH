<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

include "ClsJogador.php";
include "JogadorDAO.php";

$CadJoga = new CadJoga();
$jogadorDAO = new JogadorDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CPFJoga = filter_input(INPUT_POST, "CPFJoga", FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{11}$/")));
    $NomeJoga = filter_input(INPUT_POST, "NomeJoga", FILTER_SANITIZE_SPECIAL_CHARS);
    $NascJoga = filter_input(INPUT_POST, "NascJoga"); 
    $NascionalJoga = filter_input(INPUT_POST, "NascionalJoga", FILTER_SANITIZE_SPECIAL_CHARS);
    $AlturaJoga = filter_input(INPUT_POST, "AlturaJoga", FILTER_VALIDATE_FLOAT);
    $PosicaoJoga = filter_input(INPUT_POST, "PosicaoJoga", FILTER_SANITIZE_SPECIAL_CHARS);
    $NomeTime = filter_input(INPUT_POST, "NomeTime", FILTER_SANITIZE_SPECIAL_CHARS);
    $PernaJoga = filter_input(INPUT_POST, "PernaJoga", FILTER_SANITIZE_SPECIAL_CHARS);

    $CadJoga->setCPFJoga($CPFJoga);
    $CadJoga->setNomeJoga($NomeJoga);
    $CadJoga->setNascJoga($NascJoga);
    $CadJoga->setNascionalJoga($NascionalJoga);
    $CadJoga->setAlturaJoga($AlturaJoga);
    $CadJoga->setPosicaoJoga($PosicaoJoga);
    $CadJoga->setNomeTime($NomeTime);
    $CadJoga->setPernaJoga($PernaJoga);

    if (isset($_GET['cadJoga'])) {
        echo json_encode($jogadorDAO->Gravar($CadJoga));
    } elseif (isset($_GET['delJoga'])) {
        echo json_encode($jogadorDAO->deletar($CadJoga));
    } elseif (isset($_GET['atuJoga'])) {
        echo json_encode($jogadorDAO->atualizar($CadJoga));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
   if (isset($_GET['getJogador'])) {
       if (isset($_GET['CPFJoga'])) {
           $CPFJoga = filter_input(INPUT_GET, "CPFJoga", FILTER_SANITIZE_SPECIAL_CHARS);
           echo json_encode($jogadorDAO->consultar($CPFJoga));
       } else {
           echo json_encode($jogadorDAO->consultar());
       }
   }
}