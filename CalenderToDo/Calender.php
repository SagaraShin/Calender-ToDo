<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style_calender.css">
<title>ToDoカレンダー</title>
</head>
<body>
  <?php
    session_start();
    $year;//年
    $month;//月
    $days;//月の日数
    $next_month;//来月
    $last_month;//先月
    $calender=array();//日付を格納するカレンダー(6行7列)
    $weekday=['日','月','火','水','木','金','土'];//曜日
    $first_weekday;//月の始まりの曜日

    if(isset($_SESSION['year'])&&isset($_SESSION['month'])){//セッションにある場合(カレンダーに訪れるのが初回ではない場合)
      $year=$_SESSION['year'];
      $month=$_SESSION['month'];

    }else{//セッションにない場合(初回の場合)
      $year=date('Y');
      $month=date('m');
      $_SESSION['year']=$year;
      $_SESSION['month']=$month;
    }

    $first_weekday=date('w',strtotime($year.'-'.$month.'-01'));

    $days=date('t',strtotime($year.'-'.$month));

    //カレンダーに日付を入れる作業を行う
    $column=0;//for文での配列の列を担当する
    $line=0;//for文での配列の改行を担当する

    //カレンダーのうち月の初めまでを空にする
    for($i=0; $i<$first_weekday; $i++){
      if($column!=0&($column%7)==0){
        $column=0;
        $line++;
      }
      $calender[$line][$column]='';
      $column++;
    }
    //日付をカレンダーに入れていく
    for($i=1; $i<=$days; $i++){
      if(($column%7)==0&$column!=0){
        $line++;
        $column=0;
      }
      $calender[$line][$column]=$i;

        $column++;
    }
    //カレンダーの残りの部分を空にする
    for($i=$days+$first_weekday; $i<42; $i++){
      if(($column%7)==0){
        $line++;
        $column=0;
      }
      $calender[$line][$column]='';
      $column++;
    }

    if(($month-1)==0){
      $last_month=12;
    }else{
      $last_month=$month-1;
    }
    if(($month+1)==13){
      $next_month=1;
    }else{
      $next_month=$month+1;
    }

  ?>
  <h2>カレンダー</h2>
  <h3><?php print $year;?>年<?php print $month;?>月<br/></h3>

  <a  class="month_move" href="Calender_check.php?month=<?php print $last_month;?>"><?php print $last_month;?>月へ</a>

  <a class="month_move" href="Calender_check.php?month=<?php print $next_month;?>"><?php print $next_month;?>月へ</a>
  <?php
  print '<table border="1" align="center" class="table">';
  print '<tr>';
  for($i=0; $i<7; $i++){
    print '<th>';
    print $weekday[$i];
    print '</th>';
  }
  print '<tr/>';

  $line=0;
  print '<tr>';
  for($column=0; $column<42; $column++){
    if(($column%7)==0&$column!=0){
      $line++;
      print '</tr>';
    }
    print '<th>';
    print '<a class="calender_day" href="ToDo.php?year='.$year.'&month='.$month.'&day='.$calender[$line][$column%7].'">'.$calender[$line][$column%7].'</a>';
    print '</th>';
  }

  print '</table>';

  ?>
  
</body>
</html>
