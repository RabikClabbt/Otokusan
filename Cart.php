<?php
require 'db-connect.php';
session_start();

// Initialize $userId with a default value
$userId = 0;

// カートに商品を追加する関数
function addToCart($productId, $count, $userId, $pdo) {
    // すでにカートに同じ商品が入っているか確認
    $query = "SELECT * FROM cart WHERE memberID = :user_id AND productID = :product_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $statement->execute();
    $existingCartItem = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existingCartItem) {
        // すでにカートに同じ商品が入っている場合は数量を更新
        $newQuantity = $existingCartItem['quantity'] + $count;
        $updateQuery = "UPDATE cart SET quantity = :quantity WHERE memberID = :user_id AND productID = :product_id";
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $updateStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $updateStatement->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $updateStatement->execute();
    } else {
        // カートに新しい商品を追加
        $insertQuery = "INSERT INTO cart (memberID, productID, quantity) VALUES (:user_id, :product_id, :quantity)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $insertStatement->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $insertStatement->bindParam(':quantity', $count, PDO::PARAM_INT);
        $insertStatement->execute();
    }
}

// セッションカートに商品を追加する関数
function addToSessionCart($productId, $count) {

    if (!isset($_SESSION['sesstionCart'])) {
        $_SESSION['sesstionCart'] = [];
    }
    $quantity = $count;
    if (isset($_SESSION['sesstionCart'][$productId])) {
        $count = $_SESSION['sesstionCart'][$productId]['quantity'];
    }
    $_SESSION['sesstionCart'][$productId] = [
        'quantity' => $quantity + $count
    ];
}

// 商品詳細画面から商品IDと数量を受け取る
if (isset($_POST['productID'], $_POST['count'])) {
    $productId = $_POST['productID'];
    $count = $_POST['count'];

    // ログインしている場合はユーザーIDを取得
    if (isset($_SESSION['customer']['memberID'])) {
        $userId = $_SESSION['customer']['memberID'];

        // カートに商品を追加
        addToCart($productId, $count, $userId, $pdo);
    } else {
        // 未ログイン時、セッションに保存
        addToSessionCart($productId, $count);
    }
}

// カート情報を取得
if ($userId > 0) {
    $cartQuery = "SELECT c.productID, p.productName, p.price, p.imgPass, c.quantity
                  FROM cart c
                  JOIN product p ON c.productID = p.productID
                  WHERE c.memberID = :user_id";
    $cartStatement = $pdo->prepare($cartQuery);
    $cartStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $cartStatement->execute();
    $cartItems = $cartStatement->fetchAll(PDO::FETCH_ASSOC);
} else {
    // セッションからカート情報を取得
    if (isset($_SESSION['sesstionCart'])) {
        $sessionCartItems = $_SESSION['sesstionCart'];
        $cartItems = [];

        foreach ($sessionCartItems as $productId => $item) {
            // 商品情報を取得して連想配列に追加
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
    } else {
        $cartItems = [];
    }
}

// 以下はHTMLなどの表示部分
require 'Header.php';
require 'Sidebar.php';
?>

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
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="cartItem in cartItems" :key="cartItem.productID">
                <td><img :src="cartItem.imgPass" :alt="cartItem.productName"></td>
                <td>{{ cartItem.productName }}</td>
                <td>{{ cartItem.price }}円</td>
                <td>
                    <select v-model="cartItem.quantity" @change="updateQuantity(cartItem.productID, cartItem.quantity)">
                        <option v-for="n in 10" :key="n" :value="n">{{ n }}</option>
                    </select>
                </td>
                <td>
                    <button @click="removeFromCart(cartItem.productID)">削除</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div v-else>
        <p>カートは空です。</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="./js/Cart.js"></script>