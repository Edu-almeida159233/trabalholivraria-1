<?php
// backend/salvar_livro.php
require_once 'livros_dao.php';

if ($_POST) {
    try {
        $dados = [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'genero' => $_POST['genero'],
            'isbn' => $_POST['isbn'],
            'imagem' => $_POST['imagem'],
            'link' => $_POST['link']
        ];
        
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // EDITAR livro existente
            $sucesso = LivrosDAO::update($_POST['id'], $dados);
            $mensagem = $sucesso ? "Livro editado com sucesso!" : "Erro ao editar livro.";
        } else {
            // ADICIONAR novo livro
            $sucesso = LivrosDAO::create($dados);
            $mensagem = $sucesso ? "Livro adicionado com sucesso!" : "Erro ao adicionar livro.";
        }
        
        echo "<script>
                alert('$mensagem');
                window.location.href = '../catalogo.php';
              </script>";
              
    } catch (Exception $e) {
        echo "<script>
                alert('Erro: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
}
?>