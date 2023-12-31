<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/Purchase.css">
<title>minamis programs</title>
</head>
<body>
<?php require 'Header.php'; ?>
<?php require 'db-connect.php';?>
<?php
    $postage=540; //送料の変数割り当て
    $prefecturesNo=0; //都道府県ナンバーの変数を作ってます。
    $price=0; //価格変数
    $productName=''; //商品ネーム変数
    $cartdelete=0; //購入後にカートの情報を削除するか判断する

    echo '<div class="container">';
    if (isset($_SESSION['customer'])) {
        echo '＜お客様情報＞<br>';
        echo '氏名：', $_SESSION['customer']['memberName'] ,'<br>';
        echo '所在地域：';
        $sql2=$pdo->prepare('select regionName from region where regionID=?');
        $sql2->execute([$_SESSION['customer']['regionID']]);
        foreach($sql2 as $row){
            echo $row['regionName'],'<br>';
        }
        echo '<hr>';

        
        
        if(isset($_POST['productID'])){ 
             //廣永ファイル（商品詳細）から情報が送られた場合
            $sql=$pdo->prepare('select * from product where productID=?');
            $sql->execute([$_POST['productID']]);
            foreach($sql as $row){
                $prefecturesNo=$row['prefecturesNo'];
                $price=$row['price'];
                $productName=$row['productName'];
                $imgPass=$row['imgPass'];
            }
            $sql3=$pdo->prepare('select regionID from prefectures where prefecturesNo=?');
            $sql3->execute([$prefecturesNo]);
                foreach($sql3 as $row){
                    if($_SESSION['customer']['regionID']==$row['regionID']){
                        $postage=0;
                    }
                }

            echo '＜カート情報＞<br>';
            echo '<p><img src="otokusanImage/',$imgPass,'" alt="image"></p>';
            echo $productName,'<br>';
            echo '個数：',$_POST['count'],'個';
            echo '<br>合計金額　',$price*$_POST['count']+$postage,'円';
            if($postage!=0){
                echo '（内.送料',$postage,'円）';
            }else{
                echo '（送料無料！）';
            }
        }
        else{
            $cartdelete=1;
            echo '＜商品情報＞<br>';
            $cartStatement = $pdo->prepare('SELECT c.productID, p.productName, p.price, p.imgPass, p.prefecturesNo, c.quantity FROM cart c
                                            JOIN product p ON c.productID = p.productID
                                            WHERE c.memberID = ?');
            $cartStatement->execute([$_SESSION['customer']['memberID']]);
                foreach($cartStatement as $row){
                $prefecturesNo=$row['prefecturesNo'];
                $price+=$row['price']*$row['quantity'];
                $productName=$row['productName'];
                echo '<p><img src="otokusanImage/',$row['imgPass'],'" alt="image"></p>';
                echo $productName,'<br>';
                echo '個数：',$row['quantity'],'個';
            }

            $sql3=$pdo->prepare('select regionID from prefectures where prefecturesNo=?');
            $sql3->execute([$prefecturesNo]);
                foreach($sql3 as $row){
                    if($_SESSION['customer']['regionID']==$row['regionID']){
                        $postage=0;
                    }
                }

            
            echo '<br>合計金額　',$price+$postage,'円';
            if($postage!=0){
                echo '（内.送料',$postage,'円）';
            }else{
                echo '（送料無料！）';
            }



            
            
            
            /*$ploductID=[]; //プロダクトIDを保存しておくための変数
            $quantity=[]; //商品数量を保存する変数
            $sql4=$pdo->prepare('select productID from cart where memberID=?');
            $sql4->execute([$_SESSION['customer']['memberID']]);
                foreach($sql4 as $row){
                    $productID=$row['productID'];
                    $quantity=$row['quantity'];
                }
            $sql5=$pdo->prepare('select * from product where productID');
            $sql5->execute($productID);
            foreach($sql5 as $row){
                $prefectureNo=$row['prefecturesNo'];
                echo $row['productName'];
                echo '個数：',$quantity,'個';
                echo '合計金額',$row['price']*$_POST['count']+$postage,'円';
            }*/
            
        }
        echo '<div class="purchase-fs">';
            echo '<form method="post" action="Purchase-output.php">';
            echo '<input type="hidden" name="cartdelete" value="' ,$cartdelete, '">';
            echo '内容をご確認いただき、購入を確定してください。<br>';
            echo '<input type="submit" name="buy" value="購入確定" class="small-button">';
            echo '</form>';
        echo '</div>';
    } else {
        echo '商品を購入するには、ログインしてください。';
        echo '<a href="Login-input.php">ログイン画面へ</a>';
    }
    echo '</div>';
?>
</body>
</html>
<?php
 $pdo = null;   //DB切断
 ?>