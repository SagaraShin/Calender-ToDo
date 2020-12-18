<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ToDoカレンダー</title>
</head>
<body>
  <?php
  session_start();
  $year=$_SESSION['year'];
  $last_month=$_SESSION['month'];
  $next_month=$_GET['month'];
  //年の計算を行い、結果をセッションに保存する
  if($next_month==1&$last_month==12){
    $_SESSION['year']=$year+1;
  }
  if($next_month==12&$last_month==1){
    $_SESSION['year']=$year-1;
  }
  $_SESSION['month']=$next_month;
  header('Location: Calender.php');
  ?>
</body>
</html>
