<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Consulta</title>
    <link rel="stylesheet" type="text/css" href="adicionando.css" media="screen" />
</head>
<body onload="consultar()">
    <?php include "menu.php"; ?>

    <h2>Cadastro de Jogador</h2>

    <!-- Botão para abrir o modal de cadastro -->
    <button id="abrindoModalBtn">Clique para Inserir Dados</button>

    <!-- Modal de Cadastro -->
    <div id="meuModalCadastro" class="modal">
        <div class="modal-content">
            <form id="formCadastro" method="post">
                <span class="close" id="fecharModalCadastroBtn">&times;</span>
                <h5>Cadastro de jogador</h5>
                <input id="CPFJoga" name="CPFJoga" placeholder="CPF" type="text" pattern="\d{11}"required/><br>    
                <input id="NomeJoga" name="NomeJoga" placeholder="Nome"/><br><br>
                <label for="NascJoga">Nascimento:</label><br>
                <input id="NascJoga" name="NascJoga" type="date"/><br><br>
                <input id="NascionalJoga" name="NascionalJoga" placeholder="Nascionalidade" /><br><br>    
                <input id="AlturaJoga" name="AlturaJoga" placeholder="Altura" type="number" step="0.01"/><br><br>
                <label for="PosicaoJoga">Posição:</label><br>
                <select id="PosicaoJoga" name="PosicaoJoga" required>
                    <option value="Goleiro">Goleiro</option>
                    <option value="Defensor">Defensor</option>
                    <option value="Meio">Meio-Campo</option>
                    <option value="Atacante">Atacante</option>
                </select>
                <br><br>
                <input id="NomeTime" name="NomeTime" placeholder="Time" /><br><br>
                <label for="PernaJoga">Perna Dominante: </label>
                <input type="radio" name="PernaJoga" id="destro" value="Destro" checked>
                <label for="destro">Destro</label>
                <input type="radio" name="PernaJoga" id="canhoto" value="Canhoto">
                <label for="canhoto">Canhoto</label>
                <br><br>
                <button type="button" onclick="Gravar()">Cadastrar</button>
                <input type="reset" value="Limpar" name="Limpar" id="Limpar"> 
                <p id="resultadoCadastro"></p>
            </form>
        </div>
    </div>

    <h2>Lista de Jogadores Cadastrados</h2>
    <div id="resultado">

    </div>

    <!-- Modal de Atualização -->
    <div id="meuModalAtualizacao" class="modal">
        <div class="modal-content">
            <form id="formAtualizacao" method="post">
                <span class="close" id="fecharModalAtualizacaoBtn">&times;</span>
                <h5>Atualização de jogador</h5>
                <input id="CPFJogaAtualizacao" name="CPFJoga" placeholder="CPF" type="text" pattern="\d{11}" title="O CPF deve conter 11 dígitos numéricos" disabled/><br>    
                <input id="NomeJogaAtualizacao" name="NomeJoga" placeholder="Nome" /><br>
                <label for="NascJogaAtualizacao">Nascimento:</label><br>
                <input id="NascJogaAtualizacao" name="NascJoga" type="date" /><br><br>
                <input id="NascionalJogaAtualizacao" name="NascionalJoga" placeholder="Nascionalidade" /><br>    
                <input id="AlturaJogaAtualizacao" name="AlturaJoga" placeholder="Altura" type="number" step="0.01"/><br>
                <label for="PosicaoJogaAtualizacao">Posição:</label>
                <select id="PosicaoJogaAtualizacao" name="PosicaoJoga" required>
                    <option value="Goleiro">Goleiro</option>
                    <option value="Defensor">Defensor</option>
                    <option value="Meio">Meio-Campo</option>
                    <option value="Atacante">Atacante</option>
                </select>
                <br><br>
                <input id="NomeTimeAtualizacao" name="NomeTime" placeholder="Time" /><br>
                <label for="PernaJogaAtualizacao">Perna Dominante: </label>
                <input type="radio" name="PernaJoga" id="destroAtualizacao" value="Destro" checked>
                <label for="destroAtualizacao">Destro</label>
                <input type="radio" name="PernaJoga" id="canhotoAtualizacao" value="Canhoto">
                <label for="canhotoAtualizacao">Canhoto</label>
                <br><br>
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
            xhttp.open("GET", "CtrJogador.php?getJogador");
            xhttp.send();

            xhttp.onload = function() {
                var resposta = JSON.parse(this.responseText);
                var organizar = "<table><thead><tr><th>CPF</th><th>Nome</th><th>Nascimento</th><th>Nascionalidade</th><th>Altura</th><th>Posição</th><th>Time</th><th>Perna Dominante</th><th>Ações</th></tr></thead><tbody>";
                for (var i = 0; i < resposta.length; i++) {
                    organizar += "<tr><td>" + resposta[i].CPFJoga + "</td>" +
                        "<td>" + resposta[i].NomeJoga + "</td>" +
                        "<td>" + resposta[i].NascJoga + "</td>" +
                        "<td>" + resposta[i].NascionalJoga + "</td>" +
                        "<td>" + resposta[i].AlturaJoga + "</td>" +
                        "<td>" + resposta[i].PosicaoJoga + "</td>" +
                        "<td>" + resposta[i].NomeTime + "</td>" +
                        "<td>" + resposta[i].PernaJoga + "</td>" +
                        "<td>" +
                        "<button class='action-button' onclick='atualizar(" + resposta[i].CPFJoga + ")'>Atualizar</button>" +
                        "<button class='delete-button' onclick='apagar(" + resposta[i].CPFJoga + ")'>Apagar</button>" +
                        "</td></tr>";
                }
                organizar += "</tbody></table>";
                document.getElementById('resultado').innerHTML = organizar;
            }
        }

        // Função para cadastrar um novo jogador
        function Gravar() {
            var form = document.getElementById("formCadastro");
            var formData = new FormData(form);

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrJogador.php?cadJoga", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = "";
            for (var pair of formData.entries()) {
                data += encodeURIComponent(pair[0]) + "=" + encodeURIComponent(pair[1]) + "&";
            }
            data = data.slice(0, -1); // Remove o último &

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

        // Função para exibir os dados de um jogador para atualizar
        function atualizar(cpf) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "CtrJogador.php?getJogador&CPFJoga=" + cpf);
            xhttp.send();

            xhttp.onload = function() {
                var jogador = JSON.parse(this.responseText)[0];
                document.getElementById("CPFJogaAtualizacao").value = jogador.CPFJoga;
                document.getElementById("NomeJogaAtualizacao").value = jogador.NomeJoga;
                document.getElementById("NascJogaAtualizacao").value = jogador.NascJoga;
                document.getElementById("NascionalJogaAtualizacao").value = jogador.NascionalJoga;
                document.getElementById("AlturaJogaAtualizacao").value = jogador.AlturaJoga;
                document.getElementById("PosicaoJogaAtualizacao").value = jogador.PosicaoJoga;
                document.getElementById("NomeTimeAtualizacao").value = jogador.NomeTime;
                document.getElementById("destroAtualizacao").checked = jogador.PernaJoga === "Destro";
                document.getElementById("canhotoAtualizacao").checked = jogador.PernaJoga === "Canhoto";

                var modalAtualizacao = document.getElementById("meuModalAtualizacao");
                modalAtualizacao.style.display = "block";
            };
        }

        // Função para salvar as atualizações
        function salvarAtualizacao() {
            var cpf = document.getElementById("CPFJogaAtualizacao").value;
            var nome = document.getElementById("NomeJogaAtualizacao").value;
            var nascimento = document.getElementById("NascJogaAtualizacao").value;
            var nacionalidade = document.getElementById("NascionalJogaAtualizacao").value;
            var altura = document.getElementById("AlturaJogaAtualizacao").value;
            var posicao = document.getElementById("PosicaoJogaAtualizacao").value;
            var time = document.getElementById("NomeTimeAtualizacao").value;
            var perna = document.querySelector('input[name="PernaJoga"]:checked').value;

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "CtrJogador.php?atuJoga", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                var data = "CPFJoga=" + encodeURIComponent(cpf) +
                "&NomeJoga=" + encodeURIComponent(nome) +
                "&NascJoga=" + encodeURIComponent(nascimento) +
                "&NascionalJoga=" + encodeURIComponent(nacionalidade) +
                "&AlturaJoga=" + encodeURIComponent(altura) +
                "&PosicaoJoga=" + encodeURIComponent(posicao) +
                "&NomeTime=" + encodeURIComponent(time) +
                "&PernaJoga=" + encodeURIComponent(perna);

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

        // Função para apagar um jogador
        function apagar(cpf) {
            var r = confirm("Você confirma que deseja apagar os dados?");
            if (r == true) {
                const xhttp = new XMLHttpRequest();
                xhttp.open("POST", "CtrJogador.php?delJoga", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                var data = "CPFJoga=" + encodeURIComponent(cpf);
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