<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeBooks - <?php echo (isset($_GET['action']) && $_GET['action'] == 'edit') ? 'Editar' : 'Adicionar'; ?> Livro</title>
    <link rel="stylesheet" href="style.css" id="theme-style">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            border-color: orange;
            outline: none;
        }
        .form-help {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .btn-primary {
            background: orange;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .btn-secondary {
            background: #666;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <header>
        <span class="logotipo">FreeBooks</span>
        <ul class="navlinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="catalogo.php">Catálogo</a></li>
            <li><a href="equipe.php">Equipe</a></li>
        </ul>
        <div>
            <a href="suporte.php"><button>Suporte</button></a>
            <button id="btn-tema" class="botao-tema" title="Alternar tema">🌙</button>
        </div>
    </header>

    <main>
        <div class="texto2">
            <h2><?php echo (isset($_GET['action']) && $_GET['action'] == 'edit') ? 'Editar Livro' : 'Adicionar Novo Livro'; ?></h2>
            
            <?php
            // Se for edição, carregar os dados do livro
            $livro = null;
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
                require_once 'backend/livros_dao.php';
                $livro = LivrosDAO::getById($_GET['id']);
                
                if (!$livro) {
                    echo '<script>alert("Livro não encontrado!"); window.location.href = "catalogo.php";</script>';
                }
            }
            ?>
            
            <div class="form-container">
                <form action="backend/salvar_livro.php" method="POST">
                    <?php if ($livro): ?>
                        <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="titulo">Título do Livro:</label>
                        <input type="text" id="titulo" name="titulo" required 
                               value="<?php echo $livro ? htmlspecialchars($livro['titulo']) : ''; ?>"
                               placeholder="Digite o título do livro">
                    </div>
                    
                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <input type="text" id="autor" name="autor" required
                               value="<?php echo $livro ? htmlspecialchars($livro['autor']) : ''; ?>"
                               placeholder="Digite o nome do autor">
                    </div>
                    
                    <div class="form-group">
                        <label for="genero">Gênero:</label>
                        <input type="text" id="genero" name="genero" required
                               value="<?php echo $livro ? htmlspecialchars($livro['genero']) : ''; ?>"
                               placeholder="Ex: Romance, Terror, Ficção Científica">
                    </div>
                    
                    <div class="form-group">
                        <label for="isbn">ISBN (opcional):</label>
                        <input type="text" id="isbn" name="isbn"
                               value="<?php echo $livro ? htmlspecialchars($livro['isbn']) : ''; ?>"
                               placeholder="Ex: 978-85-123-4567-8">
                        <div class="form-help">Código único de identificação do livro</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="imagem">Nome da Imagem:</label>
                        <input type="text" id="imagem" name="imagem" required
                               value="<?php echo $livro ? htmlspecialchars($livro['imagem']) : ''; ?>"
                               placeholder="Ex: dracula.jpg">
                        <div class="form-help">Coloque apenas o nome do arquivo que está na pasta img/</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="link">Link para Ler:</label>
                        <input type="url" id="link" name="link" required
                               value="<?php echo $livro ? htmlspecialchars($livro['link']) : ''; ?>"
                               placeholder="https://...">
                        <div class="form-help">Link onde o livro pode ser lido online</div>
                    </div>
                    
                    <div style="text-align: center; margin-top: 30px;">
                        <button type="submit" class="btn-primary">
                            💾 <?php echo $livro ? 'Atualizar' : 'Salvar'; ?> Livro
                        </button>
                        
                        <a href="catalogo.php">
                            <button type="button" class="btn-secondary">
                                ↩️ Cancelar
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="rodape">
        <p class="rodape-direitos">&copy; 2025 FreeBooks. Todos os direitos reservados.</p>
        <p class="rodape-texto">📚 Compartilhando conhecimento gratuitamente</p>
    </footer>

    <script src="js/tema.js"></script>
</body>
</html>