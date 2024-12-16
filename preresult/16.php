<!--#16-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './15.php';
?>

<form method="GET">
    Название курса: <input type="text" name="course_name" required>
    <button type="submit">Найти</button>
</form>

<?php
if (isset($_GET['course_name'])) {
    $course_name = $_GET['course_name'];
    $sql = "SELECT students.name AS student_name
            FROM students
            JOIN student_courses ON students.id = student_courses.student_id
            JOIN courses ON student_courses.course_id = courses.id
            WHERE courses.name LIKE ?";
    $stmt = $conn->prepare($sql);
    $search = "%$course_name%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <table border="1">
        <tr>
            <th>Имя студента</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['student_name'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php
}
?>
