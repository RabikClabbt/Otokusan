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
    <link rel="stylesheet" href="css/Ranking.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>北海道エリアの商品ページ</title>


<?php

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT p.*, pr.prefecturesName FROM product p
        JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo
        WHERE p.prefecturesNo = '01'
        LIMIT 3";

    $stmt = $pdo->query($sql);

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
            echo '<img src="image/' . $row['imgPass'] . '" alt="' . $row['productName'] . '">';
            echo '</div>';
            echo '<div class="rproduct-description">';
            echo '<h2>' . $row['productName'] . '</h2>';
            echo '<h3>' . $row['price'] . '</h3>';
            echo '</div>';
            echo '</div>';

            
            if (($counter + 1) % 3  === 0) {
                // カウンター+1が4の倍数の場合、行を閉じる
                echo '</div>';
            }

            $counter++;
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();


}
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT p.*, pr.prefecturesName FROM product p
            JOIN prefectures pr ON p.prefecturesNo = pr.prefecturesNo
            WHERE p.prefecturesNo = '01'";
    $stmt = $pdo->query($sql);

    if ($stmt !== false) {
        $counter = 0; // カウンターを初期化

        foreach ($stmt as $row) {
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
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>