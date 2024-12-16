<!--#5-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './4.php';
    $sql_students = "SELECT id, name FROM students";
    $sql_groups = "SELECT id, name FROM groups";
    $students = $conn->query($sql_students);
    $groups = $conn->query($sql_groups);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_group'])) {
        $student_id = $_POST['student_id'];
        $group_id = $_POST['group_id'];

        if (!empty($student_id) && isset($group_id)) {
            $sql = "UPDATE students SET group_id = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $group_id, $student_id);

            if ($stmt->execute()) {
                echo "Группа обновлена";
                /*чтобы БД не переполнилась постоянно сохранённой формой*/
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo "Ошибка обновления группы: " . $conn->error;
            }
        } else {
            echo "Выберите студента и группу";
        }
    }
?>

<form method="POST">
    Студент: <select name="student_id" id="student" required>
        <option value="">Выбрать студента</option>
        <?php while ($student = $students->fetch_assoc()): ?>
            <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <br><br>

    Группа: <select name="group_id" id="group" required>
        <option value="">Выбрать группу</option>
        <?php while ($group = $groups->fetch_assoc()): ?>
            <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <br><br>

    <button type="submit" name="update_group">Обновить группу</button>
</form>

