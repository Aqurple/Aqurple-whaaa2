<!--#3-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './2.php';
    $sql = "SELECT students.id, students.name, students.group_id, groups.name AS group_name 
        FROM students
        LEFT JOIN groups ON students.group_id = groups.id
    ";
    $stmt = $conn->query($sql);
    $result = [];
    if ($stmt) {
        $result = $stmt->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Ошибка: " . $conn->error;
    }
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Группа</th>
        <th>ID группы</th>
    </tr>
    <?php foreach ($result as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= $student['name'] ?></td>
            <td><?= $student['group_name'] ?? '—' ?></td>
            <td><?= $student['group_id'] ?? '—' ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>