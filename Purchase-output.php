<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>minamis programs</title>
</head>
<body>
    <link rel="stylesheet" href="Account/css/Login-style2.css">
    <div class="container">
    <p><img src="gahaku/arigatou.gif" alt="image"></p>
<?php
    require 'db-connect.php';

    //カート情報削除処理
        if($_POST['$cartdelete']==1){
            $sql= $pdo->prepare('delete * from cart where memberID=?');
        $sql->execute([$_SESSION['customer']['memberID']];);
        }

    /*
    // 購入テーブルに挿入
    $sql_purchase = $pdo->prepare('INSERT INTO purchase (customer_id) VALUES (?)');
    $sql_purchase->execute([$customer_id]);
    
    // 最後に挿入された購入IDを取得
    $purchase_id = $pdo->lastInsertId();
    
    // 商品ごとにループ処理
    foreach ($_SESSION['product'] as $id => $product) {
        $product_id = $id;
        $count = $product['count'];
    
        // 購入明細テーブルに挿入
        $sql = $pdo->prepare('INSERT INTO purchase_detail (purchase_id, product_id, count) VALUES (?, ?, ?)');
        $sql->execute([$purchase_id, $product_id, $count]);
    }
    */
    echo '購入手続きが完了しました。ご購入ありがとうございます。';
    echo '<a href="TOP.php">TOPへ</a>';
?>
    </div>
</body>
</html>
<?php
 $pdo = null;   //DB切断
 ?>