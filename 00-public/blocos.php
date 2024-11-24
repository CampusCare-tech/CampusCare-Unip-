<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha de Blocos</title>

    <script>
        function mostrarProximaEtapa(etapaAtual, etapaProxima, campoId = null, valor = null) {
            if (campoId && valor) {
                document.getElementById(campoId).value = valor; // Define o valor do campo oculto
            }
            document.getElementById(etapaAtual).style.display = 'none'; // Esconde a etapa atual
            document.getElementById(etapaProxima).style.display = 'block'; // Mostra a próxima etapa
        }

        function voltarEtapa(etapaAtual, etapaAnterior) {
            document.getElementById(etapaAtual).style.display = 'none'; // Esconde a etapa atual
            document.getElementById(etapaAnterior).style.display = 'block'; // Mostra a etapa anterior
        }

        // Função de validação antes de confirmação do envio
        function validarFormulario() {
            // Verifica se todos os campos obrigatórios estão preenchidos
            var bloco = document.getElementById('bloco').value;
            var lugar = document.getElementById('lugar').value;
            var descricao = document.getElementById('descricao').value;
            var tipoAssistencia = document.getElementById('tipo_assistencia').value;

            if (bloco === "" || lugar === "" || descricao === "" || tipoAssistencia === "") {
                alert("Por favor, preencha todos os campos antes de enviar.");
                return false; // Impede o envio do formulário
            }

            // Se todos os campos estiverem preenchidos, solicita confirmação
            var confirmar = confirm("Você tem certeza que deseja enviar o formulário com as opções selecionadas?");
            if (confirmar) {
                // Envia o formulário se o usuário confirmar
                document.getElementById('formulario').submit();
            }
        }

        // Função para aplicar a cor azul e dourado nos botões de tipo de assistência
        function selecionarTipoAssistencia(tipo) {
            // Remove a classe 'selecionado' de todos os botões
            var botoes = document.querySelectorAll('.tipo-assistencia-btn');
            botoes.forEach(function(btn) {
                btn.classList.remove('selecionado');
            });

            // Adiciona a classe 'selecionado' no botão clicado
            var botaoSelecionado = document.getElementById(tipo);
            botaoSelecionado.classList.add('selecionado');

            // Define o valor do campo oculto para o tipo de assistência
            document.getElementById('tipo_assistencia').value = tipo;
        }
    </script>
</head>
<body>
    <form id="formulario" action="processar.php" method="post">
        <!-- Etapa 1: Escolher Bloco -->
        <div id="etapaBloco">
            <h2>Escolha o Bloco</h2>
            <?php
                $blocos = [
                    "Bloco A", "Bloco B", "Bloco C", "Bloco D",
                    "Bloco E", "Bloco F", "Bloco G", "Bloco H",
                    "Bloco I", "Bloco J", "Bloco K", "Bloco L",
                    "Bloco M", "Bloco N", "Bloco O", "Bloco P",
                    "Bloco Q", "Bloco R", "Bloco S", "Bloco CT",
                    "Auditório", "Reitoria", "Biblioteca", "Ginásio",
                    "Bloco EVA"
                ];

                foreach ($blocos as $bloco) {
                    echo '<button type="button" class="btn-12" onclick="mostrarProximaEtapa(\'etapaBloco\', \'etapaLugar\', \'bloco\', \'' . $bloco . '\')">
                            <span>' . $bloco . '</span>
                          </button>';
                }
            ?>
        </div>

        <!-- Etapa Lugar -->
        <div id="etapaLugar" style="display:none;">
            <h2>Escolha o Local</h2>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaDetalhes', 'lugar', 'Sala')"><span>Sala</span></button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaDetalhes', 'lugar', 'Banheiro')"><span>Banheiro</span></button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaDetalhes', 'lugar', 'Elevador')"><span>Elevador</span></button>
            <br>
            <!-- Botão Voltar -->
            <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaLugar', 'etapaBloco')"><span>Voltar</span></button>
        </div>

        <!-- Etapa 3: Detalhes -->
        <div id="etapaDetalhes" style="display:none;">
            <h2>Detalhes do Problema</h2>

            <label for="bloco">Bloco:</label>
            <input type="text" id="bloco" name="bloco" readonly required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <!-- Botões de tipo de assistência com alteração de cor -->
            <button type="button" class="btn-12 tipo-assistencia-btn" id="manutencao" onclick="selecionarTipoAssistencia('manutencao')">Registrar Manutenção</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="limpeza" onclick="selecionarTipoAssistencia('limpeza')">Registrar Limpeza</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="seguranca" onclick="selecionarTipoAssistencia('seguranca')">Registrar Segurança</button>
            <button type="button" class="btn-12 tipo-assistencia-btn" id="saude" onclick="selecionarTipoAssistencia('saude')">Registrar Saúde</button>

            <!-- Campo oculto para o tipo de assistência -->
            <input type="hidden" id="tipo_assistencia" name="tipo_assistencia">

            <!-- Botão de confirmação para enviar -->
            <button type="button" class="btn-12 destaque" onclick="validarFormulario()">Confirmar Envio</button>

            <!-- Botão Voltar -->
            <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaDetalhes', 'etapaLugar')"><span>Voltar</span></button>
        </div>

        <!-- Campos ocultos -->
        <input type="hidden" id="bloco" name="bloco">
        <input type="hidden" id="lugar" name="lugar">
    </form>
</body>
</html>
