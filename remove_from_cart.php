<?php
require 'db-connect.php';
session_start();

$pdo = new PDO($connect, USER, PASS);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTデータから商品IDを取得する
    $jsonData = json_decode(file_get_contents('php://input'), true);

    $productId = $jsonData['productID'];

    // ログインしている場合
    if (isset($_SESSION['customer']['memberID'])) {
        // データベースでアイテムをカートから削除する処理を実装
        // 以下は例としてcartテーブルを使用する場合のコード
        $deleteQuery = "DELETE FROM cart WHERE productID = :product_id AND memberID = :user_id";
        $deleteStatement = $pdo->prepare($deleteQuery);
        $deleteStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $deleteStatement->bindParam(':user_id', $_SESSION['customer']['memberID'], PDO::PARAM_INT);
        $deleteStatement->execute();

        // 応答を返す（ここで必要に応じてJSON形式の応答を返す）
        echo json_encode(['status' => 'success', 'message' => 'Item removed from cart successfully']);
    } else {
        // セッションカートに商品があるかチェックする
        if (isset($_SESSION['sessionCart'][$productId])) {
            // セッションカートから商品を削除する
            unset($_SESSION['sessionCart'][$productId]);

            // 応答を返す（ここで必要に応じてJSON形式の応答を返す）
            echo json_encode(['status' => 'success', 'message' => 'Item removed from cart successfully']);
        } else {
            // エラーを返す（カートから商品が見つかりません）
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Product not found in the cart']);
        }
    }
} else {
    // POST以外のリクエストに対してエラーで応答する
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Bad Request']);
}
?>