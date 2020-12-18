<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ToDoカレンダー</title>
</head>
<body>
  <?php
    session_start();
    //セッションにエラー内容が残されていたら削除する
    if(isset($_SESSION['err'])){
      unset($_SESSION['err']);
    }
    //やることが送られてこなかったら画面を戻りエラーを伝える
    if(empty($_POST['content'])){
      $_SESSION['err']='やることが入力されていません';
      header('Location: ToDo.php');
    }else{
      $content=$_POST['content'];
    }

    //年、月、日を受け取りデータベースに登録する
    $year=$_POST['year'];
    $month=$_POST['month'];
    $day=$_POST['day'];

    try{
      $dsn='mysql:dbname=CalenderToDo;host=localhost;charset=utf8';
      $user='root';
      $password='';
      $dbh=new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $sql='INSERT INTO CalenderToDo(year,month,day,content) VALUES(?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      $data[]=$year;
      $data[]=$month;
      $data[]=$day;
      $data[]=$content;
      $stmt->execute($data);

      $dbh=null;
      
      header('Location: ToDo.php');

    }catch(Exception $e){
      print 'ただいま障害により大変ご迷惑お掛けしています';
      exit();
    }

    
  
  ?>
</body>
</html>
