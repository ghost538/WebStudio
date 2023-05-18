<?php
$servername = '127.0.0.1';
$username = 'root';
$password = 'password';
$dbname = 'webstudio';

// создаем соединение с базой данных
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // подготавливаем запрос на вставку данных в таблицу
    $stmt = $conn->prepare("INSERT INTO main (name, phone, email, comment) VALUES (:name, :phone, :email, :comment)");

    // передаем параметры в запрос
    $stmt->bindParam(':name', $_POST['user-name']);
    $stmt->bindParam(':phone', $_POST['user-number']);
    $stmt->bindParam(':email', $_POST['user-mail']);
    $stmt->bindParam(':comment', $_POST['user-message']);

    // выполняем запрос
    $stmt->execute();

} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

// закрываем соединение
$conn = null;

header('Location: index.html');
?>
