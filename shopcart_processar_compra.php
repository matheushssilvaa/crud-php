<?php
session_start();
include 'db.php';  // Conexão com o banco de dados
include 'shopcart_controller.php';


// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Obtém o id_usuario a partir do email do usuário logado
$email_usuario = $_SESSION['email'];
$sql_usuario = "SELECT id FROM usuarios WHERE email = '$email_usuario' LIMIT 1";
$result_usuario = $conn->query($sql_usuario);

// Verifica se o usuário existe no banco de dados
if ($result_usuario->num_rows > 0) {
    $usuario = $result_usuario->fetch_assoc();
    $id_usuario = $usuario['id'];  // O id do usuário logado
} else {
    // Se não encontrar o usuário, redireciona ou exibe erro
    echo "Usuário não encontrado.";
    exit();
}

// Verifica se o carrinho não está vazio
if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    // Insere o pedido na tabela pedidos
    $total_pedido = calcularTotalCarrinho();  // Calcula o total do pedido
    $sql_pedido = "INSERT INTO pedidos (id_usuario, total) VALUES ($id_usuario, $total_pedido)";
    
    if ($conn->query($sql_pedido) === TRUE) {
        $id_pedido = $conn->insert_id;  // Obtém o ID do pedido inserido
        
        // Insere os itens do carrinho na tabela itens_pedido
        foreach ($_SESSION['carrinho'] as $id_produto => $item) {
            $quantidade = $item['quantidade'];
            $subtotal = $item['subtotal'];
            
            $sql_item = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, subtotal) 
                         VALUES ($id_pedido, $id_produto, $quantidade, $subtotal)";
            $conn->query($sql_item);
        }
        
        // Limpa o carrinho após a compra
        unset($_SESSION['carrinho']);
        
        // Redireciona para uma página de sucesso ou confirmação
        header("Location: shopcart_sucesso_compra.php");
        exit();
    } else {
        // Caso falhe a inserção do pedido
        echo "Erro ao processar pedido: " . $conn->error;
    }
} else {
    // Caso o carrinho esteja vazio
    echo "Carrinho vazio!";
    exit();
}
?>
