<?php
// backend/livros_dao.php
require_once 'dbconfig.php';

class LivrosDAO {
    
    // Buscar TODOS os livros
    public static function getAll() {
        $pdo = getDbConnection();
        $stmt = $pdo->query("SELECT * FROM livros ORDER BY titulo");
        return $stmt->fetchAll();
    }
    
    // Buscar UM livro por ID
    public static function getById($id) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    // Criar NOVO livro
    public static function create($dados) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, genero, isbn, imagem, link) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $dados['titulo'], 
            $dados['autor'], 
            $dados['genero'], 
            $dados['isbn'], 
            $dados['imagem'], 
            $dados['link']
        ]);
    }
    
    // ATUALIZAR livro existente - NOVA FUNÇÃO
    public static function update($id, $dados) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("UPDATE livros SET titulo=?, autor=?, genero=?, isbn=?, imagem=?, link=? WHERE id=?");
        return $stmt->execute([
            $dados['titulo'], 
            $dados['autor'], 
            $dados['genero'], 
            $dados['isbn'], 
            $dados['imagem'], 
            $dados['link'],
            $id
        ]);
    }
    
    // EXCLUIR livro - NOVA FUNÇÃO
    public static function delete($id) {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>