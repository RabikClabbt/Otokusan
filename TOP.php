<?php require 'header.php'; ?>
<?php require 'sideber.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <script>
            function changeANDscrollToElement(regionId, duration) {
            var targetElement = document.getElementById(regionId);
            if (targetElement) {
                var targetPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                var startPosition = window.scrollY;
                var startTime = performance.now();

                function scrollAnimation(currentTime) {
                    var elapsedTime = currentTime - startTime;
                    var progress = Math.min(elapsedTime / duration, 1);

                    window.scrollTo(0, easeInOutQuad(startPosition, targetPosition, progress));

                    if (elapsedTime < duration) {
                        requestAnimationFrame(scrollAnimation);
                    }
                }

                function easeInOutQuad(start, end, progress) {
                    progress /= 0.5;
                    if (progress < 1) return (end - start) / 2 * progress * progress + start;
                    progress--;
                    return -(end - start) / 2 * (progress * (progress - 2) - 1) + start;
                }

                requestAnimationFrame(scrollAnimation);
            }
                var allRegions = document.querySelectorAll('.anchor');
                    allRegions.forEach(function(region) {
                        region.style.color = "";
                    });

                    // Change color for the selected region
                    var regionHeading = document.getElementById(regionId);
                    regionHeading.style.color = "red";
            }

            /*function changeColor(regionId) {
                // Reset color for all regions
                var allRegions = document.querySelectorAll('.anchor');
                allRegions.forEach(function(region) {
                    region.style.color = "";
                });

                // Change color for the selected region
                var regionHeading = document.getElementById(regionId);
                regionHeading.style.color = "red";
            }*/
        </script>
    </head>
    <body>
        <h1 class="tiiki">ーーーー地域から探すーーーー</h1>
        <?php
        echo '<div class="region">';
            echo '<div class="ho">';
                echo '<a href="#hokkaido" onclick="changeANDscrollToElement(\'hokkaido\', 1000)"><img src="image/Hokkaido.png"></a>';
                /*echo '<input type="image" name="ho" src="image/Hokkaido.png"  alt="ho" value="ho">';*/
            echo '</div>';
            echo '<div class="to">';
                echo '<a href="#tohoku" onclick="changeANDscrollToElement(\'tohoku\', 1000)"><img src="image/tohoku.png"></a>';
                /*echo '<input type="image" name="to" src="image/tohoku.png"  alt="to" value="to">';*/
            echo '</div>';
            echo '<div class="kan">';
                echo '<a href="#kanto" onclick="changeANDscrollToElement(\'kanto\', 1000)"><img src="image/kanto.png"></a>';
                /*echo '<input type="image" name="kan" src="image/kanto.png"  alt="kan" value="kan">';*/
            echo '</div>';
            echo '<div class="tyu">';
                echo '<a href="#tyubu" onclick="changeANDscrollToElement(\'tyubu\', 1000)"><img src="image/tyubu.png"></a>';
                /*echo '<input type="image" name="tyu" src="image/tyubu.png"  alt="tyu" value="tyu">';*/
            echo '</div>';
            echo '<div class="kik">';
                echo '<a href="#kinki" onclick="changeANDscrollToElement(\'kinki\', 1000)"><img src="image/kinki.png"></a>';
                /*echo '<input type="image" name="kik" src="image/kinki.png"  alt="kik" value="kik">';*/
            echo '</div>';
            echo '<div class="tyugo">';
                echo '<a href="#tyugoku" onclick="changeANDscrollToElement(\'tyugoku\', 1000)"><img src="image/tyugoku.png"></a>';
                /*echo '<input type="image" name="tyugo" src="image/tyugoku.png"  alt="tyugo" value="tyugo">';*/
            echo '</div>';
            echo '<div class="siko">';
                echo '<a href="#sikoku" onclick="changeANDscrollToElement(\'sikoku\', 1000)"><img src="image/shikoku.png"></a>';
                /*echo '<input type="image" name="siko" src="image/shikoku.png"  alt="siko" value="siko">';*/
            echo '</div>';
            echo '<div class="kyusy">';
                echo '<a href="#kyusyu" onclick="changeANDscrollToElement(\'kyusyu\', 1000)"><img src="image/kyusyu.png"></a>';
                /*echo '<input type="image" name="kyusy" src="image/kyusyu.png"  alt="kyusy" value="kyusy">';*/
            echo '</div>';
        echo '</div>';
        ?>
        <h1 class="ken">ーーーー気になった都道府県を選んでくださいーーーー</h1>
        <div class="rink">
            <h2 id="hokkaido" class="anchor">北海道</h2>
            
            <a href= "hokkaido.html" >北海道</a>
            
            <h2 id="tohoku" class="anchor">東北地方</h2>
            
            <a href= "hokkaido.html" >青森県</a>
            <a href= "hokkaido.html" >秋田県</a>
            <a href= "hokkaido.html" >岩手県</a>
            <a href= "hokkaido.html" >宮城県</a>
            <a href= "hokkaido.html" >山形県</a>
            <a href= "hokkaido.html" >福島県</a>
            
            <h2 id="kanto" class="anchor">関東地方</h2>
            
            <a href= "hokkaido.html" >茨城県</a>
            <a href= "hokkaido.html" >栃木県</a>
            <a href= "hokkaido.html" >群馬県</a>
            <a href= "hokkaido.html" >埼玉県</a>
            <a href= "hokkaido.html" >東京都</a>
            <a href= "hokkaido.html" >千葉県</a>
            <a href= "hokkaido.html" >神奈川県</a>
            
            <h2 id="tyubu" class="anchor">中部地方</h2>
            
            <a href= "hokkaido.html" >新潟県</a>
            <a href= "hokkaido.html" >山梨県</a>
            <a href= "hokkaido.html" >静岡県</a>
            <a href= "hokkaido.html" >長野県</a>
            <a href= "hokkaido.html" >岐阜県</a>
            <a href= "hokkaido.html" >愛知県</a>
            <a href= "hokkaido.html" >富山県</a>
            <a href= "hokkaido.html" >石川県</a>
            <a href= "hokkaido.html" >福井県</a>
            
            <h2 id="kinki" class="anchor">近畿地方</h2>
            
            <a href= "hokkaido.html" >三重県</a>
            <a href= "hokkaido.html" >滋賀県</a>
            <a href= "hokkaido.html" >京都府</a>
            <a href= "hokkaido.html" >大阪府</a>
            <a href= "hokkaido.html" >兵庫県</a>
            <a href= "hokkaido.html" >奈良県</a>
            <a href= "hokkaido.html" >和歌山県</a>
            
            <h2 id="tyugoku" class="anchor">中国地方</h2>
            
            <a href= "hokkaido.html" >鳥取県</a>
            <a href= "hokkaido.html" >島根県</a>
            <a href= "hokkaido.html" >岡山県</a>
            <a href= "hokkaido.html" >広島県</a>
            <a href= "hokkaido.html" >山口県</a>
            
            <h2 id="sikoku" class="anchor">四国地方</h2>
            
            <a href= "hokkaido.html" >愛媛県</a>
            <a href= "hokkaido.html" >高知県</a>
            <a href= "hokkaido.html" >徳島県</a>
            <a href= "hokkaido.html" >香川県</a>
            
            <h2 id="kyusyu" class="anchor">九州・沖縄地方</h2>
            
            <a href= "hokkaido.html" >福岡県</a>
            <a href= "hokkaido.html" >佐賀県</a>
            <a href= "hokkaido.html" >長崎県</a>
            <a href= "hokkaido.html" >熊本県</a>
            <a href= "hokkaido.html" >大分県</a>
            <a href= "hokkaido.html" >宮崎県</a>
            <a href= "hokkaido.html" >鹿児島県</a>
            <a href= "hokkaido.html" >沖縄県</a>
            
        </div>
        <div class="kuhaku">
        </div>
    </body>
</html>