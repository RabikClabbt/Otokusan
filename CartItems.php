<?php
require 'db-connect.php';
session_start();

function getCartItems($pdo, $userId) {
    if ($userId > 0) {
        // データベースからカートアイテムを取得する
        $cartQuery = "SELECT c.productID, p.productName, p.price, p.imgPass, c.quantity
                      FROM cart c
                      JOIN product p ON c.productID = p.productID
                      WHERE c.memberID = :user_id";
        $cartStatement = $pdo->prepare($cartQuery);
        $cartStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $cartStatement->execute();
        return $cartStatement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        if (isset($_SESSION['sessionCart'])) {
            // セッションからカートアイテムを取得する
            $sessionCartItems = $_SESSION['sessionCart'];
            $cartItems = [];

            foreach ($sessionCartItems as $productId => $item) {
                // 製品情報の取得
                $productQuery = "SELECT productID, productName, price, imgPass
                                 FROM product
                                 WHERE productID = :product_id";
                $productStatement = $pdo->prepare($productQuery);
                $productStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
                $productStatement->execute();
                $productInfo = $productStatement->fetch(PDO::FETCH_ASSOC);

                if ($productInfo) {
                    $cartItems[] = [
                        'productID' => $productInfo['productID'],
                        'productName' => $productInfo['productName'],
                        'price' => $productInfo['price'],
                        'imgPass' => $productInfo['imgPass'],
                        'quantity' => $item['quantity']
                    ];
                }
            }

            return $cartItems;
        } else {
            return [];
        }
    }
}

// ユーザーIDを取得し、getCartItems関数を呼び出す。
$userId = (isset($_SESSION['customer']['memberID'])) ? $_SESSION['customer']['memberID'] : 0;
$cartItems = getCartItems($pdo, $userId);

// カート項目をJSONで返す
echo json_encode($cartItems);
?>