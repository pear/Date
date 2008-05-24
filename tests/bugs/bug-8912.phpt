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

$d = new Date("2007-08-31 11:59:59Z");
$hn_time = $d->getTime();
foreach ($states as $state) {
    $new_date = new Date($hn_time);
    print 'Original Time (Australia/Adelaide): ' . $new_date->formatLikeSQL("TZH:TZM") . " " . $new_date->getTime() . "\n";
    $timezone = new Date_TimeZone($state);
    $new_date->convertTZ($timezone);
    print $state . ': ' . ($hn_localtime = $new_date->getTime()) . "\n";
    print 'Difference: ' . ($hn_localtime - $hn_time) . "\n";
    $new_date->setTZ($originalTimezone);
    print $state . ': ' . ($hn_localtime = $new_date->getTime()) . "\n";
    print 'Difference: ' . ($hn_localtime - $hn_time) . "\n";
    print "\n";
}
?>
--EXPECT--
Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Adelaide: 1188561599
Difference: 0
Australia/Adelaide: 1188561599
Difference: 0

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Canberra: 1188561599
Difference: 0
Australia/Canberra: 1188563399
Difference: 1800

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Darwin: 1188561599
Difference: 0
Australia/Darwin: 1188561599
Difference: 0

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Brisbane: 1188561599
Difference: 0
Australia/Brisbane: 1188563399
Difference: 1800

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Hobart: 1188561599
Difference: 0
Australia/Hobart: 1188563399
Difference: 1800

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Melbourne: 1188561599
Difference: 0
Australia/Melbourne: 1188563399
Difference: 1800

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Perth: 1188561599
Difference: 0
Australia/Perth: 1188556199
Difference: -5400

Original Time (Australia/Adelaide): 01:00 1188561599
Australia/Sydney: 1188561599
Difference: 0
Australia/Sydney: 1188563399
Difference: 1800

