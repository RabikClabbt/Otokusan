<?php require 'Header.php';?>
<?php

    const SERVER = 'mysql218.phy.lolipop.lan';
    const DBNAME = 'LAA1517467-mock';
    const USER = 'LAA1517467';
    const PASS = '0tokusan';

    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/ranking.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>北海道エリアの商品ページ</title>
</head>

<body>
    <div class="header">
    <div class="area" style="height: 60px; display: flex; flex-direction: column; justify-content: left; align-items: left;">

    北海道エリア　　　　　北海道１
</div>
</div>
    <div class="ad">広告</div>
    <div class="ranking">
        売れ筋ランキング👑
        <ol>
            <li>商品1👑</li>
            <li>商品2👑</li>
            <li>商品3👑</li>
        </ol>
    </div>

    <div class="ranking-list">
        <div class="rproduct">
            <div class="rproduct-name">商品1👑</div>
            <img src="./image/meron.jpg" alt="商品1の写真">
            <div class="rproduct-description">
                <h2>商品1</h2>
            </div>
        </div>

        <div class="rproduct">
            <div class="rproduct-name">商品2👑</div>
            <img src="商品2の画像のURL" alt="商品2の写真">
            <div class="rproduct-description">
                <h2>商品2</h2>
            </div>
        </div>

        <div class="rproduct">
            <div class="rproduct-name">商品3👑</div>
            <img src="商品3の画像のURL" alt="商品3の写真">
            <div class="rproduct-description">
                <h2>商品3</h2>
            </div>
        </div>
    </div>

    <div class="ranking">
        商品一覧
        <?php

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo '<table>';
    echo '<tr> <th>商品番号</th><th>写真</th><th>商品名</th><th>価格</th> </tr>';

    $sql = "SELECT p.*, pr.prefecturesName FROM product p
            JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo
            WHERE p.prefecturesNo = '01'";
    $stmt = $pdo->query($sql);

    // クエリの実行が成功した場合のみ foreach ループを実行
    if ($stmt !== false) {
        foreach ($stmt as $row) {
            $id = $row['prefecturesName']; // 商品番号を取得
            echo '<tr>';
            echo '<td>', $id, '</td>';
            echo '<td><img src="', $row['imgPass'], '" alt="', $row['productName'], 'の写真"></td>';
            echo '<td>';
            echo '<a href="detail.php?id=', $id, '">', $row['productName'], '</a>';
            echo '</td>';
            echo '<td>', $row['price'], '</td>';
            echo '</tr>';
        }
    } else {
        echo "Error: クエリの実行に失敗しました。";
    }

    echo '</table>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

