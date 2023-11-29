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
    <link rel="stylesheet" href="css/Hokkaidou.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>北海道エリアの商品ページ</title>


<?php

try {
    $area = $_GET['area'];
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT p.*, pr.prefecturesName FROM product p  JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo  WHERE pr.regionID = ?
        LIMIT 3";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$area]);

    if ($stmt !== false) {
        $counter = 0; // カウンターを初期化

        foreach ($stmt as $row) {
            if ($counter % 3 == 0) {
                // カウンターが4の倍数の場合、新しい行を開始
                echo '<div class="ranking-list">';
            }

            echo '<div class="rproduct">';
            echo '<div class="rproduct-name">' . $row['prefecturesName'] . '</div>';
            echo '<div class="rproduct img">';
            echo '<a href="Syousai.php?productID='.$row['productID'].'">';
            echo '<img src="image/' . $row['imgPass'] . '" alt="' . $row['productName'] . '">';
            echo '</a></div>';
            echo '<div class="rproduct-description">';
            echo '<h2>' . $row['productName'] . '</h2>';
            echo '<h3>' . $row['price'] . '</h3>';
            echo '</div>';
            echo '</div>';

            
            if (($counter + 1) % 3  === 0) {
                // カウンター+1が4の倍数の場合、行を閉じるq
                echo '</div>';
            }

            $counter++;
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();


}
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
            if ($counter % 4 == 0) {
                // カウンターが4の倍数の場合、新しい行を開始
                echo '<div class="ranking-list">';
            }

            echo '<div class="rproduct">';
            echo '<div class="rproduct-name">' . $row['prefecturesName'] . '</div>';
            echo '<img src="image/' . $row['imgPass'] . '" alt="' . $row['productName'] . '">';
            echo '<div class="rproduct-description">';
            echo '<h2>' . $row['productName'] . '</h2>';
            echo '<h3>' . $row['price'] . '</h3>';
            echo '</div>';
            echo '</div>';

            
            if (($counter + 1) % 4  === 0) {
                // カウンター+1が4の倍数の場合、行を閉じる
                echo '</div>';
            }

            $counter++;
        }
        // ４の倍数になるまで空欄を出力
        for($i=$counter%4; $i<4; $i++){
            echo '<div class="rproduct">';
            echo '<div class="rproduct-name"></div>';
            echo '<div class="rproduct-description">';
            echo '<h2></h2>';
            echo '<h3></h3>';
            echo '</div>';
            echo '</div>';
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>