--TEST--
Bug #9801: Date::compare() modify params on PHP5
--FILE--
<?php
/**
 * Test for: Date class
 * Parts tested: Date::compare()
 */

require_once 'Date.php';

// $GLOBALS['_DATE_TIMEZONE_DEFAULT'] = 'Canada/Eastern';

$d1 = new Date();
$d2 = new Date();
$d1->setTZbyID('Canada/Eastern');
$d2->setTZbyID('Canada/Eastern');

echo 'Timezone (before): ' . $d1->tz->getId() . "\n";

Date::compare($d1, $d2);

echo 'Timezone (after): ' . $d1->tz->getId() . "\n";
?>
--EXPECT--
Timezone (before): Canada/Eastern
Timezone (after): Canada/Eastern
