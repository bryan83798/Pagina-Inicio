<?php
require_once 'auth.php';
require_once 'conexao.php';

$dsc_produto = $_POST['dsc_produto'];
$vlr_unit = $_POST['vlr_unit'];

$sql = "INSERT INTO produtos (dsc_produto, vlr_unit) VALUES ('$dsc_produto', '$vlr_unit')";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Salvar Produto</title>
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
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Produto salvo com sucesso!</h2>";
        } else {
            echo "<h2>Erro ao salvar:</h2> <p>" . $conn->error . "</p>";
        }
        ?>
        <a href="produto_form.php" class="btn-voltar">Cadastrar Outro</a>
        <a href="produto_exibir.php" class="btn-voltar">Ver Produtos</a>
    </div>
</body>
</html>
