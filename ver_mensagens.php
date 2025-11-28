<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeBooks - Mensagens de Suporte</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td { 
            padding: 12px 15px; 
            text-align: left; 
            border-bottom: 1px solid #ddd; 
        }
        th { 
            background-color: #f8f9fa; 
            font-weight: bold;
            color: #333;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .aberta { 
            color: #e74c3c; 
            font-weight: bold; 
        }
        .respondida { 
            color: #27ae60; 
            font-weight: bold; 
        }
        .voltar-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .voltar-link:hover {
            background: #0056b3;
        }
        .mensagem-vazia {
            text-align: center;
            padding: 40px;
            color: #666;
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
            <li><a href="suporte.php">Suporte</a></li>
        </ul>
    </header>

    <div class="container">
        <h1>📨 Mensagens de Suporte</h1>
        
        <?php
        // Incluir configuração do banco
        include 'config.php';
        
        // Consulta para buscar mensagens
        $sql = "SELECT * FROM suportes ORDER BY data_envio DESC";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0): 
        ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Pergunta</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($row['pergunta']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['data_envio'])); ?></td>
                        <td class="<?php echo $row['status']; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="mensagem-vazia">
                📭 Nenhuma mensagem de suporte encontrada.
            </div>
        <?php endif; ?>
        
        <?php
        // Fechar conexão
        if (isset($conn)) {
            $conn->close();
        }
        ?>
        
        <a href="suporte.php" class="voltar-link">← Voltar para o formulário de suporte</a>
    </div>
</body>
</html>