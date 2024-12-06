<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

include "ClsJogo.php";
include "JogoDAO.php";

$CadJogo = new CadJogo();
$jogoDAO = new JogoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CodJogo = filter_input(INPUT_POST, "CodJogo", FILTER_VALIDATE_INT);
    $TimeCasa = filter_input(INPUT_POST, "TimeCasa", FILTER_SANITIZE_SPECIAL_CHARS);
    $TimeVisit = filter_input(INPUT_POST, "TimeVisit", FILTER_SANITIZE_SPECIAL_CHARS);
    $GolCasa = filter_input(INPUT_POST, "GolCasa", FILTER_VALIDATE_INT);
    $GolVist = filter_input(INPUT_POST, "GolVist", FILTER_VALIDATE_INT);
    $DataJogo = filter_input(INPUT_POST, "DataJogo"); 
    $LocalJogo = filter_input(INPUT_POST, "LocalJogo", FILTER_SANITIZE_SPECIAL_CHARS);
    $Publico = filter_input(INPUT_POST, "Publico", FILTER_VALIDATE_INT);
    $Vencedor = filter_input(INPUT_POST, "Vencedor", FILTER_SANITIZE_SPECIAL_CHARS);

    $CadJogo->setCodJogo($CodJogo);
    $CadJogo->setTimeCasa($TimeCasa);
    $CadJogo->setTimeVisit($TimeVisit);
    $CadJogo->setGolCasa($GolCasa);
    $CadJogo->setGolVist($GolVist);
    $CadJogo->setDataJogo($DataJogo);
    $CadJogo->setLocalJogo($LocalJogo);
    $CadJogo->setPublico($Publico);
    $CadJogo->setVencedor($Vencedor);

    if (isset($_GET['cadJogo'])) {
        echo json_encode($jogoDAO->Gravar($CadJogo));
    } elseif (isset($_GET['delJogo'])) {
        echo json_encode($jogoDAO->deletar($CadJogo));
    } elseif (isset($_GET['atuJogo'])) {
        echo json_encode($jogoDAO->atualizar($CadJogo));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
   if (isset($_GET['getJogo'])) {
       if (isset($_GET['CodJogo'])) {
           $CodJogo = filter_input(INPUT_GET, "CodJogo", FILTER_SANITIZE_SPECIAL_CHARS);
           echo json_encode($jogoDAO->consultar($CodJogo));
       } else {
           echo json_encode($jogoDAO->consultar());
       }
   }
}