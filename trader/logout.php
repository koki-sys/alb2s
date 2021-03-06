<?php 
  session_start();
  if(isset($_SESSION['trader'])){
    unset($_SESSION['trader']);
    echo "<script type='text/javascript'>alert('ログアウトしました。');</script>";
    echo "<script type='text/javascript'>location.href = 'http://localhost/teamD/trader/login.php';</script>";
  } else {
}