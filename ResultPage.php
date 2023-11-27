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

    $cnt=0;
    $i=0;
    $startpage=1;
    $pageNow = $_GET['page'];//現在のページを取得 

    if(isset($_SESSION['lastpage'])){
    $lastpage = $_SESSION['lastpage'];
    }
    if(isset($_SESSION['str'])){
        $str = $_SESSION['str'];
    }
    if(isset($_SESSION['count'])){
        $count = $_SESSION['count'];
    }
    if($count==0){
        $allstr='select * from product as p inner join productgenre as pg on p.productID = pg.productID inner join prefectures as pf on p.prefecturesNo = pf.prefecturesNo';
    }
    if($count>0){
        $keyArray=array();
        $keyArray=$_SESSION['keyArray'];
    }

    if($count>0 && $cnt==0){
    switch($pageNow){
        case 1:
            $str = $str.' order by p.productID limit 0,20;';
        break;
        case 2:
            $str = $str.' order by p.productID limit 20,20;';
        break;
        case 3:
            $str = $str.' order by p.productID limit 40,20;';
        break;
        case 4:
            $str = $str.' order by p.productID limit 60,20;';
        break;
        case 5:
            $str = $str.' order by p.productID limit 80,20;';
        break;
        case 6:
            $str = $str.' order by p.productID limit 100,20;';
        break;
        case 7:
            $str = $str.' order by p.productID limit 120,20;';
        break;
        case 8:
            $str = $str.' order by p.productID limit 140,20;';
        break;
        case 9:
            $str = $str.' order by p.productID limit 160,20;';
        break;
        }
    }
    else if($count==0 && $cnt==0){
        switch($pageNow){
            case 1:
                $allstr = $allstr.' order by p.productID limit 0,20;';
            break;
            case 2:
                $allstr = $allstr.' order by p.productID limit 20,20;';
            break;
            case 3:
                $allstr = $allstr.' order by p.productID limit 40,20;';
            break;
            case 4:
                $allstr = $allstr.' order by p.productID limit 60,20;';
            break;
            case 5:
                $allstr = $allstr.' order by p.productID limit 80,20;';
            break;
            case 6:
                $allstr = $allstr.' order by p.productID limit 100,20;';
            break;
            case 7:
                $allstr = $allstr.' order by p.productID limit 120,20;';
            break;
            case 8:
                $allstr = $allstr.' order by p.productID limit 140,20;';
            break;
            case 9:
                $allstr = $allstr.' order by p.productID limit 160,20;';
            break;
            case 10:
                $allstr = $allstr.' order by p.productID limit 180,20;';
            break;
            }
    }

    if($count>0){
        $sql=$pdo->prepare($str);
        $sql->execute($keyArray);
    }
    else if($count==0){
        $sql=$pdo->query($allstr);
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

    for($startpage;$startpage<=$lastpage;$startpage++){
        if($startpage==1){
            echo '<div class="page">';
        }
        if($pageNow==$startpage){
            echo '<div class="current">';
        }
        else if($pageNow+1==$startpage){
            echo '</div>';
        }
        echo '<a href="ResultPage.php?page='.$startpage.'">',$startpage,' ','</a>';
    }
            echo '</div>';
?>
</body>
</html>
