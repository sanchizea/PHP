<?php include("connect.php"); 
header("Content-type: text/html; charset=UTF-8"); 


if(empty($_POST['js'])){ 
    if($_POST['message'] != '' && $_POST['author'] != ''){

        $author = @iconv("UTF-8", "windows-1251", $_POST['author']);
        $author = addslashes($author);
        $author = htmlspecialchars($author);
        $author = stripslashes($author);
        $author = mysql_real_escape_string($author); 

        $message = @iconv("UTF-8", "windows-1251", $_POST['message']);
        $message = addslashes($message);
        $message = htmlspecialchars($message);
        $message = stripslashes($message);
        $message = mysql_real_escape_string($message);

        $date = date("d-m-Y в H:i:s");
        $result = $mysql->query("INSERT INTO messages (author, message, date) VALUES ('$author', '$message', '$date')"); // Передаем в БД значения
        if($result == true){
            echo 0;
        }else{
            echo 1;
        }
    }else{
        echo 2;
    }
}



if($_POST['js'] == 'no'){
    if($_POST['message'] != '' && $_POST['author'] != ''){

        $author = $_POST['author'];
        $author = addslashes($author);
        $author = htmlspecialchars($author);
        $author = stripslashes($author);

        $message = $_POST['message'];
        $message = addslashes($message);
        $message = htmlspecialchars($message);
        $message = stripslashes($message);

        $date = date("d-m-Y в H:i:s");
        $result = $mysql->query("INSERT INTO messages (author, message, date) VALUES ('$author', '$message', '$date')");
        if($result == true){
            echo "Ваше сообшение успешно отправлено"; 
        }else{
            echo "Сообщение не отправлено. Ошибка базы данных";
        }
    }else{
        echo "Нельзя отправлять пустые сообщения"; 
    }
}
?>