<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>学生・教員新規登録</h2>
    <?php
    $email_address = $password = $customer_name = '';
    if (isset($SESSION['customer'])) {
        $email_address = $_SESSION['customer']['email_address'];
        $password = $_SESSION['customer']['password'];
        $customer_name = $_SESSION['customer']['customer_name'];
    }
    ?>
    <div class="naka">
        <form action="regcomp_bookconf.php" method="post">
            <div class="fo">
                学校用メールアドレス<br>
            </div>
            <input class="form" type="text" size="40" name="email_address"><br>
            <div class="fo">
                パスワード<br>
            </div>
            <input class="form" type="password" size="40" name="password"><br>
            <div class="fo">
                ユーザー名<br>
            </div>
            <input class="form" type="text" size="40" name="customer_name"><br>
            <h3>
                <input class="but" type="submit" value="登録">
            </h3>
        </form>
        <a href="login_bookconf.php">戻る</a>
    </div>
</body>

</html>