<?php 
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
    $sql = $pdo -> prepare("select customer_id,count(*) as cnt from customer where email_address = ? and password = ?");
    $sql -> execute([$_POST["email_address"],$_POST["password"]]);
    foreach($sql as $row){
        if($row["cnt"] == 0){
            header('Location: http://localhost/teamD/reserve/login_booklist.php?jg=0');
        }else{
            $_SESSION["customer"]["customer_id"] = $row["customer_id"];
            header('Location: http://localhost/teamD/reserve/index.php');
        }
    }
?>