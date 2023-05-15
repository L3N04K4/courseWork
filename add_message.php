<link rel="stylesheet" href="style.css">
<?php
include 'connect.php';
interface AddMsg{
  function message ($conn);
}
class Add_message implements AddMsg{
  function message($conn) 
  {
    $description = $_POST['description'];
    $hashtags = $_POST['hashtags'];  // Массив хэштегов
    $tags = preg_split("/[\s,]+/", $hashtags);
    $result = count($tags);
      for ($i=0; $i<$result; $i++){
          if (strpos($tags[$i], "#") === false) {
              $tags[$i] = "#" . $tags[$i];
            }
            else{
              $tags[$i]=$tags[$i];
            }
      }
      $tags = implode(", ", $tags);
      $sql = "INSERT INTO hashtag (name) VALUES ('$tags')";
      if ($conn->query($sql) === TRUE) {
        $hashtag_id = $conn->insert_id;  // id добавленного хэштега
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $sql = "INSERT INTO sms (hashtag_id,description) VALUES ('$hashtag_id', '$description')";
    if ($conn->query($sql) === TRUE) {
      $sms_id = $conn->insert_id;  // id добавленного сообщения
    } 
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo "<p>Сообщение: </p> <p>$description</p> <p>с хештегами: </p> <p>$tags</p> <p>Отправлено:)</p> <a href='index.html'><p>Назад</p></a>";
    }
  }
$fun = new Add_message; //экземпляр класса
$fun -> message($conn); //обращение к методу
?>



















