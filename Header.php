<link rel="stylesheet" href="./css/Header.css">
<div id="header">
    <div class="left">
        <div class="logo">
            <a href="ここにトップ画面へのリンク">
                <img src="./log/TopLog.png" alt="ロゴ">
            </a>
        </div>
        <div class="search-container">
            <form action="Result.php" method="post">
                <input type="text" autocomplete="off" aria-autocomplete="list" aria-controls="react-autowhatever-1" class="search-input" placeholder="キーワードを入力" name="sname" value="" spellcheck="false" data-ms-editor="true">
                <input type="hidden" name="region" value="0">
                <input type="hidden" name="category" value="0">
                <input type="hidden" name="price" value="0">
                <button type="submit" class="search-button">
                    <img src="./icon/Search.png" width="20" height="20" alt="検索">
                </button>
            </form>
        </div>
    </div>
    <div class="right">
        <a href="Search.php"><img src="./icon/Search.png" width="30" height="30" alt="検索"></a>
        <a href="Cart.php"><img src="./icon/Cart.png" width="30" height="30" alt="カート"></a>
        <a href="<?php
        echo (isset($_SESSION['custamer'])) ? './Account-input.php' : './Login-input.php';
        ?>"><img src="./icon/Account.png" width="30" height="30" alt="アカウント"></a>
    </div>
    <hr>
</div>
