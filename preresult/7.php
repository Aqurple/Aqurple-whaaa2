<!--#7-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './6.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_student_course'])) {
        $sql = "INSERT INTO student_courses (student_id, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $_POST['student_id'], $_POST['course_id']);
        if ($stmt->execute()) {
            echo "Студент добавлен на курс";
            /*чтобы БД не переполнилась постоянно сохранённой формой*/
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Ошибка: " . $stmt->error;
        }
    }

    $students_sql = "SELECT id, name FROM students";
    $courses_sql = "SELECT id, name FROM courses";
    $students = $conn->query($students_sql);
    $courses = $conn->query($courses_sql);
?>

<form method="POST">
        Студент: <select name="student_id" required>
            <?php while ($student = $students->fetch_assoc()): ?>
                <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
            <?php endwhile; ?>
        </select>
    <br>
        Курс: <select name="course_id" required>
            <?php while ($course = $courses->fetch_assoc()): ?>
                <option value="<?= $course['id'] ?>"><?= $course['name'] ?></option>
            <?php endwhile; ?>
        </select>
    <br>
    <button type="submit" name="register_student_course">Зарегистрировать</button>
</form>
