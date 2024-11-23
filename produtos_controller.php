<?php
include 'db.php';

function saveProduct($nome, $descricao, $modelo, $valorUnitario, $categoria, $marca, $urlImg, $ativo) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO produtos 
    (nome, descricao, marca, modelo, valorUnitario, categoria, ativo, url_img)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nome, $descricao, $marca, $modelo, $valorUnitario, $categoria, $ativo, $urlImg);
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

function updateProduct($id,$nome, $descricao, $modelo, $preco, $categoria, $marca, $urlImg, $ativo) {
    global $conn;
    $stmt = $conn->prepare("UPDATE produtos
    SET nome = ?, descricao = ?, marca = ?, modelo = ?, valorUnitario = ?, categoria = ?, ativo = ?, url_img = ?
    WHERE id = ?");
    
    // Aqui estamos adicionando a variável $id ao bind_param
    $stmt->bind_param("ssssssssi", $nome, $descricao, $marca, $modelo, $preco, $categoria, $ativo, $urlImg, $id);
    return $stmt->execute();
}

function deleteProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save'])) {
        saveProduct($_POST['nome'], $_POST['descricao'], $_POST['modelo'], $_POST['valorUnitario'], $_POST['categoria'], $_POST['marca'], $_POST['url_img'], $_POST['ativo']);
    } elseif (isset($_POST['update'])) {
        updateProduct($_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['modelo'], $_POST['valorUnitario'], $_POST['categoria'], $_POST['marca'], $_POST['url_img'], $_POST['ativo']);
    }
}


// Processamento da exclusão
if (isset($_GET['delete'])) {
    deleteProduct($_GET['delete']);
}
?>
