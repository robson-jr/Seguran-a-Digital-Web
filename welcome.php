<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "conf.php";

// Obtenha informações do usuário logado
$userID = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $userID);

try {
    $stmt->execute();
    $user = $stmt->fetch
    (PDO::FETCH_ASSOC);
} catch (PDOException $e) {
echo "Erro ao obter informações do usuário: " . $e->getMessage();
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo</title>
</head>
<body>
    <h2>Seja Bem Vindo!! <?php echo $user['username']; ?>!</h2>
    <p>Esta é uma tela de teste acessada somente pelo próprio usuário quando estiver logado.</p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
