<?php
$a = 2;
$b = 3;
$text1 = "これはテキスト";
$text2 = "aksdjfa;dfkl";

$c = $a + $b;

print  $c;
print "<br>";
print $text1 . $text2;
print "<br>";
print $a . $text1 . $b . $text2;
print "<br>";


$d = array(1,2,3,4,5,6,7,8,9,10);
print_r($d);
print "<br>";
$e = array("price" => "300", "name" => "メロン");
print "<br>";

$x = 0;
// for ($i = 0; $i < count($d); $i++) {
//     $x = $x + $d[$i];
// }

// $x =0;
foreach ($d as $value) {
    $x += $value;
    if (is_int($x)) {
        print "偶数";
    }
}
print $x;

?>
