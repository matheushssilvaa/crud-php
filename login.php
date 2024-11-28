<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara e executa a consulta na tabela de usuários
<<<<<<< HEAD
    $stmt = $conn->prepare("SELECT id, nome FROM usuarios WHERE email = ? AND senha = ?");
=======
    $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE email = ? AND senha = ?");
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
<<<<<<< HEAD
        $stmt->bind_result($id, $nome);
=======
        $stmt->bind_result($nome);
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
        $stmt->fetch();
        
        //Registra o usuário na sessão
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $nome;
<<<<<<< HEAD
        $_SESSION['id'] = $id;
=======
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577

        header("Location: principal.php");
        exit();
    } else {
        echo "Login ou senha inválidos. Tente novamente.";
    }
    $stmt->close();
}
$conn->close();
<<<<<<< HEAD
?>
=======
?>
>>>>>>> d9c75e20ec3733ca700387865f9c35ebf3182577
