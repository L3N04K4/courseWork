<?php
include 'connect.php';
interface AddMsg{
    function message ($conn);
  }
  class Add_message implements AddMsg{
    function message($conn) 
    {
      $description = $_POST['description'];
      $hashtags = array($_POST['hashtags']);  // Массив хэштегов

      foreach($hashtags as $tag) {
        $sql = "INSERT INTO hashtag (name) VALUES ('$tag')";
        mysqli_query($conn, $sql);
        if ($conn->query($sql) === TRUE) {
          $hashtag_id = $conn->insert_id;  // id добавленного хэштега
        } 
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

// Добавление сообщения
      $sql = "INSERT INTO sms (hashtag_id,description) VALUES ('$hashtag_id', '$description')";
      if ($conn->query($sql) === TRUE) {
        $sms_id = $conn->insert_id;  // id добавленного сообщения
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      header("Location: done.html");
    }
  }
$connect = new Add_message; //экземпляр класса
$connect -> message($conn); //обращение к методу
?>


















