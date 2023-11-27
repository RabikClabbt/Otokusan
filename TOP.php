<?php require 'header.php'; ?>
<?php require 'sideber.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <script>
            /*function changeANDscrollToElement(regionId, duration) {
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
                    regionHeading.style.color = "maroon";
            }*/

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
            echo '<div class="taiyo">';
                /*gahakuフォルダから太陽を呼び出して回転させるクラスを付与*/
                echo '<img src="gahaku/taiyo.png" class="ugokikaiten animation">';
            echo '</div>';
            echo '<div class="hikouki">';
                /*gahakuフォルダから飛行機を呼び出して斜め移動させるクラスを付与*/
                echo '<img src="gahaku/hikouki2.png" class="ugokinaname animation">';
            echo '</div>';
            echo '<div class="tori">';
                /*gahakuフォルダから鳥を呼び出して縦移動させるクラスを付与*/
                echo '<img src="gahaku/tori.png" class="ugokitate animation">';
            echo '</div>';
            echo '<div class="ho">';
                /*hrefの中に北海道リンク先を張ってください*/
                echo '<a href="#hokkaido"><img src="image/Hokkaido.png"></a>';
                /*echo '<input type="image" name="ho" src="image/Hokkaido.png"  alt="ho" value="ho">';*/
            echo '</div>';
            echo '<div class="to">';
                /*hrefの中に東北地方リンク先を張ってください*/
                echo '<a href="#tohoku"><img src="image/tohoku.png"></a>';
                /*echo '<input type="image" name="to" src="image/tohoku.png"  alt="to" value="to">';*/
            echo '</div>';
            echo '<div class="kan">';
                /*hrefの中に関東地方リンク先を張ってください*/
                echo '<a href="#kanto"><img src="image/kanto.png"></a>';
                /*echo '<input type="image" name="kan" src="image/kanto.png"  alt="kan" value="kan">';*/
            echo '</div>';
            echo '<div class="tyu">';
                /*hrefの中に中部地方リンク先を張ってください*/
                echo '<a href="#tyubu"><img src="image/tyubu.png"></a>';
                /*echo '<input type="image" name="tyu" src="image/tyubu.png"  alt="tyu" value="tyu">';*/
            echo '</div>';
            echo '<div class="kik">';
                /*hrefの中に近畿地方リンク先を張ってください*/
                echo '<a href="#kinki"><img src="image/kinki.png"></a>';
                /*echo '<input type="image" name="kik" src="image/kinki.png"  alt="kik" value="kik">';*/
            echo '</div>';
            echo '<div class="tyugo">';
                /*hrefの中に中国地方リンク先を張ってください*/
                echo '<a href="#tyugoku"><img src="image/tyugoku.png"></a>';
                /*echo '<input type="image" name="tyugo" src="image/tyugoku.png"  alt="tyugo" value="tyugo">';*/
            echo '</div>';
            echo '<div class="siko">';
                /*hrefの中に四国地方リンク先を張ってください*/
                echo '<a href="#sikoku"><img src="image/shikoku.png"></a>';
                /*echo '<input type="image" name="siko" src="image/shikoku.png"  alt="siko" value="siko">';*/
            echo '</div>';
            echo '<div class="kyusy">';
                /*hrefの中に九州地方リンク先を張ってください*/
                echo '<a href="#kyusyu"><img src="image/kyusyu.png"></a>';
                /*echo '<input type="image" name="kyusy" src="image/kyusyu.png"  alt="kyusy" value="kyusy">';*/
            echo '</div>';
        echo '</div>';
        ?>
        <?php require './Footer.php'; ?>
    </body>
</html>