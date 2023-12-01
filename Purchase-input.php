<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
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
    if (isset($_SESSION['customer'])) {
        echo '氏名：', $_SESSION['customer']['memberName'] ,'<br>';
        echo '所在地域：';
        $sql2=$pdo->prepare('select regionName from region where regionID=?');
        $sql2->execute([$_SESSION['customer']['regionID']]);
        foreach($sql2 as $row){
            echo $row['regionName'];
        }

        if(isset($_POST['productID'])){ //廣永ファイル（商品詳細）から情報が送られた場合
            $sql=$pdo->prepare('select * from product where productID');
            $sql->execute($_POST['productID']);
            foreach($sql as $row){
                $prefectureNo=$row['prefecturesNo'];
                $price=$row['price'];
                $productName=$row['productName'];
            }
            $sql3=$pdo->prepare('select regionID from prefectures where prefecturesNo=?');
            $sql3->execute([$prefecturesNo]);
                foreach($sql3 as $row){
                    if($_SESSION['customer']['regionID']==$row['regionID']){
                        $postage=0;
                    }
                }

            echo $productName;
            echo '個数：',$_POST['count'],'個';
            echo '合計金額',$price*$_POST['count']+$postage,'円';
            if($postage!=0){
                echo '（内.送料',$postage,'円）';
            }
        }
        else{
            $cartdelete=1;
            $cartStatement = $pdo->prepare('SELECT c.productID, p.productName, p.price, p.imgPass, p.prefecturesNo, c.quantity FROM cart c
                                            JOIN product p ON c.productID = p.productID
                                            WHERE c.memberID = ?');
            $cartStatement->execute([$_SESSION['customer']['memberID']]);

            foreach($cartStatement as $row){
                $prefectureNo=$row['prefecturesNo'];
                $price+=$row['price']*$row['quantity'];
                $productName=$row['productName'];
                echo $productName;
                echo '個数：',$row['quantity'],'個';
            }
            $sql3=$pdo->prepare('select regionID from prefectures where prefecturesNo=?');
            $sql3->execute([$prefecturesNo]);
                foreach($sql3 as $row){
                    if($_SESSION['customer']['regionID']==$row['regionID']){
                        $postage=0;
                    }
                }

            
            echo '合計金額',$price+$postage,'円';
            if($postage!=0){
                echo '（内.送料',$postage,'円）';
            }



            
            
            
            $ploductID[]=[]; //プロダクトIDを保存しておくための変数
            $quantity[]=[]; //商品数量を保存する変数
            $sql4=$pdo->prepare('select productID from cart where memberID=?');
            $sql4->execute([$_SESSION['customer']['memberID']]);
                foreach($sql4 as $row){
                    $productID[]=$row['productID'];
                    $quantity[]=$row['quantity'];
                }
            //$sql=$pdo->prepare('select * from product where productID');
            $sql->execute($productID[]);
            foreach($sql as $row){
                $prefectureNo=$row['prefecturesNo'];
                echo $row['productName'];
                echo '個数：',$quantity[],'個';
                echo '合計金額',$row['price']*$_POST['count']+$postage,'円';
            }
        }
        echo '<form method="post" action="Purchase-output.php">';
        echo '<input type="hidden" name="cartdelete" value="' ,$cartdelete, '">';
        echo '内容をご確認いただき、購入を確定してください。<br>';
        echo '<a href="Purchase-output.php">購入を確定する</a>';
        echo '</form>';
    } else {
        echo '商品を購入するには、ログインしてください。';
        echo '<a href="Login-input.php">ログイン画面へ</a>';
    }
?>
</body>
</html>
<?php
 $pdo = null;   //DB切断
 ?>