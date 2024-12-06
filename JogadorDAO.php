<?php

include "Conexao.php";

class JogadorDAO {

    public function Gravar(CadJoga $j) {
        $sql_Jogador = "INSERT INTO Jogador(CPFJoga, NomeJoga, NascJoga, NascionalJoga, AlturaJoga, PosicaoJoga, NomeTime, PernaJoga) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CPFJoga = $j->getCPFJoga();
        $NomeJoga = $j->getNomeJoga();
        $NascJoga = $j->getNascJoga();
        $NascionalJoga = $j->getNascionalJoga();
        $AlturaJoga = $j->getAlturaJoga();
        $PosicaoJoga = $j->getPosicaoJoga();
        $NomeTime = $j->getNomeTime();
        $PernaJoga = $j->getPernaJoga();

        $Comando = $con->prepare($sql_Jogador);
        $Comando->bindParam(1, $CPFJoga);
        $Comando->bindParam(2, $NomeJoga);
        $Comando->bindParam(3, $NascJoga);
        $Comando->bindParam(4, $NascionalJoga);
        $Comando->bindParam(5, $AlturaJoga);
        $Comando->bindParam(6, $PosicaoJoga);
        $Comando->bindParam(7, $NomeTime);
        $Comando->bindParam(8, $PernaJoga);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Cadastrado com sucesso";
        } else {
            return "Erro ao cadastrar";
        }
    }

    public function deletar(CadJoga $j) {
        $sql_Jogador = "DELETE FROM Jogador WHERE CPFJoga=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $CPFJoga = $j->getCPFJoga();

        $Comando = $con->prepare($sql_Jogador);
        $Comando->bindParam(1, $CPFJoga);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Apagado com sucesso";
        } else {
            return "Erro ao apagar";
        }
    }

    public function atualizar(CadJoga $j) {
        $sql_Jogador = "UPDATE Jogador SET NomeJoga=?, NascJoga=?, NascionalJoga=?, AlturaJoga=?, PosicaoJoga=?, NomeTime=?, PernaJoga=? WHERE CPFJoga=?";

        $bd = new Conexao();
        $con = $bd->getConexao();

        $NomeJoga = $j->getNomeJoga();
        $NascJoga = $j->getNascJoga();
        $NascionalJoga = $j->getNascionalJoga();
        $AlturaJoga = $j->getAlturaJoga();
        $PosicaoJoga = $j->getPosicaoJoga();
        $NomeTime = $j->getNomeTime();
        $PernaJoga = $j->getPernaJoga();
        $CPFJoga = $j->getCPFJoga();

        $Comando = $con->prepare($sql_Jogador);
        $Comando->bindParam(1, $NomeJoga);
        $Comando->bindParam(2, $NascJoga);
        $Comando->bindParam(3, $NascionalJoga);
        $Comando->bindParam(4, $AlturaJoga);
        $Comando->bindParam(5, $PosicaoJoga);
        $Comando->bindParam(6, $NomeTime);
        $Comando->bindParam(7, $PernaJoga);
        $Comando->bindParam(8, $CPFJoga);

        $resultado = $Comando->execute();

        if ($resultado) {
            return "Atualizado com sucesso";
        } else {
            return "Erro ao atualizar";
        }
    }

    public function consultar($cpf = null) {
        $sql = "SELECT * FROM Jogador";
        if ($cpf) {
            $sql .= " WHERE CPFJoga=?";
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
?>