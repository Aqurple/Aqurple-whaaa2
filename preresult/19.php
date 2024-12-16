<!--#19-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './18.php';

$sql = "SELECT students.name AS student_name, COUNT(student_courses.course_id) AS course_count
        FROM students
        JOIN student_courses ON students.id = student_courses.student_id
        GROUP BY students.id
        HAVING course_count > 1";
$result = $conn->query($sql);
?>

<table border="1">
    <tr>
        <th>Имя студента</th>
        <th>Количество курсов</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['student_name'] ?></td>
        <td><?= $row['course_count'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<br>