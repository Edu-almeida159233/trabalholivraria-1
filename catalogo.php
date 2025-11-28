<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FreeBooks - Catálogo de Livros">
    <meta name="keywords" content="livros gratuitos, catálogo, biblioteca online">
    <title>FreeBooks - Catálogo</title>
    <link rel="stylesheet" href="style.css" id="theme-style">
</head>
<body>
    <header>
        <span class="logotipo">FreeBooks</span>
        <ul class="navlinks">
            <li><a href="index.php">Home</a></li>
            <li><b>Catálogo</b></li>
            <li><a href="equipe.php">Equipe</a></li>
        </ul>
        <div>
            <a href="suporte.php"><button>Suporte</button></a>
            <button id="btn-tema" class="botao-tema" title="Alternar tema">🌙</button>
        </div>
    </header>

    <main>
        <div class="texto2">
            <h2>FreeBooks: o seu site de livros totalmente gratuitos!!</h2>
            <h3 class="hh">Confira agora todos os livros disponíveis:</h3>
            <a href="livro_form.php?action=add"><button style="background: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px;">➕ Adicionar Novo Livro</button></a>
        </div>
        
        <!-- ÁREA DINÂMICA PARA OS LIVROS -->
        <div id="area-livros">
            <?php
            // CARREGAR LIVROS DO BANCO DE DADOS
            require_once 'backend/livros_dao.php';
            
            try {
                $livros = LivrosDAO::getAll();
                
                if (empty($livros)) {
                    echo '<div style="text-align: center; padding: 40px; color: #666;">
                            <p>Nenhum livro cadastrado no momento.</p>
                          </div>';
                } else {
                    echo '<div class="container-livros" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; padding: 20px; max-width: 1400px; margin: 0 auto;">';
                    
                    foreach ($livros as $livro) {
                        echo '
                        <div class="card-livro" style="background: white; border: 2px solid orange; border-radius: 12px; padding: 20px; width: 250px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: all 0.3s ease;">
                            <div class="livro-imagem" style="margin-bottom: 15px;">
                                <img src="' . (strpos($livro['imagem'], 'http') === 0 ? $livro['imagem'] : 'img/' . $livro['imagem']) . '" 
                                     alt="' . htmlspecialchars($livro['titulo']) . '" 
                                     style="width: 160px; height: 220px; object-fit: cover; border-radius: 8px; border: 2px solid #ffa500;"
                                     onerror="this.onerror=null; this.src=\'https://via.placeholder.com/160x220/ffa500/ffffff?text=Capa+Não+Encontrada\'">
                            </div>
                            <div class="livro-info" style="margin-bottom: 20px; min-height: 100px;">
                                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 16px; line-height: 1.3; font-family: cursive; font-weight: bold;">
                                    ' . htmlspecialchars($livro['titulo']) . '
                                </h4>
                                <p style="margin: 0; color: #666; font-size: 14px; font-style: italic; line-height: 1.2;">
                                    ' . htmlspecialchars($livro['autor']) . '
                                </p>
                                <p style="margin: 5px 0 0 0; color: #888; font-size: 12px; background: #fff3cd; padding: 3px 8px; border-radius: 10px; display: inline-block;">
                                    ' . htmlspecialchars($livro['genero']) . '
                                </p>
                            </div>
                            <div class="livro-actions">
                                <a href="' . $livro['link'] . '" target="_blank" style="text-decoration: none;">
                                    <button style="background: orange; color: white; border: none; padding: 10px 20px; border-radius: 25px; cursor: pointer; font-size: 14px; font-weight: bold; transition: all 0.3s ease; font-family: cursive; margin-bottom: 8px; width: 100%;">
                                        📖 Ler Livro
                                    </button>
                                </a>
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="livro_form.php?action=edit&id=' . $livro['id'] . '" style="text-decoration: none; flex: 1;">
                                        <button style="background: #d4a017; color: white; border: none; padding: 8px 12px; border-radius: 20px; cursor: pointer; font-size: 12px; width: 100%;">
                                            ✏️ Editar
                                        </button>
                                    </a>
                                    <button onclick="confirmarExclusao(' . $livro['id'] . ')" style="background: #b30000; color: white; border: none; padding: 8px 12px; border-radius: 20px; cursor: pointer; font-size: 12px; flex: 1;">
                                        🗑️ Excluir
                                    </button>
                                </div>
                            </div>
                        </div>';
                    }
                    
                    echo '</div>';
                }
                
            } catch (Exception $e) {
                echo '<div style="background: #ffebee; border: 2px solid #f44336; padding: 30px; margin: 20px; border-radius: 10px; text-align: center; color: #c62828;">
                        <h3 style="margin: 0 0 15px 0;">⚠️ Erro ao carregar livros</h3>
                        <p style="margin: 0 0 10px 0;">Erro no banco de dados.</p>
                        <small>Erro: ' . $e->getMessage() . '</small>
                      </div>';
            }
            ?>
        </div>
    </main>

    <footer class="rodape">
        <p class="rodape-direitos">&copy; 2025 FreeBooks. Todos os direitos reservados.</p>
        <p class="rodape-texto">📚 Compartilhando conhecimento gratuitamente</p>
    </footer>

    <script src="js/tema.js"></script>
    <script>
    function confirmarExclusao(id) {
        if (confirm('Tem certeza que deseja excluir este livro?')) {
            window.location.href = 'backend/deletar_livro.php?id=' + id;
        }
    }
    </script>
</body>
</html>