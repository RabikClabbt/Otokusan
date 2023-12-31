<?php session_start(); ?>
<?php require 'Db-connect.php';?>
<?php require 'Header.php';?>
<link rel="stylesheet" href="css/Login-style2.css">
<div class="container">
<p><img src="image/otokusan.png" alt="image"></p>
<?php
$pdo=new PDO($connect,USER,PASS);
if (isset($_SESSION['customer'])){
    $id=$_SESSION['customer']['memberID'];
    $sql=$pdo->prepare('select * from account where memberID!=? and memberName=?');
    $sql->execute([$id, $_POST['memberName']]);
} else {
    $sql=$pdo->prepare('select * from account where memberName=?');
    $sql->execute([$_POST['memberName']]);
}
    if(empty($sql->fetchAll())){
        if(isset($_SESSION ['customer'])) {
        $sql=$pdo->prepare('update account set memberName=?, zipcord=?, regionID=?, email=? where memberID=?');
        $sql->execute([
            $_POST['memberName'], $_POST['zipcord'],
            $_POST['regionID'], $_POST['email'], $id]);
        $_SESSION['customer']=[
            'memberID'=>$id, 'memberName'=>$_POST['memberName'],
            'zipcord'=>$_POST['zipcord'], 'address'=>$_SESSION['customer']['address'], 'regionID'=>$_POST['regionID'], 
            'email'=>$_POST['email'], 'password'=>$_SESSION['customer']['password']];
        echo 'お客様情報を更新しました。';
        } else {
            $sql=$pdo->prepare('insert into account(memberID,memberName,zipcord,regionID,email,password) values (null,?,?,?,?,?)');
            $sql->execute([
            $_POST['memberName'], $_POST['zipcord'],
            $_POST['regionID'], $_POST['email'], password_hash($_POST['password'],PASSWORD_DEFAULT)]);
            echo 'お客様情報を登録しました。';
        }
        echo '<a href="TOP.php">TOPへ</a>';
        echo '<a href="Login-input.php">ログイン画面へ</a>';
    } else {
        echo 'ログイン名がすでに使用されていますので、変更してください<br>';
        echo '<a href="Account-input.php">戻る</a>';
    }
?>
</div>
<?php require 'Footer.php'; ?>