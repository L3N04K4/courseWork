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

// Добавление сообщения
$sql = "INSERT INTO sms (description)
VALUES ('$description')";
if ($conn->query($sql) === TRUE) {
  $sms_id = $conn->insert_id;  // id добавленного сообщения
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
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
  // Связь между сообщением и хэштегом
  $sql = "INSERT INTO sms (hashtag_id) VALUES ('$hashtag_id')";
  if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  header("Location: index.html");
$conn->close();
?>


