<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>商品詳細</title>
  </head>
  <body>
    <?php require 'Header.php'; ?>
    <?php require 'Sidebar.php'; ?>
    <link rel="stylesheet" type="text/css" href="./css/syousai.css">
    <div class="body-style">
      <?php
        $pdo = new PDO($connect, USER, PASS);
        if (isset($_GET['productID'])) {
            $sql = $pdo->prepare('SELECT * FROM product WHERE productID = ?');
            $sql->execute([$_GET['productID']]);
            foreach ($sql as $row) {
      ?>
      <div class="product">
        <div class="product-left">
          <p><img class="product-img" src="./image/<?php echo $row['imgPass']; ?>" height="260"></p>
        </div>

        <div class="product-right">
          <div class="details">
            <span class="product-info">
              <span class="product-name">商品名: <?php echo $row['productName']; ?></span><br>
              <span class="product-price">価格: <?php echo $row['price']; ?>円</span>
              <i class="product-description">商品説明<br><br><span>こちらの商品は・・・</span></i>
            </span>
          </div>

          <div class="control-list">
            <form action="./Cart.php" method="post" class="cartAdd">
              <label for="category_select">個数</label>
              <select class="quantity-change" name="count" id="category_select" onchange="changed()">
                <?php
                  for ($i = 1; $i < 11; $i++) {
                    echo '<option value="' , $i , '">' , $i , '</option>';
                  }
                ?>
              </select>

              <input type="hidden" name="id" value="<?php echo $row['productID']; ?>">
              <p><input type="submit" value="カートに追加"></p>
            </form>

            <form action="Purchase-input.php" method="post">
              <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>">
              <input type="hidden" name="count" id="category_hidden" value=1>
              <p><input type="submit" value="購入画面へ"></p>
            </form>
          </div>
        </div>
      </div>

      <table class="product-overview"> 
        <tr><th>商品概要</th></tr>
        <tr><td>商品名称</td><td><?php echo $row['productName']; ?></td></tr>
        <tr><td>賞味期限</td><td>2024年12月31日</td></tr>
        <tr><td>配送方法</td><td>冷凍便</td></tr>
      </table>
      <?php
          }
        }
      ?>
      <div class="other">
        <div class="other-container">
          <h2 class="payment">お支払いについて</h2>
          <div class="payment-options">
            <div class="online-payment">
              <h2>・オンライン決済</h2>
              <i>クレジットカード</i><br>
            </div>
            <div class="bank-transfer">
              <h2>・口座振り込み</h2><br>       
              <i>対応店舗</i><br>
            </div>
            <div class="cash-delivery">
              <h2>・代金引換</h2><br>
            </div>
          </div>
        </div>
        <div class="return-description">
          <h2>返品・交換について</h2>
          <i>未使用・未開封のみ可</i><br>
        </div>
      </div>
      <form action="商品一覧URL" method="post">
        <input type="submit" value="商品一覧へ" class="back">
      </form>
      <script>
        function changed() {
          var category_select = document.getElementById("category_select");
          var category_hidden = document.getElementById("category_hidden");

          var idx = category_select.selectedIndex;
          var num = category_select.options[idx].value;

          category_hidden.value = num;
        }
      </script>
    </div>
  </body>
</html>