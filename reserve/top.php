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
    <?php 
        $referer = $_SERVER['HTTP_REFERER'] ?? "";
        $ref = "http://localhost/teamD/reserve/logout.php";
        if($referer === $ref){
                $alert = "<script type='text/javascript'>alert('ログアウトしました。');</script>";
                echo $alert;
                echo "<script type='text/javascript'>location.href = 'http://localhost/teamD/reserve/top.php';</script>";
        }
?>
    <div class="day-manager">
        <div class="container day" style="width:45%; height:50px; background-color:#FFF; border:1px solid rgb(227,227,227);">
                <h5 class="text-center" style="line-height:50px;">
                    <?php 
                        $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
                        $sql = $pdo -> prepare("select date from holiday where (month = ?) or (month = (? + 1))");
                        $month = date("m");
                        $sql -> execute([$month,$month]);

                        $inc = 1;
                        while(true){
                            //次の日を管理する変数
                            $next_book_day = date("Y-m-d",strtotime("+".$inc."day"));
                            //次の日の曜日を管理する変数
                            $day_of_the_week = date('N', strtotime($next_book_day));
                            //6は土曜日、7は日曜日
                            $not_day = [6,7];
                            $week_day = ["月","火","水","木","金"];
                            //土、日ではない
                            if(!in_array($day_of_the_week,$not_day)){
                                //祝日ではない
                                $jg = false;
                                foreach($sql as $row){
                                    if($next_book_day === $row["date"]){
                                        $jg = true;
                                    }
                                }

                                if(!$jg){
                                    echo $next_book_day."(".$week_day[$day_of_the_week - 1].")";
                                    break;
                                }
                            }
                            $inc++;
                        }
                        if(isset($_SESSION["cart_temp"])){
                            for($i = 0 ; $i < count($_SESSION["cart_temp"]) ; $i++){
                                $str = explode(",",$_SESSION["cart_temp"][$i]);
                                if($str[2] !== $next_book_day) unset($_SESSION["cart_temp"][$i]);
                                $_SESSION["cart_temp"] = array_values($_SESSION["cart_temp"]);
                            }
                        }
                        $_SESSION["book_day"] = $next_book_day;
                    ?>
                </h5>
        </div>
    </div>
    <div class="bento_manager">
        <?php 
            $sql1 = $pdo -> query("select * from box_lunch");
        ?>
        <div class="row">
            <?php
                foreach($sql1 as $row1):
            ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card mb-3" style="width:95%; margin:0 auto;">
                    <img class="card-img-top" src="<?php echo "../img/menu_img/".$row1["box_image_pass"]; ?>" style="width:100%;">
                        <form action="cart-insert.php" method="POST">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo $row1["box_lunch_name"];?></h5>
                                <p class="card-text mb-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="text-center mt-2">
                                                <?php
                                                    $sql2 = $pdo -> prepare("select sum(quantity) as total from reservation where box_lunch_id = ? and receipt_date = ? and cart_flg = 1");
                                                    $sql2 -> execute([$row1["box_lunch_id"],$next_book_day]);

                                                    $total;
                                                    foreach($sql2 as $row2){
                                                        $total = $row2["total"];
                                                    }
                                                    
                                                    $x;
                                                    $n;
                                                    if(empty($total)){
                                                        $x = 1; $n = $row1["max_quantity"];
                                                    }else{
                                                        if($total < $row1["max_quantity"]){
                                                            $x = 1; $n = $row1["max_quantity"] - $total;
                                                        }else{
                                                            $x = 0; $n = 0;
                                                        }
                                                    }
                                                    if(isset($_SESSION["customer"])){
                                                        $sql3 = $pdo -> prepare("select sum(quantity) as total from reservation where box_lunch_id = ? and receipt_date = ? and cart_flg = 0");
                                                        $sql3 -> execute([$row1["box_lunch_id"],$next_book_day]);

                                                        $cart_total;
                                                        foreach($sql3 as $row3){
                                                            if($row3["total"] > 0){
                                                                $n -= $row3["total"];
                                                                if($n < 0){
                                                                    $n = 0;
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        if(isset($_SESSION["cart_temp"])){
                                                            foreach($_SESSION["cart_temp"] as $row){
                                                                $str = explode(",",$row);
                                                                $temp_id = $str[0];$temp_qua = $str[1];$temp_date = $str[2];
                                                                if($temp_id === $row1["box_lunch_id"]) $n -= (int)$temp_qua;
                                                            }
                                                        }
                                                    }
                                                    $tem_x = $x;
                                                    echo '<select class="form-control" name="quantity" style="width:70%;display:inline-block;">';
                                                    for($x ; $x <= $n ; $x++){
                                                        echo "<option value='{$x}'>{$x}</option>";
                                                    }
                                                    echo '</select>';
                                                ?>
                                                <p class="ml-1" style="display:inline;">個
                                            </h5>
                                        </div>
                                        <div class="col-6">
                                            <h3 class="text-center"><?php echo $row1["price"];;?>円</h3>
                                        </div>
                                    </div>
                                </p>
                                <?php if($n != 0):?>
                                    <!-- <input type="hidden" value="" name="date"> -->
                                    <input type="hidden" value="<?php echo $row1["box_lunch_id"]?>" name="id">
                                    <input type="hidden" value="<?php echo $row1["max_quantity"]?>" name="max">
                                    <input class="cart-btn" type="submit" value="カートへ追加" style="width:100%; border:none;">
                                <?php else: ?>
                                    <?php
                                        if($tem_x == 1): 
                                            echo "<div class='not-buy-btn'>カートにこれ以上追加できません</div>";
                                    ?>
                                    <?php else: ?>
                                        <div class="not-buy-btn">完売いたしました</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </form>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>
</html>