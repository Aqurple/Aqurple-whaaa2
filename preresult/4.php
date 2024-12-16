<!--#4-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './3.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_group'])) {
        $name = $_POST['name'];
        $sql = "INSERT INTO groups (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            /*чтобы БД не переполнилась постоянно сохранённой формой*/
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        echo "Группа добавлена успешно";
    }
?>

<form method="POST">
    Группа: <input type="text" id="group_name" name="name" required>
    <button type="submit" name="add_group">Добавить группу</button>
</form>