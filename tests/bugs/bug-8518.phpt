<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */
// CVS: $Id$
?>
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

$tmp = new Date;
$tmp->copy($date);
print_r($tmp);
?>
--EXPECT--
Date Object
(
    [year] => 2006
    [month] => 11
    [day] => 08
    [hour] => 10
    [minute] => 19
    [second] => 25
    [partsecond] => 0.9942
    [tz] => Date_TimeZone Object
        (
            [id] => UTC
            [longname] => Coordinated Universal Time
            [shortname] => UTC
            [hasdst] => 
            [dstlongname] => Coordinated Universal Time
            [dstshortname] => UTC
            [offset] => 0
            [default] => 
        )

    [getWeekdayAbbrnameLength] => 3
)
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