<?php session_start(); ?>
<?php require "../r_header.php"; ?>
<style>
  h1 {
    margin-top: 100px
  }
</style>
<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=alb2s;charset=utf8',
  'dteam',
  'password'
);
?>

<?php if ($_POST['choice'] == "現金") : ?>
  <h1 class="text-center">現金支払いが完了しました。</h1>
  <?php
  date_default_timezone_set('Japan');
  echo '<h2 class="text-center">', date('Y年m月d日'), '</h2>';
  ?>
  <h1 class="text-center">当日必要な金額</h1>
  <?php
  $resv = $pdo->prepare("SELECT * FROM reservation WHERE customer_id = ? AND receipt_date = ? AND cart_flg = 0");
  $resv->execute([$_SESSION["customer"]["customer_id"], $_SESSION["book_day"]]);
  $subtotal;
  $total = 0;
  foreach ($resv as $r) {
    $box = $pdo->prepare("SELECT * FROM box_lunch WHERE box_lunch_id = ?");
    $box->execute([$r['box_lunch_id']]);
    foreach ($box as $b) {
      $subtotal = $b['price'] * $r['quantity'];
    }
    $total += $subtotal;
  }
  ?>
  <h2 class="text-center"><?php echo $total; ?>円</h2>
<?php elseif ($_POST['choice'] == "クレジットカード") : ?>
  <h1 class="text-center">クレジット決済が完了しました。</h1>
<?php endif; ?>

<?php
$rands = [];
$min = 100;
$max = 999;
for ($i = $min; $i <= $max; $i++) {
  while (true) {
    $tmp = mt_rand($min, $max);
    if (!in_array($tmp, $rands)) {
      array_push($rands, $tmp);
      break;
    }
  }
}
date_default_timezone_set('Japan');
echo '<h1 class="text-center">', '予約番号:', date('md'), $tmp, '</h1>';
?>
<?php
// 予約済みにする処理cart_flg: 0 -> 1
$sql = $pdo->prepare("UPDATE reservation SET cart_flg=1 WHERE customer_id = ? AND receipt_date = ? AND cart_flg=0");
$sql->execute([$_SESSION["customer"]["customer_id"], $_SESSION["book_day"]]);

?>
<div class="container fixed-bottom mb-5">
  <div class="mb-3">
    <a href="top.php" class="cancel-btn">トップへ戻る</a>
  </div>
</div>
<?php require "../r_footer.php"; ?>