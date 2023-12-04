new Vue({
    el: '.cartContainer',
    data: {
        cartItems: []
    },
    mounted() {
        // Vueインスタンスがマウントされた後にカート情報を取得
        axios.get('CartItems.php')
            .then(response => {
                this.cartItems = response.data;
            })
            .catch(error => {
                console.error('エラー:', error);
            });
    },
    methods: {
        updateQuantity(productId, newQuantity) {
            // newQuantityとproductIdを数値に変換する。
            newQuantity = parseInt(newQuantity, 10);
            productId = parseInt(productId, 10);
        
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
                productID: productId
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
    computed: {
        itemAvailability() {
            return this.cartItems.length > 0;
        }
    }
});