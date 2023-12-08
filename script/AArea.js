window.onload = function () {

  // 画像を配列に格納
  var images = [
    './ranking.img/siroik.png',
    './ranking.img/rigozyamuk.jpg',
    './ranking.img/nattok.jpg',
    './ranking.img/sasak.png',
    './ranking.img/sekik.png',
    './ranking.img/kouendangok.png',
    './ranking.img/manmak.png',
    './ranking.img/amaouk.jpg'
  ];
 // リンク先配列
 var link = [
  'syousai.php?productID=126',
  'syousai.php?productID=134',
  'syousai.php?productID=165',
  'syousai.php?productID=123',
  'syousai.php?productID=93',
  'syousai.php?productID=60',
  'syousai.php?productID=75',
  'syousai.php?productID=48',

 ];
 
 // HTMLから要素を取得
 var target = document.getElementById('slide');
 var right = document.getElementById('right');
 var left = document.getElementById('left');

 // クリックしたときに変わるようにカウント変数
 var count = 0;

 // 画像を変更する関数
function change() {
  target.style.backgroundImage = 'url("' + images[count] + '")';
}


 // 画像をクリックしたら遷移
function detail(){
 window.location.href=link[count];
}

 // >をクリックしたらcountを+1する
 function goNext() {
   if (count == 7) {
     count = 0;
   } else {
     count++;
   }
   change();
 }

 // <をクリックしたらcountを-1する
 function goBack() {
   if (count == 0) {
     count = 7;
   } else {
     count--;
   }
   change();
 }

 // クリックイベント
 //right.addEventListener('click', goNext, false);
 //left.addEventListener('click', goBack, false);
 target.addEventListener('click', detail, false);

  // 3秒ごとに画像を変更する
  setInterval(function () {
    goNext();
  }, 3000);
};
