<?php session_start(); ?>
<?php require 't_header.php'; ?>
<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=alb2s;charset=utf8',
  'dteam',
  'password'
);
$sql = $pdo->prepare('INSERT INTO box_lunch VALUES(null,?,?,?,?,?)');
$sql->execute([$_SESSION['trader']['id'], $_POST['confirm_name'], $_POST['confirm_price'], $_POST['confirm_count'], $_POST['confirm_img']]);
?>
<?php if (isset($sql)) : ?>
  <h1 class="text-center mt-5">追加しました。</h1>
  <footer class="mb-5 fixed-bottom" style="margin: 0 13%;">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <a href="top.php" class="btn btn-primary btn-block">トップに戻る</a>
      </div>
      <div class="col-lg-3"></div>
    </div>
  </footer>
<?php endif; ?>
<?php require '../r_footer.php'; ?>