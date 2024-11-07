<?php
include 'usuarios_controller.php';
include 'header.php';

//Pega todos os usuários para preencher os dados da tabela
$users = getUsers();

//Variável que guarda o ID do usuário que será editado
$userToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $userToEdit = getUser($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <script>
        function clearForm() {
            document.getElementById('nome').value = '';
            document.getElementById('telefone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('senha').value = '';
            document.getElementById('id').value = '';
        }
    </script>
</head>

<body>
    <div class="content" style="margin: 20px;">
        <h2>Cadastro de Usuários</h2>
        <form method="POST" action="" class="form-row">

            <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">

            <div class="col-3">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control"
                    value="<?php echo $userToEdit['nome'] ?? ''; ?>" required>
            </div>

            <div class="col-3">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control"
                    value="<?php echo $userToEdit['telefone'] ?? ''; ?>" required>
            </div>

            <div class="col-3">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="<?php echo $userToEdit['email'] ?? ''; ?>" required>
            </div>

            <div class="col-3">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>

            <div class="col-3">
            <button type="submit" name="save" class="btn btn-primary my-2">Salvar</button>
            <button type="submit" name="update" class="btn btn-secondary my-2 ml-2">Atualizar</button>
            <button type="button" onclick="clearForm()" class="btn btn-secondary my-2 ml-2">Novo</button>
            </div>
        </form>

        <h2 style="margin-top: 50px;">Usuários Cadastrados</h2>
        <table border="1" class="table table-striped">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Email</th>
                <th scope="col">Ações</th>
            </tr>
            <!--Faz um loop FOR no resultset de usuários e preenche a tabela-->
            <?php foreach ($users as $user): ?>
                <tr>
                    <td scope="row"><?php echo $user['id']; ?></td>
                    <td><?php echo $user['nome']; ?></td>
                    <td><?php echo $user['telefone']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $user['id']; ?>">Editar</a>
                        <a href="?delete=<?php echo $user['id']; ?>"
                            onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
        <?php include 'footer.php' ?>
</body>

</html>