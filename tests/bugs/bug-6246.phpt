--TEST--
Bug #6246: Date::inDaylightTime() crashes Apache 2.0.55 with status 3221225477
--FILE--
<?php
/**
 * Test for: Date::inDaylightTime()
 * Parts tested: Date_TimeZone::inDaylightTime()
 */

require_once 'Date.php';

/**
 * In 2007, daylight saving time (DST) was extended in the United States.
 * DST started on March 11, 2007, which was three weeks earlier than in
 * the past, and it ended on November 4, 2007, one week later than in years
 * past.  This results in a new DST period that is four weeks longer than in
 * previous years.
 *
 * N.B. the time at which US Summer time starts is 2.00 'Wall-Clock' Time,
 * that is, it goes forward at 2.00 in standard time, and goes back at
 * 2.00 in Summer time.  This is unlike Europe which all switches together
 * at 1.00 GMT in both directions, so that in London, for example, the
 * clocks go back at 2.00 BST (although at that exact instant, the time
 * actually becomes 1.00 GMT).
 *
 * All countries in Europe except Iceland observe DST and change on the same
 * date and time, starting on the last Sunday in March and ending on the last
 * Sunday in October. Before 1996, DST ended on the last Sunday in September
 * in most European countries; on the British Isles though, DST then ended on
 * the fourth (which some years isn't the last) Sunday in October. In the
 * West European (UTC), Central European (CET, UTC+1), and East European
 * (UTC+2) time zones the change is simultaneous: on both dates the clocks
 * are changed everywhere at 01:00 UTC, i.e. from local times of
 * 01:00/02:00/03:00 to 02:00/03:00/04:00 in March, and vice versa in October.
 */

$dates_us = array(
    '2007-03-11T01:59:59',         // standard time
    '2007-03-11T01:59:59.999999',  // standard time
    '2007-03-11T03:00:00',         // Summer time
    '2007-11-04T00:59:59',         // Summer time
    '2007-11-04T01:00:00',         // ambiguous - could be either (standard time assumed)
    '2007-11-04T01:59:59',         // ambiguous - could be either (standard time assumed)
    '2007-11-04T02:00:00',         // standard time
);

$dates_eu = array(
    '2007-03-25T00:59:59',         // standard time
    '2007-03-25T00:59:59.999999',  // standard time
    '2007-03-25T02:00:00',         // Summer time
    '2007-10-28T00:59:59',         // Summer time
    '2007-10-28T01:00:00',         // ambiguous - could be either (standard time assumed)
    '2007-10-28T01:59:59',         // ambiguous - could be either (standard time assumed)
    '2007-11-28T02:00:00',         // standard time
);

// Date_TimeZone does not yet have historical data, and so 2006
// is treated as in the 2007 rules, and these dates will not
// behave correctly (historically).
//
//$dates_us = array(
//    '2006-04-02T02:00:00',  // begin of in daylight saving time.
//    '2006-10-29T01:59:59',  // end of in daylight saving time.
//    '2006-10-30T02:00:00',  // not in daylight saving time.
//);

$date = new Date;
$date->setTZ($hs_tz = 'America/Chicago');    // N.B. the old name was 'US/Central' (this still works)
foreach ($dates_us as $d) {
    $date->setDate($d);
    printf(
        '%s is in %s daylight saving time? %s' . "\n",
        $date->getDate(),
        $hs_tz,
        ($date->inDaylightTime() ? 'true' : 'false')
    );
}
$date = new Date;
$date->setTZ($hs_tz = 'Europe/London');    // N.B. the old name was 'US/Central' (this still works)
foreach ($dates_eu as $d) {
    $date->setDate($d);
    printf(
        '%s is in %s Summer time? %s' . "\n",
        $date->getDate(),
        $hs_tz,
        ($date->inDaylightTime() ? 'true' : 'false')
    );
}
?>
--EXPECT--
2007-03-11 01:59:59 is in America/Chicago daylight saving time? false
2007-03-11 01:59:59 is in America/Chicago daylight saving time? false
2007-03-11 03:00:00 is in America/Chicago daylight saving time? true
2007-11-04 00:59:59 is in America/Chicago daylight saving time? true
2007-11-04 01:00:00 is in America/Chicago daylight saving time? false
2007-11-04 01:59:59 is in America/Chicago daylight saving time? false
2007-11-04 02:00:00 is in America/Chicago daylight saving time? false
2007-03-25 00:59:59 is in Europe/London Summer time? false
2007-03-25 00:59:59 is in Europe/London Summer time? false
2007-03-25 02:00:00 is in Europe/London Summer time? true
2007-10-28 00:59:59 is in Europe/London Summer time? true
2007-10-28 01:00:00 is in Europe/London Summer time? false
2007-10-28 01:59:59 is in Europe/London Summer time? false
2007-11-28 02:00:00 is in Europe/London Summer time? false
