{{-- 
    VOICEFLOW CHATBOT WIDGET
    --------------------------------------------------------------------------
    Instruções para Ativação:
    1. O cliente deve criar o agente no Voiceflow.
    2. Publicar e obter o 'projectID'.
    3. Substituir 'INSERT_CLIENT_PROJECT_ID_HERE' pelo ID real.
--}}

<script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: 'INSERT_CLIENT_PROJECT_ID_HERE' }, // <--- ID DO CLIENTE ENTRA AQUI
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production',
          voice: {
            url: "https://runtime-api.voiceflow.com"
          },
          // Mantém o bot à direita (padrão), já que os botões de ação estão na esquerda.
          render: {
            mode: 'overlay',
          }
        });
      }
      v.src = "https://cdn.voiceflow.com/widget-next/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>