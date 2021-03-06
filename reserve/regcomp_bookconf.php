<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../css//style.css">
</head>

<body>
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8', 'dteam', 'password');
    if (isset($_SESSION['customer'])) {
        $id = $_SESSION['customer']['customer_id'];

        $sql = $pdo->prepare('select * from customer where customer_id!=? and email_address=?');
        $sql->execute([$id, $_REQUEST['email_address']]);
    } else {
        $sql = $pdo->prepare('select * from customer where email_address=?');
        $sql->execute([$_REQUEST['email_address']]);
    }
    if (empty($sql->fetchAll())) {
        $sql = $pdo->prepare('insert into customer values (null,?,?,?)');
        $sql->execute([$_REQUEST['customer_name'], $_REQUEST['email_address'], $_REQUEST['password']]);
        echo '登録が完了しました。';
    } else {
        echo 'メールアドレスが既に使用されています';
    }
    ?>
    </br>
    <div class="log">
        <a href="login_bookconf.php">ログイン画面へ</a>
    </div>
</body>

</html>