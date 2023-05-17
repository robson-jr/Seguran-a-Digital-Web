<?php
$host = 'localhost';
$dbname = 'to-do-project';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exemplo de execução de uma consulta
    $sql = "SELECT * FROM tasks";
    $stmt = $pdo->query($sql);
    
    // Exemplo de iteração sobre os resultados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['title'] . ": " . $row['description'] . "<br>";
    }
} catch (PDOException $e) {
    die('Erro de conexão com o banco de dados: ' . $e->getMessage());
}
?>
