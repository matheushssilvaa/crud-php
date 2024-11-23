<footer class="bg-dark text-white d-flex align-items-center" style="height: 1cm;">
        <div class="container text-center">
            <?php if(isset($_SESSION['nome'])): ?>
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Seu Nome ou Empresa. Todos os direitos reservados. Usuário logado: <b><?php echo htmlspecialchars($_SESSION['nome']); ?></b></p>
            <?php endif;?>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>
</html>