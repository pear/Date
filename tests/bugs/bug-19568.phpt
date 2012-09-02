--TEST--
Bug #19568 setDate() handles ISO week dates incorrectly
--FILE--
<?php
require_once 'Date.php';

$x = new Date('2012-W49-1');
print $x->year . "\n";
print $x->month . "\n";
print $x->day . "\n";

$y = new Date('2012-W50-1');
print $y->year . "\n";
print $y->month . "\n";
print $y->day . "\n";
--EXPECT--
2012
12
3
2012
12
10
