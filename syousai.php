<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Syousai.css">
    <title>商品詳細</title>
</head>
<body>
<?php require 'db-connect.php';?>
<?php require 'Header.php';?>
    <?php
$pdo = new PDO($connect, USER, PASS);
if (isset($_GET['productID'])) {
    $sql = $pdo->prepare('SELECT * FROM product WHERE productID = ?');
    $sql->execute([$_GET['productID']]);
        foreach ($sql as $row) {
        echo '<p><img alt="image" src="image/', $row['imgPass'], '.jpg"></p>';
        echo '<p>商品名:', $row['productName'], '</p>';
        echo '<p>価格:', $row['price'], '</p>';

        echo '<form action="カートページのURL" method="post">';
        echo '<p>個数:<select name="count">';
        for ($i = 1; $i < 10; $i++) {
            echo '<option value="' , $i , '">' , $i , '</option>';
        }
        echo '</select></p>';
        echo '<input type="hidden" name="id" value="' . $row['productID'] . '">';
        echo '<input type="hidden" name="name" value="' . $row['productName'] . '">';
        echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
        echo '<p><input type="submit" value="カートに追加"></p>';
        echo '</form>';
        echo '<form action="購入画面のURL" method="post">';
        echo '<p><input type="submit" value="購入画面へ"></p>';
        echo '</form>';
        echo '<i>商品説明</i><br><br><i>さっさと金払え</i>';

        echo '<table> <tr><th>商品概要</th></tr>';
        echo '<tr><td>商品名称　　上見ろ</td></tr>';
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
    <h2>オンライン決済</h2>
    <i>・クレジットカード</i><br>
    <h2>・口座振り込み</h2><br>       
    <i>対応店舗</i><br><i>・</i><br>
    <h2>・代金引換</h2><br>
</div>
    <div style="background:beige;  display:table-cell; text-align:right;">
    <h2>返品・交換について</h2>
    <i>未使用・未開封のみ可</i><br>
</div>
</div>
<a href="商品一覧URL">商品一覧へ</a>
</body>
</html>
