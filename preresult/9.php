<!--#9-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './8.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_student'])) {
        $student_id = $_POST['student_id'];
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $student_id);
        if ($stmt->execute()) {
            /*чтобы БД не переполнилась постоянно сохранённой формой*/
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        echo "Студент отчислен. Помянем";
    }
    
?>

<form method="POST">
    ID Студента: <input type="number" id="student_id" name="student_id" required>
    <button type="submit" name="delete_student">Отчислить студента</button>
</form>
<br>