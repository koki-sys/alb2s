<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALB2S-top</title>
    <link rel="icon" type="image/x-icon" href="../img/apple-icon-120x120.png">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <?php require "header.php"; ?>
    <div class="container mt-3" style="width:45%; height:60px; background-color:#FFF; border:1px solid rgb(227,227,227);">
                <h5 class="text-center" style="line-height:60px;">
                    カート一覧
                </h5>
    </div>

    <div class="container mx-auto" style="width:60%;">
        <?php 
            if(isset($_SESSION["customer"])):
                $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
                $sql = $pdo -> prepare("select count(*) as cnt  from reservation where customer_id = ? and receipt_date = ? and cart_flg = 0");
                $sql -> execute([$_SESSION["customer"]["customer_id"],$_SESSION["book_day"]]);
                $cnt;
                foreach($sql as $row){
                    $cnt = $row["cnt"];
                }
                if($cnt != 0):
                    $sql1 = $pdo -> prepare("select *  from reservation where customer_id = ? and receipt_date = ? and cart_flg = 0");
                    $sql1 -> execute([$_SESSION["customer"]["customer_id"],$_SESSION["book_day"]]);
                    foreach($sql1 as $row1):
                        $bento_id = $row1["box_lunch_id"];
                        $bento_qua = $row1["quantity"];
                        $bento_sql = $pdo -> prepare("select box_lunch_name, price, box_image_pass from box_lunch where box_lunch_id = ?");
                        $bento_sql -> execute([$bento_id]);
                        $bento_name;$bento_price;$bento_path;
                        foreach($bento_sql as $row):
                            $bento_name = $row["box_lunch_name"];
                            $bento_price = $row["price"];
                            $bento_path = $row["box_image_pass"];
                        endforeach;
        ?> 
            <div class="mt-5 text-center">
                <img class="img-fluid"src="../img/menu_img/<?php echo $bento_path?>" style="width:30%;">
                <div class="ml-1" style="display:inline-block;top:50%">
                    <h3 class="text-center"><?php echo $bento_name; ?></h3>
                    <h5 class="ml-3 mr-3" style="display:inline-block;"><?php echo $bento_qua ?>個</h5>
                    <h5 style="display:inline-block;"><?php echo $bento_price ?>円/1個</h5>
                    <h3>小計:<?php echo $bento_price * (int)$bento_qua; ?></h3>
                </div>
            </div>
        <?php   endforeach; ?>
            <?php else: echo "<h3 class='text-center mt-3'>カートには何も入っていません</h3>";?>
        <?php endif;?>
        <?php else: ?>
            <?php
                if(isset($_SESSION["cart_temp"])): 
                    $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
                    foreach($_SESSION["cart_temp"] as $row):
                        $str = explode(",",$row);
                        $id = $str[0];
                        $qua = $str[1];
                        $date = $str[2];

                        $bento_sql = $pdo -> prepare("select box_lunch_name, price, box_image_pass from box_lunch where box_lunch_id = ?");
                        $bento_sql -> execute([$id]);
                        $bento_name;$bento_price;$bento_path;
                        foreach($bento_sql as $row):
                            $bento_name = $row["box_lunch_name"];
                            $bento_price = $row["price"];
                            $bento_path = $row["box_image_pass"];
                        endforeach;
            ?>  
                <div class="mt-5 text-center">
                    <img class="img-fluid"src="../img/menu_img/<?php echo $bento_path?>" style="width:30%;">
                    <div class="ml-1" style="display:inline-block;top:50%">
                        <h3 class="text-center"><?php echo $bento_name; ?></h3>
                        <h5 class="ml-3 mr-3" style="display:inline-block;"><?php echo $qua ?>個</h5>
                        <h5 style="display:inline-block;"><?php echo $bento_price ?>円/1個</h5>
                        <h3>小計:<?php echo $bento_price * (int)$qua; ?></h3>
                    </div>
                </div>
            <?php
                    endforeach;
            ?>
            <?php else: echo "<h3 class='text-center mt-3'>カートには何も入っていません</h3>";?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <a class="cart-btn mx-auto mt-4" href="
        <?php 
            if(isset($_SESSION["customer"])){
                echo "pay.php";
            }else{
                echo "login_bookconf.php";
            }
        ?>
    " style="display:block;width:30%;">予約する</a>
    <a class="close-btn mx-auto mt-2" href="top.php" style="display:block; width:30%;">戻る</a>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>
</html>