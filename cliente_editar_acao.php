<?php
require_once 'auth.php';
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE clientes SET nome = '$nome', email = '$email' WHERE id_cliente = $id_cliente";

    if ($conn->query($sql) === TRUE) {
        header("Location: cliente_exibir.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
} else {
    header("Location: cliente_exibir.php");
    exit();
}
?>