<?php
include 'db.php';

// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Função para obter o produto por ID do banco de dados
function getProdutoPorId($id_produto) {
    global $conn;
    $result = $conn->query("SELECT * FROM produtos WHERE id = $id_produto");
    return $result->fetch_assoc();
}

// Função para adicionar um produto ao carrinho
function adicionarAoCarrinho($id_produto) {
    global $conn;

    // Verifica se o carrinho já existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    $produto = getProdutoPorId($id_produto);

    // Verifica se o produto existe no banco de dados
    if ($produto) {
        if (isset($_SESSION['carrinho'][$id_produto])) {
            $_SESSION['carrinho'][$id_produto]['quantidade'] += 1;
            $_SESSION['carrinho'][$id_produto]['subtotal'] = $_SESSION['carrinho'][$id_produto]['quantidade'] * $_SESSION['carrinho'][$id_produto]['preco'];
        } else {
            $_SESSION['carrinho'][$id_produto] = array(
                'nome_produto' => $produto['nome'],
                'preco' => $produto['valorUnitario'],
                'quantidade' => 1,
                'subtotal' => $produto['valorUnitario']
            );
        }
    }
}

function calcularTotalCarrinho() {
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}
?>
