<!--#8-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './7.php';

    $sql = "SELECT courses.name AS course_name, COUNT(student_courses.student_id) AS student_count
        FROM courses
        LEFT JOIN student_courses ON courses.id = student_courses.course_id
        GROUP BY courses.id, courses.name";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result): ?>
    <table border="1">
        <tr>
            <th>Название курса</th>
            <th>Количество студентов</th>
        </tr>
        <?php while ($course = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $course['course_name'] ?></td>
                <td><?= $course['student_count'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
<?php endif; ?>