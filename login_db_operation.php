<?php

include_once 'db_connect.php';

function user_add_data($user_id, $password, $save_date){
    global $pdo;
    $sql ="INSERT INTO user_data(user_id, password, save_date)
    VALUES('$user_id', '$password', '$save_date');";
    $pdo->query($sql);
    return $pdo->lastInsertId('id');
}

function user_delete_data($id){
    global $pdo;
    $sql ="DELETE FROM user_data WHERE id=$id;";
    return $pdo->query($sql);
}

function user_change_data($id, $password){
    global $pdo;
    $sql ="UPDATE user_data SET
    password = '$password' WHERE id=$id;";
    return $pdo->query($sql);
}

function user_getDataAll(){
    global $pdo;
    $sql ="SELECT * FROM user_data ORDER BY id DESC;";
    return $pdo->query($sql);
}

function user_getDataId($id){
    global $pdo;
    $sql ="SELECT * FROM user_data WHERE id=$id;";
    return $pdo->query($sql);
}

// 暗号化パスワード生成
function makePassword($passwd){
    $tempStr1 = "qwerty";
    $tempStr2 = "zxcvbn";
    $pass = hash("sha256", $passwd);
    $passw = $tempStr1 . $pass . $tempStr2;
    return hash("sha256", $passw);
}

?>