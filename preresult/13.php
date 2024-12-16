<!--#13-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './12.php';

    $sql = "SELECT * FROM students WHERE group_id IS NULL";
    $result = $conn->query($sql);
?>
<p>Студенты без группы</p>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Имя</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<br>