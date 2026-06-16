<?php
// Habilita a exibição de erros caso falte algo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Importa o modelo e o repositório do usuário
require_once 'model.php';
require_once 'UserRepository.php';

$userRepo = new UserRepository();

echo "<h1>Testando o Back-end de Usuários</h1>";

// 1. TENTAR CADASTRAR UM USUÁRIO NOVO
// Para não dar erro de e-mail duplicado ao dar F5, vamos gerar um e-mail com número aleatório
$numeroAleatorio = rand(1, 1000);
$emailTeste = "estudante" . $numeroAleatorio . "@teste.com";

try {
    $novoUsuario = new UserModel("Cloud Focado", $emailTeste, "senha123");
    $userRepo->save($novoUsuario);
    echo "✅ Usuário criado com sucesso! E-mail cadastrado: <strong>$emailTeste</strong><br><br>";
} catch (Exception $e) {
    echo "❌ Erro ao cadastrar usuário: " . $e->getMessage() . "<br><br>";
}

// 2. TENTAR BUSCAR O USUÁRIO QUE ACABAMOS DE CRIAR
echo "<h3>Buscando o usuário criado no banco de dados...</h3>";
$usuarioEncontrado = $userRepo->findByEmail($emailTeste);

if ($usuarioEncontrado) {
    echo "🎉 Usuário encontrado na memória do Banco!<br>";
    echo "<strong>ID no Banco:</strong> " . $usuarioEncontrado->getId() . "<br>";
    echo "<strong>Nome:</strong> " . $usuarioEncontrado->getNome() . "<br>";
    echo "<strong>E-mail:</strong> " . $usuarioEncontrado->getEmail() . "<br>";
} else {
    echo "❌ Ops, não consegui achar o usuário no banco.";
}