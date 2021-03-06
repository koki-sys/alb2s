<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="icon" type="image/x-icon" href="../img/apple-icon-120x120.png">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <?php require "header.php" ?>
    <?php 
        if(isset($_GET["jg"])){
            if($_GET["jg"] == 0){
                echo <<< EOF
                    <script>
                        alert('メールアドレス又はパスワードが違います。');
                    </script>
                EOF;
            }
        }
    ?>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <h2>学生・教員ログインシステム</h2>
    </nav>
    <div class="naka">
        <form action="index.php" method="post">
            <div class="fo">
                学校用メールアドレス<br>
            </div>
            <input class="form" type="text" size="40" name="email_address"><br>
            <div class="fo">
                パスワード<br>
            </div>
            <input class="form" size="40" type="password" name="password"><br><br>
            <input class="but" type="submit" value="ログインする"><br>
            <h3>
                <a href="newreg_booklist.php">新規登録</a><br>
                <a href="top.php">戻る</a>
            </h3>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>

</html>