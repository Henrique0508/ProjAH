<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Consulta de Times</title>
    <link rel="stylesheet" type="text/css" href="adicionando.css" media="screen" />
</head>
<body onload="consultar()">
    <?php include "menu.php"; ?>

    <h2>Cadastro de Time</h2>

    <!-- Botão para abrir o modal de cadastro -->
    <button id="abrindoModalBtn">Clique para Inserir Dados</button>

    <!-- Modal de Cadastro -->
    <div id="meuModalCadastro" class="modal">
        <div class="modal-content">
            <form id="formCadastro" method="post">
                <span class="close" id="fecharModalCadastroBtn">&times;</span>
                <h5>Cadastro de Time</h5>
                <input id="CodTime" name="CodTime" placeholder="Código do Time" type="number" required/><br><br>    
                <input id="NomeTime" name="NomeTime" placeholder="Nome do Time" /><br><br>
                <input id="PaisTime" name="PaisTime" placeholder="País do Time" /><br><br>
                <input id="NomeTreina" name="NomeTreina" placeholder="Nome do Treinador" /><br><br>
                <label for="AnoFunda">Ano de Fundação:</label><br>
                <input id="AnoFunda" name="AnoFunda" type="date" /><br><br>
                <button type="button" onclick="Gravar()">Cadastrar</button>
                <input type="reset" value="Limpar" name="Limpar" id="Limpar"> 
                <p id="resultadoCadastro"></p>
            </form>
        </div>
    </div>

    <h2>Lista de Times Cadastrados</h2>
    <div id="resultado">

    </div>

    <!-- Modal de Atualização -->
    <div id="meuModalAtualizacao" class="modal">
        <div class="modal-content">
            <form id="formAtualizacao" method="post">
                <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
                <h5>Atualização de Time</h5>
                <input id="CodTimeAtualizacao" name="CodTime" placeholder="Código do Time" type="number" disabled/><br>    
                <input id="NomeTimeAtualizacao" name="NomeTime" placeholder="Nome do Time" /><br>
                <input id="PaisTimeAtualizacao" name="PaisTime" placeholder="País do Time" /><br>
                <input id="NomeTreinaAtualizacao" name="NomeTreina" placeholder="Nome do Treinador" /><br>
                <label for="AnoFundaAtualizacao">Ano de Fundação:</label><br>
                <input id="AnoFundaAtualizacao" name="AnoFunda" type="date" /><br><br>
                <button type="button" onclick="salvarAtualizacao()">Atualizar</button>
                <input type="reset" value="Limpar" name="Limpar" id="Limpar"> 
                <p id="resultadoAtualizacao"></p>
            </form>
        </div>
    </div>

    <script>
        // Função para consultar e exibir os dados cadastrados
        function consultar() {
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "CtrTime.php?getTime");
            xhttp.send();

            xhttp.onload = function() {
                var resposta = JSON.parse(this.responseText);
                var organizar = "<table><thead><tr><th>Código</th><th>Nome do Time</th><th>País</th><th>Nome do Treinador</th><th>Ano de Fundação</th><th>Ações</th></tr></thead><tbody>";
                for (var i = 0; i < resposta.length; i++) {
                    organizar += "<tr><td>" + resposta[i].CodTime + "</td>" +
                        "<td>" + resposta[i].NomeTime + "</td>" +
                        "<td>" + resposta[i].PaisTime + "</td>" +
                        "<td>" + resposta[i].NomeTreina + "</td>" +
                        "<td>" + resposta[i].AnoFunda + "</td>" +
                        "<td>" +
                        "<button class='action-button' onclick='atualizar(" + resposta[i].CodTime + ")'>Atualizar</button>" +
                        "<button class='delete-button' onclick='apagar(" + resposta[i].CodTime + ")'>Apagar</button>" +
                        "</td></tr>";
                }
                organizar += "</tbody></table>";
                document.getElementById('resultado').innerHTML = organizar;
            }
        }

        // Função para cadastrar um novo time
        function Gravar() {
            var form = document.getElementById("formCadastro");
            var formData = new FormData(form);

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrTime.php?cadTime", true);
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

        // Função para exibir os dados de um time para atualizar
        function atualizar(cod) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "CtrTime.php?getTime&CodTime=" + cod);
            xhttp.send();

            xhttp.onload = function() {
                var time = JSON.parse(this.responseText)[0];
                document.getElementById("CodTimeAtualizacao").value = time.CodTime;
                document.getElementById("NomeTimeAtualizacao").value = time.NomeTime;
                document.getElementById("PaisTimeAtualizacao").value = time.PaisTime;
                document.getElementById("NomeTreinaAtualizacao").value = time.NomeTreina;
                document.getElementById("AnoFundaAtualizacao").value = time.AnoFunda;

                var modalAtualizacao = document.getElementById("meuModalAtualizacao");
                modalAtualizacao.style.display = "block";
            };
        }

        // Função para salvar as atualizações
        function salvarAtualizacao() {
            var cod = document.getElementById("CodTimeAtualizacao").value;
            var nome = document.getElementById("NomeTimeAtualizacao").value;
            var pais = document.getElementById("PaisTimeAtualizacao").value;
            var treinador = document.getElementById("NomeTreinaAtualizacao").value;
            var ano = document.getElementById("AnoFundaAtualizacao").value;

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrTime.php?atuTime", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "CodTime=" + encodeURIComponent(cod) +
                "&NomeTime=" + encodeURIComponent(nome) +
                "&PaisTime=" + encodeURIComponent(pais) +
                "&NomeTreina=" + encodeURIComponent(treinador) +
                "&AnoFunda=" + encodeURIComponent(ano);

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

        // Função para apagar um time
        function apagar(cod) {
            var r = confirm("Você confirma que deseja apagar os dados?");
            if (r == true) {
                const xhttp = new XMLHttpRequest();
                xhttp.open("POST", "CtrTime.php?delTime", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                var data = "CodTime=" + encodeURIComponent(cod);
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