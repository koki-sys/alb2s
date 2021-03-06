<?php 
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
    $sql = $pdo -> prepare("select customer_id,count(*) as cnt from customer where email_address = ? and password = ?");
    $sql -> execute([$_POST["email_address"],$_POST["password"]]);
    foreach($sql as $row){
        if($row["cnt"] == 0){
            header('Location: http://localhost/teamD/reserve/login_bookconf.php?jg=0');
        }else{
            $_SESSION["customer"]["customer_id"] = $row["customer_id"];
            foreach($_SESSION["cart_temp"] as $row_temp){
                $str = explode(",",$row_temp);
                $id = $str[0];$qua = $str[1];$date = $str[2];
                $pdo = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
                $sql = $pdo -> prepare("select count(*) as cnt from reservation where customer_id = ? and box_lunch_id = ? and receipt_date = ? and  cart_flg = 0");
                $sql -> execute([$_SESSION["customer"]["customer_id"],$id,$_SESSION["book_day"]]);

                foreach($sql as $row){
                    if($row["cnt"] == 0){
                        $sql = $pdo -> prepare("insert into reservation(reservation_id,customer_id,box_lunch_id,quantity,receipt_date,pay_flg,reserve_card) values(null,?,?,?,?,0,null)");
                        $sql -> execute([$_SESSION["customer"]["customer_id"],$id,$qua,$_SESSION["book_day"] ]);
                    }else{
                        $sql_1 = $pdo -> prepare("select *  from reservation where customer_id = ? and box_lunch_id = ? and receipt_date = ? and  cart_flg = 0");
                        $sql_1 -> execute([$_SESSION["customer"]["customer_id"],$id,$_SESSION["book_day"] ]);
                        $rev_id;
                        $rev_qua;
                        foreach($sql_1 as $row){
                            $rev_id = $row["reservation_id"];
                            $rev_qua = $row["quantity"];
                        } 
 
                        $sql_2 = $pdo -> prepare("update reservation set quantity = ? where reservation_id = ?");
                        if(isset($rev_id) && isset($rev_qua)){
                            $sql2 = $pdo -> prepare("select sum(quantity) as total from reservation where box_lunch_id = ? and receipt_date = ? and cart_flg = 1");
                            $sql2 -> execute([$id,$_SESSION["book_day"]]);
                            $sql3 = $pdo -> prepare("select max_quantity from box_lunch where box_lunch_id = ?");
                            $sql3 -> execute([$id]);
                            $max;
                            foreach($sql3 as $row3){
                                $max = $row3["max_quantity"];
                            }   
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
            }
            
            header('Location: http://localhost/teamD/reserve/pay.php');
        }
    }
?>