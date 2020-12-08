<?php 
// ファイル書き込みサンプル
$dir = "data";
$dir_path = $dir . "/";
if (!is_dir($dir)) {
    mkdir($dir);
}

$save_file_name ="sample.txt";
$save_text = array("文字列1行目", "文字列2行目", "文字列3行目");

$fp = fopen($dir_path . $save_file_name, "w");
// foreach ($save_text as $text ) {
//     $str = $text . PHP_EOL;
//     fputs($fp, $str);
// }
fputs($fp, "950-0022" . PHP_EOL);
fputs($fp, "新潟市中央区" . PHP_EOL);
fputs($fp, "025-000-1111" . PHP_EOL);
fputs($fp, "テスト太郎");

fclose($fp);

$num = 0;
$fp = fopen($dir_path . $save_file_name, "r",);
while (!feof($fp)) {
    print $num ++;
    $str = fgets($fp);
    $str = str_replace(PHP_EOL, "", $str);
    print $str . "<br>";

}
fclose($fp);

$fp = fopen($dir_path . "sample.csv", "r",);
while (!feof($fp)) {
    print $num ++;
    $str = fgets($fp);
    $str = str_replace(PHP_EOL, "", $str);
    print $str . "<br>";
}
fclose($fp);

$csv = file($dir_path . "sample.csv");


foreach ($csv as $c ) {
    var_dump($c);
    $str = str_replace(PHP_EOL, "", $c);
    $data[] = explode(",", $str);
}
var_dump($data);



?>