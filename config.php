<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";  // Padrão XAMPP
$banco = "freebooks";

// Tentar conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Se não conseguir conectar ao banco, tenta criar
if ($conn->connect_error) {
    $conn = new mysqli($servidor, $usuario, $senha);
    
    if (!$conn->connect_error) {
        // Criar banco se não existir
        $conn->query("CREATE DATABASE IF NOT EXISTS $banco");
        $conn->select_db($banco);
        
        // Mensagem para debug
        echo "<!-- Banco criado com sucesso -->";
    }
}

// Verificar se finalmente conectou
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>