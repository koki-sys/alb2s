<?php require "r_header.php"; ?>
<style>
 h1 {
    margin-top:100px
 }
</style>
<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=alb2s;charset=utf8',
  'dteam',
  'password'
);
$sql = $pdo->prepare('INSERT INTO customer VALUES(null,?,?,?)');
$sql->execute($_POST['customer_id'],$_POST['customer_name'],$_POST['email_address'],$_POST['password']);
?>
<h1 class="text-center">登録が完了しました。</h1>
<div class="container fixed-bottom mb-5">
<div class="mb-3">
 <a href="<!-- URL -->" class="btn btn-block text-white" style="background-color: #EEBCCE;">予約一覧画面へ</a>
 </div>
 </div>
<?php require "r_footer.php"; ?>