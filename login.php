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

// Verifica se veio alguma mensagem de sucesso do cadastro ou de outro lugar
if (isset($_GET['msg']) && $_GET['msg'] === 'cadastrado') {
    $sucesso = "Cadastro realizado com sucesso! Faça o login abaixo.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Busca o usuário ativo no banco
        $stmt = $conn->prepare("SELECT id_usuario, nome, senha FROM usuarios WHERE email = ? AND status = 'A'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id_usuario, $nome, $senha_hash);
        
        if ($stmt->fetch() && password_verify($senha, $senha_hash)) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $id_usuario;
            $_SESSION['usuario_nome'] = $nome;
            $_SESSION['usuario_email'] = $email;
            
            header("Location: index.php");
            exit();
        } else {
            $erro = "E-mail ou senha incorretos, ou usuário inativo.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agadetec - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; background-color: #1A1A2E;">

    <div class="box" style="margin: 0; width: 400px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <span style="font-size: 50px;">🔐</span>
            <h2 style="margin-top: 10px;">Área de Acesso</h2>
            <p>Faça login para gerenciar o sistema Agadetec</p>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label>E-mail:</label>
            <input type="email" name="email" placeholder="Digite seu e-mail" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

            <label>Senha:</label>
            <input type="password" name="senha" placeholder="Digite sua senha" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="login-footer">
            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </div>

</body>
</html>
