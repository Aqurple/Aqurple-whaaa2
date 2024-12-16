<!--#1-->
<?php
    /*каскадное подключение (работа разбита на модули для упрощения разработки*/
    require_once './0.php';
    /*исполним подключение к БД*/
    $conn = new mysqli("localhost", "root", "", "school_management");
    if ($conn->connect_error) {
        die("Подключение к " . $db_name . " <b>не</b> выполнено" . $conn->connect_error . "<br>");
    }
    echo "Подключение к " . $db_name . " выполнено" . "<br><br>";
?>