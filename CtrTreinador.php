<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json; charset=UTF-8");

include "ClsTreinador.php";
include "TreinadorDAO.php";

$CadTreinador = new CadTreinador();
$treinadorDAO = new TreinadorDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CPFTreina = filter_input(INPUT_POST, "CPFTreina", FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{11}$/")));
    $NomeTreina = filter_input(INPUT_POST, "NomeTreina", FILTER_SANITIZE_SPECIAL_CHARS);
    $NomeTime = filter_input(INPUT_POST, "NomeTime", FILTER_SANITIZE_SPECIAL_CHARS);
    $NascTreina = filter_input(INPUT_POST, "NascTreina"); 
    $NacionalTreina = filter_input(INPUT_POST, "NacionalTreina", FILTER_SANITIZE_SPECIAL_CHARS);

    $CadTreinador->setCPFTreina($CPFTreina);
    $CadTreinador->setNomeTreina($NomeTreina);
    $CadTreinador->setNomeTime($NomeTime);
    $CadTreinador->setNascTreina($NascTreina);
    $CadTreinador->setNacionalTreina($NacionalTreina);

    if (isset($_GET['cadTreinador'])) {
        echo json_encode($treinadorDAO->Gravar($CadTreinador));
    } elseif (isset($_GET['delTreinador'])) {
        echo json_encode($treinadorDAO->deletar($CadTreinador));
    } elseif (isset($_GET['atuTreinador'])) {
        echo json_encode($treinadorDAO->atualizar($CadTreinador));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
   if (isset($_GET['getTreinador'])) {
       if (isset($_GET['CPFTreina'])) {
           $CPFTreina = filter_input(INPUT_GET, "CPFTreina", FILTER_SANITIZE_SPECIAL_CHARS);
           echo json_encode($treinadorDAO->consultar($CPFTreina));
       } else {
           echo json_encode($treinadorDAO->consultar());
       }
   }
}