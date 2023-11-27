<?php require 'Header.php';?>
<link rel="stylesheet" href="css/Login-style.css">

<div class="container">
    <h1>ログイン</h1>
    <hr>
    <form action="Login-output.php" method="post" class="login-form">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="text" name="email">
        </div>
        <div class="form-group">
            <label for="password">パスワード:</label>
            <input type="password" name="password">
        </div>
        <p>アカウント未登録の方は、「アカウント作成」から登録してください。</p>
        <input type="submit" value="ログイン">
    </form>
    <a href="Account-input.php">アカウント作成</a>
    <a href="TOP.php">TOPへ</a>
</div>

<?php require 'Footer.php';?>
