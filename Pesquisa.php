<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
    <link rel="stylesheet" type="text/css" href="adicionando.css" media="screen" />
</head>
<body>
    <?php include "menu.php"; ?>

    <h2>Pesquisa</h2>

    <form id="formPesquisa" method="post">
        <label for="tipoPesquisa">Selecione o tipo de pesquisa:</label>
        <select id="tipoPesquisa" name="tipoPesquisa">
            <option value="jogador">Jogador</option>
            <option value="treinador">Treinador</option>
            <option value="time">Time</option>
            <option value="jogo">Jogo</option>
        </select><br><br>

        <label for="valorPesquisa">CPF ou Código:</label>
        <input id="valorPesquisa" name="valorPesquisa" type="text" required/><br><br>

        <button type="button" onclick="pesquisar()">Pesquisar</button>
    </form>

    <h2>Resultado da Pesquisa</h2>
    <div id="resultado">

    </div>

    <script>
        function pesquisar() {
            var tipoPesquisa = document.getElementById("tipoPesquisa").value;
            var valorPesquisa = document.getElementById("valorPesquisa").value;

            var url = "";
            switch (tipoPesquisa) {
                case "jogador":
                    url = "CtrJogador.php?getJogador&CPFJoga=" + valorPesquisa;
                    break;
                case "treinador":
                    url = "CtrTreinador.php?getTreinador&CPFTreina=" + valorPesquisa;
                    break;
                case "time":
                    url = "CtrTime.php?getTime&CodTime=" + valorPesquisa;
                    break;
                case "jogo":
                    url = "CtrJogo.php?getJogo&CodJogo=" + valorPesquisa;
                    break;
                default:
                    alert("Tipo de pesquisa inválido");
                    return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", url);
            xhttp.send();

            xhttp.onload = function() {
                var resposta = JSON.parse(this.responseText);
                var organizar = "";

                if (resposta.length > 0) {
                    organizar += "<table><thead><tr>";

                    switch (tipoPesquisa) {
                        case "jogador":
                            organizar += "<th>CPF</th><th>Nome</th><th>Nascimento</th><th>Nascionalidade</th><th>Altura</th><th>Posição</th><th>Time</th><th>Perna Dominante</th>";
                            break;
                        case "treinador":
                            organizar += "<th>CPF</th><th>Nome</th><th>Time</th><th>Nascimento</th><th>Nacionalidade</th>";
                            break;
                        case "time":
                            organizar += "<th>Código</th><th>Nome</th><th>País</th><th>Treinador</th><th>Ano de Fundação</th>";
                            break;
                        case "jogo":
                            organizar += "<th>Código</th><th>Time da Casa</th><th>Time Visitante</th><th>Gols Casa</th><th>Gols Visitante</th><th>Data</th><th>Local</th><th>Público</th><th>Vencedor</th>";
                            break;
                    }

                    organizar += "</tr></thead><tbody>";

                    for (var i = 0; i < resposta.length; i++) {
                        organizar += "<tr>";

                        switch (tipoPesquisa) {
                            case "jogador":
                                organizar += "<td>" + resposta[i].CPFJoga + "</td>" +
                                    "<td>" + resposta[i].NomeJoga + "</td>" +
                                    "<td>" + resposta[i].NascJoga + "</td>" +
                                    "<td>" + resposta[i].NascionalJoga + "</td>" +
                                    "<td>" + resposta[i].AlturaJoga + "</td>" +
                                    "<td>" + resposta[i].PosicaoJoga + "</td>" +
                                    "<td>" + resposta[i].NomeTime + "</td>" +
                                    "<td>" + resposta[i].PernaJoga + "</td>";
                                break;
                            case "treinador":
                                organizar += "<td>" + resposta[i].CPFTreina + "</td>" +
                                    "<td>" + resposta[i].NomeTreina + "</td>" +
                                    "<td>" + resposta[i].NomeTime + "</td>" +
                                    "<td>" + resposta[i].NascTreina + "</td>" +
                                    "<td>" + resposta[i].NacionalTreina + "</td>";
                                break;
                            case "time":
                                organizar += "<td>" + resposta[i].CodTime + "</td>" +
                                    "<td>" + resposta[i].NomeTime + "</td>" +
                                    "<td>" + resposta[i].PaisTime + "</td>" +
                                    "<td>" + resposta[i].NomeTreina + "</td>" +
                                    "<td>" + resposta[i].AnoFunda + "</td>";
                                break;
                            case "jogo":
                                organizar += "<td>" + resposta[i].CodJogo + "</td>" +
                                    "<td>" + resposta[i].TimeCasa + "</td>" +
                                    "<td>" + resposta[i].TimeVisit + "</td>" +
                                    "<td>" + resposta[i].GolCasa + "</td>" +
                                    "<td>" + resposta[i].GolVist + "</td>" +
                                    "<td>" + resposta[i].DataJogo + "</td>" +
                                    "<td>" + resposta[i].LocalJogo + "</td>" +
                                    "<td>" + resposta[i].Publico + "</td>" +
                                    "<td>" + resposta[i].Vencedor + "</td>";
                                break;
                        }

                        organizar += "</tr>";
                    }

                    organizar += "</tbody></table>";
                } else {
                    organizar = "Nenhum registro encontrado";
                }

                document.getElementById('resultado').innerHTML = organizar;
            }
        }
    </script>
</body>
</html>