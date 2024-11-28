<?php include 'principal_controller.php'; ?>
<?php include 'produtos_controller.php';

$products = getProducts();

?>

<?php include 'header.php'; ?>

<div class="container">
    <!-- Conteúdo da página vai aqui -->
    <h2>Olá, <?php echo htmlspecialchars($nome); ?>!</h2>
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
<<<<<<< HEAD
                            <?php echo $product['valorUnitario']; ?>
                        </p>
                        <p class="card-text" style="font-weight: bold;">Categoria: <small
                                class="text-body-secondary"><?php echo $product['categoria']; ?></small></p>
                        <form method="POST" action="principal.php">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                            <button type="submit" name="adicionar_produto"
                                class="btn btn-primary btn-block">Comprar</button>
                        </form>
=======
                            <?php echo $product['valorUnitario'];?></p>
                        <p class="card-text" style="font-weight: bold;">Categoria: <small
                                class="text-body-secondary"><?php echo $product['categoria']; ?></small></p>
                        <a href="#" class="btn btn-success" style="font-size: 20px;"><i class="bi bi-cart-plus-fill"
                                style="font-size: 25px;"></i>Comprar</a>
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <form method="POST" action="">
        <button type="submit" name="logout" value="logout" class="btn btn-danger" style="margin-bottom: 15px;"><i
                class="bi bi-box-arrow-right"></i>Logout</button>
    </form>
</div>
<?php include 'footer.php'; ?>