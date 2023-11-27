new Vue({
    el: '.cart-container',
    data: {
        cartItems: []
    },
    methods: {
        updateQuantity(productId, newQuantity) {
            // Vueデータを更新
            const cartItem = this.cartItems.find(item => item.productID === productId);
            cartItem.quantity = newQuantity;

            // バックエンドへ数量を更新するためのAJAXリクエストを送信
            axios.post('update_quantity.php', {
                productId: productId,
                newQuantity: newQuantity
            })
            .then(response => {
                // 必要に応じてレスポンスを処理
                console.log(response.data);
            })
            .catch(error => {
                console.error('エラー:', error);
            });
        },
        removeFromCart(productId) {
            // Vueデータからアイテムを削除
            this.cartItems = this.cartItems.filter(item => item.productID !== productId);

            // バックエンドへアイテムをカートから削除するためのAJAXリクエストを送信
            axios.post('remove_from_cart.php', {
                productId: productId
            })
            .then(response => {
                // 必要に応じてレスポンスを処理
                console.log(response.data);
            })
            .catch(error => {
                console.error('エラー:', error);
            });
        }
    },
    mounted() {
        // Vueインスタンスがマウントされた後にカート情報を取得
        axios.get('Cart.php')
            .then(response => {
                this.cartItems = response.data;
            })
            .catch(error => {
                console.error('エラー:', error);
            });
    }
});