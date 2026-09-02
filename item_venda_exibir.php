<?php
require_once 'auth.php';
require_once 'conexao.php';

// Uso de JOIN para buscar os dados associados
$sql = "SELECT i.id_item, i.id_venda, p.dsc_produto, i.qtd, i.vlr_item 
        FROM itens_venda i 
        INNER JOIN produtos p ON i.id_produto = p.id_produto";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Itens da Venda</title>
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

    <div class="tabela-container">
        <h2>Itens de Venda Registrados</h2>
        <a href="item_venda_form.php" class="btn-voltar" style="margin-top:0;">+ Novo Item</a>
        
        <?php
        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID Item</th><th>ID Venda</th><th>Produto</th><th>Quantidade</th><th>Valor do Item (R$)</th><th>Ações</th></tr>";
            
            while($linha = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $linha["id_item"] . "</td>";
                echo "<td>" . $linha["id_venda"] . "</td>";
                echo "<td>" . $linha["dsc_produto"] . "</td>";
                echo "<td>" . $linha["qtd"] . "</td>";
                echo "<td>" . number_format($linha["vlr_item"], 2, ',', '.') . "</td>";
                echo "<td>
                        <a href='item_venda_editar_form.php?id=" . $linha["id_item"] . "' style='color: #3498db; text-decoration: none; font-weight: bold;'>Editar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='margin-top:20px;'>Nenhum item de venda registrado.</p>";
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>
