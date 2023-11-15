<?php session_start(); ?>
<?php require 'Db-connect.php';?>
<?php require 'Header.php';?>
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
        $sql=$pdo->prepare('update account set memberName=?, zipcord=?, regionID=?, email=?, password=? where id=?');
        $sql->execute([
            $_POST['memberName'], $_POST['zipcord'],
            $_POST['regionID'], $_POST['email'], password_hash($_POST['password'],PASSWORD_DEFAULT), $id]);
        $_SESSION['customer']=[
            'memberID'=>$id, 'memberName'=>$_POST['memberName'],
            'zipcord'=>$_POST['zipcord'], 'regionID'=>$_POST['regionID'], 'email'=>$_POST['email'],
            'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT)];
        echo 'お客様情報を更新しました。';
        echo '<a href="Account-input.php">戻る</a>';
        } else {
            $sql=$pdo->prepare('insert into account values (null,?,?,?,?,?)');
            $sql->execute([
            $_POST['memberName'], $_POST['zipcord'],
            $_POST['regionID'], $_POST['email'], password_hash($_POST['password'],PASSWORD_DEFAULT)]);
            echo 'お客様情報を登録しました。';
        }
        echo '<a href="TOP.php">TOPへ</a>';
    } else {
        echo 'ログイン名がすでに使用されていますので、変更してください';
        echo '<a href="Account-input.php">戻る</a>';
    }

?>
<?php require 'Footer.php'; ?>