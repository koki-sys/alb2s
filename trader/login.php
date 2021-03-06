<?php session_start(); ?>
<?php require 't_header.php'; ?>
<?php
$referer = $_SERVER['HTTP_REFERER'] ?? '';

// ログアウト処理
if ($referer == "http://localhost/teamD/trader/top.php?") {
  if (isset($_SESSION['trader'])) {
    unset($_SESSION['trader']);
    echo <<< EOF
      <script>
        alert('ログアウトしました。');
      </script>
      EOF;
  } else {
    echo <<< EOF
      <script>
        alert('すでにログアウトしています。');
      </script>
      EOF;
  }
}
?>
<div class="container">
  <h1 class="text-center mt-3">弁当屋ログインシステム</h1>
  <form action="top.php" method="post">
    <div class="form-group row mt-5">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <label for="name">業者名</label><br>
        <input type="text" id="name" name="name" class="form-control"><br>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <div class="form-group row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <label for="password">パスワード</label><br>
        <input type="password" id="password" name="password" class="form-control"><br>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <div class="row mb-5 fixed-bottom" style="margin: 0 13%;">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <input type="submit" value="ログインする" class="btn btn-primary btn-block">
      </div>
      <div class="col-lg-3"></div>
    </div>
  </form>
</div>
<?php require '../r_footer.php'; ?>