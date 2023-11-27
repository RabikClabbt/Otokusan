<?php session_start(); ?>
<?php require 'db-connect.php' ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel ="stylesheet" href = "css/result.css">
</head>
<body>
<h1>検索結果</h1>
<?php
    $pdo=new PDO($connect,USER,PASS);

        $str='select * from product as p inner join productgenre as pg on p.productID = pg.productID inner join prefectures as pf on p.prefecturesNo = pf.prefecturesNo where';
        $count=0;
        $i=0;
        $shohincount=0;
        $startpage=1;
        $keyArray=array();

    if(strlen($_POST['sname'])>0){
        $str = $str.' productName like ?';
        $keyArray[$count]='%'.$_POST['sname'].'%';
        $count+=1;
    }

if($_POST['region']!=0){
        if($count==0){
            $str = $str.' regionID=?';
        }
        else{
            $str = $str.' and'.' regionID=?';
        }
    switch($_POST['region']){
        case 1:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 2:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 3:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 4:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 5:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 6:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 7:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
        case 8:
            $keyArray[$count]=$_POST['region'];
            $count+=1;
        break;
    }
}

if($_POST['category']!=0){
        if($count==0){
            $str = $str.' genreID=?';
        }
        else{
            $str = $str.' and'.' genreID=?';
        }
    switch($_POST['category']){
        case 01:
            $keyArray[$count]=$_POST['category'];
            $count+=1;
        break;
        case 02:
            $keyArray[$count]=$_POST['category'];
            $count+=1;
        break;
    }
}

if($_POST['price']!=0){
        if($count==0){
            $str = $str.' price between ? and ?';
        }
        else{
            $str = $str.' and'.' price between ? and ?';
        }
    switch($_POST['price']){
        case 'price1':
            $keyArray[$count]=0;
            $keyArray[$count+1]=2000;
            $count+=2;
        break;
        case 'price2':
            $keyArray[$count]=2000;
            $keyArray[$count+1]=4000;
            $count+=2;
        break;
        case 'price3':
            $keyArray[$count]=4000;
            $keyArray[$count+1]=6000;
            $count+=2;
        break;
        case 'price4':
            $keyArray[$count]=6000;
            $keyArray[$count+1]=8000;
            $count+=2;
        break;
        case 'price5':
            $keyArray[$count]=8000;
            $keyArray[$count+1]=10000;
            $count+=2;
        break;
        case 'price6':
            $keyArray[$count]=10000;
            $keyArray[$count+1]=500000;
            $count+=2;
        break;
    }
}

    //検索結果数を取得
    if($count>0){
        $sql=$pdo->prepare($str);
        $sql->execute($keyArray);
        foreach($sql as $row){
            $shohincount+=1;
        }
    }
    else{
        $shohincount = $sql=$pdo->query('select * from product as p inner join productgenre as pg on p.productID = pg.productID')->rowCount();
    }


    if($count>0){
        $sql=$pdo->prepare($str.' order by p.productID limit 0,20');
        $sql->execute($keyArray);
    }
    else{
        $sql=$pdo->query('select * from product as p inner join productgenre as pg on p.productID = pg.productID order by p.productID limit 0,20;');
    }

    if($sql->rowCount()>0){
        echo '<table align="center">';
        echo '<th></th><th></th><th></th><th></th>';
        echo '<tr>';
        foreach($sql as $row){
            echo '<td>';
            echo '<a href="Syousai.php?productID='.$row['productID'].'">'; //商品詳細画面への遷移指定
            echo '<img src="otokusanImage/',$row['imgPass'],'" height="130">'; //商品画像の表示
            echo '</a>';
            echo '<br>';
            echo $row['productName'];
            echo '</td>';
            $i+=1;
        if($i%4==0){
            echo '</tr>';
            echo '<tr>';
            }
        }
        echo '</table>';
    }
    else{
        echo '<p>','該当する商品が見つかりませんでした。','</p>';
        echo '<p>','条件の変更を行ってください。','</p>';
    }

    if($shohincount>20){
    $lastpage = ceil($shohincount/20);
    for($startpage;$startpage<=$lastpage;$startpage++){
        if($startpage==1){
            echo '<div class="page">';
            echo '<div class="current">';
        }
        else if($startpage==2){
            echo '</div>';
        }
        echo '<a href="ResultPage.php?page='.$startpage.'">',$startpage,' ','</a>';
        }

            echo '</div>';
    }
    else{
    $lastpage = 1;
    echo '<div class="page">';
    echo '<div class="current">';
    echo '<a href="ResultPage.php?page='.$startpage.'">',$startpage,' ','</a>';
    echo '</div>';
    echo '</div>';
    }

    //ページネーション用の変数

    if($count>0){
        $_SESSION['keyArray'] = array();
        $_SESSION['keyArray'] = $keyArray;
    }

        $_SESSION['str'] = $str;
        $_SESSION['lastpage'] = $lastpage;//最小または最大ページ数を取得
        $_SESSION['count'] = $count;//条件が指定されているかを確認
?>
</body>
</html>
