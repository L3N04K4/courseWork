<?php
// Подключение к базе данных
$db = 'yakusheva_database';
$username = 'root';
$password = '';

$conn = new mysqli('localhost', $username, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Переменные для добавления сообщения
$description = $_POST['description'];
$hashtags = array($_POST['hashtags']);  // Массив хэштегов


foreach($hashtags as $tag) {
    $sql = "INSERT INTO hashtag (name)
    VALUES ('$tag')";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
        $hashtag_id = $conn->insert_id;  // id добавленного хэштега
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
}

// Добавление сообщения
$sql = "INSERT INTO sms (hashtag_id,description)
VALUES ('$hashtag_id', '$description')";

  header("Location: done.html");
$conn->close();
?>


