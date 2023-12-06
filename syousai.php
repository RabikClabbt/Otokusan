<?php session_start();?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
</head>
<body>
<?php require 'Header.php';?>
<?php require 'Sidebar.php'; ?>
<link rel="stylesheet" type="text/css" href="syousai.css">
    <?php
$pdo = new PDO($connect, USER, PASS);
if (isset($_GET['productID'])) {
    $sql = $pdo->prepare('SELECT * FROM product WHERE productID = ?');
    $sql->execute([$_GET['productID']]);
        foreach ($sql as $row) {
          echo '<p class="shohin">';
          echo '<img src="./image/', $row['imgPass'], '" height="260">';
          echo '<span class="product-info">';
          echo '<span class="product-name">商品名: ', $row['productName'], '</span><br>';
          echo '<span class="product-price">価格: ', $row['price'], '円','</span>';
          echo '</span>';
          echo '</p>';
          echo '<i class="setumei">商品説明<br><br><span>こちらの商品は・・・</span></i>';


        echo '<form action="Cart.php" method="post">';
        echo '<p>個数:<select name="count">';
        for ($i = 1; $i < 11; $i++) {
            echo '<option value="' , $i , '">' , $i , '</option>';
        }
        echo '</select></p>';

        echo '<input type="hidden" name="id" value="' . $row['productID'] . '">';
        echo '<p><input type="submit" value="カートに追加"></p>';
        echo '</form>';

        echo '<form action="Purchase-input.php" method="post">';
        echo '<input type="hidden" name="productID" value="' . $row['productID'] . '">';
        echo '<p><input type="submit" value="購入画面へ"></p>';
        echo '</form>';

        echo '<table> <tr><th>商品概要</th></tr>';
        echo '<tr><td>商品名称　　' . $row['productName'] . '</td></tr>';
        echo '<tr><td>原材料　　　a</td></tr>';
        echo '<tr><td>賞味期限　　2024年12月31日</td></tr>';
        echo '<tr><td>配送方法　　冷凍便</td></tr>';
        echo '</table>';
    }
}

?>
<div style="background:lavender;  display:table;  width:100%;">
  <div style="background:lightbrown; display:table-cell;">
    <h2 style="padding-left: 50px;">お支払いについて</h2>
    <div class="payment-options">
      <div>
        <h2 class="online">・オンライン決済</h2>
        <i style="padding: 29px; font-size:x-large">クレジットカード</i><br>
      </div>
      <div>
        <h2>・口座振り込み</h2><br>       
        <i style="font-size:x-large">対応店舗</i><br>
      </div>
      <div>
        <h2 class="daibiki">・代金引換</h2><br>
      </div>
    </div>
  </div>
  <div style="background:beige;  display:table-cell; text-align:right;">
    <h2>返品・交換について</h2>
    <i style="padding: 30px; font-size:x-large">未使用・未開封のみ可</i><br>
  </div>
</div><form action="商品一覧URL" method="post">
<input type="submit" value="商品一覧へ"
style="padding: 10px; font-size:x-large; background-color: #f6e5cc; color: black; border: none; border-radius: 5px; cursor: pointer;">
</form>
</body>
</html>
