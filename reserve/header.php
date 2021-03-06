<header class="sticky-top">
        <div class="container-fluid" style="background-color:#FFF;">
            <div id="header-row" class="row">
                <div class="col-lg-10 col-sm-8 col-7 d-flex align-items-center ml-3">
                    <a href="top.php" class="img-wrap1""><img class="img-fluid" src="../img/alb2s_logo.png"></a>
                </div>
                <div class="col-lg col-sm col d-flex align-items-center">
                    <a href="
                        <?php 
                            if(isset($_SESSION["customer"])){
                                echo "index.php";
                            }else{
                                echo "login_booklist.php";
                            }                            
                        ?>
                    ">
                    <img class="img-fluid img-wrap2" src="../img/user_icon.png" >
                    </a>
                </div>
                <?php 
                    if(isset($_SESSION["customer"])):
                ?> 
                    <div class="col-lg col-sm col d-flex align-items-center mx-auto">
                        <a href="logout.php">
                            <img class="img-fluid img-wrap2 p-2 ml-1" src="../img/logout_icon.png" >
                        </a>
                    </div>
                <?php
                    endif;
                ?>
                <div class="co-lg col-sm col d-flex align-items-center">
                    <span id="cart_icon" style="display:block;">
                        <p>
                            <?php
                                if(isset($_SESSION["customer"])){
                                    $pdo_h = new PDO('mysql:host=localhost;dbname=alb2s;charset=utf8','dteam','password');
                                    $sql_h = $pdo_h -> prepare("select count(*) as cnt from reservation where customer_id = ? and receipt_date = ? and cart_flg = 0");
                                    $sql_h -> execute([$_SESSION["customer"]["customer_id"],$_SESSION["book_day"]]);
                                    foreach($sql_h as $row_h){
                                        if(isset($row_h["cnt"])){
                                            if($row_h["cnt"] == 0){
                                                echo 0;
                                            }else{
                                                echo $row_h["cnt"];
                                            }
                                        }else{
                                            echo "なし";
                                        }
                                    }
                                }else{
                                    if(isset($_SESSION["cart_temp"])){
                                        echo count($_SESSION["cart_temp"]);
                                    }else{
                                        echo 0;
                                    }
                                }  
                            ?>
                        </p>
                        <a href="bo_conf.php">
                            <img class="img-fluid img-wrap2" src="../img/cart_icon.png">
                        </a>        
                    </span>     
                </div>
            </div>
        </div>
</header>