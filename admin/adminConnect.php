<?php
    const SERVER = 'myspl219.phy.lolipop.lan';
    const DBNAME = 'LAA1517467-admin';
    const USER = 'LAA1517467';
    const PASS = 'admin123';

    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';

    $pdo = new PDO($connect, USER, PASSWORD);
?>