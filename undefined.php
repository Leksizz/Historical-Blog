<?php

$result = [];
$string = "/blog/{id}";
preg_match_all("/\{(\w+)\}/u", $string, $result);
var_dump($result);