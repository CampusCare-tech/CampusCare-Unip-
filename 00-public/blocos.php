    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Escolha de Blocos</title>

        <script>
            function mostrarProximaEtapa(etapaAtual, etapaProxima, campoId = null, valor = null) {
                if (campoId && valor) {
                    document.getElementById(campoId).value = valor;
                }
                document.getElementById(etapaAtual).style.display = 'none';
                document.getElementById(etapaProxima).style.display = 'block';
            }

            function voltarEtapa(etapaAtual, etapaAnterior) {
                document.getElementById(etapaAtual).style.display = 'none';
                document.getElementById(etapaAnterior).style.display = 'block';
            }

            function validarFormulario() {
                var bloco = document.getElementById('bloco').value;
                var localTipo = document.getElementById('local_tipo').value;
                var localIdentificacao = document.getElementById('local_identificacao').value;
                var descricao = document.getElementById('descricao').value;
                var tipoAssistencia = document.getElementById('tipo_assistencia').value;

                if (!bloco || !localTipo || !localIdentificacao || !descricao || !tipoAssistencia) {
                    alert("Por favor, preencha todos os campos antes de enviar.");
                    return false;
                }

                const confirmar = confirm("Você tem certeza que deseja enviar o formulário?");
                if (confirmar) {
                    document.getElementById('formulario').submit();
                }
            }

            function selecionarTipoAssistencia(tipo) {
                document.querySelectorAll('.tipo-assistencia-btn').forEach(btn => btn.classList.remove('selecionado'));
                document.getElementById(tipo).classList.add('selecionado');
                document.getElementById('tipo_assistencia').value = tipo;
            }
        </script>
    </head>
    <body>
        <form id="formulario" action="../01-includes/processar.php" method="post">
            <div id="etapaBloco">
                
                <h2>Escolha o Bloco</h2>
                <br>
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
                        echo '<button type="button" class="btn-12" onclick="mostrarProximaEtapa(\'etapaBloco\', \'etapaLugar\', \'bloco\', \'' . $bloco . '\')">' . $bloco . '</button>';
                    }
                ?>
            </div>

            <div id="etapaLugar" style="display:none;">
            <h2 style="color: #2c2c2c; font-size: 40px; text-align: center;">Escolha o Local</h2>
            <br>
                <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Sala')">Sala</button>
                <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Banheiro')">Banheiro</button>
                <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaIdentificacao', 'local_tipo', 'Elevador')">Elevador</button>
                <br>
                <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaLugar', 'etapaBloco')">Voltar</button>
            </div>

            <div id="etapaIdentificacao" style="display:none;">
            <h2 style="color: #2c2c2c; font-size: 40px; text-align: center;">Identifique o Local</h2>
                <label style="color: #2c2c2c; font-size: 30px; text-align:" for="local_identificacao">Identificação:</label>
                <input type="text" id="local_identificacao" name="local_identificacao" required>
                <button type="button" class="btn-12 destaque" onclick="mostrarProximaEtapa('etapaIdentificacao', 'etapaDetalhes')">Avançar</button>
                <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaIdentificacao', 'etapaLugar')">Voltar</button>
            </div>

                <div id="etapaDetalhes" style="display:none;">
                <h2 style="color: #2c2c2c; font-size: 35px; text-align: center;">Detalhes do Problema</h2>

                <br>
                <label style="color: #2c2c2c; font-size: 35px; for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>

                <!-- Botões de tipo de assistência -->
                <button type="button" class="btn-12 tipo-assistencia-btn" id="manutencao" onclick="selecionarTipoAssistencia('manutencao')">Manutenção</button>
                <button type="button" class="btn-12 tipo-assistencia-btn" id="limpeza" onclick="selecionarTipoAssistencia('limpeza')">Limpeza</button>
                <button type="button" class="btn-12 tipo-assistencia-btn" id="seguranca" onclick="selecionarTipoAssistencia('seguranca')">Segurança</button>
                <button type="button" class="btn-12 tipo-assistencia-btn" id="saude" onclick="selecionarTipoAssistencia('saude')">Saúde</button>

                <input type="hidden" id="tipo_assistencia" name="tipo_assistencia">

                <!-- Div para os botões Voltar e Enviar -->
                <div class="action-buttons">
                    <button type="button" class="btn-12 destaque" onclick="validarFormulario()">Enviar</button>
                    <button type="button" class="btn-12 voltar" onclick="voltarEtapa('etapaDetalhes', 'etapaIdentificacao')">Voltar</button>
                </div>

            <input type="hidden" id="bloco" name="bloco">
            <input type="hidden" id="local_tipo" name="local_tipo">
        </form>
    </body>
    </html>
