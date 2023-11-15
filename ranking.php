<?php require 'db-connect.php'; ?>
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
    <img src="./image/otokusan.png" alt="ロゴの説明文" width="100" style="float: left;">

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
     echo '<table>';
     echo '<tr> <th>商品番号</th> <th>商品名</th><th>価格</th> </tr>'; 
    // 既存のdb-connect.phpファイルで定義された接続情報を使用して$pdo変数を初期化します
    $pdo = new PDO($connect, USER, PASS);
    // prefecturesNoが01の商品情報を取得するSQLクエリ
    $sql = "SELECT * FROM product WHERE prefecturesNo = '01'";
    $stmt = $pdo->query($sql);

       
        $sql=$pdo->query('select * from product');
        foreach ($sql as $row) {
            $id=$row['productID'];
            echo '<tr>';
            echo '<td>', $id, '</td>';
            echo '<td>';
            echo '<a href="detail.php?id=', $id, '">', $row['productName'], '</a>';
            echo '</td>';
            echo '<td>', $row['price'], '</td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>
</body>
</html>