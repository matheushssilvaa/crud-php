<?php
include 'produtos_controller.php';
include 'header.php';

//Pega todos os usuários para preencher os dados da tabela
$products = getProducts();

$productToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $productToEdit = getProducts($_GET['edit']);
}

session_start();

// Verifica se o usuário está registrado na sessão (logado)
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <h2>Cadastro de Produtos</h2>
        <form method="POST" action="" class="form-collumn" style="justify-content: center;">

            <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">

            <div class="col">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
            </div>

            <div class="row" style="margin-right: 0; margin-left: 0; margin-top:5px;">
                <div class="col">
                <label for="nome">Marca:</label>
                <input type="text" id="marca" style="width: 100%;" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
                </div>
                <div class="col">
                <label for="nome">Modelo:</label>
                <input type="text" id="modelo" style="width: 100%;" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
                </div>
            </div>

            <div class="col">
                <label for="nome">Descrição:</label>
                <textarea type="text" id="nome" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required></textarea>
            </div>

            <div class="row" style="margin-right: 0; margin-left: 0; margin-top:5px;">
                <div class="col">
                <label for="nome">Valor unitário R$:</label>
                <input type="text" id="valor-unitario" style="width: 100%;" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
                </div>
                <div class="col">
                <label for="nome">Categoria:</label>
                <input type="text" id="categoria" style="width: 100%;" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
                </div>
            </div>
            <div class="row" style="margin-right: 0; margin-left: 0; margin-top:5px;">
                <div class="col">
                <label for="nome">Url da imagem</label>
                <input type="text" id="url-imagem" style="width: 100%;" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
                </div>

                <div class="col">
                <label for="nome">Ativo?</label>
                <select name="ativo" id="ativo">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                </div>
                
            </div>
            <div class="col" style="margin-top: 10px;">
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <button class="btn btn-primary">Editar</button>
                <button class="btn btn-primaty">Cancelar</button>
            </div>
            
        </form>

        <h2 style="margin-top: 50px;">Produtos Cadastrados</h2>
        <table border="1" class="table table-striped">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Preço unitario</th>
                <th scope="col">Ativo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Url da imagem</th>
                <th scope="col">Ações</th>
            </tr>
            <!--Faz um loop FOR no resultset de produtos e preenche a tabela-->
            <?php foreach ($products as $product): ?>
                <tr>
                    <td scope="row"><?php echo $product['id']; ?></td>
                    <td><?php echo $product['nome']; ?></td>
                    <td><?php echo $product['descricao']; ?></td>
                    <td><?php echo $product['marca']; ?></td>
                    <td><?php echo $product['modelo']; ?></td>
                    <td><?php echo $product['valorUnitario']; ?></td>
                    <td><?php echo $product['ativo']; ?></td>
                    <td><?php echo $product['categoria']; ?></td>
                    <td><?php echo $product['url_img']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $product['id']; ?>">Editar</a>
                        <a href="?delete=<?php echo $product['id']; ?>"
                            onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>