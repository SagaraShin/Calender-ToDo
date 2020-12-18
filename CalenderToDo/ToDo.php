<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style_todo.css">
<title>ToDoカレンダー</title>
</head>
<body>
<?php
  session_start();

  if(isset($_GET['year'])&&isset($_GET['month'])&&isset($_GET['day'])){//Calender.phpからToDo.phpにきた場合
    $year=$_GET['year'];
    $month=$_GET['month'];
    $day=$_GET['day'];
    $_SESSION['yearDB']=$year;
    $_SESSION['monthDB']=$month;
    $_SESSION['dayDB']=$day;
  }else{//ToDo_check.phpからToDo.phpにきた場合
    $year=$_SESSION['yearDB'];
    $month=$_SESSION['monthDB'];
    $day=$_SESSION['dayDB'];
  }
  print $year.'年';
  print $month.'月';
  print $day.'日';

?>
 
<form method="post" action="ToDo_check.php">
  <br/><label>やること追加</label><br/>
  <input type="text" name="content">
  <input type="hidden" name="year" value=<?php print $year;?>>
  <input type="hidden" name="month" value=<?php    print $month;?>>
    <input type="hidden" name="day" value=<?php print $day;?>>

  <input type="submit" value="追加">
</form>

<?php
  //ToDo_checkでエラーがあった場合に表示する
  if(isset($_SESSION['err'])){
    print $_SESSION['err'];
    print '<br/>';
  }
  try{
    $dsn='mysql:dbname=CalenderToDo;host=localhost;charset=utf8';
      $user='root';
      $password='';
      $dbh=new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $sql='SELECT * FROM CalenderToDo WHERE year=?AND month=? AND day=?';
      $stmt=$dbh->prepare($sql);
      $data[]=$year;
      $data[]=$month;
      $data[]=$day;
      $stmt->execute($data);
      $dbh=null;
      
      print '<br/>やること一覧<br/>';
      print '<ul>';
      while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){
          break;
        }
        print '<div class="todo">';
        print '<li class="todo_content">'.$rec['content'].'</li>';
        print '<a href=ToDo_delete.php?code='.$rec['code'].'>削除</a>';
        print '</div>';
      }
      print '</ul>';
      print '<br/>';
  }catch(Exception $e){
    print 'ただいま障害により大変ご迷惑お掛けしております';
    exit();
  }

?>
<br/>
<a href="Calender.php">カレンダーに戻る</a>
</body>
</html>
