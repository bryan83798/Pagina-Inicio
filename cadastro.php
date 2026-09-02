<?php
require_once 'conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se o usuário já estiver logado, redireciona para o início
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Formato de e-mail inválido.";
    } elseif ($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve conter pelo menos 6 caracteres.";
    } else {
        // Verifica se o e-mail já existe
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            // Insere o novo usuário
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt_insert = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt_insert->execute()) {
                $sucesso = "Cadastro realizado com sucesso! Você já pode fazer login.";
            } else {
                $erro = "Erro ao cadastrar usuário: " . $conn->error;
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agadetec - Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; background-color: #1A1A2E;">

    <div class="box" style="margin: 0; width: 450px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <span style="font-size: 50px;">✨</span>
            <h2 style="margin-top: 10px;">Criar Conta</h2>
            <p>Cadastre-se para acessar o sistema Agadetec</p>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>

        <form action="cadastro.php" method="POST">
            <label>Nome Completo:</label>
            <input type="text" name="nome" placeholder="Digite seu nome completo" required value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">

            <label>E-mail:</label>
            <input type="email" name="email" placeholder="Digite seu melhor e-mail" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

            <label>Senha:</label>
            <input type="password" name="senha" placeholder="Crie uma senha de no mínimo 6 caracteres" required>

            <label>Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" placeholder="Confirme sua senha" required>

            <button type="submit">Cadastrar</button>
        </form>

        <div class="login-footer">
            <p>Já possui uma conta? <a href="login.php">Faça Login</a></p>
        </div>
    </div>

</body>
</html>
