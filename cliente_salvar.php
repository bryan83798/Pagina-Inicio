<?php
require_once 'auth.php';
require_once 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];

$sql = "INSERT INTO clientes (nome, email) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nome, $email);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Salvar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu-top">
        <div class="menu-links">
            <a href="index.php">Início</a>
            <a href="cliente_exibir.php">Clientes</a>
            <a href="produto_exibir.php">Produtos</a>
            <a href="venda_exibir.php">Vendas</a>
            <a href="item_venda_exibir.php">Itens de Venda</a>
        </div>
        <div class="menu-user">
            <span class="navbar-avatar" style="background-color: <?php echo $_SESSION['perfil_cor']; ?>;">
                <?php echo $_SESSION['perfil_emoji']; ?>
            </span>
            <span>Olá, <strong><?php echo htmlspecialchars($_SESSION['perfil_nome']); ?></strong></span>
            <a href="perfis.php" class="btn-trocar-perfil">Trocar Perfil</a>
            <a href="logout.php" class="btn-logout">Sair</a>
        </div>
    </div>
    
    <div class="box" style="text-align: center;">
        <?php
        try {
            $stmt->execute();
            echo "<h2>Cliente salvo com sucesso!</h2>";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "<h2>Erro ao salvar:</h2> <p>O e-mail <strong>" . htmlspecialchars($email) . "</strong> já está cadastrado.</p>";
            } else {
                echo "<h2>Erro ao salvar:</h2> <p>" . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        ?>
        <a href="cliente_form.php" class="btn-voltar">Cadastrar Outro</a>
        <a href="cliente_exibir.php" class="btn-voltar">Ver Clientes</a>
    </div>
</body>
</html>