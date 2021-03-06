<?php require "../r_header.php"; ?>
<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=alb2s;charset=utf8',
  'dteam',
  'password'
);
$sql = $pdo->prepare('update reservation set quantity=? where reservation_id=?');
$sql->execute([$_POST['confirm_count'], $_POST['confirm_updid']]);
?>
<style>
  h1 {
    margin-top: 100px
  }
</style>

<h1 class="text-center">変更しました。</h1>
<div class="container fixed-bottom mb-5">
  <div class="mb-3">
    <a href="index.php" class="cancel-btn">トップへ戻る</a>
  </div>
</div>

<?php require "../r_footer.php"; ?>