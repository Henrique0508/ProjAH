<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Consulta de Jogos</title>
    <link rel="stylesheet" type="text/css" href="adicionando.css" media="screen" />
</head>
<body onload="consultar()">
    <?php include "menu.php"; ?>

    <h2>Cadastro de Jogo</h2>

    <!-- Botão para abrir o modal de cadastro -->
    <button id="abrindoModalBtn">Clique para Inserir Dados</button>

    <!-- Modal de Cadastro -->
    <div id="meuModalCadastro" class="modal">
        <div class="modal-content">
            <form id="formCadastro" method="post">
                <span class="close" id="fecharModalCadastroBtn">&times;</span>
                <h5>Cadastro de Jogo</h5>
                <input id="CodJogo" name="CodJogo" placeholder="Código do Jogo" type="number" required/><br><br> 
                <input id="TimeCasa" name="TimeCasa" placeholder="Time da Casa" /><br><br>
                <input id="TimeVisit" name="TimeVisit" placeholder="Time Visitante" /><br><br>
                <input id="GolCasa" name="GolCasa" placeholder="Gols Time da Casa" type="number" oninput="verificarVencedor()" /><br><br>
                <input id="GolVist" name="GolVist" placeholder="Gols Time Visitante" type="number" oninput="verificarVencedor()" /><br><br>
                <label for="DataJogo">Data do Jogo:</label><br>
                <input id="DataJogo" name="DataJogo" type="date" /><br><br>
                <input id="LocalJogo" name="LocalJogo" placeholder="Local do Jogo" /><br><br>    
                <input id="Publico" name="Publico" placeholder="Público" type="number" /><br><br><br>
                <input type="hidden" id="Vencedor" name="Vencedor" />
                <button type="button" onclick="Gravar()">Cadastrar</button>
                <input type="reset" value="Limpar" name="Limpar" id="Limpar"> 
                <p id="resultadoCadastro"></p>
            </form>
        </div>
    </div>

    <h2>Lista de Jogos Cadastrados</h2>
    <div id="resultado">

    </div>

    <!-- Modal de Atualização -->
    <div id="meuModalAtualizacao" class="modal">
        <div class="modal-content">
            <form id="formAtualizacao" method="post">
                <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
                <h5>Atualização de Jogo</h5>
                <input id="CodJogoAtualizacao" name="CodJogo" placeholder="Código do Jogo" type="number" disabled/><br>    
                <input id="TimeCasaAtualizacao" name="TimeCasa" placeholder="Time da Casa" /><br>
                <input id="TimeVisitAtualizacao" name="TimeVisit" placeholder="Time Visitante" /><br>
                <input id="GolCasaAtualizacao" name="GolCasa" placeholder="Gols Time da Casa" type="number" oninput="verificarVencedorAtualizacao()" /><br>
                <input id="GolVistAtualizacao" name="GolVist" placeholder="Gols Time Visitante" type="number" oninput="verificarVencedorAtualizacao()" /><br>
                <label for="DataJogoAtualizacao">Data do Jogo:</label><br>
                <input id="DataJogoAtualizacao" name="DataJogo" type="date" /><br><br>
                <input id="LocalJogoAtualizacao" name="LocalJogo" placeholder="Local do Jogo" /><br>    
                <input id="PublicoAtualizacao" name="Publico" placeholder="Público" type="number" /><br>
                <input type="hidden" id="VencedorAtualizacao" name="Vencedor" />
                <button type="button" onclick="salvarAtualizacao()">Atualizar</button>
                <input type="reset" value="Limpar" name="Limpar" id="Limpar"> 
                <p id="resultadoAtualizacao"></p>
            </form>
        </div>
    </div>

    <script>
        // Função para verificar
        function verificarVencedor() {
            var golCasa = document.getElementById("GolCasa").value;
            var golVist = document.getElementById("GolVist").value;
            var vencedor = document.getElementById("Vencedor");

            if (golCasa > golVist) {
                vencedor.value = document.getElementById("TimeCasa").value;
            } else if (golCasa < golVist) {
                vencedor.value = document.getElementById("TimeVisit").value;
            } else {
                vencedor.value = "Empate";
            }
        }

        // Função para atualizar o vencedor 
        function verificarVencedorAtualizacao() {
            var golCasa = document.getElementById("GolCasaAtualizacao").value;
            var golVist = document.getElementById("GolVistAtualizacao").value;
            var vencedor = document.getElementById("VencedorAtualizacao");

            if (golCasa > golVist) {
                vencedor.value = document.getElementById("TimeCasaAtualizacao").value;
            } else if (golCasa < golVist) {
                vencedor.value = document.getElementById("TimeVisitAtualizacao").value;
            } else {
                vencedor.value = "Empate";
            }
        }

        // Função para consultar e exibir os dados cadastrados
        function consultar() {
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "CtrJogo.php?getJogo");
            xhttp.send();

            xhttp.onload = function() {
                var resposta = JSON.parse(this.responseText);
                var organizar = "<table><thead><tr><th>Código</th><th>Time da Casa</th><th>Time Visitante</th><th>Gols Casa</th><th>Gols Visitante</th><th>Data</th><th>Local</th><th>Público</th><th>Vencedor</th><th>Ações</th></tr></thead><tbody>";
                for (var i = 0; i < resposta.length; i++) {
                    organizar += "<tr><td>" + resposta[i].CodJogo + "</td>" +
                        "<td>" + resposta[i].TimeCasa + "</td>" +
                        "<td>" + resposta[i].TimeVisit + "</td>" +
                        "<td>" + resposta[i].GolCasa + "</td>" +
                        "<td>" + resposta[i].GolVist + "</td>" +
                        "<td>" + resposta[i].DataJogo + "</td>" +
                        "<td>" + resposta[i].LocalJogo + "</td>" +
                        "<td>" + resposta[i].Publico + "</td>" +
                        "<td>" + resposta[i].Vencedor + "</td>" +
                        "<td>" +
                        "<button class='action-button' onclick='atualizar(" + resposta[i].CodJogo + ")'>Atualizar</button>" +
                        "<button class='delete-button' onclick='apagar(" + resposta[i].CodJogo + ")'>Apagar</button>" +
                        "</td></tr>";
                }
                organizar += "</tbody></table>";
                document.getElementById('resultado').innerHTML = organizar;
            }
        }

        // Função para cadastrar um novo jogo
        function Gravar() {
            var form = document.getElementById("formCadastro");
            var formData = new FormData(form);

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrJogo.php?cadJogo", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "";
            for (var pair of formData.entries()) {
                data += encodeURIComponent(pair[0]) + "=" + encodeURIComponent(pair[1]) + "&";
            }
            data = data.slice(0, -1);

            xhttp.send(data);

            xhttp.onload = function() {
                document.getElementById("resultadoCadastro").innerHTML = this.responseText;
                consultar();
            };
        }

        // Função para abrir o modal de cadastro
        var modalCadastro = document.getElementById("meuModalCadastro");
        var btnCadastro = document.getElementById("abrindoModalBtn");
        var spanCadastro = document.getElementById("fecharModalCadastroBtn");

        btnCadastro.onclick = function() {
            modalCadastro.style.display = "block";
        }

        // Função para fechar o modal de cadastro
        spanCadastro.onclick = function() {
            modalCadastro.style.display = "none";
        }

        // Função para fechar a modal de cadastro se clicar fora dela
        window.onclick = function(event) {
            if (event.target == modalCadastro) {
                modalCadastro.style.display = "none";
            }
        }

        // Função para exibir os dados de um jogo para atualizar
        function atualizar(cod) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "CtrJogo.php?getJogo&CodJogo=" + cod);
            xhttp.send();

            xhttp.onload = function() {
                var jogo = JSON.parse(this.responseText)[0];
                document.getElementById("CodJogoAtualizacao").value = jogo.CodJogo;
                document.getElementById("TimeCasaAtualizacao").value = jogo.TimeCasa;
                document.getElementById("TimeVisitAtualizacao").value = jogo.TimeVisit;
                document.getElementById("GolCasaAtualizacao").value = jogo.GolCasa;
                document.getElementById("GolVistAtualizacao").value = jogo.GolVist;
                document.getElementById("DataJogoAtualizacao").value = jogo.DataJogo;
                document.getElementById("LocalJogoAtualizacao").value = jogo.LocalJogo;
                document.getElementById("PublicoAtualizacao").value = jogo.Publico;
                document.getElementById("VencedorAtualizacao").value = jogo.Vencedor;

                var modalAtualizacao = document.getElementById("meuModalAtualizacao");
                modalAtualizacao.style.display = "block";
            };
        }

        // Função para salvar as atualizações
        function salvarAtualizacao() {
            var cod = document.getElementById("CodJogoAtualizacao").value;
            var timeCasa = document.getElementById("TimeCasaAtualizacao").value;
            var timeVisit = document.getElementById("TimeVisitAtualizacao").value;
            var golCasa = document.getElementById("GolCasaAtualizacao").value;
            var golVist = document.getElementById("GolVistAtualizacao").value;
            var dataJogo = document.getElementById("DataJogoAtualizacao").value;
            var localJogo = document.getElementById("LocalJogoAtualizacao").value;
            var publico = document.getElementById("PublicoAtualizacao").value;
            var vencedor = document.getElementById("VencedorAtualizacao").value;

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrJogo.php?atuJogo", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "CodJogo=" + encodeURIComponent(cod) +
                "&TimeCasa=" + encodeURIComponent(timeCasa) +
                "&TimeVisit=" + encodeURIComponent(timeVisit) +
                "&GolCasa=" + encodeURIComponent(golCasa) +
                "&GolVist=" + encodeURIComponent(golVist) +
                "&DataJogo=" + encodeURIComponent(dataJogo) +
                "&LocalJogo=" + encodeURIComponent(localJogo) +
                "&Publico=" + encodeURIComponent(publico) +
                "&Vencedor=" + encodeURIComponent(vencedor);

            xhttp.send(data);

            xhttp.onload = function() {
                document.getElementById("resultadoAtualizacao").innerHTML = this.responseText;
                consultar();
                var modalAtualizacao = document.getElementById("meuModalAtualizacao");
                modalAtualizacao.style.display = "none";
            };
        }

        // Função para fechar o modal de atualização
        var modalAtualizacao = document.getElementById("meuModalAtualizacao");
        var spanAtualizacao = document.getElementById("fecharModalAtualizacaoBtn");

        spanAtualizacao.onclick = function() {
            modalAtualizacao.style.display = "none";
        }

        // Função para fechar o modal de atualização se clicar fora dela
        window.onclick = function(event) {
            if (event.target == modalAtualizacao) {
                modalAtualizacao.style.display = "none";
            }
        }

        // Função para apagar um jogo
        function apagar(cod) {
            var r = confirm("Você confirma que deseja apagar os dados?");
            if (r == true) {
                const xhttp = new XMLHttpRequest();
                xhttp.open("POST", "CtrJogo.php?delJogo", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                var data = "CodJogo=" + encodeURIComponent(cod);
                xhttp.send(data);

                xhttp.onload = function() {
                    document.getElementById("resultadoacao").innerHTML = this.responseText;
                    consultar();
                }
            } else {
                document.getElementById("resultadoacao").innerHTML = "Saindo...";
                consultar();
            }
        }
    </script>
</body>
</html>