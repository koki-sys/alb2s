<?php 
  session_start();
  if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    unset($_SESSION["cart_temp"]);
    $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
    $delete=$pdo->prepare('DELETE FROM reservation WHERE customer_id = ? AND cart_flg = 0');
    $delete->execute([$_SESSION['customer']['customer_id']]);
    echo "<script type='text/javascript'>location.href = 'http://localhost/teamD/reserve/top.php';</script>";
  } else {
  }