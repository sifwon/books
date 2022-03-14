<?php
require __DIR__ . '/lib/mysqli.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost = $_ENV['DB_HOST'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassWord = $_ENV['DB_PASSWORD'];
$dbDatabase = $_ENV['DB_DATABASE'];
$link = mysqli_connect($dbHost,$dbUsername,$dbPassWord,$dbDatabase);
if(!$link){
    echo 'データベースの接続に失敗しました' . PHP_EOL;
    echo mysqli_connect_error($link);
    exit;
}else{
    echo 'データベースの接続に成功しました' . PHP_EOL;
}