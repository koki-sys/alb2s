<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
  <title>支払い画面</title>
  <link rel="icon" type="image/x-icon" href="img/apple-icon-120x120.png">
  <link rel="stylesheet" href="../css/stylesheet.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style type="text/css">
    #batu {
      width: 5%;
      height: 5%;
    }

    #sentaku_title {
      font-family: "游ゴシック Medium", "Yu Gothic Medium", "游ゴシック体", "YuGothic",
        "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", "Meiryo", "verdana", sans-serif;
      font-weight: bold;
    }

    .credit_sign {
      border: 2px solid #6C757D;
      border-radius: 5px;
      width: 60%;
      background-color: white;
    }

    .row-choice {
      margin-top: 3%;
      margin-bottom: 3%;
    }

    .row-choice-btn-back {
      margin-top: 5%;
    }

    .row-choice-btn {
      margin-top: 1%;
    }

    .modal-body {
      padding-left: 15%;
      padding-right: 15%;
    }

    .modal-header {
      justify-content: right;
    }
  </style>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php require 'header.php'; ?>
  <?php
  if (isset($_SESSION["preg_error"])) :
    if ($_SESSION['preg_error'] == 1) {
      echo '<script>alert("記入項目が間違っています");</script>';
      $_SESSION['preg_error'] = 0;
    }
  endif;
  ?>
  <!-- 編集するところ→$_SESSION['preg_error'] = 0;の一文を、予約確認画面に入れておく。
    105行目、注文後遷移ファイル名
    165行目、支払方法確定ボタン押した後の画面遷移先ファイル名
    -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center">
          <span style="border-bottom: solid 1px black; font-size:130%;" id="sentaku_title">支払方法選択</span>
        </h2>
      </div>
    </div>
  </div>
  <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title" id="myModalLabel" data-dismiss="modal">
            <button type="button" class="btn btn-default"><img src="../img/batu.png" id="batu"></button>
          </div>
        </div>
        <div class="modal-body">
          <?php
          echo '<form action="insert_credit_card.php" method="post">';
          echo '<img src="../img/card_icon.png"><br>';
          echo 'カード番号 card number<br>';
          echo '<input size="4" type="tel" maxlength="4" name="no1" required>';
          echo '<input size="4" type="tel" maxlength="4" name="no2" required>';
          echo '<input size="4" type="tel" maxlength="4" name="no3" required>';
          echo '<input size="4" type="tel" maxlength="4" name="no4" required>';
          echo '<br>有効期限 Expiration<br>';
          echo '<input size="4" type="tel" maxlength="2" name="kigen_tuki" required>';
          echo '<input size="4" type="tel" maxlength="4" name="kigen_nen" required>';
          echo '<br>セキュリティコード CVC/CVV<br>';
          echo '<input size="4" type="tel" maxlength="3" name="sec" required>';
          echo '</div>';
          echo '<div class="modal-footer">';
          echo '<input type="submit" class="btn btn-primary" value="クレジットカード登録">';
          echo '</div>';
          echo '</form>';
          ?>
        </div>
      </div>
    </div>
  </div>
  <form action="Payment_completion.php" method="post">
    <div class="container">
      <div class="row row-choice">
        <div class="col-12 text-center" style="font-size:120%">
          <input id="cash" class="choose" type="radio" name="choice" value="現金" checked="checked">現金　　　　　　<br>
        </div>
      </div>
      <div class="row row-choice">
        <div class="col-12 text-center" style="font-size:120%">
          <input id="credit_card" class="btn btn-primary choose" type="radio" name="choice" value="クレジットカード" data-toggle="modal" data-target="#testModal" data-backdrop="false">クレジットカード
        </div>
      </div>
    </div>
    <div class="container credit_insert">
      <div class="container">
        <div class="row">
          <div class="col-4 offset-4 credit_sign">
            <span>登録済みクレジットカード</span>
            <?php
            $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8', 'dteam', 'password');
            $sql = $pdo->prepare('select right(card_id,4) from credit_card where credit_customer_id =?');
            if (isset($_SESSION['customer']['customer_id'])) {
              $sql->execute([$_SESSION['customer']['customer_id']]);
              if (!empty($sql)) {
                foreach ($sql as $value) {
                  echo '<br>';
                  echo '<input type="radio" name="credit_card_id" required">' . "XXXX " . current($value);
                }
              } else {
                echo 'なし';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      $('.credit_insert').hide();

      $('#cash').click(function() {
        $('.credit_insert').hide();
      });
      $('#credit_card').click(function() {
        $('.credit_insert').show();
      });
    </script>
    <div class="container">
      <div class="row row-choice-btn-back">
        <div class="col-12 text-center" style="font-size:120%">
          <!-- <input class="back btn btn-secondary btn-lg" type="button" onclick="history.back()" value="　　戻る　　"><br> -->
          <a class="back btn btn-secondary btn-lg" href="bo_conf.php">　　戻る　　</a>
        </div>
      </div>
      <div class="row row-choice-btn">
        <div class="col-12 text-center" style="font-size:120%">
          <input class="pay btn btn-primary btn-lg" type="submit" value="支払方法確定"><br>
        </div>
      </div>
    </div>
  </form>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>

</html>