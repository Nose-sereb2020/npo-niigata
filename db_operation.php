<?php

include_once 'db_connect.php';

function add_data($name, $yubin, $jusho1, $jusho2, $tel, $mail, $biko){
    global $pdo;
    $sql ="INSERT INTO address_data(name, yubin, jusho1, jusho2, tel, mail, biko)
    VALUES('$name', '$yubin', '$jusho1', '$jusho2', '$tel', '$mail', '$biko');";
    $pdo->query($sql);
    return $pdo->lastInsertId('id');
}


function delete_data($id){
    global $pdo;
    $sql ="DELETE FROM address_data WHERE id=$id;";
    return $pdo->query($sql);

    
}

function change_data($id, $name, $yubin, $jusho1, $jusho2, $tel, $mail, $biko){
    global $pdo;
    $sql ="UPDATE address_data SET
    name = '$name',
    yubin = '$yubin',
    jusho1 = '$jusho1',
    jusho2 = '$jusho2',
    tel = '$tel',
    mail = '$mail',
    biko = '$biko' WHERE id=$id;";
    return $pdo->query($sql);
}

function getDataAll(){
    global $pdo;
    $sql ="SELECT * FROM address_data ORDER BY id DESC;";
    return $pdo->query($sql);

}

function getDataId($id){
    global $pdo;
    $sql ="SELECT * FROM address_data WHERE id=$id;";
    return $pdo->query($sql);

}



?>