<?php
require_once 'auth.php';
require_once 'conexao.php';

if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];
    
    // Atualiza o status para 'I' (Inativo)
    $sql = "UPDATE produtos SET status = 'I' WHERE id_produto = $id_produto";
    
    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a lista
        header("Location: produto_exibir.php");
        exit();
    } else {
        echo "Erro ao inativar produto: " . $conn->error;
    }
} else {
    echo "ID não informado.";
}

$conn->close();
?>
