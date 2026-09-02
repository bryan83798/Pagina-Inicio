<?php
require_once 'auth.php';
require_once 'conexao.php';

$id_venda   = $_POST['id_venda'];
$id_produto = $_POST['id_produto'];
$qtd        = $_POST['qtd'];

// Calcula vlr_item em PHP (substitui o TRIGGER removido do banco de dados)
$res_preco = $conn->query("SELECT vlr_unit FROM produtos WHERE id_produto = '$id_produto'");
$produto   = $res_preco->fetch_assoc();
$vlr_item  = $produto['vlr_unit'] * $qtd;

$sql = "INSERT INTO itens_venda (id_venda, id_produto, qtd, vlr_item)
        VALUES ('$id_venda', '$id_produto', '$qtd', '$vlr_item')";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Salvar Item da Venda</title>
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
            echo "<h2>Item adicionado com sucesso!</h2>";
        } else {
            echo "<h2>Erro ao adicionar item:</h2> <p>" . $conn->error . "</p>";
        }
        ?>
        <a href="item_venda_form.php" class="btn-voltar">Adicionar Outro Item</a>
        <a href="item_venda_exibir.php" class="btn-voltar">Ver Itens de Venda</a>
    </div>
</body>
</html>
