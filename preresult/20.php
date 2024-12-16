<!--#20-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './19.php';

    $sql = "SELECT teachers.name AS teacher_name, COUNT(student_courses.student_id) AS total_students
            FROM teachers
            JOIN courses ON teachers.id = courses.teacher_id
            JOIN student_courses ON courses.id = student_courses.course_id
            GROUP BY teachers.id";
    $result = $conn->query($sql);
    ?>

<table border="1">
    <tr>
        <th>Преподаватель</th>
        <th>Количество студентов</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['teacher_name'] ?></td>
        <td><?= $row['total_students'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>