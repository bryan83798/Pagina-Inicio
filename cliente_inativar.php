<?php
require_once 'auth.php';
require_once 'conexao.php';

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];
    
    // Atualiza o status para 'I' (Inativo)
    $sql = "UPDATE clientes SET status = 'I' WHERE id_cliente = $id_cliente";
    
    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a lista
        header("Location: cliente_exibir.php");
        exit();
    } else {
        echo "Erro ao inativar cliente: " . $conn->error;
    }
} else {
    echo "ID não informado.";
}

$conn->close();
?>