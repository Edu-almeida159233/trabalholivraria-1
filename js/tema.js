document.addEventListener('DOMContentLoaded', function() {
    console.log('=== INICIANDO SISTEMA DE TEMA ===');
    
    criarBotaoTema();
    aplicarTemaSalvo();
    ajustarRodape();

    // ⬇️ MOVI este código para dentro do único DOMContentLoaded ⬇️
    const botaoTema = document.getElementById('btn-tema');
    if (botaoTema) {
        botaoTema.addEventListener('click', alternarTemaComRodape);
    }
});

function criarBotaoTema() {
    const header = document.querySelector('header');
    
    if (header && !document.getElementById('btn-tema')) {
        const botaoTema = document.createElement('button');
        botaoTema.id = 'btn-tema';
        botaoTema.className = 'botao-tema';
        botaoTema.innerHTML = '🌙';
        botaoTema.title = 'Alternar tema';
        
        // Estilos básicos
        botaoTema.style.cssText = `
            padding: 12px 14px;
            background: orange;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            margin-left: 10px;
        `;
        
        header.appendChild(botaoTema);
        console.log('✅ Botão criado com sucesso');
    }
}

function aplicarTemaSalvo() {
    const temaSalvo = localStorage.getItem('tema');
    const botaoTema = document.getElementById('btn-tema');
    
    console.log('Tema salvo:', temaSalvo);
    
    if (temaSalvo === 'escuro') {
        document.getElementById('theme-style').href = 'style/dark_style.css';
        if (botaoTema) botaoTema.innerHTML = '☀️';
        console.log('✅ Tema escuro aplicado');
    } else {
        document.getElementById('theme-style').href = 'style/style.css';
        if (botaoTema) botaoTema.innerHTML = '🌙';
        console.log('✅ Tema claro aplicado');
    }
}

function alternarTema() {
    console.log('🔄 Alternando tema...');
    
    const temaAtual = localStorage.getItem('tema');
    const novoTheme = temaAtual === 'escuro' ? 'claro' : 'escuro';
    
    console.log('Tema atual:', temaAtual, 'Novo tema:', novoTheme);
    
    // Aplicar novo tema
    localStorage.setItem('tema', novoTheme);
    aplicarTemaSalvo();
    
    console.log('✅ Tema alterado para:', novoTheme);
}

// ===== SISTEMA DE RODAPÉ FIXO =====
function ajustarRodape() {
    const rodape = document.querySelector('.rodape');
    const body = document.body;
    const html = document.documentElement;
    
    if (!rodape) {
        console.log('⚠️ Rodapé não encontrado');
        return;
    }
    
    // Altura total da página
    const alturaTotal = Math.max(
        body.scrollHeight, 
        body.offsetHeight, 
        html.clientHeight, 
        html.scrollHeight, 
        html.offsetHeight
    );
    
    // Altura da viewport (tela visível)
    const alturaViewport = window.innerHeight;
    
    console.log(`📏 Altura total: ${alturaTotal}px, Viewport: ${alturaViewport}px`);
    
    // Se o conteúdo for menor que a tela, fixa o rodapé no final
    if (alturaTotal < alturaViewport) {
        rodape.style.position = 'fixed';
        rodape.style.bottom = '0';
        rodape.style.left = '0';
        rodape.style.right = '0';
        rodape.style.marginTop = '0';
        document.body.style.paddingBottom = '70px'; // Espaço para o rodapé fixo
        console.log('✅ Rodapé fixado no final da tela');
    } else {
        // Se tiver conteúdo suficiente, volta ao fluxo normal
        rodape.style.position = 'relative';
        rodape.style.bottom = 'auto';
        rodape.style.marginTop = '40px';
        document.body.style.paddingBottom = '0';
        console.log('✅ Rodapé no fluxo normal (conteúdo longo)');
    }
}

// Ajustar também quando o tema mudar (pode alterar alturas)
function alternarTemaComRodape() {
    alternarTema();
    // Pequeno delay para o CSS carregar antes de ajustar o rodapé
    setTimeout(ajustarRodape, 100);
}

// Eventos de redimensionamento e carregamento
window.addEventListener('resize', ajustarRodape);
window.addEventListener('load', ajustarRodape);