<!--#0 — так как для всех заданий предполагается, что есть база данных school_management, то её для начала стоит создать-->
<?php
    /*так как таблиц будет больше, чем одна, то лучше бы создать функцию для добавления таблиц*/
    function create_table($connection, $table_query) {
        if ($connection->query($table_query)) {
            echo "Таблица создана успешно" . "<br>";
        } else {
            echo "Ошибка при создании таблицы: " . $connection->error . "<br>";
        }
    }

    /*и сразу же сами таблицы, а также само название БД (пришлось немного изменить структуру, ибо с предложенной по ТЗ выполнение всего функционала невозможно):*/
    $db_name = "school_management";
    $groups_table_query = "
    CREATE TABLE IF NOT EXISTS groups (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    )
    ";
    $students_table_query = "
    CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        group_id INT,
        FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE SET NULL
    )
    ";
    $teachers_table_query = "
    CREATE TABLE IF NOT EXISTS teachers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )
    ";
    $courses_table_query = "
    CREATE TABLE IF NOT EXISTS courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        teacher_id INT,
        FOREIGN KEY (teacher_id) REFERENCES teachers(id)
    );
    ";
    $student_courses_table_query = "
    CREATE TABLE IF NOT EXISTS student_courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT,
        course_id INT,
        FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
        FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
    )
    ";

    /*теперь исполним подключение к БД*/
    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error) {
        die("Подключение к " . $db_name . " <b>не</b> выполнено" . $conn->connect_error . "<br>");
    }
    echo "Подключение к " . $db_name . " выполнено" . "<br>";

    /*здесь же представлено создание БД*/
    if($conn->query("CREATE DATABASE IF NOT EXISTS $db_name")) {
        echo "База данных '$db_name' создана" . "<br>";
    } else {
        echo "Ошибка при создании базы данных: " . $conn->error . "<br>";
    }

    /*выберем получившуюся БД для последующего её наполнения*/
    if ($conn->select_db($db_name)) {
        echo "Используется база данных '$db_name'" . "<br>";
    } else {
        echo "Ошибка выбора базы данных: " . $conn->error . "<br>";
    }

    /*наполнение БД:*/
    create_table($conn, $groups_table_query);
    create_table($conn, $students_table_query);
    create_table($conn, $teachers_table_query);
    create_table($conn, $courses_table_query);
    create_table($conn, $student_courses_table_query);

    /*прервём подключение к БД*/
    $conn->close();
    echo "Подключние к '$db_name'" . " прервано" . "<br><br>";
?>