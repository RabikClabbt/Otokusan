<?php require 'Header.php';?>
<form action="Login-output.php" method="post">
    E-mail:<input type="text" name="email"><br>
    パスワード:<input type="password" name="password"><br>
    <p>アカウント未登録の方は、「アカウント作成」から登録してください。</p>
<input type="submit" value="ログイン">
</form>
<a href="Account-input.php">TOPへ</a>
<a href="TOP.php">戻る</a>
<?php require 'Footer.php';?>
