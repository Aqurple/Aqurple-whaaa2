<!--#6-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './5.php';
    $sql = "SELECT students.name AS student_name, groups.name AS group_name 
                FROM students 
                LEFT JOIN groups ON students.group_id = groups.id";
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
        <th>Имя Студента</th>
        <th>Группа</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= $row["student_name"] ?></td>
            <td><?= $row["group_name"] ?? "—" ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>