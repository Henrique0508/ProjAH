<?php

include "Conexao.php";

class TreinadorDAO {

    public function Gravar(CadTreinador $t) {
        $sql_Treinador = "INSERT INTO Treinador(CPFTreina, NomeTreina, NomeTime, NascTreina, NacionalTreina) 
        VALUES (?, ?, ?, ?, ?)";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CPFTreina = $t->getCPFTreina();
        $NomeTreina = $t->getNomeTreina();
        $NomeTime = $t->getNomeTime();
        $NascTreina = $t->getNascTreina();
        $NacionalTreina = $t->getNacionalTreina();

        $Comando = $con->prepare($sql_Treinador);
        $Comando->bindParam(1, $CPFTreina);
        $Comando->bindParam(2, $NomeTreina);
        $Comando->bindParam(3, $NomeTime);
        $Comando->bindParam(4, $NascTreina);
        $Comando->bindParam(5, $NacionalTreina);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Cadastrado com sucesso";
        } else {
            return "Erro ao cadastrar";
        }
    }

    public function deletar(CadTreinador $t) {
        $sql_Treinador = "DELETE FROM Treinador WHERE CPFTreina=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CPFTreina = $t->getCPFTreina();

        $Comando = $con->prepare($sql_Treinador);
        $Comando->bindParam(1, $CPFTreina);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Apagado com sucesso";
        } else {
            return "Erro ao apagar";
        }
    }

    public function atualizar(CadTreinador $t) {
        $sql_Treinador = "UPDATE Treinador SET NomeTreina=?, NomeTime=?, NascTreina=?, NacionalTreina=? WHERE CPFTreina=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $NomeTreina = $t->getNomeTreina();
        $NomeTime = $t->getNomeTime();
        $NascTreina = $t->getNascTreina();
        $NacionalTreina = $t->getNacionalTreina();
        $CPFTreina = $t->getCPFTreina();

        $Comando = $con->prepare($sql_Treinador);
        $Comando->bindParam(1, $NomeTreina);
        $Comando->bindParam(2, $NomeTime);
        $Comando->bindParam(3, $NascTreina);
        $Comando->bindParam(4, $NacionalTreina);
        $Comando->bindParam(5, $CPFTreina);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Atualizado com sucesso";
        } else {
            return "Erro ao atualizar";
        }
    }

    public function consultar($cpf = null) {
        $sql = "SELECT * FROM Treinador";
        if ($cpf) {
            $sql .= " WHERE CPFTreina=?";
        }

        $bd = new Conexao();
        $con = $bd->getConexao();

        if ($cpf) {
            $valor = $con->prepare($sql);
            $valor->bindParam(1, $cpf);
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