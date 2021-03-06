<?php session_start(); ?>
<?php require 't_header.php'; ?>
<?php
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$loginRef = "http://localhost/teamD/trader/login.php";

if ($referer == $loginRef && isset($_POST['name'], $_POST['password'])) {
  // ログイン処理
  unset($_SESSION['trader']);
  $pdo = new PDO(
    'mysql:host=localhost;dbname=alb2s;charset=utf8',
    'dteam',
    'password'
  );
  $sql = $pdo->prepare('select * from trader where trader_name=? and password=?');
  $sql->execute([$_POST['name'], $_POST['password']]);
  foreach ($sql as $row) {
    $_SESSION['trader'] = [
      'id' => $row['trader_id'],
      'name' => $row['trader_name'],
      'email' => $row['email_address'],
      'password' => $row['password']
    ];
  }
  if (isset($_SESSION['trader'])) {
    // ログインに成功したとき、専用のページを持ってくる。
    require 'login-success.php';
    echo <<< EOF
      <script>
        alert('ログインしました。');
      </script>
    EOF;
  } else {
    header('Location: http://localhost/teamD/trader/login.php');
  }
} elseif ($referer != $loginRef && isset($_SESSION['trader'])) {
  require 'login-success.php';
} else {
  echo <<< EOF
      <script>
        alert("ログインエラー。\nログインページからログインしてください。");
      </script>
    EOF;
  header('Location: http://localhost/teamD/trader/login.php');
}
?>
<?php require '../r_footer.php'; ?>