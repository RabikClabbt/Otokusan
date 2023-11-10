<?php session_start(); ?>
<?php require 'db-connect.php';?>
<?php require 'Header.php';?>
<?php
unset($_SESSION['customer']);
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->prepare('select * from account where email=?');
$sql->execute([$_POST['email']]);
foreach($sql as $row){
    if(password_verify($_POST['password'],$row['password'])){
        $_SESSION['customer']=[
            'memberID'=>$row['memberID'],'name'=>$row['memberName'],
            'address'=>$row['address'],'region'=>$row['login'],
            'password'=>$row['password']
        ];
    }
}
if(isset($_SESSION['customer'])){
    echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
}else {
    echo 'ログイン名またはパスワードが違います。';
}
?>
<?php require 'footer.php';?>
