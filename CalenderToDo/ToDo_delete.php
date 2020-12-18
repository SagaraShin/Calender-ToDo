<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ToDoカレンダー</title>
</head>
<body>
  <?php
  //コード番号を受け取り、データベースから内容を削除する
  $code=$_GET['code'];
  try{
    $dsn='mysql:dbname=CalenderToDo;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='DELETE FROM CalenderToDo WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$code;
    $stmt->execute($data);
    $dbh=null;
    header('Location: ToDo.php');
  }catch(Exception $e){
    print 'ただいま大変ご迷惑お掛けしております';
    exit();
  }
  
  
  
  ?>
</body>
</html>
