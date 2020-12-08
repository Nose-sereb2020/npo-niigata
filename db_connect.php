<?php
$db_name = "test_db";
$username = "test_db";
$passwd = "password";
$options = null;
$dsn = "mysql:host=localhost;dbname=$db_name;charset=utf8";

try{
    $pdo = new PDO($dsn, $username, $passwd , $options);
    $pdo->query("SET NAMES utf8");

    //print "データベース接続完了";
}catch(Excepton $e){
    exit('データベース接続失敗' .$e->getMessage());
}

?>