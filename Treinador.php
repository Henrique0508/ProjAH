<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Consulta de Treinadores</title>
    <link rel="stylesheet" type="text/css" href="adicionando.css" media="screen" />
</head>
<body onload="consultar()">
    <?php include "menu.php"; ?>

    <h2>Cadastro de Treinador</h2>

    <!-- Botão para abrir o modal de cadastro -->
    <button id="abrindoModalBtn">Clique para Inserir Dados</button>

    <!-- Modal de Cadastro -->
    <div id="meuModalCadastro" class="modal">
        <div class="modal-content">
            <form id="formCadastro" method="post">
                <span class="close" id="fecharModalCadastroBtn">&times;</span>
                <h5>Cadastro de Treinador</h5>
                <input id="CPFTreina" name="CPFTreina" placeholder="CPF" type="text" pattern="\d{11}" title="O CPF deve conter 11 dígitos numéricos" required/><br><br>    
                <input id="NomeTreina" name="NomeTreina" placeholder="Nome do Treinador" /><br><br>
                <input id="NomeTime" name="NomeTime" placeholder="Nome do Time" /><br><br>
                <label for="NascTreina">Nascimento:</label><br>
                <input id="NascTreina" name="NascTreina" type="date" /><br><br>
                <input id="NacionalTreina" name="NacionalTreina" placeholder="Nacionalidade" /><br><br>
                <button type="button" onclick="Gravar()">Cadastrar</button>
                <input type="reset" value="Limpar" name="Limpar" id="Limpar"> 
                <p id="resultadoCadastro"></p>
            </form>
        </div>
    </div>

    <h2>Lista de Treinadores Cadastrados</h2>
    <div id="resultado">

    </div>

    <!-- Modal de Atualização -->
    <div id="meuModalAtualizacao" class="modal">
        <div class="modal-content">
            <form id="formAtualizacao" method="post">
                <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
                <h5>Atualização de Treinador</h5>
                <input id="CPFTreinaAtualizacao" name="CPFTreina" placeholder="CPF" type="text" pattern="\d{11}" title="O CPF deve conter 11 dígitos numéricos" disabled/><br>    
                <input id="NomeTreinaAtualizacao" name="NomeTreina" placeholder="Nome do Treinador" /><br>
                <input id="NomeTimeAtualizacao" name="NomeTime" placeholder="Nome do Time" /><br>
                <label for="NascTreinaAtualizacao">Nascimento:</label><br>
                <input id="NascTreinaAtualizacao" name="NascTreina" type="date" /><br><br>
                <input id="NacionalTreinaAtualizacao" name="NacionalTreina" placeholder="Nacionalidade" /><br>    
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
            xhttp.open("GET", "CtrTreinador.php?getTreinador");
            xhttp.send();

            xhttp.onload = function() {
                var resposta = JSON.parse(this.responseText);
                var organizar = "<table><thead><tr><th>CPF</th><th>Nome do Treinador</th><th>Nome do Time</th><th>Nascimento</th><th>Nacionalidade</th><th>Ações</th></tr></thead><tbody>";
                for (var i = 0; i < resposta.length; i++) {
                    organizar += "<tr><td>" + resposta[i].CPFTreina + "</td>" +
                        "<td>" + resposta[i].NomeTreina + "</td>" +
                        "<td>" + resposta[i].NomeTime + "</td>" +
                        "<td>" + resposta[i].NascTreina + "</td>" +
                        "<td>" + resposta[i].NacionalTreina + "</td>" +
                        "<td>" +
                        "<button class='action-button' onclick='atualizar(" + resposta[i].CPFTreina + ")'>Atualizar</button>" +
                        "<button class='delete-button' onclick='apagar(" + resposta[i].CPFTreina + ")'>Apagar</button>" +
                        "</td></tr>";
                }
                organizar += "</tbody></table>";
                document.getElementById('resultado').innerHTML = organizar;
            }
        }

        // Função para cadastrar um novo treinador
        function Gravar() {
            var form = document.getElementById("formCadastro");
            var formData = new FormData(form);

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrTreinador.php?cadTreinador", true);
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

        // Função para exibir os dados de um treinador para atualizar
        function atualizar(cpf) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "CtrTreinador.php?getTreinador&CPFTreina=" + cpf);
            xhttp.send();

            xhttp.onload = function() {
                var treinador = JSON.parse(this.responseText)[0];
                document.getElementById("CPFTreinaAtualizacao").value = treinador.CPFTreina;
                document.getElementById("NomeTreinaAtualizacao").value = treinador.NomeTreina;
                document.getElementById("NomeTimeAtualizacao").value = treinador.NomeTime;
                document.getElementById("NascTreinaAtualizacao").value = treinador.NascTreina;
                document.getElementById("NacionalTreinaAtualizacao").value = treinador.NacionalTreina;

                var modalAtualizacao = document.getElementById("meuModalAtualizacao");
                modalAtualizacao.style.display = "block";
            };
        }

        // Função para salvar as atualizações
        function salvarAtualizacao() {
            var cpf = document.getElementById("CPFTreinaAtualizacao").value;
            var nome = document.getElementById("NomeTreinaAtualizacao").value;
            var time = document.getElementById("NomeTimeAtualizacao").value;
            var nascimento = document.getElementById("NascTreinaAtualizacao").value;
            var nacionalidade = document.getElementById("NacionalTreinaAtualizacao").value;

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrTreinador.php?atuTreinador", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "CPFTreina=" + encodeURIComponent(cpf) +
                "&NomeTreina=" + encodeURIComponent(nome) +
                "&NomeTime=" + encodeURIComponent(time) +
                "&NascTreina=" + encodeURIComponent(nascimento) +
                "&NacionalTreina=" + encodeURIComponent(nacionalidade);

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

        // Função para apagar um treinador
        function apagar(cpf) {
            var r = confirm("Você confirma que deseja apagar os dados?");
            if (r == true) {
                const xhttp = new XMLHttpRequest();
                xhttp.open("POST", "CtrTreinador.php?delTreinador", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                var data = "CPFTreina=" + encodeURIComponent(cpf);
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