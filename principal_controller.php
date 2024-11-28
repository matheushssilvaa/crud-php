<?php
<<<<<<< HEAD
include 'db.php';
session_start();

// Verifica se o usuÃ¡rio estÃ¡ registrado na sessÃ£o (logado)
=======
//Prepara pa gerenciar a sessão
session_start();

// Verifica se o usuário está registrado na sessão (logado)
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

<<<<<<< HEAD
// Armazena informaÃ§Ãµes do usuÃ¡rio
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];

// FunÃ§Ã£o para obter todos os produtos
function getProdutos() {
    global $conn;
    $result = $conn->query("SELECT * FROM produtos");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// FunÃ§Ã£o para adicionar o produto ao carrinho
function adicionarAoCarrinho($id_produto) {
    global $conn;
    
    // Verifica se o produto jÃ¡ estÃ¡ no carrinho
    if (isset($_SESSION['carrinho'][$id_produto])) {
        // Se jÃ¡ existe, aumenta a quantidade
        $_SESSION['carrinho'][$id_produto]['quantidade']++;
        $_SESSION['carrinho'][$id_produto]['subtotal'] = $_SESSION['carrinho'][$id_produto]['quantidade'] * $_SESSION['carrinho'][$id_produto]['preco'];
    } else {
        // Se nÃ£o existe, adiciona o item ao carrinho
        $produto = getProdutoPorId($id_produto);
        $_SESSION['carrinho'][$id_produto] = [
            'id_produto'   => $produto['id'],
            'nome_produto' => $produto['nome'],
            'quantidade'   => 1,
            'preco'        => $produto['valorunitario'],
            'subtotal'     => $produto['valorunitario']
        ];
    }
    header("Location: shopcart.php");
    exit();
}

// FunÃ§Ã£o para obter um produto por ID
function getProdutoPorId($id_produto) {
    global $conn;
    $result = $conn->query("SELECT * FROM produtos WHERE id = $id_produto");
    return $result->fetch_assoc();
}

// FunÃ§Ã£o para lidar com o logout
=======
// Armazena informações do usuário
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];

// Função para lidar com o logout
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
<<<<<<< HEAD

// Adicionar produto ao carrinho via POST
if (isset($_POST['adicionar_produto'])) {
    $id_produto = (int)$_POST['id_produto'];
    adicionarAoCarrinho($id_produto);
    header("Location: principal.php");
    exit();
}
=======
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
?>