--TEST--
Bug #967: Date_TimeZone uses a bad global variable
--FILE--
<?php
/**
 * Test for: Date_TimeZone
 * Parts tested: Date_TimeZone::setDefault() and Date_TimeZone::getDefault()
 */

require_once 'Date/TimeZone.php';

// Sets default timezone via a global variable.
$_DATE_TIMEZONE_DEFAULT = 'Pacific/Chatham';
$tz = Date_TimeZone::getDefault();
echo 'Date_TimeZone::$id = ' . $tz->id . "\n";

// Sets default timezone via Date_TimeZone::setDefault().
Date_TimeZone::setDefault('CST');
$default = 'EST';
$tz = Date_TimeZone::getDefault();
echo 'Date_TimeZone::$id = ' . $tz->id . "\n";
echo '$GLOBALS[\'_DATE_TIMEZONE_DEFAULT\'] = ' . $_DATE_TIMEZONE_DEFAULT . "\n";
?>
--EXPECT--
Date_TimeZone::$id = Pacific/Chatham
Date_TimeZone::$id = CST
$GLOBALS['_DATE_TIMEZONE_DEFAULT'] = CST
