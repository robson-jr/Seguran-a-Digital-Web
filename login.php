<?php
session_start();
require_once "conf.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);

    try {
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "Nome de usuário ou senha inválidos.";
        }
    } catch (PDOException $e) {
        echo "Erro ao efetuar login: " . $e->getMessage();
    }
}
?>

<h2>Login</h2>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">Nome de usuário:</label>
    <input type="text" name="username" required><br>

    <label for="password">Senha:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>
