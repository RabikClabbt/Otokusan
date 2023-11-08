<?php session_start(); ?>
<?php require 'header.php';?>
<?php require 'db-connect.php';?>
<link rel="stylesheet" href="css/style.css">
<?php
  $pdo=new PDO($connect,USER,PASS);
  $name=$mail=$pass=$region='';

  if(isset($_SESSION['customer'])){
    $name=$_SESSION['customer']['name'];
        $name=$_SESSION['customer']['name'];
        $mail=$_SESSION['customer']['mail'];
        $pass=$_SESSION['customer']['pass'];
        $region=$_SESSION['customer']['region'];
    $sql=$pdo->query('select *from prefectures');
      echo '<h1>アカウント情報</h1>';
    echo '<form method="post" action=".php">';
      echo '<label for="name">氏名</label>';
      echo '<input type="text" id="name" value="',$name,'" required>';
      echo '<input type="submit" name="update" value="更新">';
      echo '<br>';
    echo '</form>';

    echo '<form method="post" action=".php">';
      echo '<label for="mail">E-mail</label>';
      echo '<input type="text" id="mail" value="',$mail,'" required>';
      echo '<br>';

    echo '<form method="post" action=".php">';
      echo '<label for="pass">パスワード</label>';
      echo '<input type="text" id="pass" value="',$pass,'" required>';
      echo '<br>';

    echo '<form method="post" action=".php">';
      echo '<label for="region">所在地域</label>';
      echo '<p>',$region,'</p>';
      echo '<select id="region" name="region" required>';
        foreach($sql as $row){
          echo '<option value="',$row['prefecturesNo'],'">',$row['prefecturesName'],'</option>';
        }
      echo '</select>';
          
      echo '<input type="submit" name="update" value="登録">';
    
  }

  else{
    $sql=$pdo->query('select *from prefectures');
    echo '<form method="post" action=".php">';
      echo '<h1>アカウント登録</h1>';

      echo '<label for="name">氏名</label>';
      echo '<input type="text" id="name" value="',$name,'" required>';
      echo '<br>';

      echo '<label for="mail">E-mail</label>';
      echo '<input type="text" id="mail" value="',$mail,'" required>';
      echo '<br>';

      echo '<label for="pass">パスワード</label>';
      echo '<input type="text" id="pass" value="',$pass,'" required>';
      echo '<br>';

      echo '<label for="region">所在地</label>';
      echo '<select id="region" name="region" required>';
        foreach($sql as $row){
          echo '<option value="',$row['prefecturesNo'],'">',$row['prefecturesName'],'</option>';
        }
      echo '</select>';
          
      echo '<input type="submit" name="insert" value="登録">';
    echo '</form>';
  }
  
?>
<?php require 'footer.php';?>
