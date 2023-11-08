<?php require 'header.php';?>
<?php require 'db-connect.php';?>
    <h1>アカウント情報</h1>
    <form method="post" action=".php">
        <label for="name">氏名</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" name="update" value="更新">
        <br>
        <label for="region">所在地域</label>
        
        <select id="region" name="region" required>
            for(int i=1;i<=47;i++){
                <option value=""></option>
            }
            <option value="北海道">北海道</option>
            <option value="青森">青森</option>
            <option value=""></option>
            <!-- 他の都道府県を追加 -->
        </select>
        
        <input type="submit" name="update" value="更新">
    </form>
    
    <form method="post" action="delete_account.php">
        <input type="submit" name="delete" value="アカウント削除">
    </form>
<?php require 'footer.php'; ?>
