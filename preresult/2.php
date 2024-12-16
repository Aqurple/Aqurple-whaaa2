<!--#2-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './1.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
        $name = $_POST['name'];
        $sql = "INSERT INTO students (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            /*чтобы БД не переполнилась постоянно сохранённой формой*/
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        echo "Студент добавлен успешно";
    }
?>

<form method="POST">
    Имя студента: <input type="text" id="name" name="name" required>
    <button type="submit" name="add_student">Добавить студента</button>
</form>