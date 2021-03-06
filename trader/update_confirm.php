<?php require 't_header.php'; ?>
<?php
$id = $_POST['id'];
$img = $_POST['img_path'];
$name = $_POST['name'];
$price = $_POST['price'];
$count = $_POST['count'];
?>
<div class="container">
  <h1 class="text-center mt-3">更新確認画面</h1>
  <div class="row mt-3">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <label for="img">画像</label><br>
      <img src="../img/menu_img/<?php echo $img; ?>" alt="画像がセットされてません。戻るを押して画像を追加してください" width="50%" height="auto" class="text-danger"><br>
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
  <form action="update_finish.php" method="post">
    <input type="hidden" name="confirm_id" value="<?php echo $id; ?>">
    <input type="hidden" name="confirm_img" value="<?php echo $img; ?>">
    <input type="hidden" name="confirm_name" value="<?php echo $name; ?>">
    <input type="hidden" name="confirm_price" value="<?php echo $price; ?>">
    <input type="hidden" name="confirm_count" value="<?php echo $count; ?>">
    <footer class="mb-5 fixed-bottom" style="margin: 0 13%;">
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <input type="submit" value="確定する" class="btn btn-success btn-block">
  </form>
</div>
<div class="col-lg-3"></div>
</div>
<div class="row mt-3">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
    <form action="lunchbox_update.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="img_path" value="<?php echo $img; ?>">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="price" value="<?php echo $price; ?>">
      <input type="hidden" name="count" value="<?php echo $count; ?>">
      <input type="submit" value="戻る" class="btn btn-outline-success btn-block">
    </form>
  </div>
  <div class="col-lg-3"></div>
</div>
</footer>
</div>
<?php require '../r_footer.php'; ?>