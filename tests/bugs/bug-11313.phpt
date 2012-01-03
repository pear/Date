--TEST--
Bug #11313 DST time change not handled correctly
--FILE--
<?php

date_default_timezone_set('Europe/Moscow');
//include_once('debug.php');
require_once 'Date.php';

$date = new Date('2007-03-25 03:00:04');
$tmp = new Date($date);

$PRINT_FORMAT = "%Y-%m-%d %H:%M:%S %Z%O";

//var_dump($date->tz, 'TimeZone');
printf("% 50s: %s\n", "Actual date", $date->format($PRINT_FORMAT));

$tmp->copy($date);
$tmp->subtractSpan(new Date_Span('0:00:00:05'));
printf("% 50s: %s\n", 'Subtracting 5 seconds',
$tmp->format($PRINT_FORMAT));

$tmp->copy($date);
$tmp->subtractSpan(new Date_Span('0:00:20:00'));
printf("% 50s: %s\n", "Subtracting 20 minutes",
$tmp->format($PRINT_FORMAT));

$tmp->copy($date);
$tmp->subtractSpan(new Date_Span('0:02:30:00'));
printf("% 50s: %s\n", "Subtracting 2 hours 30 minutes",
$tmp->format($PRINT_FORMAT));

$tmp->copy($date);
$tmp->subtractSpan(new Date_Span('0:10:00:00'));
printf("% 50s: %s\n", "Subtracting 10 hours",
$tmp->format($PRINT_FORMAT));

$tmp->copy($date);
$tmp->subtractSpan(new Date_Span('3:00:00:00'));
printf("% 50s: %s\n", "Subtracting 3 days",
$tmp->format($PRINT_FORMAT));

?>
--EXPECT--
                                       Actual date: 2007-03-25 03:00:04 MSD+04:00
                             Subtracting 5 seconds: 2007-03-25 01:59:59 MSK+03:00
                            Subtracting 20 minutes: 2007-03-25 01:40:04 MSK+03:00
                    Subtracting 2 hours 30 minutes: 2007-03-24 23:30:04 MSK+03:00
                              Subtracting 10 hours: 2007-03-24 16:00:04 MSK+03:00
                                Subtracting 3 days: 2007-03-22 02:00:04 MSK+03:00
