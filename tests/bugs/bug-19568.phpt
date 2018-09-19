--TEST--
Bug #19568 setDate() handles ISO week dates incorrectly
--FILE--
<?php
require_once 'Date.php';

$x = new Date('2012-W49-1');
print $x->getYear() . "\n";
print $x->getMonth() . "\n";
print $x->getDay() . "\n";

$y = new Date('2012-W50-1');
print $y->getYear() . "\n";
print $y->getMonth() . "\n";
print $y->getDay() . "\n";
--EXPECT--
2012
12
3
2012
12
10
