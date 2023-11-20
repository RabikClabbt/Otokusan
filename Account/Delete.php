<?php session_start(); ?>
<?php require 'Header.php';?>
<?php require 'Db-connect.php';?>
<?php
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('delete from account where memberID=?');
    $sql->execute([$_SESSION['customer']['memberID']]);
    echo 'アカウントを削除しました。';
    session_unset();
    session_destroy();
    echo '<a href="TOP.php">TOPへ</a>';
?>
<?php require 'Footer.php';?>
