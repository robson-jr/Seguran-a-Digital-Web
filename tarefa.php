<?php
require_once "conf.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    $sql = "INSERT INTO tasks (title, description) VALUES (:title, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);

    try {
        $stmt->execute();
        echo "Tarefa adicionada com sucesso!";
    } catch (PDOException $e) {
        die('Erro ao adicionar tarefa: ' . $e->getMessage());
    }
}
?>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="title">Título da tarefa:</label>
    <input type="text" name="title" required><br>

    <label for="description">Descrição da tarefa:</label>
    <textarea name="description"></textarea><br>

    <input type="submit" value="Adicionar">
</form>
