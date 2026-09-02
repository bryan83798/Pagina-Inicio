<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
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

    <div class="box">
        <h2>Cadastro de Cliente</h2>
        <form action="cliente_salvar.php" method="POST" id="meuForm">
            <label>Nome do Cliente:</label>
            <input type="text" name="nome" placeholder="Digite o nome" class="validar">
            
            <label>Email do Cliente:</label>
            <input type="email" name="email" placeholder="Digite o email" class="validar">
            
            <button type="submit">Salvar Cliente</button>
        </form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="cliente_exibir.php" class="btn-voltar">Ver Clientes Cadastrados</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
