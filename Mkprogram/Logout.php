<?php session_start(); ?>
<?php require 'Header.php';?>
<?php
if (isset($_SESSION['customer'])){
    unset($_SESSION['customer']);
    echo '<h1>ログアウト完了しました。</h1>';。
    echo '<p>またのご利用をお待ちしております。<p>';
}else{
    echo 'すでにログアウトしています。';
}
?>
<?php require 'Footer.php';?>