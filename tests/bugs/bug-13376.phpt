--TEST--
Bug #13376 setFromDateDiff change source dates
--FILE--
<?php

require_once 'Date.php';

$startDate = new Date( "2008-02-12" );
$endDate = new Date( "2008-03-01" );
print "Days: " . $startDate->format( "%Y-%m-%d" ) . " to " .
$endDate->format( "%Y-%m-%d" ) . "\n";
$diff = new Date_Span();
$diff->setFromDateDiff( $startDate, $endDate );
print "Days: " . $startDate->format( "%Y-%m-%d" ) . " to " .
$endDate->format( "%Y-%m-%d" ) . "\n";

?>
--EXPECT--
Days: 2008-02-12 to 2008-03-01
Days: 2008-02-12 to 2008-03-01
