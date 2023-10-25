<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>システム開発演習</title>
    <link rel="stylesheet" href="./css/ex.css"/>
</head>
<body>
    <h1>条件検索</h1>
    <form action="Search-Result.php" method="post">
    <div class="text">
    <input type="text" style="width:25%;" name="sname" placeholder="商品名を入力して下さい">
    </div>
<?php
        $region = array("九州地方","四国地方","中国地方","近畿地方","中部地方","関東地方","東北地方","北海道");
        $category = array("加工食品","生鮮食品");
        $price = array("0~2000","2000~4000","4000~6000","6000~8000","8000~10000");
        
    echo '<h3>地方</h3>';
    echo '<div class="c1">';
        for($i=0;$i<8;$i++){
        echo '<input type="checkbox" name="region',$i,'">',$region[$i];
        if ($i%3==0 && $i!=0){
         echo '<br>'; 
        }
    }
    echo '</div>';

    echo '<h3>カテゴリ</h3>';
    echo '<div class="c2">';
        for($i=0;$i<2;$i++){
        echo '<input type="checkbox" name="category',$i,'">',$category[$i];
    }
    echo '</div>';
    echo '<br>';

    echo '<h3>価格</h3>';
    echo '<div class="c3">';
        for($i=0;$i<5;$i++){
        echo '<input type="checkbox" name="price',$i,'">',$price[$i];
        if ($i%2==0 && $i!=0){
         echo '<br>'; 
        }
    }
    echo '</div>';
    echo '<br>';
?>
    <p>
    <div class="button">
    <button type="submit">検索</button>
    </div>
    </p>
    </form>
</body>
</html>