<?php session_start();?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam', 'password');
$card = $_REQUEST['no1'].$_REQUEST['no2'].$_REQUEST['no3'].$_REQUEST['no4'];
$hi = 01;
$date = $_REQUEST['kigen_nen'].'-'.$_REQUEST['kigen_tuki'].'-'.$hi;
$test = $_SESSION['customer']['customer_id'];

echo $_SESSION['customer']['customer_id'];
if (preg_match('/^[\d]+$/', $card) && preg_match('/^[\d]+$/', $_REQUEST['kigen_nen']) &&preg_match('/^[\d]+$/', $_REQUEST['kigen_tuki'])) {
        $sql=$pdo->prepare('insert into credit_card values(?,?,?)');
        $sql->execute([$card, $test, $date]);
        header("Location: pay.php");
        exit();
    }else{
        $_SESSION['preg_error'] = 1;
        header("Location: pay.php");
        exit();
    }


?>