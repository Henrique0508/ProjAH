<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

include "ClsTime.php";
include "TimeDAO.php";

$CadTime = new CadTime();
$timeDAO = new TimeDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CodTime = filter_input(INPUT_POST, "CodTime", FILTER_VALIDATE_INT);
    $NomeTime = filter_input(INPUT_POST, "NomeTime", FILTER_SANITIZE_SPECIAL_CHARS);
    $PaisTime = filter_input(INPUT_POST, "PaisTime", FILTER_SANITIZE_SPECIAL_CHARS);
    $NomeTreina = filter_input(INPUT_POST, "NomeTreina", FILTER_SANITIZE_SPECIAL_CHARS);
    $AnoFunda = filter_input(INPUT_POST, "AnoFunda", FILTER_SANITIZE_SPECIAL_CHARS);

    $CadTime->setCodTime($CodTime);
    $CadTime->setNomeTime($NomeTime);
    $CadTime->setPaisTime($PaisTime);
    $CadTime->setNomeTreina($NomeTreina);
    $CadTime->setAnoFunda($AnoFunda);

    if (isset($_GET['cadTime'])) {
        echo json_encode($timeDAO->Gravar($CadTime));
    } elseif (isset($_GET['delTime'])) {
        echo json_encode($timeDAO->deletar($CadTime));
    } elseif (isset($_GET['atuTime'])) {
        echo json_encode($timeDAO->atualizar($CadTime));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
   if (isset($_GET['getTime'])) {
       if (isset($_GET['CodTime'])) {
           $CodTime = filter_input(INPUT_GET, "CodTime", FILTER_SANITIZE_SPECIAL_CHARS);
           echo json_encode($timeDAO->consultar($CodTime));
       } else {
           echo json_encode($timeDAO->consultar());
       }
   }
}