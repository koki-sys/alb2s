<?php require 't_header.php'; ?>
<?php
$img = $_POST['img_path'];
$name = $_POST['name'];
$price = $_POST['price'];
$count = $_POST['count'];
?>
<div class="container">
  <h1 class="text-center mt-3">追加確認画面</h1>
  <div class="row mt-3">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <label for="img">画像</label>
      <img src="../img/menu_img/<?php echo $img; ?>" alt="弁当" width="50%" height="auto"><br>
    </div>
    <div class="col-lg-3"></div>
  </div>
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <label for="name">名前</label>
      <?php echo $name; ?><br>
    </div>
    <div class="col-lg-3"></div>
  </div>
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <label for="price">値段</label>
      <?php echo $price; ?><br>
    </div>
    <div class="col-lg-3"></div>
  </div>
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <label for="count">個数</label>
      <?php echo $count; ?><br>
    </div>
    <div class="col-lg-3"></div>
  </div>
  <form action="add_finish.php" method="post">
    <input type="hidden" name="confirm_img" value="<?php echo $img; ?>">
    <input type="hidden" name="confirm_name" value="<?php echo $name; ?>">
    <input type="hidden" name="confirm_price" value="<?php echo $price; ?>">
    <input type="hidden" name="confirm_count" value="<?php echo $count; ?>">
    <footer class="mb-5 fixed-bottom" style="margin: 0 13%;">
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <input type="submit" value="確定する" class="btn btn-primary btn-block">
        </div>
        <div class="col-lg-3"></div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <a href="lunchbox_add.php" class="btn btn-outline-primary btn-block">戻る</a>
        </div>
        <div class="col-lg-3"></div>
      </div>
    </footer>
  </form>
</div>
?>
<?php require '../r_footer.php'; ?>