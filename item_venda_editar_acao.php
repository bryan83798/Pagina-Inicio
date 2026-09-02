<?php
require_once 'auth.php';
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_item    = $_POST['id_item'];
    $id_venda   = $_POST['id_venda'];
    $id_produto = $_POST['id_produto'];
    $qtd        = $_POST['qtd'];

    // Calcula vlr_item em PHP (substitui o TRIGGER removido do banco de dados)
    $res_preco = $conn->query("SELECT vlr_unit FROM produtos WHERE id_produto = '$id_produto'");
    $produto   = $res_preco->fetch_assoc();
    $vlr_item  = $produto['vlr_unit'] * $qtd;

    $sql = "UPDATE itens_venda
            SET id_venda = '$id_venda', id_produto = '$id_produto', qtd = '$qtd', vlr_item = '$vlr_item'
            WHERE id_item = $id_item";

    if ($conn->query($sql) === TRUE) {
        header("Location: item_venda_exibir.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
} else {
    header("Location: item_venda_exibir.php");
    exit();
}
?>
