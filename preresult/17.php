<!--#17-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './16.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_id = $_POST['course_id'];
    $sql = "DELETE FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    if ($stmt->execute()) {
        echo "Курс удалён";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
}
?>

<form method="POST">
    ID курса для удаления: <input type="number" name="course_id" required>
    <button type="submit">Удалить</button>
</form>