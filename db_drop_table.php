<?php

include_once 'db_connect.php';

$sql ="DROP TABLE address_data;";

$set = $pdo->query($sql);

if($set){
    print "テーブルを削除しました";
}else{
    print "テーブルを削除できませんでした";
}

?>