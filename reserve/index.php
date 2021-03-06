<?php session_start(); ?>
<?php require "../r_header.php"; ?>
<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-7 text-left">
      <?php
      $pdo = new PDO(
        'mysql:host=localhost;dbname=alb2s;charset=utf8',
        'dteam',
        'password'
      );

      $delid = $_POST['delid'] ?? '';
      $delbtn = $_POST['delbtn'] ?? '';
      $referer = $_SERVER['HTTP_REFERER'] ?? '';

      // 遷移元によって処理を分ける（取り消し、ログイン、topに遷移）
      if ($referer == "http://localhost/teamD/reserve/index.php" && isset($delid, $delbtn)) {
        $subcancel = $pdo->prepare('DELETE FROM reservation WHERE reservation_id = ?');
        $subcancel->execute([$delid]);
      } elseif ($referer == "http://localhost/teamD/reserve/login_booklist.php") {
        // ログイン画面からの処理
        unset($_SESSION['customer']);
        $loginsql = $pdo->prepare('SELECT * from customer where email_address = ? AND password = ?');
        $loginsql->execute([$_POST['email_address'], $_POST['password']]);
        foreach ($loginsql as $login) {
          $_SESSION['customer']['customer_id'] = $login['customer_id'];
        }
      }
      // idを挿入（日付表示の部分）したのsqlのwhereをcustomer_idに変える。
      $date = $pdo->prepare('SELECT receipt_date FROM reservation WHERE reservation_id = ?');
      $date->execute([$_SESSION['customer']['customer_id']]);
      $date_s;
      foreach ($date as $row) {
        $date_s = date('m/d', strtotime($row['receipt_date']));
      }
      ?>
      <h5 class="text-left text-secondary ml-1">
        <?php echo $_SESSION["book_day"] ?>配膳分
      </h5>
    </div>
    <div class="col-5">
      <?php
      //予約した分、弁当の合計金額を出して表示する。（弁当の合計金額部分）
      $pdo = new PDO(
        'mysql:host=localhost;dbname=alb2s;charset=utf8',
        'dteam',
        'password'
      );
      $sql = $pdo->prepare('SELECT * FROM reservation WHERE cart_flg = 1 AND customer_id = ?');
      $sql->execute([$_SESSION['customer']['customer_id']]);
      $total = 0;
      $subtotal = 0;
      // box_lunch_idを使って、もう一つprepare文作って、価格をbox_lunchから取得する。
      foreach ($sql as $ttl) {
        $num = $pdo->prepare('SELECT * FROM box_lunch WHERE box_lunch_id = ?');
        $num->execute([$ttl['box_lunch_id']]);
        foreach ($num as $subttl) {
          //１つの弁当の小計
          $subtotal = $subttl['price'] * $ttl['quantity']; // 合計OOO円
        }
        // 小計を足す。
        $total += $subtotal;
      }
      ?>
      <h5 class="text-right text-secondary mr-1">
        合計<?php echo $total; ?>円
      </h5>
    </div>
  </div>

  <div class="row">
    <div class="col-1"></div>
    <div class="col-3 col-md-3 col-lg-2">
      <a href="top.php" class="back-btn mb-3">戻る</a>
    </div>
    <div class="col-1 col-md-4 col-lg-6"></div>
    <div class="col-6 col-md-3 col-lg-2">
      <a href="Cancellation_confirmation.php" class="cancel-btn float-right">
        キャンセル
      </a>
    </div>
    <div class="col-1"></div>
  </div>

  <div class="row">
    <div class="col-4 col-lg-3"></div>
    <div class="col-2 col-sm-2 col-md-4 col-lg-6"></div>
    <div class="col-5 col-sm-5 col-md-3 col-lg-2">
      <p class="text-secondary mt-1" style="font-size: 0.7rem">
        ※すべての予約がキャンセルされます。
      </p>
    </div>
    <div class="col-1"></div>
  </div>
  <!-- 画面の上部分(戻る、キャンセルボタンなど)  終わり -->
  <div class="row">
    <?php
    $pdo = new PDO(
      'mysql:host=localhost;dbname=alb2s;charset=utf8',
      'dteam',
      'password'
    );

    $sql = $pdo->prepare('SELECT * FROM reservation WHERE cart_flg = 1 AND customer_id = ?');
    $sql->execute([$_SESSION['customer']['customer_id']]);
    ?>
    <?php foreach ($sql as $resv) : ?>
      <?php
      $sub = $pdo->prepare('SELECT * FROM box_lunch WHERE box_lunch_id = ?');
      $sub->execute([$resv["box_lunch_id"]]);
      ?>

      <?php foreach ($sub as $b_lunch) : ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card mt-3">
            <img class="card-img-top" src="../img/menu_img/<?php echo $b_lunch['box_image_pass']; ?>" alt="弁当"></img>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="text-left"><?php echo $b_lunch['box_lunch_name']; ?></h5>
                </div>
                <div class="col-6">
                  <h5 class="text-right">計:<?php echo $resv['quantity'] * $b_lunch['price']; ?>円</h5>
                </div>
              </div>
              <form action="Change_confirmation.php" method="post" class="mt-2">
                <div class="form-row">
                  <div class="form-group col-8"></div>
                  <div class="form-group col-4">
                    <input type="hidden" name="updid" value="<?php echo $resv['reservation_id'] ?>">
                    <select name="count" class="form-control-sm float-right">
                      <?php for ($i = 1; $i <= 30; $i++) : ?>
                        <?php if ($i == $resv['quantity']) : ?>
                          <option value="<?php echo $i; ?>" selected><?php echo $i; ?>個</option>
                        <?php else : ?>
                          <option value="<?php echo $i; ?>"><?php echo $i; ?>個</option>
                        <?php endif; ?>
                      <?php endfor; ?>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-4 col-md-2 m-0"></div>
                  <div class="form-group col-6 col-sm-4 col-md-5 m-0 float-right">
                    <input type="submit" class="update-btn" value="変更" style="background-color: #b1e0ec; color: #ffffff">
                  </div>
              </form>
              <div class="form-group col-6 col-sm-4 col-md-5 m-0">
                <form action="index.php" method="post">
                  <input type="hidden" name="delid" value="<?php echo $resv['reservation_id']; ?>">
                  <input type="submit" name="delbtn" class="btn btn-block" style="color: #a7a7a7" value="取り消し">
                </form>
              </div>
            </div>
          </div>
        </div>
  </div>
<?php endforeach; ?>
<?php endforeach; ?>
</div>
</div>
<?php require "../r_footer.php"; ?>