--TEST--
Bug #8518: Date::copy() doest not copy the parts of a second.
--FILE--
<?php
/**
 * Test for: Date
 * Parts tested: Date::copy()
 */

require_once 'Date.php';

$date = new Date('2006-11-08 10:19:25.9942');
$date->setTZbyID("UTC");

$tmp = new Date;
$tmp->copy($date);
print_r($tmp);
?>
--EXPECT--
Date Object
(
    [year] => 2006
    [month] => 11
    [day] => 8
    [hour] => 10
    [minute] => 19
    [second] => 25
    [partsecond] => 0.9942
    [tz] => Date_TimeZone Object
        (
            [id] => UTC
            [offset] => 0
            [shortname] => UTC
            [dstshortname] => 
            [longname] => Coordinated Universal Time
            [dstlongname] => 
            [hasdst] => 
            [on_summertimeoffset] => 
            [on_summertimestartmonth] => 
            [os_summertimestartday] => 
            [on_summertimestarttime] => 
            [on_summertimeendmonth] => 
            [os_summertimeendday] => 
            [on_summertimeendtime] => 
        )

    [getWeekdayAbbrnameLength] => 3
)