<?php
require 'db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 受け取ったデータを取得
    $productId = $_POST['productId'];
    $newQuantity = $_POST['newQuantity'];

    // データベースで数量を更新する処理を実装
    // 以下は例としてcart_itemsテーブルを使用する場合のコード
    $updateQuery = "UPDATE cart_items SET quantity = :quantity WHERE product_id = :product_id";
    $updateStatement = $pdo->prepare($updateQuery);
    $updateStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $updateStatement->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
    $updateStatement->execute();

    // 応答を返す（ここで必要に応じてJSON形式の応答を返す）
    echo json_encode(['status' => 'success', 'message' => 'Quantity updated successfully']);
} else {
    // POSTリクエストでない場合はエラー応答
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Bad Request']);
}
?>