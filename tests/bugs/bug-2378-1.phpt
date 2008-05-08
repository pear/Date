--TEST--
Bug #2378: Date::getDate(DATE_FORMAT_UNIXTIME) doesn't convert to GMT
--FILE--
<?php

require_once "Date.php";


$date =& new Date(1095935549);
echo $date->getTime()."\n";
$date->convertTZbyID('America/Los_Angeles');
echo $date->getTime()."\n";

?>
--EXPECT--
1095935549
1095935549
