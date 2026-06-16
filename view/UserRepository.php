<?php
require_once 'database.php';
require_once 'model.php';
require_once 'IUserRepository.php';

class UserRepository implements IUserRepository {
    private $db;

    public function __construct() {
        // Pega a conexão Singleton que você já configurou
        $this->db = Database::getConnection();
    }

    // Salva ou atualiza um usuário no banco
    public function save(UserModel $user) {
        $sql = "INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(':nome', $user->getNome());
        $stmt->bindValue(':email', $user->getEmail());
        // Em um sistema real, usaríamos password_hash para a senha, mas vamos manter simples por enquanto
        $stmt->bindValue(':senha', $user->getSenha()); 
        
        $stmt->execute();
    }

    // Busca um usuário pelo e-mail (essencial para o Login!)
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$dados) {
            return null;
        }
        
        return new UserModel($dados['nome'], $dados['email'], $dados['senha'], $dados['id']);
    }

    // Busca por ID
    public function find($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$dados) return null;
        return new UserModel($dados['nome'], $dados['email'], $dados['senha'], $dados['id']);
    }
}