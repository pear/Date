--TEST--
Bug #9213: Date_Calc doesn't like including Date.php
--FILE--
<?php
/**
 * Test for: Date_Calc
 * Parts tested: DATE_CALC_FORMAT constant
 * $Id$
 */

require_once 'Date.php'; //Uh oh! I break things
require_once 'Date/Calc.php';

$calc = new Date_Calc();
print $calc->beginOfWeek(1, 6, 2006) . "\n";
print $calc->beginOfWeek(1, 6, 2006) . "\n";
print $calc->beginOfNextWeek(1, 6, 2006) . "\n";
?>
--EXPECT--
20060529
20060529
20060605
