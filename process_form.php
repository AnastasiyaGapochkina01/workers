<?php
// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Данные для подключения к базе данных
    $host = 'localhost'; // Хост базы данных
    $username = 'worker'; // Имя пользователя базы данных
    $password = 'workerpass'; // Пароль базы данных
    $database = 'workers'; // Имя базы данных

    // Подключение к базе данных
    $connection = mysqli_connect($host, $username, $password, $database);

    // Проверка на ошибку подключения
    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получение данных из формы
    $id = $_POST["id"];
    $wname = $_POST["wname"];
    $swname = $_POST["swname"];
    $department = $_POST["department"];

    // Подготовка SQL-запроса для добавления записи
    $insertQuery = "INSERT INTO employers (id, wname, swname, department) VALUES ('$id', '$wname', '$swname', '$department')";

    // Выполнение запроса
    if (mysqli_query($connection, $insertQuery)) {
	    echo "<p>Новая запись успешно добавлена в таблицу.</p>";
	    echo '<a href="view_records.php">View all records</a>';

    } else {
        echo "Ошибка при добавлении записи: " . mysqli_error($connection);
    }

    // Закрытие соединения с базой данных
    mysqli_close($connection);
} else {
    // Если форма не была отправлена, перенаправьте пользователя на страницу с формой
    header("Location: index.html");
    exit;
}
?>
