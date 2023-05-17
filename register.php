<?php
require_once "conf.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    try {
        $stmt->execute();
        echo "Usuário registrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao registrar usuário: " . $e->getMessage();
    }
}
?>

<h2>Registro de Usuário</h2>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">Nome de usuário:</label>
    <input type="text" name="username" required><br>

    <label for="password">Senha:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Registrar">
</form>
