<?php
require 'db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 受け取ったデータを取得
    $productId = $_POST['productId'];

    // データベースでアイテムをカートから削除する処理を実装
    // 以下は例としてcartテーブルを使用する場合のコード
    $deleteQuery = "DELETE FROM cart WHERE productID = :product_id";
    $deleteStatement = $pdo->prepare($deleteQuery);
    $deleteStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $deleteStatement->execute();

    // 応答を返す（ここで必要に応じてJSON形式の応答を返す）
    echo json_encode(['status' => 'success', 'message' => 'Item removed from cart successfully']);
} else {
    // POSTリクエストでない場合はエラー応答
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Bad Request']);
}
?>