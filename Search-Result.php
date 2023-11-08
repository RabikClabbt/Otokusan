<?php require 'db-connect.php' ?>

<?php
if(isset($_POST['sname'])){
    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>';
    $pdo = new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from product where productName like ?');
    $sql->execute(['%'.$_POST['sname'].'%']);
    foreach($sql as $row){
        $id=$row['productID'];
        echo '<tr>';
        echo '<td>',$id,'</td>';
        echo '<td>',$row['productName'],'</td>';
        echo '<td>',$row['price'],'</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>