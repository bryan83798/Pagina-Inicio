<?php
$conn = new mysqli("sql312.infinityfree.com", "if0_42213297", "198374CABLAR", "if0_42213297_sistema");
if ($conn->connect_error) {
    die("erro de conexão: " .   $conn->connect_error);
}

// Cria tabela de usuários automaticamente caso não exista
$sqlCreateUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    status VARCHAR(1) DEFAULT 'A'
)";
if (!$conn->query($sqlCreateUsuarios)) {
    die("erro ao verificar/criar tabela de usuários: " . $conn->error);
}

// Cria tabela de perfis automaticamente caso não exista
$sqlCreatePerfis = "CREATE TABLE IF NOT EXISTS perfis (
    id_perfil INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nome_perfil VARCHAR(50) NOT NULL,
    avatar_cor VARCHAR(7) DEFAULT '#FF7B54',
    avatar_emoji VARCHAR(10) DEFAULT '👤',
    status VARCHAR(1) DEFAULT 'A',
    CONSTRAINT fk_usuario_perfil FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
)";
if (!$conn->query($sqlCreatePerfis)) {
    die("erro ao verificar/criar tabela de perfis: " . $conn->error);
}
?>