<!--#12-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './11.php';
?>

<form method="GET">
    Имя студента: <input type="text" name="name" required>
    <button type="submit">Поиск</button>
</form>

<?php
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "SELECT students.id, students.name, students.group_id, groups.name AS group_name 
        FROM students
        LEFT JOIN groups ON students.group_id = groups.id
            WHERE students.name LIKE ?";
    $stmt = $conn->prepare($sql);
    $search = "%$name%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Группа</th>
            <th>ID группы</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['group_name'] ?? '—' ?></td>
            <td><?= $row['group_id'] ?? '—' ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php
}
?>