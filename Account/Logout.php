<?php session_start(); ?>
<?php require 'Header.php';?>
<?php
if (isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo '<h1>ログアウト完了しました。</h1>';
    echo 'またのご利用をお待ちしております。';
}else{
    echo 'すでにログアウトしています。';
}
    echo '<a href="TOP.php">TOPへ</a>';
?>
<?php require 'Footer.php';?>