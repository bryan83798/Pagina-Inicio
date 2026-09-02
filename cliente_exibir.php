<?php
require_once 'auth.php';
require_once 'conexao.php';

$sql = "SELECT * FROM clientes WHERE status = 'A'";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
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
        <h2>Clientes Cadastrados</h2>
        <a href="cliente_form.php" class="btn-voltar" style="margin-top:0;">+ Novo Cliente</a>
        
        <?php
        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>";
            
            while($linha = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $linha["id_cliente"] . "</td>";
                echo "<td>" . $linha["nome"] . "</td>";
                echo "<td>" . $linha["email"] . "</td>";
                echo "<td>
                        <a href='cliente_editar_form.php?id=" . $linha["id_cliente"] . "' style='color: #3498db; text-decoration: none; font-weight: bold; margin-right: 10px;'>Editar</a>
                        <a href='cliente_inativar.php?id=" . $linha["id_cliente"] . "' style='color: #FF4C4C; text-decoration: none; font-weight: bold;'>Inativar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='margin-top:20px;'>Nenhum cliente cadastrado.</p>";
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>