<?php

include_once 'db_connect.php';

$sql ="CREATE TABLE address_data(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, name TEXT, yubin TEXT,
    jusho1 TEXT, jusho2 TEXT, tel TEXT, mail TEXT, biko TEXT, time_stamp TIMESTAMP);";

$set = $pdo->query($sql);

if($set){
    print "テーブルを作成しました";
}else{
    print "テーブルを作成できませんでした";
}

?>