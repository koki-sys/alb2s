<?php session_start(); ?>
<?php require 't_header.php'; ?>
<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=alb2s;charset=utf8',
  'dteam',
  'password'
);
$sql = $pdo->prepare('DELETE FROM box_lunch WHERE box_lunch_id = ?');
$sql->execute([$_POST['confirm_id']]);
?>
<?php if (isset($sql)) : ?>
  <h1 class="text-center mt-5">削除しました。</h1>
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