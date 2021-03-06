<!--ログインに成功したときに呼び出す-->
<div class="container mt-3">
  <div class="row">
    <div class="col-lg-6">
      <h1><?php echo $_SESSION['trader']['name']; ?></h1>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-2">
      <a href="logout.php" class="btn btn-danger btn-block">ログアウト</a>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-lg-6">
      <h4>販売中</h4>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-2">
      <a href="lunchbox_add.php" class="btn btn-primary btn-block">追加</a>
    </div>
  </div>

  <?php
  $pdo = new PDO(
    'mysql:host=localhost;dbname=alb2s;charset=utf8',
    'dteam',
    'password'
  );
  $sql = $pdo->prepare('SELECT * FROM box_lunch WHERE trader_id = ?');
  $sql->execute([$_SESSION['trader']['id']]);
  ?>
  <?php foreach ($sql as $row) : ?>
    <div class="row mb-4">
      <div class="col-2"></div>
      <div class="col-4">
        <form action="lunchbox_update.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['box_lunch_id']; ?>">
          <input type="hidden" name="img_path" value="<?php echo $row['box_image_pass']; ?>"">
          <input type="hidden" name="name" value="<?php echo $row['box_lunch_name']; ?>">
          <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="count" value="<?php echo $row['max_quantity']; ?>">
          <img src="../img/menu_img/<?php echo $row['box_image_pass']; ?>" alt="更新ボタンから画像を追加してください!" width="40%" height="auto" class="text-danger">
      </div>
      <div class="col-6">
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3">
            <p><?php echo $row['box_lunch_name']; ?></p>
            <p><?php echo $row['price']; ?>円</p>
          </div>
          <div class="col-6"></div>
        </div>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3">
            <input type="submit" value="更新" class="btn btn-outline-success btn-block">
          </div>
          </form>
          <div class="col-3">
            <form action="delete_confirm.php" method="post">
              <input type="hidden" name="id" value="<?php echo $row['box_lunch_id']; ?>">
              <input type="hidden" name="img_path" value="<?php echo $row['box_image_pass']; ?>">
              <input type="hidden" name="name" value="<?php echo $row['box_lunch_name']; ?>">
              <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
              <input type="hidden" name="count" value="<?php echo $row['max_quantity']; ?>">
              <input type="submit" value="削除" class="btn btn-outline-danger btn-block">
          </div>
          <div class="col-3"></div>
        </div>
        </form>
      </div>
    </div>
    <br>
  <?php endforeach; ?>
</div>