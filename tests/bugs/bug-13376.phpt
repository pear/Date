--TEST--
Bug #13376 setFromDateDiff change the source of Date objects
--FILE--
<?php
/*
 * Test for: Date_Span
 * Part tested: Date_Span::setFromDateDiff()
 *
 * This test should be tested on both PHP4 and PHP5 to see the different.
 *
 * $Id$
 */

require_once 'Date.php';

$startDate = new Date('2008-02-29 00:00:00');
$endDate = new Date('2008-03-01 23:30:10');
print 'Days: ' . $startDate->format('%Y-%m-%d') . ' to ' . $endDate->format( '%Y-%m-%d') . "\n";

$diff = new Date_Span();
$diff->setFromDateDiff($startDate, $endDate);

// still same instances?
print 'Days: ' . $startDate->format('%Y-%m-%d') . ' to ' . $endDate->format('%Y-%m-%d') . "\n";

// what about diff?
print 'Diff: ' . $diff->format('%D day %H hours %M minutes %S seconds') . "\n";
?>
--EXPECT--
Days: 2008-02-29 to 2008-03-01
Days: 2008-02-29 to 2008-03-01
Diff: 1 day 23 hours 30 minutes 10 seconds
