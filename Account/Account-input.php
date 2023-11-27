<?php session_start(); ?>
<?php require 'Header.php';?>
<?php require 'Db-connect.php';?>
<link rel="stylesheet" href="css/style.css">
<?php
  $pdo=new PDO($connect,USER,PASS);
  $memberName=$email=$password=$regionID=$zipcord='';

  if(isset($_SESSION['customer'])){
        $memberName=$_SESSION['customer']['memberName'];
        $zipcord=$_SESSION['customer']['zipcord'];
        $regionID=$_SESSION['customer']['regionID'];
        $email=$_SESSION['customer']['email'];
        $password=$_SESSION['customer']['password'];

      echo '<div class="container">';

      echo '<h1>アカウント情報</h1>';
    echo '<form method="post" action="Account-output.php">';
      echo '<label for="memberName">氏名</label>';
      echo '<input type="text" id="memberName" name="memberName" value="',$memberName,'" required>';
      echo '<input type="hidden" name="zipcord" value="' ,$zipcord, '">';
      echo '<input type="hidden" name="regionID" value="' ,$regionID, '">';
      echo '<input type="hidden" name="email" value="' ,$email, '">';
      echo '<input type="submit" name="update" value="更新" class="small-button">';
      echo '<br>';
    echo '</form>';

    echo '<form method="post" action="Account-output.php">';
      echo '<label for="email">E-mail</label>';
      echo '<input type="text" id="email" name="email" value="',$email,'" required>';
      echo '<input type="hidden" name="memberName" value="' ,$memberName, '">';
      echo '<input type="hidden" name="zipcord" value="' ,$zipcord, '">';
      echo '<input type="hidden" name="regionID" value="' ,$regionID, '">';
      echo '<input type="submit" name="update" value="更新" class="small-button">';
      echo '<br>';
    echo '</form>';

    echo '<form method="post" action="Account-output.php">';
      echo '<label for="zipcord">郵便番号</label>';
      echo '<input type="text" id="zipcord" name="zipcord" value="',$zipcord,'">';
      echo '<input type="hidden" name="memberName" value="' ,$memberName, '">';
      echo '<input type="hidden" name="regionID" value="' ,$regionID, '">';
      echo '<input type="hidden" name="email" value="' ,$email, '">';
      echo '<input type="submit" name="update" value="更新" class="small-button">';
      echo '<br>';
    echo '</form>';

    echo '<form method="post" action="Account-output.php">';
      echo '<label for="regionID">所在地域</label>';

      $sql2=$pdo->prepare('select regionName from region where regionID=?');
      $sql2->execute([$regionID]);
      foreach($sql2 as $row){
        echo '<p>・',$row['regionName'],'</p>';
      }

      $sql=$pdo->query('select * from prefectures');
      echo '<select id="regionID" name="regionID" required>';
        foreach($sql as $row){
          echo '<option value="',$row['regionID'],'">',$row['prefecturesName'],'</option>';
        }
      echo '</select>';
      echo '<input type="hidden" name="memberName" value="' ,$memberName, '">';
      echo '<input type="hidden" name="zipcord" value="' ,$zipcord, '">';
      echo '<input type="hidden" name="email" value="' ,$email, '">';
      echo '<input type="submit" name="update" value="更新" class="small-button">';
    echo '</form>';

    echo '<a href="Logout.php">ログアウト</a>';
    echo '<a href="Delete.php">アカウント削除</a>';
    echo '<a href="TOP.php">TOPへ</a>';

    echo '</div>';
  }

  else{
    $sql=$pdo->query('select *from prefectures');
    echo '<div class="container">';

    echo '<form method="post" action="Account-output.php">';
      echo '<h1>アカウント登録</h1>';

      echo '<label for="memberName">氏名</label>';
      echo '<input type="text" id="memberName" name="memberName" value="',$memberName,'" required>';
      echo '<br>';

      echo '<label for="email">E-mail</label>';
      echo '<input type="text" id="email" name="email" value="',$email,'" required>';
      echo '<br>';

      echo '<label for="password">パスワード</label>';
      echo '<input type="text" id="password" name="password" value="',$password,'" required>';
      echo '<br>';

      echo '<label for="regionID">所在地</label>';
      echo '<select id="regionID" name="regionID" required>';
        foreach($sql as $row){
          echo '<option value="',$row['regionID'],'">',$row['prefecturesName'],'</option>';
        }
      echo '</select>';

      echo '<label for="zipcord">郵便番号</label>';
      echo '<input type="text" id="zipcord" name="zipcord" value="',$zipcord,'">';
      echo '<br>';
          
      echo '<input type="submit" name="insert" value="登録" class="small-button">';
    echo '</form>';

    echo '</div>';
  }
  
?>
<?php require 'Footer.php';?>
