--TEST--
Bug #8912: putenv() causes crashes in DateTimeZone::inDaylightTime() under windows
--FILE--
<?php
/**
 * Test for: Date_TimeZone
 * Parts tested: Date_TimeZone::inDaylightTime()
 */

require_once 'Date.php';

$states = array(
    'Australia/Adelaide',
    'Australia/Canberra',
    'Australia/Darwin',
    'Australia/Brisbane',
    'Australia/Hobart',
    'Australia/Melbourne',
    'Australia/Perth',
    'Australia/Sydney'
);

$originalTimezone = new Date_TimeZone('Australia/Adelaide');

$d = new Date("2007-08-31 11.59.59Z");
$hn_time = $d->getTime();
foreach ($states as $state) {
    $new_date = new Date($hn_time);
    print 'Original Time (Australia/Adelaide): ' . $new_date->getTime() . "\n";
    $timezone = new Date_TimeZone($state);
//    $new_date->setTZ($originalTimezone);
    $new_date->convertTZ($timezone);
    print $state . ': ' . ($hn_localtime = $new_date->getTime()) . "\n";
    print 'Difference: ' . ($hn_localtime - $hn_time) . "\n";
    print "\n";
}
?>
--EXPECT--
Original Time (Australia/Adelaide): 943920000
Australia/Adelaide: 943920000
Difference: 0

Original Time (Australia/Adelaide): 943920000
Australia/Canberra: 943921800
Difference: 1800

Original Time (Australia/Adelaide): 943920000
Australia/Darwin: 943920000
Difference: 0

Original Time (Australia/Adelaide): 943920000
Australia/Brisbane: 943921800
Difference: 1800

Original Time (Australia/Adelaide): 943920000
Australia/Hobart: 943921800
Difference: 1800

Original Time (Australia/Adelaide): 943920000
Australia/Melbourne: 943921800
Difference: 1800

Original Time (Australia/Adelaide): 943920000
Australia/Perth: 943914600
Difference: -5400

Original Time (Australia/Adelaide): 943920000
Australia/Sydney: 943921800
Difference: 1800
