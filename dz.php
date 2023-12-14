<?php

$arr = [];
$i = 0;
while ($i < rand(5, 20)) {
    $arr[] += rand(0, 9);
    $i++;
}
print_r($arr);
echo "<br />";
$j = 0;
$sum = 0;
$counter = 0;
while ($j < count($arr)) {
    if ($sum < 10) {
        $sum += $arr[$j];
        $counter++;
    }
    $j++;
}
echo "Кол-во сложенных элементов: $counter";