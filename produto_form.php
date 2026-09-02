<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
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
        <h2>Cadastro de Produto</h2>
        <form action="produto_salvar.php" method="POST" id="meuForm">
            <label>Descrição do Produto:</label>
            <input type="text" name="dsc_produto" placeholder="Digite a descrição" class="validar">
            
            <label>Valor Unitário (R$):</label>
            <input type="number" step="0.01" name="vlr_unit" placeholder="Ex: 99.90" class="validar">
            
            <button type="submit">Salvar Produto</button>
        </form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="produto_exibir.php" class="btn-voltar">Ver Produtos Cadastrados</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
