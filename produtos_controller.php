<?php
include 'db.php';

function saveProduct($nome, $descricao, $modelo, $preco, $categoria, $marca, $urlImg) {
    header("Location: cadastro_produtos.php?save=1");
    global $conn;
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, marca, modelo, valorUnitario, categoria, ativo, url_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nome, $descricao, $marca, $modelo, $preco, $categoria, $ativo, $urlImg);
    return $stmt->execute();
}

function getProducts() {
    global $conn;
    $result = $conn->query("SELECT * FROM produtos");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProduct($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateProduct($nome, $descricao, $modelo, $preco, $categoria, $marca, $urlImg) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, descricao = ?, marca = ?, modelo = ?, valorUnitario = ?, categoria = ?, ativo = ?, url_img = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $nome, $descricao, $marca, $modelo, $preco, $categoria, $ativo, $urlImg);
    return $stmt->execute();
}

function deleteProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save'])) {
        saveProduct($_POST['nome'], $_POST['descricao'], $_POST['modelo'], $_POST['marca'], $_POST['categoria'], $_POST['preco'], $_POST['url_img']);
    } elseif (isset($_POST['update'])) {
        updateProduct($_POST['nome'], $_POST['descricao'], $_POST['modelo'], $_POST['marca'], $_POST['categoria'], $_POST['preco'], $_POST['url_img']);
    }
}

// Processamento da exclusão
if (isset($_GET['delete'])) {
    deleteProduct($_GET['delete']);
}
?>
