<?php
// Conexão com o banco de dados
$servername = "localhost";  // Usar localhost no XAMPP
$username = "rockmusic";         // Usuário padrão no MySQL do XAMPP
$password = "Kurtcobain27";             // Sem senha no MySQL do XAMPP
$dbname = "rockmusic";      // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Variáveis para mostrar mensagens de sucesso ou erro
$mensagem = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização dos dados do formulário
    $nome = trim($_POST['nome']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $idade = (int) $_POST['idade']; // Assumindo que idade é um número
    $banda = trim($_POST['banda']);

    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, idade, banda) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nome, $email, $idade, $banda); // s = string, i = integer

    // Executar a consulta e verificar se o cadastro foi bem-sucedido
    if ($stmt->execute()) {
        $mensagem = "Novo registro criado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar: " . $stmt->error;
    }

    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Rock Music</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>

    <!-- Exibir a mensagem de sucesso ou erro -->
    <p><?php echo $mensagem; ?></p>

    <!-- Formulário de cadastro -->
    <form method="POST" action="cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" required><br><br>

        <label for="banda">Banda favorita:</label>
        <input type="text" id="banda" name="banda" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
