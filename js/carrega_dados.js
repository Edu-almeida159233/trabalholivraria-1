document.addEventListener('DOMContentLoaded', function() {
    console.log('📚 Iniciando carregamento de livros...');
    carregarLivros();
});

async function carregarLivros() {
    try {
        const areaLivros = document.getElementById('area-livros');
        if (!areaLivros) {
            console.log('⚠️ Área de livros não encontrada');
            return;
        }

        console.log('🔍 Buscando dados.json...');
        const response = await fetch('./dados.json');
        
        if (!response.ok) {
            throw new Error(`Arquivo não encontrado: ${response.status}`);
        }
        
        const dados = await response.json();
        console.log('✅ JSON carregado:', dados);

        if (!dados.livros || dados.livros.length === 0) {
            console.log('📭 Nenhum livro encontrado no JSON');
            areaLivros.innerHTML = '<div style="text-align: center; padding: 40px; color: #666;"><p>Nenhum livro disponível no momento.</p></div>';
            return;
        }

        console.log(`📖 Encontrados ${dados.livros.length} livros`);

        // Limpar área de livros
        areaLivros.innerHTML = '';

        // Criar container para os livros
        const containerLivros = document.createElement('div');
        containerLivros.className = 'container-livros';
        containerLivros.style.cssText = `
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        `;

        // Criar cards para cada livro
        dados.livros.forEach((livro) => {
            const card = document.createElement('div');
            card.className = 'card-livro';
            card.style.cssText = `
                background: white;
                border: 2px solid orange;
                border-radius: 12px;
                padding: 20px;
                width: 220px;
                text-align: center;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transition: all 0.3s ease;
            `;

            card.innerHTML = `
                <div class="livro-imagem" style="margin-bottom: 15px;">
                    <img src="${livro.imagem}" 
                         alt="${livro.titulo}" 
                         style="width: 140px; height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/140x200/ffa500/ffffff?text=Imagem+Não+Encontrada'">
                </div>
                <div class="livro-info" style="margin-bottom: 20px; min-height: 80px;">
                    <h4 style="margin: 0 0 8px 0; color: #333; font-size: 16px; line-height: 1.3; font-family: cursive;">
                        ${livro.titulo}
                    </h4>
                    <p style="margin: 0; color: #666; font-size: 14px; font-style: italic; line-height: 1.2;">
                        ${livro.autor}
                    </p>
                </div>
                <div class="livro-actions">
                    <a href="${livro.link}" target="_blank" style="text-decoration: none;">
                        <button style="
                            background: orange;
                            color: white;
                            border: none;
                            padding: 10px 20px;
                            border-radius: 25px;
                            cursor: pointer;
                            font-size: 14px;
                            font-weight: bold;
                            transition: all 0.3s ease;
                            font-family: cursive;
                        " onmouseover="this.style.backgroundColor='darkorange'" 
                          onmouseout="this.style.backgroundColor='orange'">
                            📖 Ler Livro
                        </button>
                    </a>
                </div>
            `;

            // Efeitos hover
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px)';
                card.style.boxShadow = '0 8px 20px rgba(0,0,0,0.2)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
            });

            containerLivros.appendChild(card);
        });

        areaLivros.appendChild(containerLivros);
        console.log(`🎉 ${dados.livros.length} livros exibidos com sucesso!`);

    } catch (erro) {
        console.error('❌ Erro ao carregar os livros:', erro);
        const areaLivros = document.getElementById('area-livros');
        if (areaLivros) {
            areaLivros.innerHTML = `
                <div style="
                    background: #ffebee;
                    border: 2px solid #f44336;
                    padding: 30px;
                    margin: 20px;
                    border-radius: 10px;
                    text-align: center;
                    color: #c62828;
                ">
                    <h3 style="margin: 0 0 15px 0;">⚠️ Erro ao carregar livros</h3>
                    <p style="margin: 0 0 10px 0;">Verifique se o arquivo "dados.json" está na pasta correta.</p>
                    <small>Erro: ${erro.message}</small>
                </div>
            `;
        }
    }
}

// CSS para tema escuro
function adicionarCSSLivros() {
    if (document.querySelector('style[data-livros-css]')) return;
    
    const style = document.createElement('style');
    style.setAttribute('data-livros-css', 'true');
    style.textContent = `
        [data-theme="dark"] .card-livro {
            background: #2d2d2d !important;
            border-color: #bb86fc !important;
            color: #e0e0e0 !important;
        }
        
        [data-theme="dark"] .card-livro h4 {
            color: #e0e0e0 !important;
        }
        
        [data-theme="dark"] .card-livro p {
            color: #a0a0a0 !important;
        }
        
        [data-theme="dark"] .card-livro button {
            background: #bb86fc !important;
            color: #000 !important;
            font-weight: bold;
        }
        
        [data-theme="dark"] .card-livro button:hover {
            background: #a56eff !important;
        }
    `;
    document.head.appendChild(style);
}

// Inicializar CSS
document.addEventListener('DOMContentLoaded', adicionarCSSLivros);