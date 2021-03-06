<?php require "../r_header.php"; ?>
<style>
  h1 {
    margin-top: 100px
  }
</style>

<?php
$id = $_POST['updid'];
$count = $_POST['count'];
echo '<h1 class="text-center">変更しますか？</h1>';
echo '<div class="container fixed-bottom mb-5">';
echo '<div class="mb-3">';
echo '<form action="Change_completed.php" method="post">';
echo '<input type="hidden" name="confirm_updid" value="', $id, '">';
echo '<input type="hidden" name="confirm_count" value="', $count, '">';
echo '<input type="submit" value="確定" class="update-btn">';
echo '</form>';
echo '</div>';
echo '<div>';
echo '<a href="index.php" class="back-btn">戻る</a>';
echo '</div>';
echo '</div>';
?>
<?php require "../r_footer.php"; ?>