<?php require 'header.php'; ?>
<?php require 'sideber.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <?php
        echo '<div class="region">';
            echo '<div class="ho">';
                echo '<a href="#hokkaido"><img src="image/Hokkaido.png"></a>';
                /*echo '<input type="image" name="ho" src="image/Hokkaido.png"  alt="ho" value="ho">';*/
            echo '</div>';
            echo '<div class="to">';
                echo '<a href="#tohoku"><img src="image/tohoku.png"></a>';
                /*echo '<input type="image" name="to" src="image/tohoku.png"  alt="to" value="to">';*/
            echo '</div>';
            echo '<div class="kan">';
                echo '<a href="#kanto"><img src="image/kanto.png"></a>';
                /*echo '<input type="image" name="kan" src="image/kanto.png"  alt="kan" value="kan">';*/
            echo '</div>';
            echo '<div class="tyu">';
                echo '<a href="#tyubu"><img src="image/tyubu.png"></a>';
                /*echo '<input type="image" name="tyu" src="image/tyubu.png"  alt="tyu" value="tyu">';*/
            echo '</div>';
            echo '<div class="kik">';
                echo '<a href="#kinki"><img src="image/kinki.png"></a>';
                /*echo '<input type="image" name="kik" src="image/kinki.png"  alt="kik" value="kik">';*/
            echo '</div>';
            echo '<div class="tyugo">';
                echo '<a href="#tyugoku"><img src="image/tyugoku.png"></a>';
                /*echo '<input type="image" name="tyugo" src="image/tyugoku.png"  alt="tyugo" value="tyugo">';*/
            echo '</div>';
            echo '<div class="siko">';
                echo '<a href="#sikoku"><img src="image/shikoku.png"></a>';
                /*echo '<input type="image" name="siko" src="image/shikoku.png"  alt="siko" value="siko">';*/
            echo '</div>';
            echo '<div class="kyusy">';
                echo '<a href="#kyusyu"><img src="image/kyusyu.png"></a>';
                /*echo '<input type="image" name="kyusy" src="image/kyusyu.png"  alt="kyusy" value="kyusy">';*/
            echo '</div>';
        echo '</div>';
        ?>
        <div class="rink">
            <h2 id="hokkaido" class="anchor">北海道</h2>
            <ul>
                <li><a href= "hokkaido.html" >北海道</a></li>
            </ul>
            <h2 id="tohoku" class="anchor">東北地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >青森県</a></li>
                <li><a href= "hokkaido.html" >秋田県</a></li>
                <li><a href= "hokkaido.html" >岩手県</a></li>
                <li><a href= "hokkaido.html" >宮城県</a></li>
                <li><a href= "hokkaido.html" >山形県</a></li>
                <li><a href= "hokkaido.html" >福島県</a></li>
            </ul>
            <h2 id="kanto" class="anchor">関東地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >茨城県</a></li>
                <li><a href= "hokkaido.html" >栃木県</a></li>
                <li><a href= "hokkaido.html" >群馬県</a></li>
                <li><a href= "hokkaido.html" >埼玉県</a></li>
                <li><a href= "hokkaido.html" >東京都</a></li>
                <li><a href= "hokkaido.html" >千葉県</a></li>
                <li><a href= "hokkaido.html" >神奈川県</a></li>
            </ul>
            <h2 id="tyubu" class="anchor">中部地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >新潟県</a></li>
                <li><a href= "hokkaido.html" >山梨県</a></li>
                <li><a href= "hokkaido.html" >静岡県</a></li>
                <li><a href= "hokkaido.html" >長野県</a></li>
                <li><a href= "hokkaido.html" >岐阜県</a></li>
                <li><a href= "hokkaido.html" >愛知県</a></li>
                <li><a href= "hokkaido.html" >富山県</a></li>
                <li><a href= "hokkaido.html" >石川県</a></li>
                <li><a href= "hokkaido.html" >福井県</a></li>
            </ul>
            <h2 id="kinki" class="anchor">近畿地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >三重県</a></li>
                <li><a href= "hokkaido.html" >滋賀県</a></li>
                <li><a href= "hokkaido.html" >京都府</a></li>
                <li><a href= "hokkaido.html" >大阪府</a></li>
                <li><a href= "hokkaido.html" >兵庫県</a></li>
                <li><a href= "hokkaido.html" >奈良県</a></li>
                <li><a href= "hokkaido.html" >和歌山県</a></li>
            </ul>
            <h2 id="tyugoku" class="anchor">中国地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >鳥取県</a></li>
                <li><a href= "hokkaido.html" >島根県</a></li>
                <li><a href= "hokkaido.html" >岡山県</a></li>
                <li><a href= "hokkaido.html" >広島県</a></li>
                <li><a href= "hokkaido.html" >山口県</a></li>
            </ul>
            <h2 id="sikoku" class="anchor">四国地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >愛媛県</a></li>
                <li><a href= "hokkaido.html" >高知県</a></li>
                <li><a href= "hokkaido.html" >徳島県</a></li>
                <li><a href= "hokkaido.html" >香川県</a></li>
            </ul>
            <h2 id="kyusyu" class="anchor">九州・沖縄地方</h2>
            <ul>
                <li><a href= "hokkaido.html" >福岡県</a></li>
                <li><a href= "hokkaido.html" >佐賀県</a></li>
                <li><a href= "hokkaido.html" >長崎県</a></li>
                <li><a href= "hokkaido.html" >熊本県</a></li>
                <li><a href= "hokkaido.html" >大分県</a></li>
                <li><a href= "hokkaido.html" >宮崎県</a></li>
                <li><a href= "hokkaido.html" >鹿児島県</a></li>
                <li><a href= "hokkaido.html" >沖縄県</a></li>
            </ul>
        </div>
    </body>
</html>