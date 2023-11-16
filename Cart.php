<?php
require 'db-connect.php';
session_start();

// Initialize $userId with a default value
$userId = 0;

// カートに商品を追加する関数
function addToCart($productId, $count, $userId, $pdo) {
    // すでにカートに同じ商品が入っているか確認
    $query = "SELECT * FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $statement->execute();
    $existingCartItem = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existingCartItem) {
        // すでにカートに同じ商品が入っている場合は数量を更新
        $newQuantity = $existingCartItem['quantity'] + $count;
        $updateQuery = "UPDATE cart_items SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $updateStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $updateStatement->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $updateStatement->execute();
    } else {
        // カートに新しい商品を追加
        $insertQuery = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $insertStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $insertStatement->bindParam(':quantity', $count, PDO::PARAM_INT);
        $insertStatement->execute();
    }
}

// 商品詳細画面から商品IDと数量を受け取る
if (isset($_POST['productID'], $_POST['count'])) {
    $productId = $_POST['productID'];
    $count = $_POST['count'];

    // ログインしている場合はユーザーIDを取得
    if (isset($_SESSION['customer']['memberID'])) {
        $userId = $_SESSION['customer']['memberID'];
    }

    // カートに商品を追加
    addToCart($productId, $count, $userId, $pdo);
}

// カート情報を取得
if ($userId > 0) {
    $cartQuery = "SELECT c.product_id, p.product_name, p.price, p.imgPass, c.quantity, p.price * c.quantity as subtotal
                  FROM cart_items c
                  JOIN products p ON c.product_id = p.productID
                  WHERE c.user_id = :user_id";
    $cartStatement = $pdo->prepare($cartQuery);
    $cartStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $cartStatement->execute();
    $cartItems = $cartStatement->fetchAll(PDO::FETCH_ASSOC);
}

// 以下はHTMLなどの表示部分
require 'Header.php';
require 'Sidebar.php';
?>

<!-- カート情報の表示 -->
<!-- カート情報の表示 -->
<div class="cart-container">
    <h3>ショッピングカート</h3>
    <table v-if="cartItems.length > 0">
        <thead>
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>個数</th>
                <th>小計</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="cartItem in cartItems" :key="cartItem.product_id">
                <td><img :src="cartItem.imgPass" :alt="cartItem.product_name"></td>
                <td>{{ cartItem.product_name }}</td>
                <td>{{ cartItem.price }}円</td>
                <td>
                    <input type="number" min="1" v-model="cartItem.quantity">
                    <button @click="updateQuantity(cartItem.product_id)">変更</button>
                </td>
                <td>{{ cartItem.subtotal }}円</td>
                <td>
                    <button @click="removeFromCart(cartItem.product_id)">削除</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div v-else>
        <p>カートは空です。</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="Cart.js"></script>