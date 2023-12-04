<?php
require 'db-connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 受け取ったデータを取得
    $jsonData = json_decode(file_get_contents('php://input'), true);

    $productId = $jsonData['productId'];
    $newQuantity = $jsonData['newQuantity'];


    // ログインしている場合はデータベースのカートを更新
    if (isset($_SESSION['customer']['memberID'])) {
        // データベースで数量を更新する処理を実装
        // 以下は例としてcartテーブルを使用する場合のコード
        $updateQuery = "UPDATE cart SET quantity = :quantity WHERE productID = :product_id AND memberID = :user_id";
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $updateStatement->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $updateStatement->bindParam(':user_id', $_SESSION['customer']['memberID'], PDO::PARAM_INT);
        $updateStatement->execute();

        // 応答を返す（ここで必要に応じてJSON形式の応答を返す）
        echo json_encode(['status' => 'success', 'message' => 'Quantity updated successfully']);
    } else {
        // 未ログイン時はセッションのカートを更新
        if (isset($_SESSION['sessionCart'][$productId])) {
            $_SESSION['sessionCart'][$productId]['quantity'] = $newQuantity;
        }

        // 応答を返す（ここで必要に応じてJSON形式の応答を返す）
        echo json_encode(['status' => 'success', 'message' => 'Quantity updated successfully']);
    }
} else {
    // POSTリクエストでない場合はエラー応答
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Bad Request']);
}
?>