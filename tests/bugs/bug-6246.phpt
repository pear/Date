<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */
// CVS: $Id$
?>
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
 * The schedule for 2006 in the United States was that DST began on
 * the first Sunday in April (April 2, 2006), and changed back to standard
 * time on the last Sunday in October (October 29, 2006). The time is
 * adjusted at 2 AM local time.
 * See http://en.wikipedia.org/wiki/Daylight_saving_time_around_the_world
 * for more details.
 */
$dates = array(
    '2006-04-02T02:00:00',  // begin of in daylight saving time.
    '2006-10-29T01:59:00',  // end of in daylight saving time.
    '2006-10-30T02:00:00',  // not in daylight saving time.
);

$date = new Date;
$date->setTZ('US/Central');
foreach ($dates as $d) {
    $date->setDate($d);
    printf(
        '%s is in daylight saving time? %s' . "\n",
        $date->getDate(),
        ($date->inDaylightTime($date) ? 'true' : 'false')
    );
}
?>
--EXPECT--
2006-04-02 02:00:00 is in daylight saving time? true
2006-10-29 01:59:00 is in daylight saving time? true
2006-10-30 02:00:00 is in daylight saving time? false
<?php
/*
 * Local variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */
?>