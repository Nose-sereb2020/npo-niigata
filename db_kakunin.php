<?php

include_once 'db_operation.php';

//add data
// $name ="taro";
// $yubin ="959-2222";
// $jusho1 ="niigataken niigatashi";
// $jusho2 ="chuoku oumi1-1-1";
// $tel ="025-123-456";
// $mail ="test@test.com";
// $biko ="this is biko";
// $id = add_data( $name,  $yubin,  $jusho1,  $jusho2,  $tel,  $mail,  $biko);
// print $id;


//delete data
// $id = 4;
// $str = delete_data($id);
// var_dump($str);

//data modify
// $id = 2;
// $name ="hanako";
// $yubin ="151-5654";
// $jusho1 ="niigataken sihibatashi";
// $jusho2 ="nishishibata midoricho1-1-1";
// $tel ="999-545-787";
// $mail ="hanako@test.com";
// $biko ="this is hanko\'s boko";
// $str = change_data($id, $name,  $yubin,  $jusho1,  $jusho2,  $tel,  $mail,  $biko);
// var_dump($str);

//all data fetch
// $rst = getDataAll();
// while($row = $rst->fetch(PDO::FETCH_ASSOC)) {
//     var_dump(PDO::FETCH_ASSOC);
//     var_dump($row);
//     print PHP_EOL;
// }

//data part fetch
$id = 2;
$rst = getDataId($id);
if($row = $rst->fetch(PDO::FETCH_ASSOC)){
    var_dump($row["name"]);
}



?>