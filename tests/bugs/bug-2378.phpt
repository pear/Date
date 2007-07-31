--TEST--
Bug #2378: Date::getDate(DATE_FORMAT_UNIXTIME) doesn't convert to GMT
--FILE--
<?php
/**
 * Test for: Date
 * Parts tested: Date::getTime(), Date::getDate(DATE_FORMAT_UNIXTIME)
 */

require_once 'Date.php';

$date =& new Date('2006-12-08T01:00:00Z');
$ts = $date->getTime();
echo 'Greenwich = ' . $ts . ' - ' . date('Y-m-d H:i:s', $ts) . "\n";

$date->convertTZbyID('Asia/Jakarta');
$ts = $date->getTime();
echo 'Jakarta (GMT+0700) = ' . $ts . ' - ' . date('Y-m-d H:i:s', $ts) . "\n";
?>
--EXPECT--
Greenwich = 1165579200 - 2006-12-08 01:00:00
Jakarta (GMT+0700) = 1165579200 - 2006-12-08 08:00:00
