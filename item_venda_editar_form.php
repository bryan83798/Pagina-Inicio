<?php
require_once 'auth.php';
require_once 'conexao.php';

if (isset($_GET['id'])) {
    $id_item = $_GET['id'];
    $sql_item = "SELECT * FROM itens_venda WHERE id_item = $id_item";
    $resultado_item = $conn->query($sql_item);
    $item = $resultado_item->fetch_assoc();

    // Busca as vendas para o campo de seleção
    $sql_vendas = "SELECT id_venda, dat_venda FROM vendas";
    $resultado_vendas = $conn->query($sql_vendas);

    // Busca os produtos ativos para o campo de seleção
    $sql_produtos = "SELECT id_produto, dsc_produto, vlr_unit FROM produtos WHERE status = 'A'";
    $resultado_produtos = $conn->query($sql_produtos);
} else {
    header("Location: item_venda_exibir.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Item da Venda</title>
    <link rel="stylesheet" href="style.css?v=2">
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
        <h2>Editar Item na Venda</h2>
        <form action="item_venda_editar_acao.php" method="POST" id="meuForm">
            <input type="hidden" name="id_item" value="<?php echo $item['id_item']; ?>">
            
            <label>Venda:</label>
            <select name="id_venda" class="validar">
                <?php
                if ($resultado_vendas->num_rows > 0) {
                    while($venda = $resultado_vendas->fetch_assoc()) {
                        $selected = ($venda['id_venda'] == $item['id_venda']) ? "selected" : "";
                        $data_formatada = date('d/m/Y', strtotime($venda["dat_venda"]));
                        echo "<option value='" . $venda["id_venda"] . "' $selected>Venda ID: " . $venda["id_venda"] . " - Data: " . $data_formatada . "</option>";
                    }
                }
                ?>
            </select>

            <label>Produto:</label>
            <select name="id_produto" class="validar">
                <?php
                if ($resultado_produtos->num_rows > 0) {
                    while($produto = $resultado_produtos->fetch_assoc()) {
                        $selected = ($produto['id_produto'] == $item['id_produto']) ? "selected" : "";
                        echo "<option value='" . $produto["id_produto"] . "' $selected>" . $produto["dsc_produto"] . " (R$ " . number_format($produto["vlr_unit"], 2, ',', '.') . ")</option>";
                    }
                }
                ?>
            </select>
            
            <label>Quantidade:</label>
            <input type="number" name="qtd" value="<?php echo $item['qtd']; ?>" min="1" class="validar">
            
            <button type="submit">Salvar Alterações</button>
        </form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="item_venda_exibir.php" class="btn-voltar">Cancelar</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
