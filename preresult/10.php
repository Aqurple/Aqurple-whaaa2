<!--#10-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './9.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['student_id']) && isset($_POST['name'])) {
            $student_id = $_POST['student_id'];
            $name = $_POST['name'];

            $sql = "UPDATE students SET name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $name, $student_id);
            $stmt->execute();
            /*if ($stmt->execute()) {
                echo "Имя студента обновлено";
                // Избежание повторной отправки формы
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo "Ошибка: " . $stmt->error;
            }*/
        }
    }
?>

<form method="POST" action="">
    ID студента: <input type="number" id="student_id" name="student_id" required>
    Новое имя: <input type="text" id="name" name="name" required>
    <button type="submit">Обновить имя</button>
</form>