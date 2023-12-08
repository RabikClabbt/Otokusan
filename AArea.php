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
    <link rel="stylesheet" href="./css/koukoku.css">
    <link rel="stylesheet" href="./css/Area.css">
    <script src="./script/AArea.js"></script> 
</head>
<body>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エリアの商品ページ</title>

    <div class ="slide-pic">
  <div id ="slide" class="slideshow">
    <p class="disc"></p> 
  </div>
</div>

<?php

try {
    $area = $_GET['area'];
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //地方表示
    echo '<div class="region">';
    $regionsql = $pdo->prepare ("select regionName from region where regionID = ?");
    $regionsql -> execute([$area]);
    foreach($regionsql as $row){
        echo '<h1>'.$row['regionName'].'</h1>';
    }
    echo '</div>';
    echo'<h1>ランキング👑</h1>';

    if($area == 1){
    $sql = "SELECT p.*, pr.prefecturesName FROM product p  JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo  WHERE pr.regionID = ?
            LIMIT 3";
    }else{
    $sql = "SELECT p.*, pr.prefecturesName
    FROM product p
    JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo
    WHERE pr.regionID = ?
      AND p.productID = (
        SELECT MIN(productID)
        FROM product
        WHERE prefecturesNo = pr.prefecturesNo
      )
    LIMIT 3;";
    };
    

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$area]);
    $spanClass = 'price-class';

    if ($stmt !== false) {
        $counter = 0; // カウンターを初期化

        foreach ($stmt as $row) {
            if ($counter % 3 == 0) {
                // カウンターが3の倍数の場合、新しい行を開始
                echo '<div class="ranking-list">';
            }

            echo '<div class="rproduct">';
            echo '<div class="rproduct-name">' . $row['prefecturesName'] ;
            echo '<div class="ranking-img"></div><img src="./ranking.img/ranking0' . ($counter + 1) . '.png" class="ranking_img" alt="順位" width="234" height="100">';
            echo '<div class="rproduct-img">';
            echo '<a href="syousai.php?productID='.$row['productID'].'">';
            echo '<img src="./otokusanImage/' . $row['imgPass'] . '" alt="' . $row['productName'] . '">';
            echo '</a></div>';
            echo '<h2>' . $row['productName'] . '</h2>';
            echo '<h3>' . '<span class="' . $spanClass . '">¥' . $row['price'] . '</span>' . '</h3>';
            echo '</div>';
            echo '</div>';

            if (($counter + 1) % 3  === 0) {
                echo '</div>';
            }
            $counter++;
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<h1>商品一覧</h1>

<?php
try {
    $area = $_GET['area'];
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT p.*, pr.prefecturesName FROM product p
            JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo
            WHERE pr.regionID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$area]);
    $data = $stmt->fetchAll();

    if ($stmt !== false) {
        $counter = 0; // カウンターを初期化

        foreach ($data as $row) {
            if ($counter % 6 == 0) {
                // カウンターが4の倍数の場合、新しい行を開始
                echo '<div class="product-list">';
            }

            echo '<div class="product">';
            echo '<div class="product-name">' . $row['prefecturesName'] ;
            echo '<div class="rproduct-img">';
            echo '<a href="syousai.php?productID='.$row['productID'].'">';
            echo '<img src="./otokusanImage/' . $row['imgPass'] . '" alt="' . $row['productName'] . '">';
            echo '</a></div>';
            echo '<h3>' . $row['productName'] . '</h3>';
            echo '<h3>' . '<span class="' . $spanClass . '">¥' . $row['price'] . '</span>' . '</h3>';
            echo '</div>';
            echo '</div>';

            
            if (($counter + 1) % 6  === 0) {
                // カウンター+1が4の倍数の場合、行を閉じる
                echo '</div>';
            }

            $counter++;
        }
        // ４の倍数になるまで空欄を出力
        for($i=$counter%6; $i<6; $i++){
            echo '<div class="product">';
            echo '<div class="product-name"></div>';
            echo '<div class="product-description">';
            echo '<h2></h2>';
            echo '<h3></h3>';
            echo '</div>';
            echo '</div>';
        }
        // 商品一覧の行を閉じる
        echo '</div>';
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<br>
<h1>エリア別</h1>
<?php
echo '<div class="Area1">';
echo '<h2>北海道エリア</h2>';
echo '<a href="AArea.php?area=1">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/hokai.jpg" alt="北海道エリア">';
echo '</div></a>';

echo '<h2>東北エリア</h2>';
echo '<a href="AArea.php?area=2">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/touhoku.jpg" alt="東北エリア">';
echo '</div></a>';

echo '<h2>関東エリア</h2>';
echo '<a href="AArea.php?area=3">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/kantou.jpg" alt="関東エリア">';
echo '</div></a>';
echo '</div>';

echo '<div class="Area2">';
echo '<h2>中部エリア</h2>';
echo '<a href="AArea.php?area=4">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/tyuubu.jpg" alt="中部エリア">';
echo '</div></a>';

echo '<h2>近畿エリア</h2>';
echo '<a href="AArea.php?area=5">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/kinki.jpg" alt="近畿エリア">';
echo '</div></a>';

echo '<h2>中国エリア</h2>';
echo '<a href="AArea.php?area=6">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/tyugoku.jpg" alt="中国エリア">';
echo '</div></a>';
echo '</div>';

echo '<div class="Area3">';
echo '<h2>四国エリア</h2>';
echo '<a href="AArea.php?area=7">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/sikoku.jpg" alt="四国エリア">';
echo '</div></a>';

echo '<h2>九州・沖縄エリア</h2>';
echo '<a href="AArea.php?area=8">';
echo '<div class="image_circle">';
echo '<img src="./ranking.img/kyusyuu.jpg" alt="九州沖縄エリア">';
echo '</div></a>';

echo '<h2>TOP</h2>';
echo '<a href="TOP.php">';
echo '<div class="image_circle">';
echo '<img src="./log/LogoTemporary.png" alt="TOP">';
echo '</div></a>';
echo '</div>';
?>

</body>


</html>
