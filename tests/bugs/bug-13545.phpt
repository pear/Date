--TEST--
Bug #13545 Date_Span::set() doesn't work when passed an int and format
--FILE--
<?php

require_once 'Date.php';

$span = new Date_Span(1, '%D');
echo $span->format('%D-%S');

?> 
--EXPECT--
1-00
