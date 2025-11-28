<?php
// backend/deletar_livro.php
require_once 'livros_dao.php';

if (isset($_GET['id'])) {
    try {
        $sucesso = LivrosDAO::delete($_GET['id']);
        
        if ($sucesso) {
            echo "<script>
                    alert('Livro excluído com sucesso!');
                    window.location.href = '../catalogo.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao excluir livro.');
                    window.history.back();
                  </script>";
        }
        
    } catch (Exception $e) {
        echo "<script>
                alert('Erro: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
} else {
    header('Location: ../catalogo.php');
}
?>