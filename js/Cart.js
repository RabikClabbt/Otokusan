new Vue({
    el: '.cart-container',
    data: {
        cartItems: <?php echo json_encode($cartItems); ?>
    },
    methods: {
        updateQuantity(productId) {
            const cartItem = this.cartItems.find(item => item.product_id === productId);
            const newQuantity = cartItem.quantity;
            // バックエンドへ数量を更新するためのAJAXリクエストを送信
            fetch('update_quantity.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    productId: productId,
                    newQuantity: newQuantity
                }),
            })
            .then(response => response.json())
            .then(data => {
                // 必要に応じてレスポンスを処理
                console.log(data);
            })
            .catch((error) => {
                console.error('エラー:', error);
            });
        },
        removeFromCart(productId) {
            // バックエンドへアイテムをカートから削除するためのAJAXリクエストを送信
            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    productId: productId
                }),
            })
            .then(response => response.json())
            .then(data => {
                // 必要に応じてレスポンスを処理
                console.log(data);
            })
            .catch((error) => {
                console.error('エラー:', error);
            });
        }
    }
});