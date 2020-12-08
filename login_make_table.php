<?php 
include_once 'db_connect.php';

$sql = "DROP TABLE user_data;";
$pdo->query($sql);
print "既存テーブル削除" . "<br>";

$sql = "CREATE TABLE user_data(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id TEXT, password TEXT, save_date DATE);";

$set = $pdo->query($sql);

if ($set) {
    print "テーブルを作成しました";
}else {
    print "テーブルを作成できませんでした";
}
?>