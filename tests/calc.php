<?php

/**
 * Tests for the Date_Calc class
 *
 * Any individual tests that fail will have their name, expected result
 * and actual result printed out.  So seeing no output when executing
 * this file is a good thing.
 *
 * Can be run via CLI or a web server.
 *
 * This test senses whether it is from an installation of PEAR::Date or if
 * it's from CVS or a .tar file.  If it's an installed version, use the
 * installed version of Date_Calc.  Otherwise, use the local development
 * copy of Date_Calc.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Date and Time
 * @package    Date
 * @author     Daniel Convissor <danielc@php.net>
 * @copyright  2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/Date
 * @since      File available since Release 1.2
 */

if ('@include_path@' != '@'.'include_path'.'@') {
    ini_set('include_path', ini_get('include_path')
            . PATH_SEPARATOR . '.'
    );
} else {
    ini_set('include_path', realpath(dirname(__FILE__) . '/../')
            . PATH_SEPARATOR . '.' . PATH_SEPARATOR
            . ini_get('include_path')
    );
}

/**
 * Get the needed class
 */
require_once 'Date/Calc.php';

/**
 * Compare the test result to the expected result
 *
 * If the test fails, echo out the results.
 *
 * @param mixed  $expect     the scalar or array you expect from the test
 * @param mixed  $actual     the scalar or array results from the test
 * @param string $test_name  the name of the test
 *
 * @return void
 */
function compare($expect, $actual, $test_name) {
    if (is_array($expect)) {
        if (count(array_diff($actual, $expect))) {
            echo "$test_name failed.  Expect:\n";
            print_r($expect);
            echo "Actual:\n";
            print_r($actual);
        }
    } else {
        if ($expect != $actual) {
            echo "$test_name failed.  Expect: $expect.  Actual: $actual\n";
        }
    }
}

if (php_sapi_name() != 'cli') {
    echo "<pre>\n";
}


compare('20001122', Date_Calc::dateFormat(22, 11, 2000, '%Y%m%d'), 'dateFormat');

compare('2001', Date_Calc::defaultCentury(1), 'defaultCentury 1');
compare('1960', Date_Calc::defaultCentury(60), 'defaultCentury 2');
compare('2010', Date_Calc::defaultCentury(10), 'defaultCentury 3');

compare(2451871, Date_Calc::dateToDays(22, 11, 2000), 'dateToDays');
compare('20001122', Date_Calc::daysToDate(2451871), 'daysToDate');

compare('2000-47-3', Date_Calc::gregorianToISO(22, 11, 2000), 'gregorianToISO');
compare(2451716.56767, Date_Calc::dateSeason('SUMMERSOLSTICE', 2000), 'dateSeason');

compare(date('Ymd'), Date_Calc::dateNow(), 'dateNow');
compare(date('Y'), Date_Calc::getYear(), 'getYear');
compare(date('m'), Date_Calc::getMonth(), 'getMonth');
compare(date('d'), Date_Calc::getDay(), 'getDay');

compare(327, Date_Calc::julianDate(22, 11, 2000), 'julianDate');
compare('November', Date_Calc::getMonthFullname(11), 'getMonthFullname');
compare('Nov', Date_Calc::getMonthAbbrname(11), 'getMonthAbbrname');
compare('Saturday', Date_Calc::getWeekdayFullname(1, 1, 2005), 'getWeekdayFullname');
compare('Sat', Date_Calc::getWeekdayAbbrname(1, 1, 2005), 'getWeekdayAbbrname');
compare(11, Date_Calc::getMonthFromFullName('November'), 'getMonthFromFullName');

$exp = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
);
compare($exp, Date_Calc::getMonthNames(), 'getMonthNames');

$exp = array(
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday'
);
compare($exp, Date_Calc::getWeekDays(), 'getWeekDays');

compare(3, Date_Calc::dayOfWeek(22, 11, 2000), 'dayOfWeek');
compare(47, Date_Calc::weekOfYear(22, 11, 2000), 'weekOfYear');
compare(4, Date_Calc::quarterOfYear(22, 11, 2000), 'quarterOfYear');

compare(28, Date_Calc::daysInMonth(2, 1900), 'daysInMonth 1');
compare(29, Date_Calc::daysInMonth(2, 1996), 'daysInMonth 2');
compare(29, Date_Calc::daysInMonth(2, 2000), 'daysInMonth 3');
compare(28, Date_Calc::daysInMonth(2, 2001), 'daysInMonth 4');
compare(30, Date_Calc::daysInMonth(11, 2000), 'daysInMonth 5');

compare(5, Date_Calc::weeksInMonth(11, 2000), 'weeksInMonth');

$exp = array(
    '19000226',
    '19000227',
    '19000228',
    '19000301',
    '19000302',
    '19000303',
    '19000304',
);
compare($exp, Date_Calc::getCalendarWeek(27, 2, 1900), 'getCalendarWeek 1');

$exp = array(
    '20000228',
    '20000229',
    '20000301',
    '20000302',
    '20000303',
    '20000304',
    '20000305',
);
compare($exp, Date_Calc::getCalendarWeek(28, 2, 2000), 'getCalendarWeek 2');

$exp = array(
    '20001127',
    '20001128',
    '20001129',
    '20001130',
    '20001201',
    '20001202',
    '20001203'
);
compare($exp, Date_Calc::getCalendarWeek(27, 11, 2000), 'getCalendarWeek 3');

$exp = array(
    array(
        '20001030',
        '20001031',
        '20001101',
        '20001102',
        '20001103',
        '20001104',
    ),
    array(
        '20001105',
        '20001106',
        '20001107',
        '20001108',
        '20001109',
        '20001110',
        '20001111',
    ),
    array(
        '20001112',
        '20001113',
        '20001114',
        '20001115',
        '20001116',
        '20001117',
        '20001118',
    ),
    array(
        '20001119',
        '20001121',
        '20001122',
        '20001123',
        '20001124',
        '20001125',
        '20001126',
    ),
    array(
        '20001127',
        '20001128',
        '20001129',
        '20001130',
        '20001201',
        '20001202',
        '20001203'
    )
);
compare($exp, Date_Calc::getCalendarMonth(11, 2000), 'getCalendarMonth');

// I don't feel like dealing with this right now...
//compare('', Date_Calc::getCalendarYear(2000), 'getCalendarYear');

compare('20001121', Date_Calc::prevDay(22, 11, 2000), 'prevDay');
compare('20001123', Date_Calc::nextDay(22, 11, 2000), 'nextDay');

compare('20001117', Date_Calc::prevWeekday(19, 11, 2000), 'prevWeekday 1');
compare('20001121', Date_Calc::prevWeekday(22, 11, 2000), 'prevWeekday 2');
compare('20001123', Date_Calc::nextWeekday(22, 11, 2000), 'nextWeekday 1');
compare('20001127', Date_Calc::nextWeekday(24, 11, 2000), 'nextWeekday 2');

compare('20001121', Date_Calc::prevDayOfWeek(2, 22, 11, 2000), 'prevDayOfWeek 1');
compare('20001115', Date_Calc::prevDayOfWeek(3, 22, 11, 2000), 'prevDayOfWeek 2');
compare('20001122', Date_Calc::prevDayOfWeek(3, 22, 11, 2000, '%Y%m%d', true), 'prevDayOfWeek 3');
compare('20001122', Date_Calc::nextDayOfWeek(3, 22, 11, 2000, '%Y%m%d', true), 'nextDayOfWeek 1');
compare('20001129', Date_Calc::nextDayOfWeek(3, 22, 11, 2000), 'nextDayOfWeek 2');
compare('20001123', Date_Calc::nextDayOfWeek(4, 22, 11, 2000), 'nextDayOfWeek 3');

compare('20001121', Date_Calc::prevDayOfWeekOnOrBefore(2, 22, 11, 2000), 'prevDayOfWeekOnOrBefore 1');
compare('20001122', Date_Calc::prevDayOfWeekOnOrBefore(3, 22, 11, 2000), 'prevDayOfWeekOnOrBefore 2');
compare('20001122', Date_Calc::nextDayOfWeekOnOrAfter(3, 22, 11, 2000), 'nextDayOfWeekOnOrAfter 1');
compare('20001123', Date_Calc::nextDayOfWeekOnOrAfter(4, 22, 11, 2000), 'nextDayOfWeekOnOrAfter 2');

compare('20001120', Date_Calc::beginOfWeek(22, 11, 2000), 'beginOfWeek');
compare('20001126', Date_Calc::endOfWeek(22, 11, 2000), 'endOfWeek');

compare('20001113', Date_Calc::beginOfPrevWeek(22, 11, 2000), 'beginOfPrevWeek');
compare('20001127', Date_Calc::beginOfNextWeek(22, 11, 2000), 'beginOfNextWeek');

compare('20001101', Date_Calc::beginOfMonth(11, 2000), 'beginOfMonth');

compare('20001001', Date_Calc::beginOfPrevMonth(22, 11, 2000), 'beginOfPrevMonth');
compare('20001031', Date_Calc::endOfPrevMonth(22, 11, 2000), 'endOfPrevMonth');

compare('20001201', Date_Calc::beginOfNextMonth(22, 11, 2000), 'beginOfNextMonth');
compare('20001231', Date_Calc::endOfNextMonth(22, 11, 2000), 'endOfNextMonth');

compare('19991001', Date_Calc::beginOfMonthBySpan(-13, 22, 11, 2000), 'beginOfMonthBySpan 1');
compare('20001001', Date_Calc::beginOfMonthBySpan(-1, 22, 11, 2000), 'beginOfMonthBySpan 2');
compare('20001101', Date_Calc::beginOfMonthBySpan(0, 22, 11, 2000), 'beginOfMonthBySpan 3');
compare('20001201', Date_Calc::beginOfMonthBySpan(1, 22, 11, 2000), 'beginOfMonthBySpan 4');
compare('20011201', Date_Calc::beginOfMonthBySpan(13, 22, 11, 2000), 'beginOfMonthBySpan 5');

compare('19990101', Date_Calc::beginOfMonthBySpan(-13, 22, 2, 2000), 'beginOfMonthBySpan 6');
compare('20000101', Date_Calc::beginOfMonthBySpan(-1, 22, 2, 2000), 'beginOfMonthBySpan 7');
compare('20000201', Date_Calc::beginOfMonthBySpan(0, 22, 2, 2000), 'beginOfMonthBySpan 8');
compare('20000301', Date_Calc::beginOfMonthBySpan(1, 22, 2, 2000), 'beginOfMonthBySpan 9');
compare('20010301', Date_Calc::beginOfMonthBySpan(13, 22, 2, 2000), 'beginOfMonthBySpan 10');

compare('19991031', Date_Calc::endOfMonthBySpan(-13, 22, 11, 2000), 'endOfMonthBySpan 1');
compare('20001031', Date_Calc::endOfMonthBySpan(-1, 22, 11, 2000), 'endOfMonthBySpan 2');
compare('20001130', Date_Calc::endOfMonthBySpan(0, 22, 11, 2000), 'endOfMonthBySpan 3');
compare('20001231', Date_Calc::endOfMonthBySpan(1, 22, 11, 2000), 'endOfMonthBySpan 4');
compare('20011231', Date_Calc::endOfMonthBySpan(13, 22, 11, 2000), 'endOfMonthBySpan 5');

compare('19990131', Date_Calc::endOfMonthBySpan(-13, 22, 2, 2000), 'endOfMonthBySpan 6');
compare('20000131', Date_Calc::endOfMonthBySpan(-1, 22, 2, 2000), 'endOfMonthBySpan 7');
compare('20000229', Date_Calc::endOfMonthBySpan(0, 22, 2, 2000), 'endOfMonthBySpan 8');
compare('20000331', Date_Calc::endOfMonthBySpan(1, 22, 2, 2000), 'endOfMonthBySpan 9');
compare('20010331', Date_Calc::endOfMonthBySpan(13, 22, 2, 2000), 'endOfMonthBySpan 10');

compare(3, Date_Calc::firstOfMonthWeekday(11, 2000), 'firstOfMonthWeekday');

compare('20001122', Date_Calc::NWeekdayOfMonth(4, 3, 11, 2000), 'NWeekdayOfMonth 1');
compare('20050131', Date_Calc::NWeekdayOfMonth('last', 1, 1, 2005), 'NWeekdayOfMonth 2');
compare('20050130', Date_Calc::NWeekdayOfMonth('last', 0, 1, 2005), 'NWeekdayOfMonth 3');
compare('20050129', Date_Calc::NWeekdayOfMonth('last', 6, 1, 2005), 'NWeekdayOfMonth 4');
compare('20050128', Date_Calc::NWeekdayOfMonth('last', 5, 1, 2005), 'NWeekdayOfMonth 5');
compare('20050127', Date_Calc::NWeekdayOfMonth('last', 4, 1, 2005), 'NWeekdayOfMonth 6');
compare('20050126', Date_Calc::NWeekdayOfMonth('last', 3, 1, 2005), 'NWeekdayOfMonth 7');
compare('20050125', Date_Calc::NWeekdayOfMonth('last', 2, 1, 2005), 'NWeekdayOfMonth 8');

compare('20050331', Date_Calc::NWeekdayOfMonth('last', 4, 3, 2005), 'NWeekdayOfMonth 9');
compare('20050330', Date_Calc::NWeekdayOfMonth('last', 3, 3, 2005), 'NWeekdayOfMonth 10');
compare('20050329', Date_Calc::NWeekdayOfMonth('last', 2, 3, 2005), 'NWeekdayOfMonth 11');
compare('20050328', Date_Calc::NWeekdayOfMonth('last', 1, 3, 2005), 'NWeekdayOfMonth 12');
compare('20050327', Date_Calc::NWeekdayOfMonth('last', 0, 3, 2005), 'NWeekdayOfMonth 13');
compare('20050326', Date_Calc::NWeekdayOfMonth('last', 6, 3, 2005), 'NWeekdayOfMonth 14');
compare('20050325', Date_Calc::NWeekdayOfMonth('last', 5, 3, 2005), 'NWeekdayOfMonth 15');

compare(false, Date_Calc::isValidDate(29, 2, 1900), 'isValidDate 1');
compare(true, Date_Calc::isValidDate(29, 2, 2000), 'isValidDate 2');

compare(false, Date_Calc::isLeapYear(1900), 'isLeapYear 1');
compare(true, Date_Calc::isLeapYear(1996), 'isLeapYear 2');
compare(true, Date_Calc::isLeapYear(2000), 'isLeapYear 3');
compare(false, Date_Calc::isLeapYear(2001), 'isLeapYear 4');

compare(false, Date_Calc::isFutureDate(22, 11, 2000), 'isFutureDate 1');
compare(true, Date_Calc::isFutureDate(22, 11, date('Y') + 1), 'isFutureDate 2');

compare(false, Date_Calc::isPastDate(22, 11, date('Y') + 1), 'isPastDate 1');
compare(true, Date_Calc::isPastDate(22, 11, 2000), 'isPastDate 2');

compare(10, Date_Calc::dateDiff(22, 11, 2000, 12, 11, 2000), 'dateDiff 1');
compare(10, Date_Calc::dateDiff(12, 11, 2000, 22, 11, 2000), 'dateDiff 2');
compare(61, Date_Calc::dateDiff(22, 11, 2000, 22, 1, 2001), 'dateDiff 3');

compare(-1, Date_Calc::compareDates(12, 11, 2000, 22, 11, 2000), 'compareDates 1');
compare(0, Date_Calc::compareDates(22, 11, 2000, 22, 11, 2000), 'compareDates 2');
compare(1, Date_Calc::compareDates(22, 11, 2000, 12, 11, 2000), 'compareDates 3');
