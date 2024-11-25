<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Define o idioma da página como português do Brasil -->
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura o site para dispositivos móveis -->
    <title>Escolha de Blocos</title> <!-- Título exibido na aba do navegador -->

    <script>
        // Função para avançar de uma etapa para outra
        function mostrarProximaEtapa(etapaAtual, etapaProxima, campoId = null, valor = null) {
            if (campoId && valor) { // Se um campo e valor forem fornecidos, preenche o campo com o valor
                document.getElementById(campoId).value = valor;
            }
            document.getElementById(etapaAtual).style.display = 'none'; // Esconde a etapa atual
            document.getElementById(etapaProxima).style.display = 'block'; // Mostra a próxima etapa
        }

        // Função para voltar para a etapa anterior
        function voltarEtapa(etapaAtual, etapaAnterior) {
            document.getElementById(etapaAtual).style.display = 'none'; // Esconde a etapa atual
            document.getElementById(etapaAnterior).style.display = 'block'; // Mostra a etapa anterior
        }

        // Função para validar o formulário antes de enviar
        function validarFormulario() {
            // Obtém os valores dos campos do formulário
            var bloco = document.getElementById('bloco').value;
            var localTipo = document.getElementById('local_tipo').value;
            var localIdentificacao = document.getElementById('local_identificacao').value;
            var descricao = document.getElementById('descricao').value;
            var tipoAssistencia = document.getElementById('tipo_assistencia').value;

            // Verifica se todos os campos foram preenchidos
            if (!bloco || !localTipo || !localIdentificacao || !descricao || !tipoAssistencia) {
                alert("Por favor, preencha todos os campos antes de enviar."); // Exibe mensagem de alerta
                return false;
            }

            // Confirmação antes de enviar o formulário
            const confirmar = confirm("Você tem certeza que deseja enviar o formulário?");
            if (confirmar) {
                document.getElementById('formulario').submit(); // Envia o formulário
            }
        }

        // Função para selecionar o tipo de assistência
        function selecionarTipoAssistencia(tipo) {
            // Remove a classe "selecionado" de todos os botões
            document.querySelectorAll('.tipo-assistencia-btn').forEach(btn => btn.classList.remove('selecionado'));
            // Adiciona a classe "selecionado" ao botão clicado
            document.getElementById(tipo).classList.add('selecionado');
            document.getElementById('tipo_assistencia').value = tipo; // Define o valor do campo escondido
        }

        // Valida o campo de identificação antes de avançar
        function validarIdentificacao() {
            const identificacao = document.getElementById('local_identificacao').value.trim();

            if (!identificacao) { // Exibe alerta se o campo estiver vazio
                alert("Por favor, preencha o campo de identificação antes de avançar.");
            } else {
                mostrarProximaEtapa('etapaIdentificacao', 'etapaDetalhes'); // Avança para a próxima etapa
            }
        }
    </script>
</head>
<body>
    <form id="formulario" action="../01-includes/processar.php" method="post">
        <!-- Etapa de seleção do bloco -->
        <div id="etapaBloco">
            <h2>Escolha o Bloco</h2>
            <br>
            <?php
                // Lista de blocos exibidos como botões
                $blocos = [
                    "Bloco A", "Bloco B", "Bloco C", "Bloco D",
                    "Bloco E", "Bloco F", "Bloco G", "Bloco H",
                    "Bloco I", "Bloco J", "Bloco K", "Bloco L",
                    "Bloco M", "Bloco N", "Bloco O", "Bloco P",
                    "Bloco Q", "Bloco R", "Bloco S", "Bloco CT",
                    "Auditório", "Reitoria", "Biblioteca", "Ginásio",
                    "Bloco EVA"
                ];

                // Gera botões dinamicamente para cada bloco
                foreach ($blocos as $bloco) {
                    echo '<button type="button" class="btn-12" onclick="mostrarProximaEtapa(\'etapaBloco\', \'etapaLugar\', \'bloco\', \'' . $bloco . '\')">' . $bloco . '</button>';
                }
            ?>
        </div>

        <!-- Etapa de escolha do local -->
        <div id="etapaLugar" style="display:none;">
            <h2>Escolha o Local</h2>
            <br>
            <!-- Botões para selecionar o tipo de local -->
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Sala')">Sala</button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Banheiro')">Banheiro</button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Elevador')">Elevador</button>
            <br>
            <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaLugar', 'etapaBloco')">Voltar</button>
        </div>

        <!-- Etapa de identificação do local -->
        <div id="etapaIdentificacao" style="display:none;">
            <h2>Identifique o Local</h2>
            <br>
            <!-- Campo de identificação -->
            <label for="local_identificacao">Identificação:</label>
            <input type="text" id="local_identificacao" name="local_identificacao" placeholder="Ex: Sala 1" required>
            <br>
            <button type="button" class="btn-12 destaque" onclick="validarIdentificacao()">Avançar</button>
            <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaIdentificacao', 'etapaLugar')">Voltar</button>
        </div>

        <!-- Etapa de detalhes do problema -->
        <div id="etapaDetalhes" style="display:none;">
            <h2>Detalhes do Problema</h2>
            <br>
            <!-- Campo de descrição -->
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
            <br>
            <!-- Botões para selecionar o tipo de assistência -->
            <button type="button" class="btn-12 tipo-assistencia-btn" id="manutencao" onclick="selecionarTipoAssistencia('manutencao')">Manutenção</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="limpeza" onclick="selecionarTipoAssistencia('limpeza')">Limpeza</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="seguranca" onclick="selecionarTipoAssistencia('seguranca')">Segurança</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="saude" onclick="selecionarTipoAssistencia('saude')">Saúde</button>
            <input type="hidden" id="tipo_assistencia" name="tipo_assistencia">
            <br>
            <!-- Botões de navegação -->
            <div class="action-buttons">
                <button type="button" class="btn-12 destaque" onclick="validarFormulario()">Enviar</button>
                <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaDetalhes', 'etapaIdentificacao')">Voltar</button>
            </div>
        </div>

        <!-- Campos ocultos para armazenar os dados das etapas -->
        <input type="hidden" id="bloco" name="bloco">
        <input type="hidden" id="local_tipo" name="local_tipo">
    </form>
</body>
</html>
