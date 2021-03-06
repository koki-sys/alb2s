<?php require 't_header.php'; ?>
<div class="container">
  <h1 class="text-center mt-3">お弁当追加</h1>
  <form action="add_confirm.php" method="post">
    <div class="form-group row mt-3">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <label for="img">画像</label><br>
        <input type="file" id="img" name="img_path" class="form-control"><br>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <div class="form-group row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <label for="name">名前</label><br>
        <input type="text" id="name" name="name" class="form-control"><br>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <div class="form-group row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <label for="price">値段</label><br>
        <input type="text" id="price" name="price" class="form-control"><br>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <div class="form-group row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <label for="count">個数</label><br>
        <input type="text" id="count" name="count" class="form-control"><br>
      </div>
      <div class="col-lg-3"></div>
    </div>

    <footer class="mb-5 fixed-bottom" style="margin: 0 13%;">
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <input type="submit" value="追加する" class="btn btn-primary btn-block">
        </div>
        <div class="col-lg-3"></div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <a href="top.php" class="btn btn-outline-primary btn-block">戻る</a>
        </div>
        <div class="col-lg-3"></div>
      </div>
    </footer>
  </form>
</div>
<?php require '../r_footer.php'; ?>