<!--#14-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './13.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_course'])) {
        $name = $_POST['name'];
        $sql = "INSERT INTO courses (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            /*чтобы БД не переполнилась постоянно сохранённой формой*/
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        echo "Курс добавлен успешно";
    }
?>

<form method="POST">
    Название курса: <input type="text" id="name" name="name" required>
    <button type="submit" name="add_course">Добавить курс</button>
</form>