<?php session_start(); ?>
<?php require 'Db-connect.php';?>
<?php require 'Header.php';?>
<link rel="stylesheet" href="css/Login-style2.css">
<div class="container">
<?php
echo '<p><img src="image/otokusan.png" alt="image"></p>';
unset($_SESSION['customer']);
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from account where email=?');
$sql->execute([$_POST['email']]);
foreach($sql as $row){
    if(password_verify($_POST['password'],$row['password'])){
        $_SESSION['customer']=[
            'memberID'=>$row['memberID'],'memberName'=>$row['memberName'],
            'zipcord'=>$row['zipcord'],'address'=>$row['address'],
            'regionID'=>$row['regionID'],'email'=>$row['email'],
            'password'=>$row['password']
        ];
    }
}
if(isset($_SESSION['customer'])){
    echo 'いらっしゃいませ、',$_SESSION['customer']['memberName'],'さん。';
}else {
    echo 'ログイン名またはパスワードが違います。';
    echo '<a href="Login-input.php">戻る</a>';
}
    echo '<a href="TOP.php">TOPへ</a>';
?>
</div>
<?php require 'Footer.php';?>
