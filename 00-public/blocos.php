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
    </script>
    
    </head>
<body>
    <form action="processar.php" method="post">
        <!-- Etapa 1: Escolher Bloco -->
        <div id="etapaBloco">
            <h2>Escolha o Bloco</h2>
            <!-- Blocos -->
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco A')"><span>Bloco A</span><span>Bloco A</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco B')"><span>Bloco B</span><span>Bloco B</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco C')"><span>Bloco C</span><span>Bloco C</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco D')"><span>Bloco D</span><span>Bloco D</span></button>
<br>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco E')"><span>Bloco E</span><span>Bloco E</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco F')"><span>Bloco F</span><span>Bloco F</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco G')"><span>Bloco G</span><span>Bloco G</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco H')"><span>Bloco H</span><span>Bloco H</span></button>
<br>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco I')"><span>Bloco I</span><span>Bloco I</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco J')"><span>Bloco J</span><span>Bloco J</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco K')"><span>Bloco K</span><span>Bloco K</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco L')"><span>Bloco L</span><span>Bloco L</span></button>
<br>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco M')"><span>Bloco M</span><span>Bloco M</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco N')"><span>Bloco N</span><span>Bloco N</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco O')"><span>Bloco O</span><span>Bloco O</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco P')"><span>Bloco P</span><span>Bloco P</span></button>
<br>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco Q')"><span>Bloco Q</span><span>Bloco Q</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco R')"><span>Bloco R</span><span>Bloco R</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco S')"><span>Bloco S</span><span>Bloco S</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco CT')"><span>Bloco CT</span><span>Bloco CT</span></button>
<br>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Auditório')"><span>Auditório</span><span>Auditório</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Reitoria')"><span>Reitoria</span><span>Reitoria</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Biblioteca')"><span>Biblioteca</span><span>Biblioteca</span></button>
<br>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Ginásio')"><span>Ginásio</span><span>Ginásio</span></button>
<button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaBloco', 'etapaLugar', 'bloco', 'Bloco EVA')"><span>Click!</span><span>EVA</span></button>

        </div>

        <!-- Etapa 2: Escolher Lugar -->
        <div class="" id="etapaLugar">
            <h2>Escolha o Local</h2>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaDetalhes', 'lugar', 'Sala')"><span>Sala</span><span>Sala</span></button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaDetalhes', 'lugar', 'Banheiro')"><span>Banheiro</span><span>Banheiro</span></button>
            <button type="button" class="btn-12" onclick="mostrarProximaEtapa('etapaLugar', 'etapaDetalhes', 'lugar', 'Elevador')"><span>Elevador</span><span>Elevador</span></button>
            <br>
            <button type="button" class="btn-12" onclick="voltarEtapa('etapaLugar', 'etapaBloco')"><span>Voltar</span><span>Voltar</span></button>
        </div>

        <!-- Etapa 3: Tipo de Assistência -->
        <div class="" id="etapaAssistencia">
            <h2>Tipo de Assistência</h2>
            <button type="button" class="btn-12" onclick="selecionarAssistencia('manutencao')">Manutenção</button>
            <button type="button" class="btn-12" onclick="selecionarAssistencia('limpeza')">Limpeza</button>
            <button type="button" class="btn-12" onclick="selecionarAssistencia('seguranca')">Segurança</button>
            <button type="button" class="btn-12" onclick="selecionarAssistencia('saude')">Saúde</button>
            <input type="hidden" name="tipo_assistencia" id="tipo_assistencia">
        </div>

        <!-- Etapa 4: Detalhes -->
        <div class="" id="etapaDetalhes">
            <h2>Detalhes do Problema</h2>
            <label for="ponto">Descreva qual o lugar:</label><br>
            <textarea name="ponto" id="ponto" rows="2" required></textarea><br><br>
            <label for="descricao">Descreva o problema:</label><br>
            <textarea name="descricao" id="descricao" rows="4" required></textarea><br><br>
            <button type="submit" class="btn-12" name="enviar"><span>Enviar</span><span>Enviar</span></button>
            <button type="button" class="btn-12" onclick="voltarEtapa('etapaDetalhes', 'etapaLugar')"><span>Voltar</span><span>Voltar</span></button>
        </div>

        <!-- Campos ocultos -->
        <input type="hidden" id="bloco" name="bloco">
        <input type="hidden" id="lugar" name="lugar">
    </form>
</body>
</html>
