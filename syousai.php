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
    <header>ロゴ</header>

    <div>
        <img src="image/mentaiko.jpg" alt="商品画像">

        <i>商品名</i><br>
        <i>値段+送料</i>
    </div>
    <label for="quantity">数量</label>
    <select class="suryou" name="suryou">
        <option value="">選択してください</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <a href="カートページのURL">カートに入れる</a>
    <a href="購入ページのURL">購入する</a>
    
    <i>商品説明</i>
    <table>
        <tr>
            <td><i>商品概要</i></td>
        </tr>
        <tr>
            <td><i>商品名称　　上見ろ</i></td>
        </tr>
        <tr>
            <td><i>原材料　　　？</i></td>
        </tr>
        <tr>
            <td><i>賞味期限　　昨日</i></td>
        </tr>
        <tr>
            <td><i>配送方法　　投げ配</i></td>
        </tr>
    </table>

    <div style="background:lavender;  display:table;  width:100%;">
    <div style="background:skyblue; display:table-cell;">
    <h2>お支払いについて</h2>
    <h2>オンライン決済</h2>
    <i>・クレジットカード</i><br>
    <h2>・口座振り込み</h2><br>       
    <i>対応店舗</i><br><i>・</i><br>
    <h2>・代金引換</h2><br>
</div>
    <div style="background:orange;  display:table-cell; text-align:right;">
    <h2>返品・交換について</h2>
    <i>未使用・未開封のみ可</i><br>
</div>
</div>
<a href="商品一覧URL">商品一覧へ</a>

</body>
</html>
