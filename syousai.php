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
<link rel="stylesheet" type="text/css" href="Syousai.css">
    <?php
$pdo = new PDO($connect, USER, PASS);
if (isset($_GET['productID'])) {
    $sql = $pdo->prepare('SELECT * FROM product WHERE productID = ?');
    $sql->execute([$_GET['productID']]);
        foreach ($sql as $row) {
        echo '<img src="./image/',$row['imgPass'],'"height="130">';
        echo '<p>商品名:', $row['productName'], '</p>';
        echo '<p>価格:', $row['price'], '</p>';

        echo '<form action="Cart.php" method="post">';
        echo '<p>個数:<select name="count">';
        for ($i = 1; $i < 11; $i++) {
            echo '<option value="' , $i , '">' , $i , '</option>';
        }
        echo '</select></p>';

        echo '<input type="hidden" name="id" value="' . $row['productID'] . '">';
        echo '<p><input type="submit" value="カートに追加"></p>';
        echo '</form>';

        echo '<input type="hidden" name="id" value="' . $row['productID'] . '">';
        echo '<form action="購入画面のURL" method="post">';
        echo '<p><input type="submit" value="購入画面へ"></p>';
        echo '</form>';

        echo '<i class="setumei">商品説明</i><br><i>さっさと金払え</i>';

        echo '<table> <tr><th>商品概要</th></tr>';
        echo '<tr><td>商品名称　　' . $row['productName'] . '</td></tr>';
        echo '<tr><td>原材料　　　？</td></tr>';
        echo '<tr><td>賞味期限　　昨日</td></tr>';
        echo '<tr><td>配送方法　　投げ配</td></tr>';
        echo '</table>';
    }
}

?>
    <div style="background:lavender;  display:table;  width:100%;">
    <div style="background:lightbrown; display:table-cell;">
    <h2>お支払いについて</h2>
    <h2 class="online">オンライン決済</h2>
    <i class="kureka">・クレジットカード</i><br>
    <h2>・口座振り込み</h2><br>       
    <i>対応店舗</i><br>
    <h2 class="daibiki">・代金引換</h2><br>
</div>
    <div style="background:beige;  display:table-cell; text-align:right;">
    <h2>返品・交換について</h2>
    <i>未使用・未開封のみ可</i><br>
</div>
</div>
<form action="商品一覧URL" method="post">
<input type="submit" value="商品一覧へ"
style="padding: 10px; background-color: #f6e5cc; color: black; border: none; border-radius: 5px; cursor: pointer;">
</form>
</body>
</html>
