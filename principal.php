<?php
session_start();

// Verifica se o usuário está logado, se não redireciona
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); 
    exit();
}

// Inclui os controladores necessários
include 'principal_controller.php';
include 'produtos_controller.php';

// Obtém os produtos
$products = getProducts();

// Verifica se o formulário de adicionar ao carrinho foi enviado
if (isset($_POST['adicionar_produto'])) {
    $id_produto = $_POST['id_produto'];
    adicionarAoCarrinho($id_produto); 
    header("Location: principal.php");
    exit();
}

?>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <div class="img-card" style="width:100%; height:250px; object-fit:cover; border-radius:5px;">
                        <img style="width:100%; height:250px; object-fit:cover; border-radius:5px;"
                            src="<?php echo $product['url_img']; ?>" alt="productImage" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold;"><?php echo $product['nome']; ?></h5>
                        <p class="card-text"><?php echo $product['descricao']; ?></p>
                        <p class="card-text" style="font-weight: bold;">Preço:
                            R$ <?php echo number_format($product['valorUnitario'], 2, ',', '.'); ?>
                        </p>
                        <p class="card-text" style="font-weight: bold;">Categoria: <small
                                class="text-body-secondary"><?php echo $product['categoria']; ?></small></p>
                        <form method="POST" action="principal.php">
                            <input type="hidden" name="id_produto" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="adicionar_produto"
                                class="btn btn-primary btn-block">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Logout -->
    <form method="POST" action="">
        <button type="submit" name="logout" value="logout" class="btn btn-danger" style="margin-bottom: 15px;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>

<?php include 'footer.php'; ?>
