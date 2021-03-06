<?php require "r_header.php"; ?>
<style>
 h1 {
    margin-top:100px
 }
</style>

<h1 class="text-center">クレジット決済が完了しました。</h1>
<?php
$rands = [];
$min = 100; $max = 999;
for( $i = $min; $i <= $max; $i++ ){
    while( true ){
        $tmp = mt_rand( $min, $max );
        if(!in_array( $tmp, $rands ) ){
            array_push( $rands, $tmp );
            break;
        }
    }
}
date_default_timezone_set('Japan');
echo '<h1 class="text-center">','予約番号:',date('md'),$tmp,'</h1>';
?>

<div class="container fixed-bottom mb-5">
<div class="mb-3">
 <a href="<!-- URL -->" class="btn btn-block text-white" style="background-color: #EEBCCE;">トップへ戻る</a>
 </div>
 </div>
<?php require "r_footer.php"; ?>