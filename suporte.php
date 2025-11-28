<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FreeBooks - Suporte">
    <meta name="keywords" content="FreeBooks, suporte, ajuda, livros gratuitos">
    <title>FreeBooks - Suporte</title>
    <link rel="stylesheet" href="style.css" id="theme-style">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        .form-textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            resize: vertical;
            min-height: 120px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        .btn-submit {
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .pergunta-section {
            margin-top: 40px;
            padding: 30px;
            border: 2px solid orange;
            border-radius: 10px;
            background: #fffaf0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            text-align: center;
            color: orange;
            margin-bottom: 25px;
            font-size: 24px;
        }
        .mensagem-sucesso {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            text-align: center;
            font-weight: bold;
        }
        .mensagem-erro {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            text-align: center;
            font-weight: bold;
        }
        .debug-info {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            font-size: 14px;
        }
        .debug-sucesso {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #bee5eb;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
        }
        .debug-erro {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
        }
        .links-container {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
        }
        .link-admin {
            color: #007bff;
            font-size: 16px;
            text-decoration: none;
            font-weight: bold;
            padding: 12px 24px;
            border: 2px solid #007bff;
            border-radius: 5px;
            transition: all 0.3s;
            display: inline-block;
            margin: 5px;
        }
        .link-admin:hover {
            background: #007bff;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }
        .link-phpmvadmin {
            color: #666;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s;
            display: inline-block;
            margin-top: 10px;
        }
        .link-phpmvadmin:hover {
            color: #333;
        }
        .page-title {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }
        .page-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 18px;
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
        <div class="form-container">
            <h1 class="page-title">FreeBooks: Seu Portal de Livros Gratuitos</h1>
            <h2 class="page-subtitle">Precisa de ajuda? Entre em contato conosco!</h2>
            
            <?php
            // 🔥 CÓDIGO PHP SIMPLIFICADO
            $mensagem_sucesso = "";
            $mensagem_erro = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Incluir conexão com banco
                include 'config.php';
                
                // Coletar dados do formulário
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $cpf = $_POST['cpf'];
                $pergunta = $_POST['pergunta'];
                
                echo "<div class='debug-info'>";
                echo "<strong>🔍 Dados Recebidos:</strong><br>";
                echo "Nome: $nome<br>";
                echo "Email: $email<br>";
                echo "CPF: $cpf<br>";
                echo "Pergunta: $pergunta<br>";
                echo "</div>";
                
                // Validações básicas
                if (empty($nome) || empty($email) || empty($cpf) || empty($pergunta)) {
                    $mensagem_erro = "⚠️ Por favor, preencha todos os campos!";
                } else {
                    // INSERÇÃO SIMPLES - SEM PREPARE
                    $sql = "INSERT INTO suportes (nome, email, cpf, pergunta) 
                            VALUES ('$nome', '$email', '$cpf', '$pergunta')";
                    
                    if (mysqli_query($conn, $sql)) {
                        $mensagem_sucesso = "✅ Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.";
                        echo "<div class='debug-sucesso'>✅ Dados inseridos no banco com sucesso!</div>";
                    } else {
                        $mensagem_erro = "❌ Erro ao enviar mensagem. Tente novamente.";
                        echo "<div class='debug-erro'>❌ Erro no MySQL: " . mysqli_error($conn) . "</div>";
                    }
                }
                mysqli_close($conn);
            }
            ?>
            
            <!-- MOSTRAR MENSAGENS DE SUCESSO/ERRO -->
            <?php if (!empty($mensagem_sucesso)): ?>
                <div class="mensagem-sucesso">
                    <?php echo $mensagem_sucesso; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($mensagem_erro)): ?>
                <div class="mensagem-erro">
                    <?php echo $mensagem_erro; ?>
                </div>
            <?php endif; ?>
            
            <form action="suporte.php" method="post" id="form-suporte">
                <!-- NOME DE USUÁRIO -->
                <div class="form-group">
                    <label for="id_nome" class="form-label">Nome de usuário:</label>
                    <input type="text" id="id_nome" name="nome" 
                           value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>"
                           placeholder="Digite seu nome de usuário" required
                           class="form-input">
                </div>
                
                <!-- EMAIL -->
                <div class="form-group">
                    <label for="id_email" class="form-label">Seu e-mail:</label>
                    <input type="email" id="id_email" name="email"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                           placeholder="Digite o seu email" required
                           class="form-input">
                </div>
                
                <!-- CPF -->
                <div class="form-group">
                    <label for="id_cpf" class="form-label">Seu CPF:</label>
                    <input type="text" id="id_cpf" name="cpf" 
                           value="<?php echo isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf']) : ''; ?>"
                           placeholder="000.000.000-00" maxlength="14" required
                           class="form-input">
                </div>

                <!-- CAIXINHA DE PERGUNTAS -->
                <div class="pergunta-section">
                    <h3 class="section-title">📝 Tem alguma dúvida?</h3>
                    
                    <div class="form-group">
                        <label for="id_pergunta" class="form-label">Sua pergunta:</label>
                        <textarea id="id_pergunta" name="pergunta" 
                                  rows="6" 
                                  placeholder="Digite aqui a sua dúvida ou problema..."
                                  class="form-textarea"><?php echo isset($_POST['pergunta']) ? htmlspecialchars($_POST['pergunta']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        📤 Enviar Dúvida
                    </button>
                </div>
            </form>
            
            <!-- LINKS -->
            <div class="links-container">
                <a href="ver_mensagens.php" class="link-admin">
                    👁️ Ver todas as mensagens de suporte
                </a>
                <br>
                <a href="http://localhost/phpmyadmin" target="_blank" class="link-phpmvadmin">
                    🗃️ Ver tabela no phpMyAdmin
                </a>
            </div>
        </div>
    </main>

    <footer class="rodape">
        <p class="rodape-direitos">&copy; 2025 FreeBooks.</p>
        <p class="rodape-texto">📚 Compartilhando conhecimento gratuitamente</p>
    </footer>

    <script src="js/validacao.js"></script>
    <script src="js/tema.js"></script>
    
    <script>
        // Script para formatação do CPF
        document.addEventListener('DOMContentLoaded', function() {
            const cpfInput = document.getElementById('id_cpf');
            if (cpfInput) {
                cpfInput.addEventListener('input', function() {
                    let valor = this.value.replace(/\D/g, '');
                    
                    if (valor.length <= 11) {
                        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
                        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
                        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                        this.value = valor;
                    }
                });
            }
            
            // Focar no primeiro campo
            document.getElementById('id_nome').focus();
        });
    </script>
</body>
</html>