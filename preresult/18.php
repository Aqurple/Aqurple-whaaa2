<!--#18-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './17.php';

if (isset($_GET['group_id'])) {
    $group_id = $_GET['group_id'];
    $sql = "SELECT * FROM students WHERE group_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $group_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<form method="GET">
    Группа:
    <select name="group_id" required>
        <?php
        $groups = $conn->query("SELECT * FROM groups");
        while ($row = $groups->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Фильтровать</button>
</form>

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