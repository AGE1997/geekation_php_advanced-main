<?php
$dsn = "mysql:host=localhost;dbname=casteria;charset=utf8";
$user = "root";
$password = "root";
$opt = [];

try {
    // DBへ接続
    $dbh = new PDO($dsn, $user, $password, $opt);
    echo "接続成功\n";
} catch (PDOException $e) {
    echo "接続失敗:". $e->getMessage(). "\n";
}
