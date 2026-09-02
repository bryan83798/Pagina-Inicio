<?php
require_once 'auth.php';
require_once 'conexao.php';

// Busca os clientes para o campo de seleção
$sql_clientes = "SELECT id_cliente, nome FROM clientes WHERE status = 'A'";
$resultado_clientes = $conn->query($sql_clientes);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Venda</title>
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
        <h2>Registrar Nova Venda</h2>
        <form action="venda_salvar.php" method="POST" id="meuForm">
            <label>Cliente:</label>
            <select name="id_cliente" class="validar">
                <option value="">Selecione um Cliente</option>
                <?php
                if ($resultado_clientes->num_rows > 0) {
                    while($cliente = $resultado_clientes->fetch_assoc()) {
                        echo "<option value='" . $cliente["id_cliente"] . "'>" . $cliente["nome"] . "</option>";
                    }
                }
                ?>
            </select>
            
            <label>Data da Venda:</label>
            <input type="date" name="dat_venda" class="validar">
            
            <button type="submit">Salvar Venda</button>
        </form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="venda_exibir.php" class="btn-voltar">Ver Vendas Registradas</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
