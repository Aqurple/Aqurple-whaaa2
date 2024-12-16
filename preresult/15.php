<!--#15-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './14.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_teacher'])) {
        $name = $_POST['name'];
        $sql = "INSERT INTO teachers (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            /*чтобы БД не переполнилась постоянно сохранённой формой*/
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        echo "Преподаватель зарегистрирован успешно";
    }
?>

<form method="POST">
    Преподаватель: <input type="text" id="teacher_name" name="name" required>
    <button type="submit" name="add_teacher">Зарегистрировать преподавателя</button>
</form>