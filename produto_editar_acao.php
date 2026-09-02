<?php
require_once 'auth.php';
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produto = $_POST['id_produto'];
    $dsc_produto = $_POST['dsc_produto'];
    $vlr_unit = $_POST['vlr_unit'];

    $sql = "UPDATE produtos SET dsc_produto = '$dsc_produto', vlr_unit = '$vlr_unit' WHERE id_produto = $id_produto";

    if ($conn->query($sql) === TRUE) {
        header("Location: produto_exibir.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
} else {
    header("Location: produto_exibir.php");
    exit();
}
?>
