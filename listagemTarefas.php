<?php
$host = 'localhost';
$dbname = 'to-do-project';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM tasks";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($tasks)) {
        echo "<h2>Tarefas:</h2>";
        echo "<ul>";
        foreach ($tasks as $task) {
            $status = $task['completed'] ? "Concluída" : "Pendente";
            echo "<li>";
            echo "<strong>Título:</strong> " . htmlspecialchars($task['title']) . "<br>";
            echo "<strong>Descrição:</strong> " . htmlspecialchars($task['description']) . "<br>";
            echo "<strong>Status:</strong> " . $status;
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Não há tarefas.</p>";
    }
} catch (PDOException $e) {
    die('Erro ao obter as tarefas: ' . $e->getMessage());
}
?>
