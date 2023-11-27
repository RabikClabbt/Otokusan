<?php session_start(); ?>
<?php require 'Header.php';?>
<?php require 'Db-connect.php';?>
<link rel="stylesheet" href="css/Login-style2.css">
<div class="container">
<p><img src="image/otokusan.png" alt="image"></p>
<?php
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('delete from account where memberID=?');
    $sql->execute([$_SESSION['customer']['memberID']]);
    echo 'アカウントを削除しました。';
    session_unset();
    session_destroy();
    echo '<a href="TOP.php">TOPへ</a>';
?>
</div>
<?php require 'Footer.php';?>
