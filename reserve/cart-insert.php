<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALB2S-Cart_Insert</title>
    <link rel="icon" type="image/x-icon" href="../img/apple-icon-120x120.png">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <?php require "header.php"; ?>
    <div class="container card mx-auto mt-5" id="cart-insert" style="width:50%; margin:0 auto;">
        <?php 
            $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
            $sql = $pdo -> prepare("select box_lunch_name, price, box_image_pass, max_quantity from box_lunch where box_lunch_id = ?");
            $sql -> execute([$_POST["id"]]);
            // 選択した弁当の個数
            $qua = $_POST["quantity"];
            $max = $_POST["max"];
            // $next_book_day = $_SESSION["book_day"];

            $bento_name;$bento_price;$bento_img;$rest;
            foreach($sql as $row){
                $bento_name = $row["box_lunch_name"];
                $bento_price = $row["price"];
                $bento_img = $row["box_image_pass"];
            }
            if(isset($_SESSION["customer"])){
                $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
                $sql = $pdo -> prepare("select count(*) as cnt from reservation where customer_id = ? and box_lunch_id = ? and receipt_date = ? and  cart_flg = 0");
                $sql -> execute([$_SESSION["customer"]["customer_id"],$_POST["id"],$_SESSION["book_day"]]);

                foreach($sql as $row){
                    if($row["cnt"] == 0){
                        $sql = $pdo -> prepare("insert into reservation(reservation_id,customer_id,box_lunch_id,quantity,receipt_date,pay_flg,reserve_card) values(null,?,?,?,?,0,null)");
                        $sql -> execute([$_SESSION["customer"]["customer_id"],$_POST["id"],$qua,$_SESSION["book_day"] ]);
                    }else{
                        $sql_1 = $pdo -> prepare("select *  from reservation where customer_id = ? and box_lunch_id = ? and receipt_date = ? and  cart_flg = 0");
                        $sql_1 -> execute([$_SESSION["customer"]["customer_id"],$_POST["id"],$_SESSION["book_day"] ]);
                        $rev_id;
                        $rev_qua;
                        foreach($sql_1 as $row){
                            $rev_id = $row["reservation_id"];
                            $rev_qua = $row["quantity"];
                        } 
 
                        $sql_2 = $pdo -> prepare("update reservation set quantity = ? where reservation_id = ?");
                        if(isset($rev_id) && isset($rev_qua)){
                            $sql2 = $pdo -> prepare("select sum(quantity) as total from reservation where box_lunch_id = ? and receipt_date = ? and cart_flg = 1");
                            $sql2 -> execute([$_POST["id"],$_SESSION["book_day"]]);
                            foreach($sql2 as $row2){
                                if($row2["total"] > 0){
                                    $max -= $row2["total"];
                                }
                            }
                            
                            $sum = (int)$rev_qua + (int)$qua;
                            if($sum > $max){
                                $sum = $max;
                            }
                        }
                        
                        if(isset($sum)){
                            $sql_2 -> execute([$sum,$rev_id]);
                        }
                    }
                }
            }else{
                if(isset($_SESSION["cart_temp"])){
                    $jg = false;
                    for($i = 0 ; $i < count($_SESSION["cart_temp"]) ; $i++){
                        $str = explode(",",$_SESSION["cart_temp"][$i]);
                        if($str[0] === $_POST["id"]){
                            $num = (int)$str[1] + $qua;
                            if($num > $max){
                                $num = $max;
                            }
                            $temp = $str[0].",".$num.",".$str[2];
                            $_SESSION["cart_temp"][$i] = $temp;
                            $jg = true;
                            break;
                        }
                    }
                    if($jg){
                    }else{
                        $temp = $_POST["id"].",".$qua.",".$_SESSION["book_day"];
                        $num = count($_SESSION["cart_temp"]);
                        $_SESSION["cart_temp"][$num] = $temp;
                    }
                }else{
                    $temp = $_POST["id"].",".$qua.",".$_SESSION["book_day"];
                    $_SESSION["cart_temp"][0] = $temp;
                }
            }
        ?>
        <h5 class="card-title mt-3">カートに追加しました</h5>
        <img class="bd-placeholder-img card-img-top" width="100%" src="../img/menu_img/<?php echo $bento_img;?>">
        <h4 class="card-title mt-3"><?php echo $bento_name; ?></h4>
            <p class="card-text">
                <div class="row">
                    <div class="col-6">
                        <h3 class="text-center" style="display:inline;"><?php echo $qua;?>個</h3>
                    </div>
                    <div class="col-6">
                        <h3 class="text-center"><?php echo $bento_price;?>円</h3>
                    </div>
                </div>
            </p>
            <p class="card-text">
                <div class="row">
                    <div class="col-6">
                        <h3 class="text-center">合計:</h3>
                    </div>
                    <div class="col-6">
                        <h3 class="text-center mr-1"><?php echo $bento_price * $qua;?>円</h3>
                    </div>
                </div>
            </p>

        <a href="top.php" class="close-btn mb-3 mx-auto" style="width:50%; display:block;">戻る</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>
</html>