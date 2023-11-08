<?php require 'db-connect.php' ?>
<?php
    $pdo=new PDO($connect,USER,PASS);

        $str='select * from product as p inner join productgenre as pg on p.productID = pg.productID where';
        $count=0;
        $keyArray=array();

    if(strlen($_POST['sname'])>0){
        $str = $str.' productName like ?';
        $keyArray[$count]='%'.$_POST['sname'].'%';
        $count+=1;
    }

if($_POST['region']!=0){
        if($count==0){
            $str = $str.' prefecturesNo=?';
        }
        else{
            $str = $str.'or'.' prefecturesNo=?';
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
            $str = $str.'or'.' genreID=?';
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
            $str = $str.'or'.' price between ? and ?';
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
    }
}

    if($count>0){
        $sql=$pdo->prepare($str);
        $sql->execute($keyArray);
    }
    else{
        $sql=$pdo->query('select * from product as p inner join productgenre as pg on p.productID = pg.productID');
    }

    if($sql->rowCount()>0){
        echo '<table>';
        echo '<tr><th>商品ID</th><th>商品名</th><th>価格</th></tr>';
        foreach($sql as $row){
            echo '<tr>';
            echo '<td>',$row['productID'],'</td>';
            echo '<td>',$row['productName'],'</td>';
            echo '<td>',$row['price'],'</td>';
            echo '</tr>';
            echo "\n";
        }
        echo '</table>';
    }
    else{
        echo '<p>','該当する商品が見つかりませんでした。','</p>';
        echo '<p>','条件の変更を行ってください。','</p>';
    }
?>
