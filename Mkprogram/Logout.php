<?php session_start(); ?>
<?php require 'Header.php';?>
<link rel="stylesheet" href="css/Login-style2.css">
<div class="container">
<?php
    echo '<p><img src="image/otokusan.png" alt="image"></p>';
if (isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo '<h1>ログアウト完了しました。</h1>';
    echo 'またのご利用をお待ちしております。';
}else{
    echo 'すでにログアウトしています。';
}
    echo '<a href="TOP.php">TOPへ</a>';
?>
</div>
<?php require 'Footer.php';?>