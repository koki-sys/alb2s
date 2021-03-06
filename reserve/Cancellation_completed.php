<?php session_start(); ?>
<?php require "../r_header.php"; ?>
<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=alb2s;charset=utf8',
  'dteam',
  'password'
);
$sql = $pdo->prepare('delete from reservation where customer_id=?');
$sql->execute([$_SESSION['customer']['customer_id']]);
?>
<style>
 h1 {
    margin-top:100px
 }
</style>

<h1 class="text-center">キャンセルしました。</h1>
<div class="container fixed-bottom mb-5">
<div class="mb-3">
 <a href="index.php" class="cancel-btn">トップへ戻る</a>
 </div>
 </div>

<?php require "../r_footer.php"; ?>