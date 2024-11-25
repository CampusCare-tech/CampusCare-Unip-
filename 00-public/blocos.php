<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha de Blocos</title>
    <script>
        // Mostra a próxima etapa do formulário, ocultando a atual e configurando um valor, se necessário
        function mostrarProximaEtapa(etapaAtual, etapaProxima, campoId = null, valor = null) {
            if (campoId && valor) {
                document.getElementById(campoId).value = valor; // Define o valor do campo oculto
            }
            document.getElementById(etapaAtual).style.display = 'none'; // Esconde a etapa atual
            document.getElementById(etapaProxima).style.display = 'block'; // Mostra a próxima etapa
        }

        // Retorna para a etapa anterior no formulário
        function voltarEtapa(etapaAtual, etapaAnterior) {
            document.getElementById(etapaAtual).style.display = 'none'; // Esconde a etapa atual
            document.getElementById(etapaAnterior).style.display = 'block'; // Mostra a etapa anterior
        }

        // Valida o formulário antes de enviar para garantir que todos os campos estejam preenchidos
        function validarFormulario() {
            var bloco = document.getElementById('bloco').value;
            var localTipo = document.getElementById('local_tipo').value;
            var localIdentificacao = document.getElementById('local_identificacao').value;
            var descricao = document.getElementById('descricao').value;
            var tipoAssistencia = document.getElementById('tipo_assistencia').value;

            if (!bloco || !localTipo || !localIdentificacao || !descricao || !tipoAssistencia) {
                alert("Por favor, preencha todos os campos antes de enviar."); // Alerta de erro
                return false;
            }

            const confirmar = confirm("Você tem certeza que deseja enviar o formulário?");
            if (confirmar) {
                document.getElementById('formulario').submit(); // Envia o formulário
            }
        }

        // Marca o botão de tipo de assistência selecionado e define seu valor
        function selecionarTipoAssistencia(tipo) {
            document.querySelectorAll('.tipo-assistencia-btn').forEach(btn => btn.classList.remove('selecionado'));
            document.getElementById(tipo).classList.add('selecionado'); // Adiciona a classe "selecionado"
            document.getElementById('tipo_assistencia').value = tipo; // Define o valor oculto
        }

        // Valida o campo de identificação antes de avançar
        function validarIdentificacao() {
            const identificacao = document.getElementById('local_identificacao').value.trim();

            if (!identificacao) {
                alert("Por favor, preencha o campo de identificação antes de avançar."); // Alerta se vazio
            } else {
                mostrarProximaEtapa('etapaIdentificacao', 'etapaDetalhes'); // Avança para a próxima etapa
            }
        }
    </script>
</head>
<body>
    <form id="formulario" action="../01-includes/processar.php" method="post">
        <!-- Etapa 1: Escolha do Bloco -->
        <div id="etapaBloco">
            <h2>Escolha o Bloco</h2>
            <br>
            <?php
                // Lista de blocos disponíveis
                $blocos = [
                    "Bloco A", "Bloco B", "Bloco C", "Bloco D",
                    "Bloco E", "Bloco F", "Bloco G", "Bloco H",
                    "Bloco I", "Bloco J", "Bloco K", "Bloco L",
                    "Bloco M", "Bloco N", "Bloco O", "Bloco P",
                    "Bloco Q", "Bloco R", "Bloco S", "Bloco CT",
                    "Auditório", "Reitoria", "Biblioteca", "Ginásio",
                    "Bloco EVA"
                ];

                // Cria botões para cada bloco que avançam para a próxima etapa
                foreach ($blocos as $bloco) {
                    echo '<button type="button" class="btn-12" onclick="mostrarProximaEtapa(\'etapaBloco\', \'etapaLugar\', \'bloco\', \'' . $bloco . '\')">' . $bloco . '</button>';
                }
            ?>
        </div>

        <!-- Etapa 2: Escolha do Local -->
        <div id="etapaLugar" style="display:none;">
            <h2>Escolha o Local</h2>
            <br>
            <!-- Botões para escolha de tipos de locais -->
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Sala')">Sala</button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Banheiro')">Banheiro</button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Elevador')">Elevador</button>
            <br>
            <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaLugar', 'etapaBloco')">Voltar</button>
        </div>

        <!-- Etapa 3: Identificação -->
        <div id="etapaIdentificacao" style="display:none;">
            <h2>Identifique o Local</h2>
            <br>
            <!-- Campo de texto para identificação -->
            <label for="local_identificacao">Identificação:</label>
            <input type="text" id="local_identificacao" name="local_identificacao" placeholder="Ex: Sala 1" required>
            <br>
            <button type="button" class="btn-12 destaque" onclick="validarIdentificacao()">Avançar</button>
            <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaIdentificacao', 'etapaLugar')">Voltar</button>
        </div>

        <!-- Etapa 4: Detalhes -->
        <div id="etapaDetalhes" style="display:none;">
            <h2>Detalhes do Problema</h2>
            <br>
            <!-- Campo para descrição -->
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
            <br>
            <!-- Botões para tipo de assistência -->
            <button type="button" class="btn-12 tipo-assistencia-btn" id="manutencao" onclick="selecionarTipoAssistencia('manutencao')">Manutenção</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="limpeza" onclick="selecionarTipoAssistencia('limpeza')">Limpeza</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="seguranca" onclick="selecionarTipoAssistencia('seguranca')">Segurança</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="saude" onclick="selecionarTipoAssistencia('saude')">Saúde</button>
            <input type="hidden" id="tipo_assistencia" name="tipo_assistencia">
            <br>
            <div class="action-buttons">
                <button type="button" class="btn-12 destaque" onclick="validarFormulario()">Enviar</button>
                <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaDetalhes', 'etapaIdentificacao')">Voltar</button>
            </div>
        </div>

        <!-- Campos ocultos para armazenar dados -->
        <input type="hidden" id="bloco" name="bloco">
        <input type="hidden" id="local_tipo" name="local_tipo">
    </form>
</body>
</html>
