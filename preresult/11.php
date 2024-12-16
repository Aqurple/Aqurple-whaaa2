<!--#11-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './10.php';
    
    $sql = "SELECT teachers.name AS teacher_name, courses.name AS course_name
            FROM teachers
            LEFT JOIN courses ON teachers.id = courses.teacher_id";
    $result = $conn->query($sql);
?>
    
<table border="1">
    <tr>
        <th>Преподаватель</th>
        <th>Курс</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['teacher_name'] ?></td>
        <td><?= $row['course_name'] ?? '—' ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<br>