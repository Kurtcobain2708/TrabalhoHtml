<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados recebidos do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $banda = $_POST['banda'];

    // Conexão com o banco de dados
    $conn = new mysqli('localhost', 'luizcarlos', 'Kurtcobain27', 'rockmusic');

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Prepara a query SQL para inserir os dados
    $sql = "INSERT INTO usuarios (nome, email, idade, banda) VALUES ('$nome', '$email', '$idade', '$banda')";

    // Executa a consulta
    if ($conn->query($sql) === TRUE) {
        // Exibe a mensagem de sucesso
        $mensagem_sucesso = "Cadastro realizado com sucesso!";
    } else {
        // Exibe a mensagem de erro caso a inserção falhe
        $mensagem_erro = "Erro ao cadastrar: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Rock Music</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Cadastro</h1>

        <!-- Se houver uma mensagem de sucesso, exibe-a -->
        <?php if (isset($mensagem_sucesso)) { ?>
            <p style="color: green;"><?= $mensagem_sucesso ?></p>
        <?php } ?>

        <!-- Se houver uma mensagem de erro, exibe-a -->
        <?php if (isset($mensagem_erro)) { ?>
            <p style="color: red;"><?= $mensagem_erro ?></p>
        <?php } ?>

        <form method="POST" action="cadastro.php">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade" required>

            <label for="banda">Banda favorita:</label>
            <input type="text" name="banda" id="banda" required>

            <button type="submit">Cadastrar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Rock Music. Todos os direitos reservados.</p>
    </footer>

</body>
</html>

