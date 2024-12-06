<?php

include "Conexao.php";

class TimeDAO {

    public function Gravar(CadTime $t) {
        $sql_Time = "INSERT INTO Times(CodTime, NomeTime, PaisTime, NomeTreina, AnoFunda) 
        VALUES (?, ?, ?, ?, ?)";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CodTime = $t->getCodTime();
        $NomeTime = $t->getNomeTime();
        $PaisTime = $t->getPaisTime();
        $NomeTreina = $t->getNomeTreina();
        $AnoFunda = $t->getAnoFunda();

        $Comando = $con->prepare($sql_Time);
        $Comando->bindParam(1, $CodTime);
        $Comando->bindParam(2, $NomeTime);
        $Comando->bindParam(3, $PaisTime);
        $Comando->bindParam(4, $NomeTreina);
        $Comando->bindParam(5, $AnoFunda);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Cadastrado com sucesso";
        } else {
            return "Erro ao cadastrar";
        }
    }

    public function deletar(CadTime $t) {
        $sql_Time = "DELETE FROM Times WHERE CodTime=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CodTime = $t->getCodTime();

        $Comando = $con->prepare($sql_Time);
        $Comando->bindParam(1, $CodTime);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Apagado com sucesso";
        } else {
            return "Erro ao apagar";
        }
    }

    public function atualizar(CadTime $t) {
        $sql_Time = "UPDATE Times SET NomeTime=?, PaisTime=?, NomeTreina=?, AnoFunda=? WHERE CodTime=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $NomeTime = $t->getNomeTime();
        $PaisTime = $t->getPaisTime();
        $NomeTreina = $t->getNomeTreina();
        $AnoFunda = $t->getAnoFunda();
        $CodTime = $t->getCodTime();

        $Comando = $con->prepare($sql_Time);
        $Comando->bindParam(1, $NomeTime);
        $Comando->bindParam(2, $PaisTime);
        $Comando->bindParam(3, $NomeTreina);
        $Comando->bindParam(4, $AnoFunda);
        $Comando->bindParam(5, $CodTime);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Atualizado com sucesso";
        } else {
            return "Erro ao atualizar";
        }
    }

    public function consultar($codTime = null) {
        $sql = "SELECT * FROM Times";
        if ($codTime) {
            $sql .= " WHERE CodTime=?";
        }

        $bd = new Conexao();
        $con = $bd->getConexao();

        if ($codTime) {
            $valor = $con->prepare($sql);
            $valor->bindParam(1, $codTime);
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