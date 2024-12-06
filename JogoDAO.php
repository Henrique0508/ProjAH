<?php

include "Conexao.php";

class JogoDAO {

    public function Gravar(CadJogo $j) {
        $sql_Jogo = "INSERT INTO Jogo(CodJogo, TimeCasa, TimeVisit, GolCasa, GolVist, DataJogo, LocalJogo, Publico, Vencedor) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CodJogo = $j->getCodJogo();
        $TimeCasa = $j->getTimeCasa();
        $TimeVisit = $j->getTimeVisit();
        $GolCasa = $j->getGolCasa();
        $GolVist = $j->getGolVist();
        $DataJogo = $j->getDataJogo();
        $LocalJogo = $j->getLocalJogo();
        $Publico = $j->getPublico();
        $Vencedor = $j->getVencedor();

        $Comando = $con->prepare($sql_Jogo);
        $Comando->bindParam(1, $CodJogo);
        $Comando->bindParam(2, $TimeCasa);
        $Comando->bindParam(3, $TimeVisit);
        $Comando->bindParam(4, $GolCasa);
        $Comando->bindParam(5, $GolVist);
        $Comando->bindParam(6, $DataJogo);
        $Comando->bindParam(7, $LocalJogo);
        $Comando->bindParam(8, $Publico);
        $Comando->bindParam(9, $Vencedor);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Cadastrado com sucesso";
        } else {
            return "Erro ao cadastrar";
        }
    }

    public function deletar(CadJogo $j) {
        $sql_Jogo = "DELETE FROM Jogo WHERE CodJogo=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CodJogo = $j->getCodJogo();

        $Comando = $con->prepare($sql_Jogo);
        $Comando->bindParam(1, $CodJogo);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Apagado com sucesso";
        } else {
            return "Erro ao apagar";
        }
    }

    public function atualizar(CadJogo $j) {
        $sql_Jogo = "UPDATE Jogo SET TimeCasa=?, TimeVisit=?, GolCasa=?, GolVist=?, DataJogo=?, LocalJogo=?, Publico=?, Vencedor=? WHERE CodJogo=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $TimeCasa = $j->getTimeCasa();
        $TimeVisit = $j->getTimeVisit();
        $GolCasa = $j->getGolCasa();
        $GolVist = $j->getGolVist();
        $DataJogo = $j->getDataJogo();
        $LocalJogo = $j->getLocalJogo();
        $Publico = $j->getPublico();
        $Vencedor = $j->getVencedor();
        $CodJogo = $j->getCodJogo();

        $Comando = $con->prepare($sql_Jogo);
        $Comando->bindParam(1, $TimeCasa);
        $Comando->bindParam(2, $TimeVisit);
        $Comando->bindParam(3, $GolCasa);
        $Comando->bindParam(4, $GolVist);
        $Comando->bindParam(5, $DataJogo);
        $Comando->bindParam(6, $LocalJogo);
        $Comando->bindParam(7, $Publico);
        $Comando->bindParam(8, $Vencedor);
        $Comando->bindParam(9, $CodJogo);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Atualizado com sucesso";
        } else {
            return "Erro ao atualizar";
        }
    }

    public function consultar($codJogo = null) {
        $sql = "SELECT * FROM Jogo";
        if ($codJogo) {
            $sql .= " WHERE CodJogo=?";
        }

        $bd = new Conexao();
        $con = $bd->getConexao();

        if ($codJogo) {
            $valor = $con->prepare($sql);
            $valor->bindParam(1, $codJogo);
        } else {
            $valor = $con->prepare($sql);
        }

        $valor->execute();

        if ($valor->rowCount() > 0) {
            $resultado = $valor->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return "Nenhum registro encontrado";
        }
    }
}