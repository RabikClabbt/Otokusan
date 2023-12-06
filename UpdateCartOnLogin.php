<?php
require 'db-connect.php';
session_start();

$pdo = new PDO($connect, USER, PASS);

// データベースにカートアイテムを追加または更新する関数
function addToCart($productId, $quantity, $userId, $pdo) {
    // カートに商品がすでにあるかどうかをチェックする
    $query = "SELECT * FROM cart WHERE memberID = :user_id AND productID = :product_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $statement->execute();
    $existingCartItem = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existingCartItem) {
        // テーブルにアイテムが存在する場合、数量を更新する
        $newQuantity = min($existingCartItem['quantity'] + $quantity, 10);
        $updateQuery = "UPDATE cart SET quantity = :quantity WHERE memberID = :user_id AND productID = :product_id";
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $updateStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $updateStatement->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $updateStatement->execute();
    } else {
        // テーブルにアイテムが存在しない場合、追加する
        $insertQuery = "INSERT INTO cart (memberID, productID, quantity) VALUES (:user_id, :product_id, :quantity)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $insertStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $insertStatement->bindParam(':quantity', min($quantity, 10), PDO::PARAM_INT);
        $insertStatement->execute();
    }
}

// ユーザーがログインしているかチェックする
if (isset($_SESSION['customer']['memberID'])) {
    // ユーザーIDの取得
    $userId = $_SESSION['customer']['memberID'];

    // セッションカートに商品があるかチェックする
    if (isset($_SESSION['sessionCart'])) {
        foreach ($_SESSION['sessionCart'] as $productId => $item) {
            // カートテーブルの各商品を追加または更新する
            addToCart($productId, $item['quantity'], $userId, $pdo);
        }
    }

    // データベース更新後にセッションカートをクリアする
    unset($_SESSION['sessionCart']);
}
?>