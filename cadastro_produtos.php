<?php
include 'produtos_controller.php';
include 'header.php';

//Pega todos os usuários para preencher os dados da tabela
$products = getProducts();

$productToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário

if (isset($_GET['edit'])) {
    $productToEdit = getProduct($_GET['edit']);
}



session_start();

// Verifica se o usuário está registrado na sessão (logado)
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <style>
        td {
            text-align: center;
        }

        .active-product {
            background-color: green;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .table td, .table th {
            padding: .75rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .acoes {
            display: flex;
            align-items: center;
        }
    </style>
    <script>
        function clearForm() {
            document.getElementById('nome').value = '';
            document.getElementById('marca').value = '';
            document.getElementById('modelo').value = '';
            document.getElementById('descricao').value = '';
            document.getElementById('id').value = '';
            document.getElementById('valor-unitario').value = '';
            document.getElementById('categoria').value = '';
            document.getElementById('url-imagem').value = '';
            document.getElementById('ativo').value = '';
        }
    </script>
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <h2>Cadastro de Produtos</h2>
        <form method="POST" action="" class="form-collumn" style="justify-content: center;">

            <input type="hidden" id="id" name="id" value="<?php echo $productToEdit['id'] ?? ''; ?>">

            <div class="col">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control"
                    value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
            </div>

            <div class="row" style="margin-right: 0; margin-left: 0; margin-top:5px;">
                <div class="col">
                    <label for="nome">Marca:</label>
                    <input type="text" id="marca" style="width: 100%;" name="marca" class="form-control"
                        value="<?php echo $productToEdit['marca'] ?? ''; ?>" required>
                </div>
                <div class="col">
                    <label for="nome">Modelo:</label>
                    <input type="text" id="modelo" style="width: 100%;" name="modelo" class="form-control"
                        value="<?php echo $productToEdit['modelo'] ?? ''; ?>" required>
                </div>
            </div>

            <div class="col">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control"
                    required><?php echo $productToEdit['descricao'] ?? ''; ?></textarea>
            </div>

            <div class="row" style="margin-right: 0; margin-left: 0; margin-top:5px;">
                <div class="col">
                    <label for="nome">Valor unitário R$:</label>
                    <input type="text" id="valor-unitario" style="width: 100%;" name="valorUnitario"
                        class="form-control" value="<?php echo $productToEdit['valorUnitario'] ?? ''; ?>" required>
                </div>
                <div class="col">
                    <label for="nome">Categoria:</label>
                    <input type="text" id="categoria" style="width: 100%;" name="categoria" class="form-control"
                        value="<?php echo $productToEdit['categoria'] ?? ''; ?>" required>
                </div>
            </div>
            <div class="row" style="margin-right: 0; margin-left: 0; margin-top:5px;">
                <div class="col">
                    <label for="nome">Url da imagem</label>
                    <input type="text" id="url-imagem" style="width: 100%;" name="url_img" class="form-control"
                        value="<?php echo $productToEdit['url_img'] ?? ''; ?>" required>
                </div>

                <div class="col">
                    <label for="nome" class="form-label">Ativo?</label>
                    <select name="ativo" id="ativo" class="form-select">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>

            </div>
            <div class="col" style="margin-top: 10px;">
                <button type="submit" class="btn btn-success" name="save">Cadastrar</button>
                <button type="submit" class="btn btn-success" name="update">Salvar alteração</button>
                <button class="btn btn-primary" onclick="clearForm()">Novo produto</button>
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
                <th scope="col">Preço</th>
                <th scope="col">Ativo</th>
                <th scope="col">Categoria</th>
                <th scope="col">imagem</th>
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
                    <td><?php if ($product['ativo'] == 1) { ?>
                            <div class="active-product">
                                <span>Ativo</span>
                            </div>
                        <?php } else { ?>
                            <div class="active-product">
                                <span>Inativo</span>
                            </div>
                        <?php } ?>
                    </td>
                    <td><?php echo $product['categoria']; ?></td>
                    <td>
                        <div style="width: 100px; height: 100px;">
                            <img style="width: 100px; height: 100px; object-fit: cover; border-radius:5px;"
                                src="<?php echo $product['url_img']; ?>" alt="productImage" />
                    </td>
        </div>
        <td class="acoes" style="display:flex; border: 0;">
            <a class="btn btn-warning" style="margin: 2px;" href="?edit=<?php echo $product['id']; ?>">Editar</a>
            <a class="btn btn-danger" style="margin: 2px;" href="?delete=<?php echo $product['id']; ?>"
                onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
        </td>
        </tr>
    <?php endforeach; ?>
    </table>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>