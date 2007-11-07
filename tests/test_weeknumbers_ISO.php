<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Tests for the Date_Calc::isoWeekDate() function
 *
 * Any individual tests that fail will have their name, expected result
 * and actual result printed out.  So seeing no output when executing
 * this file is a good thing.
 *
 * Can be run via CLI or a web server.
 *
 * This test senses whether it is from an installation of PEAR::Date or if
 * it's from CVS or a .tar file.  If it's an installed version, use the
 * installed version of Date.  Otherwise, use the local development
 * copy of Date.
 *
 * PHP versions 4 and 5
 *
 * LICENSE:
 *
 * Copyright (c) 2007 C.A. Woodcock <c01234@netcomuk.co.uk>
 * All rights reserved.
 *
 * This source file is subject to the New BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to pear-dev@lists.php.net so we can send you a copy immediately.
 *
 * @category   Date and Time
 * @package    Date
 * @author     C.A. Woodcock <c01234@netcomuk.co.uk>
 * @copyright  Copyright (c) 2007 C.A. Woodcock <c01234@netcomuk.co.uk>
 * @license    http://www.opensource.org/licenses/bsd-license.php
 *             BSD License
 * @link       http://pear.php.net/package/Date
 * @since      [next version]
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
require_once 'Date.php';

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
        if ($expect !== $actual) {
            echo "'$test_name' failed.  Expect: '$expect'  Actual: '$actual'\n";
        }
    }
}

if (php_sapi_name() != 'cli') {
    echo "<pre>\n";
}


$date = new Date("1989-12-24 00:00:00Z");

// Sunday, 24th December 1989
compare('1989 51 7', $date->format2('IYYY IW ID'), 'IW (1990 -8)');

$date->addDays(1);

// Monday, 25th December 1989
compare('1989 52 1', $date->format2('IYYY IW ID'), 'IW (1990 -7)');

$date->addDays(1);

// Tuesday, 26th December 1989
compare('1989 52 2', $date->format2('IYYY IW ID'), 'IW (1990 -6)');

$date->addDays(1);

// Wednesday, 27th December 1989
compare('1989 52 3', $date->format2('IYYY IW ID'), 'IW (1990 -5)');

$date->addDays(1);

// Thursday, 28th December 1989
compare('1989 52 4', $date->format2('IYYY IW ID'), 'IW (1990 -4)');

$date->addDays(1);

// Friday, 29th December 1989
compare('1989 52 5', $date->format2('IYYY IW ID'), 'IW (1990 -3)');

$date->addDays(1);

// Saturday, 30th December 1989
compare('1989 52 6', $date->format2('IYYY IW ID'), 'IW (1990 -2)');

$date->addDays(1);

// Sunday, 31st December 1989
compare('1989 52 7', $date->format2('IYYY IW ID'), 'IW (1990 -1)');

$date->addDays(1);

// Monday, 1st January 1990
compare('1990 01 1', $date->format2('IYYY IW ID'), 'IW (1990 0)');

$date->addDays(1);

// Tuesday, 2nd January 1990
compare('1990 01 2', $date->format2('IYYY IW ID'), 'IW (1990 1)');

$date->addDays(1);

// Wednesday, 3rd January 1990
compare('1990 01 3', $date->format2('IYYY IW ID'), 'IW (1990 2)');

$date->addDays(1);

// Thursday, 4th January 1990
compare('1990 01 4', $date->format2('IYYY IW ID'), 'IW (1990 3)');

$date->addDays(1);

// Friday, 5th January 1990
compare('1990 01 5', $date->format2('IYYY IW ID'), 'IW (1990 4)');

$date->addDays(1);

// Saturday, 6th January 1990
compare('1990 01 6', $date->format2('IYYY IW ID'), 'IW (1990 5)');

$date->addDays(1);

// Sunday, 7th January 1990
compare('1990 01 7', $date->format2('IYYY IW ID'), 'IW (1990 6)');

$date->addDays(1);

// Monday, 8th January 1990
compare('1990 02 1', $date->format2('IYYY IW ID'), 'IW (1990 7)');

$date->setDayMonthYear(24, 12, 1990);

// Monday, 24th December 1990
compare('1990 52 1', $date->format2('IYYY IW ID'), 'IW (1991 -8)');

$date->addDays(1);

// Tuesday, 25th December 1990
compare('1990 52 2', $date->format2('IYYY IW ID'), 'IW (1991 -7)');

$date->addDays(1);

// Wednesday, 26th December 1990
compare('1990 52 3', $date->format2('IYYY IW ID'), 'IW (1991 -6)');

$date->addDays(1);

// Thursday, 27th December 1990
compare('1990 52 4', $date->format2('IYYY IW ID'), 'IW (1991 -5)');

$date->addDays(1);

// Friday, 28th December 1990
compare('1990 52 5', $date->format2('IYYY IW ID'), 'IW (1991 -4)');

$date->addDays(1);

// Saturday, 29th December 1990
compare('1990 52 6', $date->format2('IYYY IW ID'), 'IW (1991 -3)');

$date->addDays(1);

// Sunday, 30th December 1990
compare('1990 52 7', $date->format2('IYYY IW ID'), 'IW (1991 -2)');

$date->addDays(1);

// Monday, 31st December 1990
compare('1991 01 1', $date->format2('IYYY IW ID'), 'IW (1991 -1)');

$date->addDays(1);

// Tuesday, 1st January 1991
compare('1991 01 2', $date->format2('IYYY IW ID'), 'IW (1991 0)');

$date->addDays(1);

// Wednesday, 2nd January 1991
compare('1991 01 3', $date->format2('IYYY IW ID'), 'IW (1991 1)');

$date->addDays(1);

// Thursday, 3rd January 1991
compare('1991 01 4', $date->format2('IYYY IW ID'), 'IW (1991 2)');

$date->addDays(1);

// Friday, 4th January 1991
compare('1991 01 5', $date->format2('IYYY IW ID'), 'IW (1991 3)');

$date->addDays(1);

// Saturday, 5th January 1991
compare('1991 01 6', $date->format2('IYYY IW ID'), 'IW (1991 4)');

$date->addDays(1);

// Sunday, 6th January 1991
compare('1991 01 7', $date->format2('IYYY IW ID'), 'IW (1991 5)');

$date->addDays(1);

// Monday, 7th January 1991
compare('1991 02 1', $date->format2('IYYY IW ID'), 'IW (1991 6)');

$date->addDays(1);

// Tuesday, 8th January 1991
compare('1991 02 2', $date->format2('IYYY IW ID'), 'IW (1991 7)');

$date->setDayMonthYear(24, 12, 1991);

// Tuesday, 24th December 1991
compare('1991 52 2', $date->format2('IYYY IW ID'), 'IW (1992 -8)');

$date->addDays(1);

// Wednesday, 25th December 1991
compare('1991 52 3', $date->format2('IYYY IW ID'), 'IW (1992 -7)');

$date->addDays(1);

// Thursday, 26th December 1991
compare('1991 52 4', $date->format2('IYYY IW ID'), 'IW (1992 -6)');

$date->addDays(1);

// Friday, 27th December 1991
compare('1991 52 5', $date->format2('IYYY IW ID'), 'IW (1992 -5)');

$date->addDays(1);

// Saturday, 28th December 1991
compare('1991 52 6', $date->format2('IYYY IW ID'), 'IW (1992 -4)');

$date->addDays(1);

// Sunday, 29th December 1991
compare('1991 52 7', $date->format2('IYYY IW ID'), 'IW (1992 -3)');

$date->addDays(1);

// Monday, 30th December 1991
compare('1992 01 1', $date->format2('IYYY IW ID'), 'IW (1992 -2)');

$date->addDays(1);

// Tuesday, 31st December 1991
compare('1992 01 2', $date->format2('IYYY IW ID'), 'IW (1992 -1)');

$date->addDays(1);

// Wednesday, 1st January 1992
compare('1992 01 3', $date->format2('IYYY IW ID'), 'IW (1992 0)');

$date->addDays(1);

// Thursday, 2nd January 1992
compare('1992 01 4', $date->format2('IYYY IW ID'), 'IW (1992 1)');

$date->addDays(1);

// Friday, 3rd January 1992
compare('1992 01 5', $date->format2('IYYY IW ID'), 'IW (1992 2)');

$date->addDays(1);

// Saturday, 4th January 1992
compare('1992 01 6', $date->format2('IYYY IW ID'), 'IW (1992 3)');

$date->addDays(1);

// Sunday, 5th January 1992
compare('1992 01 7', $date->format2('IYYY IW ID'), 'IW (1992 4)');

$date->addDays(1);

// Monday, 6th January 1992
compare('1992 02 1', $date->format2('IYYY IW ID'), 'IW (1992 5)');

$date->addDays(1);

// Tuesday, 7th January 1992
compare('1992 02 2', $date->format2('IYYY IW ID'), 'IW (1992 6)');

$date->addDays(1);

// Wednesday, 8th January 1992
compare('1992 02 3', $date->format2('IYYY IW ID'), 'IW (1992 7)');

$date->setDayMonthYear(24, 12, 1992);

// Thursday, 24th December 1992
compare('1992 52 4', $date->format2('IYYY IW ID'), 'IW (1993 -8)');

$date->addDays(1);

// Friday, 25th December 1992
compare('1992 52 5', $date->format2('IYYY IW ID'), 'IW (1993 -7)');

$date->addDays(1);

// Saturday, 26th December 1992
compare('1992 52 6', $date->format2('IYYY IW ID'), 'IW (1993 -6)');

$date->addDays(1);

// Sunday, 27th December 1992
compare('1992 52 7', $date->format2('IYYY IW ID'), 'IW (1993 -5)');

$date->addDays(1);

// Monday, 28th December 1992
compare('1992 53 1', $date->format2('IYYY IW ID'), 'IW (1993 -4)');

$date->addDays(1);

// Tuesday, 29th December 1992
compare('1992 53 2', $date->format2('IYYY IW ID'), 'IW (1993 -3)');

$date->addDays(1);

// Wednesday, 30th December 1992
compare('1992 53 3', $date->format2('IYYY IW ID'), 'IW (1993 -2)');

$date->addDays(1);

// Thursday, 31st December 1992
compare('1992 53 4', $date->format2('IYYY IW ID'), 'IW (1993 -1)');

$date->addDays(1);

// Friday, 1st January 1993
compare('1992 53 5', $date->format2('IYYY IW ID'), 'IW (1993 0)');

$date->addDays(1);

// Saturday, 2nd January 1993
compare('1992 53 6', $date->format2('IYYY IW ID'), 'IW (1993 1)');

$date->addDays(1);

// Sunday, 3rd January 1993
compare('1992 53 7', $date->format2('IYYY IW ID'), 'IW (1993 2)');

$date->addDays(1);

// Monday, 4th January 1993
compare('1993 01 1', $date->format2('IYYY IW ID'), 'IW (1993 3)');

$date->addDays(1);

// Tuesday, 5th January 1993
compare('1993 01 2', $date->format2('IYYY IW ID'), 'IW (1993 4)');

$date->addDays(1);

// Wednesday, 6th January 1993
compare('1993 01 3', $date->format2('IYYY IW ID'), 'IW (1993 5)');

$date->addDays(1);

// Thursday, 7th January 1993
compare('1993 01 4', $date->format2('IYYY IW ID'), 'IW (1993 6)');

$date->addDays(1);

// Friday, 8th January 1993
compare('1993 01 5', $date->format2('IYYY IW ID'), 'IW (1993 7)');

$date->setDayMonthYear(24, 12, 1993);

// Friday, 24th December 1993
compare('1993 51 5', $date->format2('IYYY IW ID'), 'IW (1994 -8)');

$date->addDays(1);

// Saturday, 25th December 1993
compare('1993 51 6', $date->format2('IYYY IW ID'), 'IW (1994 -7)');

$date->addDays(1);

// Sunday, 26th December 1993
compare('1993 51 7', $date->format2('IYYY IW ID'), 'IW (1994 -6)');

$date->addDays(1);

// Monday, 27th December 1993
compare('1993 52 1', $date->format2('IYYY IW ID'), 'IW (1994 -5)');

$date->addDays(1);

// Tuesday, 28th December 1993
compare('1993 52 2', $date->format2('IYYY IW ID'), 'IW (1994 -4)');

$date->addDays(1);

// Wednesday, 29th December 1993
compare('1993 52 3', $date->format2('IYYY IW ID'), 'IW (1994 -3)');

$date->addDays(1);

// Thursday, 30th December 1993
compare('1993 52 4', $date->format2('IYYY IW ID'), 'IW (1994 -2)');

$date->addDays(1);

// Friday, 31st December 1993
compare('1993 52 5', $date->format2('IYYY IW ID'), 'IW (1994 -1)');

$date->addDays(1);

// Saturday, 1st January 1994
compare('1993 52 6', $date->format2('IYYY IW ID'), 'IW (1994 0)');

$date->addDays(1);

// Sunday, 2nd January 1994
compare('1993 52 7', $date->format2('IYYY IW ID'), 'IW (1994 1)');

$date->addDays(1);

// Monday, 3rd January 1994
compare('1994 01 1', $date->format2('IYYY IW ID'), 'IW (1994 2)');

$date->addDays(1);

// Tuesday, 4th January 1994
compare('1994 01 2', $date->format2('IYYY IW ID'), 'IW (1994 3)');

$date->addDays(1);

// Wednesday, 5th January 1994
compare('1994 01 3', $date->format2('IYYY IW ID'), 'IW (1994 4)');

$date->addDays(1);

// Thursday, 6th January 1994
compare('1994 01 4', $date->format2('IYYY IW ID'), 'IW (1994 5)');

$date->addDays(1);

// Friday, 7th January 1994
compare('1994 01 5', $date->format2('IYYY IW ID'), 'IW (1994 6)');

$date->addDays(1);

// Saturday, 8th January 1994
compare('1994 01 6', $date->format2('IYYY IW ID'), 'IW (1994 7)');

$date->setDayMonthYear(24, 12, 1994);

// Saturday, 24th December 1994
compare('1994 51 6', $date->format2('IYYY IW ID'), 'IW (1995 -8)');

$date->addDays(1);

// Sunday, 25th December 1994
compare('1994 51 7', $date->format2('IYYY IW ID'), 'IW (1995 -7)');

$date->addDays(1);

// Monday, 26th December 1994
compare('1994 52 1', $date->format2('IYYY IW ID'), 'IW (1995 -6)');

$date->addDays(1);

// Tuesday, 27th December 1994
compare('1994 52 2', $date->format2('IYYY IW ID'), 'IW (1995 -5)');

$date->addDays(1);

// Wednesday, 28th December 1994
compare('1994 52 3', $date->format2('IYYY IW ID'), 'IW (1995 -4)');

$date->addDays(1);

// Thursday, 29th December 1994
compare('1994 52 4', $date->format2('IYYY IW ID'), 'IW (1995 -3)');

$date->addDays(1);

// Friday, 30th December 1994
compare('1994 52 5', $date->format2('IYYY IW ID'), 'IW (1995 -2)');

$date->addDays(1);

// Saturday, 31st December 1994
compare('1994 52 6', $date->format2('IYYY IW ID'), 'IW (1995 -1)');

$date->addDays(1);

// Sunday, 1st January 1995
compare('1994 52 7', $date->format2('IYYY IW ID'), 'IW (1995 0)');

$date->addDays(1);

// Monday, 2nd January 1995
compare('1995 01 1', $date->format2('IYYY IW ID'), 'IW (1995 1)');

$date->addDays(1);

// Tuesday, 3rd January 1995
compare('1995 01 2', $date->format2('IYYY IW ID'), 'IW (1995 2)');

$date->addDays(1);

// Wednesday, 4th January 1995
compare('1995 01 3', $date->format2('IYYY IW ID'), 'IW (1995 3)');

$date->addDays(1);

// Thursday, 5th January 1995
compare('1995 01 4', $date->format2('IYYY IW ID'), 'IW (1995 4)');

$date->addDays(1);

// Friday, 6th January 1995
compare('1995 01 5', $date->format2('IYYY IW ID'), 'IW (1995 5)');

$date->addDays(1);

// Saturday, 7th January 1995
compare('1995 01 6', $date->format2('IYYY IW ID'), 'IW (1995 6)');

$date->addDays(1);

// Sunday, 8th January 1995
compare('1995 01 7', $date->format2('IYYY IW ID'), 'IW (1995 7)');

$date->setDayMonthYear(24, 12, 1995);

// Sunday, 24th December 1995
compare('1995 51 7', $date->format2('IYYY IW ID'), 'IW (1996 -8)');

$date->addDays(1);

// Monday, 25th December 1995
compare('1995 52 1', $date->format2('IYYY IW ID'), 'IW (1996 -7)');

$date->addDays(1);

// Tuesday, 26th December 1995
compare('1995 52 2', $date->format2('IYYY IW ID'), 'IW (1996 -6)');

$date->addDays(1);

// Wednesday, 27th December 1995
compare('1995 52 3', $date->format2('IYYY IW ID'), 'IW (1996 -5)');

$date->addDays(1);

// Thursday, 28th December 1995
compare('1995 52 4', $date->format2('IYYY IW ID'), 'IW (1996 -4)');

$date->addDays(1);

// Friday, 29th December 1995
compare('1995 52 5', $date->format2('IYYY IW ID'), 'IW (1996 -3)');

$date->addDays(1);

// Saturday, 30th December 1995
compare('1995 52 6', $date->format2('IYYY IW ID'), 'IW (1996 -2)');

$date->addDays(1);

// Sunday, 31st December 1995
compare('1995 52 7', $date->format2('IYYY IW ID'), 'IW (1996 -1)');

$date->addDays(1);

// Monday, 1st January 1996
compare('1996 01 1', $date->format2('IYYY IW ID'), 'IW (1996 0)');

$date->addDays(1);

// Tuesday, 2nd January 1996
compare('1996 01 2', $date->format2('IYYY IW ID'), 'IW (1996 1)');

$date->addDays(1);

// Wednesday, 3rd January 1996
compare('1996 01 3', $date->format2('IYYY IW ID'), 'IW (1996 2)');

$date->addDays(1);

// Thursday, 4th January 1996
compare('1996 01 4', $date->format2('IYYY IW ID'), 'IW (1996 3)');

$date->addDays(1);

// Friday, 5th January 1996
compare('1996 01 5', $date->format2('IYYY IW ID'), 'IW (1996 4)');

$date->addDays(1);

// Saturday, 6th January 1996
compare('1996 01 6', $date->format2('IYYY IW ID'), 'IW (1996 5)');

$date->addDays(1);

// Sunday, 7th January 1996
compare('1996 01 7', $date->format2('IYYY IW ID'), 'IW (1996 6)');

$date->addDays(1);

// Monday, 8th January 1996
compare('1996 02 1', $date->format2('IYYY IW ID'), 'IW (1996 7)');

$date->setDayMonthYear(24, 12, 1996);

// Tuesday, 24th December 1996
compare('1996 52 2', $date->format2('IYYY IW ID'), 'IW (1997 -8)');

$date->addDays(1);

// Wednesday, 25th December 1996
compare('1996 52 3', $date->format2('IYYY IW ID'), 'IW (1997 -7)');

$date->addDays(1);

// Thursday, 26th December 1996
compare('1996 52 4', $date->format2('IYYY IW ID'), 'IW (1997 -6)');

$date->addDays(1);

// Friday, 27th December 1996
compare('1996 52 5', $date->format2('IYYY IW ID'), 'IW (1997 -5)');

$date->addDays(1);

// Saturday, 28th December 1996
compare('1996 52 6', $date->format2('IYYY IW ID'), 'IW (1997 -4)');

$date->addDays(1);

// Sunday, 29th December 1996
compare('1996 52 7', $date->format2('IYYY IW ID'), 'IW (1997 -3)');

$date->addDays(1);

// Monday, 30th December 1996
compare('1997 01 1', $date->format2('IYYY IW ID'), 'IW (1997 -2)');

$date->addDays(1);

// Tuesday, 31st December 1996
compare('1997 01 2', $date->format2('IYYY IW ID'), 'IW (1997 -1)');

$date->addDays(1);

// Wednesday, 1st January 1997
compare('1997 01 3', $date->format2('IYYY IW ID'), 'IW (1997 0)');

$date->addDays(1);

// Thursday, 2nd January 1997
compare('1997 01 4', $date->format2('IYYY IW ID'), 'IW (1997 1)');

$date->addDays(1);

// Friday, 3rd January 1997
compare('1997 01 5', $date->format2('IYYY IW ID'), 'IW (1997 2)');

$date->addDays(1);

// Saturday, 4th January 1997
compare('1997 01 6', $date->format2('IYYY IW ID'), 'IW (1997 3)');

$date->addDays(1);

// Sunday, 5th January 1997
compare('1997 01 7', $date->format2('IYYY IW ID'), 'IW (1997 4)');

$date->addDays(1);

// Monday, 6th January 1997
compare('1997 02 1', $date->format2('IYYY IW ID'), 'IW (1997 5)');

$date->addDays(1);

// Tuesday, 7th January 1997
compare('1997 02 2', $date->format2('IYYY IW ID'), 'IW (1997 6)');

$date->addDays(1);

// Wednesday, 8th January 1997
compare('1997 02 3', $date->format2('IYYY IW ID'), 'IW (1997 7)');

$date->setDayMonthYear(24, 12, 1997);

// Wednesday, 24th December 1997
compare('1997 52 3', $date->format2('IYYY IW ID'), 'IW (1998 -8)');

$date->addDays(1);

// Thursday, 25th December 1997
compare('1997 52 4', $date->format2('IYYY IW ID'), 'IW (1998 -7)');

$date->addDays(1);

// Friday, 26th December 1997
compare('1997 52 5', $date->format2('IYYY IW ID'), 'IW (1998 -6)');

$date->addDays(1);

// Saturday, 27th December 1997
compare('1997 52 6', $date->format2('IYYY IW ID'), 'IW (1998 -5)');

$date->addDays(1);

// Sunday, 28th December 1997
compare('1997 52 7', $date->format2('IYYY IW ID'), 'IW (1998 -4)');

$date->addDays(1);

// Monday, 29th December 1997
compare('1998 01 1', $date->format2('IYYY IW ID'), 'IW (1998 -3)');

$date->addDays(1);

// Tuesday, 30th December 1997
compare('1998 01 2', $date->format2('IYYY IW ID'), 'IW (1998 -2)');

$date->addDays(1);

// Wednesday, 31st December 1997
compare('1998 01 3', $date->format2('IYYY IW ID'), 'IW (1998 -1)');

$date->addDays(1);

// Thursday, 1st January 1998
compare('1998 01 4', $date->format2('IYYY IW ID'), 'IW (1998 0)');

$date->addDays(1);

// Friday, 2nd January 1998
compare('1998 01 5', $date->format2('IYYY IW ID'), 'IW (1998 1)');

$date->addDays(1);

// Saturday, 3rd January 1998
compare('1998 01 6', $date->format2('IYYY IW ID'), 'IW (1998 2)');

$date->addDays(1);

// Sunday, 4th January 1998
compare('1998 01 7', $date->format2('IYYY IW ID'), 'IW (1998 3)');

$date->addDays(1);

// Monday, 5th January 1998
compare('1998 02 1', $date->format2('IYYY IW ID'), 'IW (1998 4)');

$date->addDays(1);

// Tuesday, 6th January 1998
compare('1998 02 2', $date->format2('IYYY IW ID'), 'IW (1998 5)');

$date->addDays(1);

// Wednesday, 7th January 1998
compare('1998 02 3', $date->format2('IYYY IW ID'), 'IW (1998 6)');

$date->addDays(1);

// Thursday, 8th January 1998
compare('1998 02 4', $date->format2('IYYY IW ID'), 'IW (1998 7)');

$date->setDayMonthYear(24, 12, 1998);

// Thursday, 24th December 1998
compare('1998 52 4', $date->format2('IYYY IW ID'), 'IW (1999 -8)');

$date->addDays(1);

// Friday, 25th December 1998
compare('1998 52 5', $date->format2('IYYY IW ID'), 'IW (1999 -7)');

$date->addDays(1);

// Saturday, 26th December 1998
compare('1998 52 6', $date->format2('IYYY IW ID'), 'IW (1999 -6)');

$date->addDays(1);

// Sunday, 27th December 1998
compare('1998 52 7', $date->format2('IYYY IW ID'), 'IW (1999 -5)');

$date->addDays(1);

// Monday, 28th December 1998
compare('1998 53 1', $date->format2('IYYY IW ID'), 'IW (1999 -4)');

$date->addDays(1);

// Tuesday, 29th December 1998
compare('1998 53 2', $date->format2('IYYY IW ID'), 'IW (1999 -3)');

$date->addDays(1);

// Wednesday, 30th December 1998
compare('1998 53 3', $date->format2('IYYY IW ID'), 'IW (1999 -2)');

$date->addDays(1);

// Thursday, 31st December 1998
compare('1998 53 4', $date->format2('IYYY IW ID'), 'IW (1999 -1)');

$date->addDays(1);

// Friday, 1st January 1999
compare('1998 53 5', $date->format2('IYYY IW ID'), 'IW (1999 0)');

$date->addDays(1);

// Saturday, 2nd January 1999
compare('1998 53 6', $date->format2('IYYY IW ID'), 'IW (1999 1)');

$date->addDays(1);

// Sunday, 3rd January 1999
compare('1998 53 7', $date->format2('IYYY IW ID'), 'IW (1999 2)');

$date->addDays(1);

// Monday, 4th January 1999
compare('1999 01 1', $date->format2('IYYY IW ID'), 'IW (1999 3)');

$date->addDays(1);

// Tuesday, 5th January 1999
compare('1999 01 2', $date->format2('IYYY IW ID'), 'IW (1999 4)');

$date->addDays(1);

// Wednesday, 6th January 1999
compare('1999 01 3', $date->format2('IYYY IW ID'), 'IW (1999 5)');

$date->addDays(1);

// Thursday, 7th January 1999
compare('1999 01 4', $date->format2('IYYY IW ID'), 'IW (1999 6)');

$date->addDays(1);

// Friday, 8th January 1999
compare('1999 01 5', $date->format2('IYYY IW ID'), 'IW (1999 7)');

$date->setDayMonthYear(24, 12, 1999);

// Friday, 24th December 1999
compare('1999 51 5', $date->format2('IYYY IW ID'), 'IW (2000 -8)');

$date->addDays(1);

// Saturday, 25th December 1999
compare('1999 51 6', $date->format2('IYYY IW ID'), 'IW (2000 -7)');

$date->addDays(1);

// Sunday, 26th December 1999
compare('1999 51 7', $date->format2('IYYY IW ID'), 'IW (2000 -6)');

$date->addDays(1);

// Monday, 27th December 1999
compare('1999 52 1', $date->format2('IYYY IW ID'), 'IW (2000 -5)');

$date->addDays(1);

// Tuesday, 28th December 1999
compare('1999 52 2', $date->format2('IYYY IW ID'), 'IW (2000 -4)');

$date->addDays(1);

// Wednesday, 29th December 1999
compare('1999 52 3', $date->format2('IYYY IW ID'), 'IW (2000 -3)');

$date->addDays(1);

// Thursday, 30th December 1999
compare('1999 52 4', $date->format2('IYYY IW ID'), 'IW (2000 -2)');

$date->addDays(1);

// Friday, 31st December 1999
compare('1999 52 5', $date->format2('IYYY IW ID'), 'IW (2000 -1)');

$date->addDays(1);

// Saturday, 1st January 2000
compare('1999 52 6', $date->format2('IYYY IW ID'), 'IW (2000 0)');

$date->addDays(1);

// Sunday, 2nd January 2000
compare('1999 52 7', $date->format2('IYYY IW ID'), 'IW (2000 1)');

$date->addDays(1);

// Monday, 3rd January 2000
compare('2000 01 1', $date->format2('IYYY IW ID'), 'IW (2000 2)');

$date->addDays(1);

// Tuesday, 4th January 2000
compare('2000 01 2', $date->format2('IYYY IW ID'), 'IW (2000 3)');

$date->addDays(1);

// Wednesday, 5th January 2000
compare('2000 01 3', $date->format2('IYYY IW ID'), 'IW (2000 4)');

$date->addDays(1);

// Thursday, 6th January 2000
compare('2000 01 4', $date->format2('IYYY IW ID'), 'IW (2000 5)');

$date->addDays(1);

// Friday, 7th January 2000
compare('2000 01 5', $date->format2('IYYY IW ID'), 'IW (2000 6)');

$date->addDays(1);

// Saturday, 8th January 2000
compare('2000 01 6', $date->format2('IYYY IW ID'), 'IW (2000 7)');

$date->setDayMonthYear(24, 12, 2000);

// Sunday, 24th December 2000
compare('2000 51 7', $date->format2('IYYY IW ID'), 'IW (2001 -8)');

$date->addDays(1);

// Monday, 25th December 2000
compare('2000 52 1', $date->format2('IYYY IW ID'), 'IW (2001 -7)');

$date->addDays(1);

// Tuesday, 26th December 2000
compare('2000 52 2', $date->format2('IYYY IW ID'), 'IW (2001 -6)');

$date->addDays(1);

// Wednesday, 27th December 2000
compare('2000 52 3', $date->format2('IYYY IW ID'), 'IW (2001 -5)');

$date->addDays(1);

// Thursday, 28th December 2000
compare('2000 52 4', $date->format2('IYYY IW ID'), 'IW (2001 -4)');

$date->addDays(1);

// Friday, 29th December 2000
compare('2000 52 5', $date->format2('IYYY IW ID'), 'IW (2001 -3)');

$date->addDays(1);

// Saturday, 30th December 2000
compare('2000 52 6', $date->format2('IYYY IW ID'), 'IW (2001 -2)');

$date->addDays(1);

// Sunday, 31st December 2000
compare('2000 52 7', $date->format2('IYYY IW ID'), 'IW (2001 -1)');

$date->addDays(1);

// Monday, 1st January 2001
compare('2001 01 1', $date->format2('IYYY IW ID'), 'IW (2001 0)');

$date->addDays(1);

// Tuesday, 2nd January 2001
compare('2001 01 2', $date->format2('IYYY IW ID'), 'IW (2001 1)');

$date->addDays(1);

// Wednesday, 3rd January 2001
compare('2001 01 3', $date->format2('IYYY IW ID'), 'IW (2001 2)');

$date->addDays(1);

// Thursday, 4th January 2001
compare('2001 01 4', $date->format2('IYYY IW ID'), 'IW (2001 3)');

$date->addDays(1);

// Friday, 5th January 2001
compare('2001 01 5', $date->format2('IYYY IW ID'), 'IW (2001 4)');

$date->addDays(1);

// Saturday, 6th January 2001
compare('2001 01 6', $date->format2('IYYY IW ID'), 'IW (2001 5)');

$date->addDays(1);

// Sunday, 7th January 2001
compare('2001 01 7', $date->format2('IYYY IW ID'), 'IW (2001 6)');

$date->addDays(1);

// Monday, 8th January 2001
compare('2001 02 1', $date->format2('IYYY IW ID'), 'IW (2001 7)');

$date->setDayMonthYear(24, 12, 2001);

// Monday, 24th December 2001
compare('2001 52 1', $date->format2('IYYY IW ID'), 'IW (2002 -8)');

$date->addDays(1);

// Tuesday, 25th December 2001
compare('2001 52 2', $date->format2('IYYY IW ID'), 'IW (2002 -7)');

$date->addDays(1);

// Wednesday, 26th December 2001
compare('2001 52 3', $date->format2('IYYY IW ID'), 'IW (2002 -6)');

$date->addDays(1);

// Thursday, 27th December 2001
compare('2001 52 4', $date->format2('IYYY IW ID'), 'IW (2002 -5)');

$date->addDays(1);

// Friday, 28th December 2001
compare('2001 52 5', $date->format2('IYYY IW ID'), 'IW (2002 -4)');

$date->addDays(1);

// Saturday, 29th December 2001
compare('2001 52 6', $date->format2('IYYY IW ID'), 'IW (2002 -3)');

$date->addDays(1);

// Sunday, 30th December 2001
compare('2001 52 7', $date->format2('IYYY IW ID'), 'IW (2002 -2)');

$date->addDays(1);

// Monday, 31st December 2001
compare('2002 01 1', $date->format2('IYYY IW ID'), 'IW (2002 -1)');

$date->addDays(1);

// Tuesday, 1st January 2002
compare('2002 01 2', $date->format2('IYYY IW ID'), 'IW (2002 0)');

$date->addDays(1);

// Wednesday, 2nd January 2002
compare('2002 01 3', $date->format2('IYYY IW ID'), 'IW (2002 1)');

$date->addDays(1);

// Thursday, 3rd January 2002
compare('2002 01 4', $date->format2('IYYY IW ID'), 'IW (2002 2)');

$date->addDays(1);

// Friday, 4th January 2002
compare('2002 01 5', $date->format2('IYYY IW ID'), 'IW (2002 3)');

$date->addDays(1);

// Saturday, 5th January 2002
compare('2002 01 6', $date->format2('IYYY IW ID'), 'IW (2002 4)');

$date->addDays(1);

// Sunday, 6th January 2002
compare('2002 01 7', $date->format2('IYYY IW ID'), 'IW (2002 5)');

$date->addDays(1);

// Monday, 7th January 2002
compare('2002 02 1', $date->format2('IYYY IW ID'), 'IW (2002 6)');

$date->addDays(1);

// Tuesday, 8th January 2002
compare('2002 02 2', $date->format2('IYYY IW ID'), 'IW (2002 7)');

$date->setDayMonthYear(24, 12, 2002);

// Tuesday, 24th December 2002
compare('2002 52 2', $date->format2('IYYY IW ID'), 'IW (2003 -8)');

$date->addDays(1);

// Wednesday, 25th December 2002
compare('2002 52 3', $date->format2('IYYY IW ID'), 'IW (2003 -7)');

$date->addDays(1);

// Thursday, 26th December 2002
compare('2002 52 4', $date->format2('IYYY IW ID'), 'IW (2003 -6)');

$date->addDays(1);

// Friday, 27th December 2002
compare('2002 52 5', $date->format2('IYYY IW ID'), 'IW (2003 -5)');

$date->addDays(1);

// Saturday, 28th December 2002
compare('2002 52 6', $date->format2('IYYY IW ID'), 'IW (2003 -4)');

$date->addDays(1);

// Sunday, 29th December 2002
compare('2002 52 7', $date->format2('IYYY IW ID'), 'IW (2003 -3)');

$date->addDays(1);

// Monday, 30th December 2002
compare('2003 01 1', $date->format2('IYYY IW ID'), 'IW (2003 -2)');

$date->addDays(1);

// Tuesday, 31st December 2002
compare('2003 01 2', $date->format2('IYYY IW ID'), 'IW (2003 -1)');

$date->addDays(1);

// Wednesday, 1st January 2003
compare('2003 01 3', $date->format2('IYYY IW ID'), 'IW (2003 0)');

$date->addDays(1);

// Thursday, 2nd January 2003
compare('2003 01 4', $date->format2('IYYY IW ID'), 'IW (2003 1)');

$date->addDays(1);

// Friday, 3rd January 2003
compare('2003 01 5', $date->format2('IYYY IW ID'), 'IW (2003 2)');

$date->addDays(1);

// Saturday, 4th January 2003
compare('2003 01 6', $date->format2('IYYY IW ID'), 'IW (2003 3)');

$date->addDays(1);

// Sunday, 5th January 2003
compare('2003 01 7', $date->format2('IYYY IW ID'), 'IW (2003 4)');

$date->addDays(1);

// Monday, 6th January 2003
compare('2003 02 1', $date->format2('IYYY IW ID'), 'IW (2003 5)');

$date->addDays(1);

// Tuesday, 7th January 2003
compare('2003 02 2', $date->format2('IYYY IW ID'), 'IW (2003 6)');

$date->addDays(1);

// Wednesday, 8th January 2003
compare('2003 02 3', $date->format2('IYYY IW ID'), 'IW (2003 7)');

$date->setDayMonthYear(24, 12, 2003);

// Wednesday, 24th December 2003
compare('2003 52 3', $date->format2('IYYY IW ID'), 'IW (2004 -8)');

$date->addDays(1);

// Thursday, 25th December 2003
compare('2003 52 4', $date->format2('IYYY IW ID'), 'IW (2004 -7)');

$date->addDays(1);

// Friday, 26th December 2003
compare('2003 52 5', $date->format2('IYYY IW ID'), 'IW (2004 -6)');

$date->addDays(1);

// Saturday, 27th December 2003
compare('2003 52 6', $date->format2('IYYY IW ID'), 'IW (2004 -5)');

$date->addDays(1);

// Sunday, 28th December 2003
compare('2003 52 7', $date->format2('IYYY IW ID'), 'IW (2004 -4)');

$date->addDays(1);

// Monday, 29th December 2003
compare('2004 01 1', $date->format2('IYYY IW ID'), 'IW (2004 -3)');

$date->addDays(1);

// Tuesday, 30th December 2003
compare('2004 01 2', $date->format2('IYYY IW ID'), 'IW (2004 -2)');

$date->addDays(1);

// Wednesday, 31st December 2003
compare('2004 01 3', $date->format2('IYYY IW ID'), 'IW (2004 -1)');

$date->addDays(1);

// Thursday, 1st January 2004
compare('2004 01 4', $date->format2('IYYY IW ID'), 'IW (2004 0)');

$date->addDays(1);

// Friday, 2nd January 2004
compare('2004 01 5', $date->format2('IYYY IW ID'), 'IW (2004 1)');

$date->addDays(1);

// Saturday, 3rd January 2004
compare('2004 01 6', $date->format2('IYYY IW ID'), 'IW (2004 2)');

$date->addDays(1);

// Sunday, 4th January 2004
compare('2004 01 7', $date->format2('IYYY IW ID'), 'IW (2004 3)');

$date->addDays(1);

// Monday, 5th January 2004
compare('2004 02 1', $date->format2('IYYY IW ID'), 'IW (2004 4)');

$date->addDays(1);

// Tuesday, 6th January 2004
compare('2004 02 2', $date->format2('IYYY IW ID'), 'IW (2004 5)');

$date->addDays(1);

// Wednesday, 7th January 2004
compare('2004 02 3', $date->format2('IYYY IW ID'), 'IW (2004 6)');

$date->addDays(1);

// Thursday, 8th January 2004
compare('2004 02 4', $date->format2('IYYY IW ID'), 'IW (2004 7)');

$date->setDayMonthYear(24, 12, 2004);

// Friday, 24th December 2004
compare('2004 52 5', $date->format2('IYYY IW ID'), 'IW (2005 -8)');

$date->addDays(1);

// Saturday, 25th December 2004
compare('2004 52 6', $date->format2('IYYY IW ID'), 'IW (2005 -7)');

$date->addDays(1);

// Sunday, 26th December 2004
compare('2004 52 7', $date->format2('IYYY IW ID'), 'IW (2005 -6)');

$date->addDays(1);

// Monday, 27th December 2004
compare('2004 53 1', $date->format2('IYYY IW ID'), 'IW (2005 -5)');

$date->addDays(1);

// Tuesday, 28th December 2004
compare('2004 53 2', $date->format2('IYYY IW ID'), 'IW (2005 -4)');

$date->addDays(1);

// Wednesday, 29th December 2004
compare('2004 53 3', $date->format2('IYYY IW ID'), 'IW (2005 -3)');

$date->addDays(1);

// Thursday, 30th December 2004
compare('2004 53 4', $date->format2('IYYY IW ID'), 'IW (2005 -2)');

$date->addDays(1);

// Friday, 31st December 2004
compare('2004 53 5', $date->format2('IYYY IW ID'), 'IW (2005 -1)');

$date->addDays(1);

// Saturday, 1st January 2005
compare('2004 53 6', $date->format2('IYYY IW ID'), 'IW (2005 0)');

$date->addDays(1);

// Sunday, 2nd January 2005
compare('2004 53 7', $date->format2('IYYY IW ID'), 'IW (2005 1)');

$date->addDays(1);

// Monday, 3rd January 2005
compare('2005 01 1', $date->format2('IYYY IW ID'), 'IW (2005 2)');

$date->addDays(1);

// Tuesday, 4th January 2005
compare('2005 01 2', $date->format2('IYYY IW ID'), 'IW (2005 3)');

$date->addDays(1);

// Wednesday, 5th January 2005
compare('2005 01 3', $date->format2('IYYY IW ID'), 'IW (2005 4)');

$date->addDays(1);

// Thursday, 6th January 2005
compare('2005 01 4', $date->format2('IYYY IW ID'), 'IW (2005 5)');

$date->addDays(1);

// Friday, 7th January 2005
compare('2005 01 5', $date->format2('IYYY IW ID'), 'IW (2005 6)');

$date->addDays(1);

// Saturday, 8th January 2005
compare('2005 01 6', $date->format2('IYYY IW ID'), 'IW (2005 7)');

$date->setDayMonthYear(24, 12, 2005);

// Saturday, 24th December 2005
compare('2005 51 6', $date->format2('IYYY IW ID'), 'IW (2006 -8)');

$date->addDays(1);

// Sunday, 25th December 2005
compare('2005 51 7', $date->format2('IYYY IW ID'), 'IW (2006 -7)');

$date->addDays(1);

// Monday, 26th December 2005
compare('2005 52 1', $date->format2('IYYY IW ID'), 'IW (2006 -6)');

$date->addDays(1);

// Tuesday, 27th December 2005
compare('2005 52 2', $date->format2('IYYY IW ID'), 'IW (2006 -5)');

$date->addDays(1);

// Wednesday, 28th December 2005
compare('2005 52 3', $date->format2('IYYY IW ID'), 'IW (2006 -4)');

$date->addDays(1);

// Thursday, 29th December 2005
compare('2005 52 4', $date->format2('IYYY IW ID'), 'IW (2006 -3)');

$date->addDays(1);

// Friday, 30th December 2005
compare('2005 52 5', $date->format2('IYYY IW ID'), 'IW (2006 -2)');

$date->addDays(1);

// Saturday, 31st December 2005
compare('2005 52 6', $date->format2('IYYY IW ID'), 'IW (2006 -1)');

$date->addDays(1);

// Sunday, 1st January 2006
compare('2005 52 7', $date->format2('IYYY IW ID'), 'IW (2006 0)');

$date->addDays(1);

// Monday, 2nd January 2006
compare('2006 01 1', $date->format2('IYYY IW ID'), 'IW (2006 1)');

$date->addDays(1);

// Tuesday, 3rd January 2006
compare('2006 01 2', $date->format2('IYYY IW ID'), 'IW (2006 2)');

$date->addDays(1);

// Wednesday, 4th January 2006
compare('2006 01 3', $date->format2('IYYY IW ID'), 'IW (2006 3)');

$date->addDays(1);

// Thursday, 5th January 2006
compare('2006 01 4', $date->format2('IYYY IW ID'), 'IW (2006 4)');

$date->addDays(1);

// Friday, 6th January 2006
compare('2006 01 5', $date->format2('IYYY IW ID'), 'IW (2006 5)');

$date->addDays(1);

// Saturday, 7th January 2006
compare('2006 01 6', $date->format2('IYYY IW ID'), 'IW (2006 6)');

$date->addDays(1);

// Sunday, 8th January 2006
compare('2006 01 7', $date->format2('IYYY IW ID'), 'IW (2006 7)');

$date->setDayMonthYear(24, 12, 2006);

// Sunday, 24th December 2006
compare('2006 51 7', $date->format2('IYYY IW ID'), 'IW (2007 -8)');

$date->addDays(1);

// Monday, 25th December 2006
compare('2006 52 1', $date->format2('IYYY IW ID'), 'IW (2007 -7)');

$date->addDays(1);

// Tuesday, 26th December 2006
compare('2006 52 2', $date->format2('IYYY IW ID'), 'IW (2007 -6)');

$date->addDays(1);

// Wednesday, 27th December 2006
compare('2006 52 3', $date->format2('IYYY IW ID'), 'IW (2007 -5)');

$date->addDays(1);

// Thursday, 28th December 2006
compare('2006 52 4', $date->format2('IYYY IW ID'), 'IW (2007 -4)');

$date->addDays(1);

// Friday, 29th December 2006
compare('2006 52 5', $date->format2('IYYY IW ID'), 'IW (2007 -3)');

$date->addDays(1);

// Saturday, 30th December 2006
compare('2006 52 6', $date->format2('IYYY IW ID'), 'IW (2007 -2)');

$date->addDays(1);

// Sunday, 31st December 2006
compare('2006 52 7', $date->format2('IYYY IW ID'), 'IW (2007 -1)');

$date->addDays(1);

// Monday, 1st January 2007
compare('2007 01 1', $date->format2('IYYY IW ID'), 'IW (2007 0)');

$date->addDays(1);

// Tuesday, 2nd January 2007
compare('2007 01 2', $date->format2('IYYY IW ID'), 'IW (2007 1)');

$date->addDays(1);

// Wednesday, 3rd January 2007
compare('2007 01 3', $date->format2('IYYY IW ID'), 'IW (2007 2)');

$date->addDays(1);

// Thursday, 4th January 2007
compare('2007 01 4', $date->format2('IYYY IW ID'), 'IW (2007 3)');

$date->addDays(1);

// Friday, 5th January 2007
compare('2007 01 5', $date->format2('IYYY IW ID'), 'IW (2007 4)');

$date->addDays(1);

// Saturday, 6th January 2007
compare('2007 01 6', $date->format2('IYYY IW ID'), 'IW (2007 5)');

$date->addDays(1);

// Sunday, 7th January 2007
compare('2007 01 7', $date->format2('IYYY IW ID'), 'IW (2007 6)');

$date->addDays(1);

// Monday, 8th January 2007
compare('2007 02 1', $date->format2('IYYY IW ID'), 'IW (2007 7)');

$date->setDayMonthYear(24, 12, 2007);

// Monday, 24th December 2007
compare('2007 52 1', $date->format2('IYYY IW ID'), 'IW (2008 -8)');

$date->addDays(1);

// Tuesday, 25th December 2007
compare('2007 52 2', $date->format2('IYYY IW ID'), 'IW (2008 -7)');

$date->addDays(1);

// Wednesday, 26th December 2007
compare('2007 52 3', $date->format2('IYYY IW ID'), 'IW (2008 -6)');

$date->addDays(1);

// Thursday, 27th December 2007
compare('2007 52 4', $date->format2('IYYY IW ID'), 'IW (2008 -5)');

$date->addDays(1);

// Friday, 28th December 2007
compare('2007 52 5', $date->format2('IYYY IW ID'), 'IW (2008 -4)');

$date->addDays(1);

// Saturday, 29th December 2007
compare('2007 52 6', $date->format2('IYYY IW ID'), 'IW (2008 -3)');

$date->addDays(1);

// Sunday, 30th December 2007
compare('2007 52 7', $date->format2('IYYY IW ID'), 'IW (2008 -2)');

$date->addDays(1);

// Monday, 31st December 2007
compare('2008 01 1', $date->format2('IYYY IW ID'), 'IW (2008 -1)');

$date->addDays(1);

// Tuesday, 1st January 2008
compare('2008 01 2', $date->format2('IYYY IW ID'), 'IW (2008 0)');

$date->addDays(1);

// Wednesday, 2nd January 2008
compare('2008 01 3', $date->format2('IYYY IW ID'), 'IW (2008 1)');

$date->addDays(1);

// Thursday, 3rd January 2008
compare('2008 01 4', $date->format2('IYYY IW ID'), 'IW (2008 2)');

$date->addDays(1);

// Friday, 4th January 2008
compare('2008 01 5', $date->format2('IYYY IW ID'), 'IW (2008 3)');

$date->addDays(1);

// Saturday, 5th January 2008
compare('2008 01 6', $date->format2('IYYY IW ID'), 'IW (2008 4)');

$date->addDays(1);

// Sunday, 6th January 2008
compare('2008 01 7', $date->format2('IYYY IW ID'), 'IW (2008 5)');

$date->addDays(1);

// Monday, 7th January 2008
compare('2008 02 1', $date->format2('IYYY IW ID'), 'IW (2008 6)');

$date->addDays(1);

// Tuesday, 8th January 2008
compare('2008 02 2', $date->format2('IYYY IW ID'), 'IW (2008 7)');

$date->setDayMonthYear(24, 12, 2008);

// Wednesday, 24th December 2008
compare('2008 52 3', $date->format2('IYYY IW ID'), 'IW (2009 -8)');

$date->addDays(1);

// Thursday, 25th December 2008
compare('2008 52 4', $date->format2('IYYY IW ID'), 'IW (2009 -7)');

$date->addDays(1);

// Friday, 26th December 2008
compare('2008 52 5', $date->format2('IYYY IW ID'), 'IW (2009 -6)');

$date->addDays(1);

// Saturday, 27th December 2008
compare('2008 52 6', $date->format2('IYYY IW ID'), 'IW (2009 -5)');

$date->addDays(1);

// Sunday, 28th December 2008
compare('2008 52 7', $date->format2('IYYY IW ID'), 'IW (2009 -4)');

$date->addDays(1);

// Monday, 29th December 2008
compare('2009 01 1', $date->format2('IYYY IW ID'), 'IW (2009 -3)');

$date->addDays(1);

// Tuesday, 30th December 2008
compare('2009 01 2', $date->format2('IYYY IW ID'), 'IW (2009 -2)');

$date->addDays(1);

// Wednesday, 31st December 2008
compare('2009 01 3', $date->format2('IYYY IW ID'), 'IW (2009 -1)');

$date->addDays(1);

// Thursday, 1st January 2009
compare('2009 01 4', $date->format2('IYYY IW ID'), 'IW (2009 0)');

$date->addDays(1);

// Friday, 2nd January 2009
compare('2009 01 5', $date->format2('IYYY IW ID'), 'IW (2009 1)');

$date->addDays(1);

// Saturday, 3rd January 2009
compare('2009 01 6', $date->format2('IYYY IW ID'), 'IW (2009 2)');

$date->addDays(1);

// Sunday, 4th January 2009
compare('2009 01 7', $date->format2('IYYY IW ID'), 'IW (2009 3)');

$date->addDays(1);

// Monday, 5th January 2009
compare('2009 02 1', $date->format2('IYYY IW ID'), 'IW (2009 4)');

$date->addDays(1);

// Tuesday, 6th January 2009
compare('2009 02 2', $date->format2('IYYY IW ID'), 'IW (2009 5)');

$date->addDays(1);

// Wednesday, 7th January 2009
compare('2009 02 3', $date->format2('IYYY IW ID'), 'IW (2009 6)');

$date->addDays(1);

// Thursday, 8th January 2009
compare('2009 02 4', $date->format2('IYYY IW ID'), 'IW (2009 7)');

$date->setDayMonthYear(24, 12, 2009);

// Thursday, 24th December 2009
compare('2009 52 4', $date->format2('IYYY IW ID'), 'IW (2010 -8)');

$date->addDays(1);

// Friday, 25th December 2009
compare('2009 52 5', $date->format2('IYYY IW ID'), 'IW (2010 -7)');

$date->addDays(1);

// Saturday, 26th December 2009
compare('2009 52 6', $date->format2('IYYY IW ID'), 'IW (2010 -6)');

$date->addDays(1);

// Sunday, 27th December 2009
compare('2009 52 7', $date->format2('IYYY IW ID'), 'IW (2010 -5)');

$date->addDays(1);

// Monday, 28th December 2009
compare('2009 53 1', $date->format2('IYYY IW ID'), 'IW (2010 -4)');

$date->addDays(1);

// Tuesday, 29th December 2009
compare('2009 53 2', $date->format2('IYYY IW ID'), 'IW (2010 -3)');

$date->addDays(1);

// Wednesday, 30th December 2009
compare('2009 53 3', $date->format2('IYYY IW ID'), 'IW (2010 -2)');

$date->addDays(1);

// Thursday, 31st December 2009
compare('2009 53 4', $date->format2('IYYY IW ID'), 'IW (2010 -1)');

$date->addDays(1);

// Friday, 1st January 2010
compare('2009 53 5', $date->format2('IYYY IW ID'), 'IW (2010 0)');

$date->addDays(1);

// Saturday, 2nd January 2010
compare('2009 53 6', $date->format2('IYYY IW ID'), 'IW (2010 1)');

$date->addDays(1);

// Sunday, 3rd January 2010
compare('2009 53 7', $date->format2('IYYY IW ID'), 'IW (2010 2)');

$date->addDays(1);

// Monday, 4th January 2010
compare('2010 01 1', $date->format2('IYYY IW ID'), 'IW (2010 3)');

$date->addDays(1);

// Tuesday, 5th January 2010
compare('2010 01 2', $date->format2('IYYY IW ID'), 'IW (2010 4)');

$date->addDays(1);

// Wednesday, 6th January 2010
compare('2010 01 3', $date->format2('IYYY IW ID'), 'IW (2010 5)');

$date->addDays(1);

// Thursday, 7th January 2010
compare('2010 01 4', $date->format2('IYYY IW ID'), 'IW (2010 6)');

$date->addDays(1);

// Friday, 8th January 2010
compare('2010 01 5', $date->format2('IYYY IW ID'), 'IW (2010 7)');

$date->setDayMonthYear(24, 12, 2010);

// Friday, 24th December 2010
compare('2010 51 5', $date->format2('IYYY IW ID'), 'IW (2011 -8)');

$date->addDays(1);

// Saturday, 25th December 2010
compare('2010 51 6', $date->format2('IYYY IW ID'), 'IW (2011 -7)');

$date->addDays(1);

// Sunday, 26th December 2010
compare('2010 51 7', $date->format2('IYYY IW ID'), 'IW (2011 -6)');

$date->addDays(1);

// Monday, 27th December 2010
compare('2010 52 1', $date->format2('IYYY IW ID'), 'IW (2011 -5)');

$date->addDays(1);

// Tuesday, 28th December 2010
compare('2010 52 2', $date->format2('IYYY IW ID'), 'IW (2011 -4)');

$date->addDays(1);

// Wednesday, 29th December 2010
compare('2010 52 3', $date->format2('IYYY IW ID'), 'IW (2011 -3)');

$date->addDays(1);

// Thursday, 30th December 2010
compare('2010 52 4', $date->format2('IYYY IW ID'), 'IW (2011 -2)');

$date->addDays(1);

// Friday, 31st December 2010
compare('2010 52 5', $date->format2('IYYY IW ID'), 'IW (2011 -1)');

$date->addDays(1);

// Saturday, 1st January 2011
compare('2010 52 6', $date->format2('IYYY IW ID'), 'IW (2011 0)');

$date->addDays(1);

// Sunday, 2nd January 2011
compare('2010 52 7', $date->format2('IYYY IW ID'), 'IW (2011 1)');

$date->addDays(1);

// Monday, 3rd January 2011
compare('2011 01 1', $date->format2('IYYY IW ID'), 'IW (2011 2)');

$date->addDays(1);

// Tuesday, 4th January 2011
compare('2011 01 2', $date->format2('IYYY IW ID'), 'IW (2011 3)');

$date->addDays(1);

// Wednesday, 5th January 2011
compare('2011 01 3', $date->format2('IYYY IW ID'), 'IW (2011 4)');

$date->addDays(1);

// Thursday, 6th January 2011
compare('2011 01 4', $date->format2('IYYY IW ID'), 'IW (2011 5)');

$date->addDays(1);

// Friday, 7th January 2011
compare('2011 01 5', $date->format2('IYYY IW ID'), 'IW (2011 6)');

$date->addDays(1);

// Saturday, 8th January 2011
compare('2011 01 6', $date->format2('IYYY IW ID'), 'IW (2011 7)');

$date->setDayMonthYear(24, 12, 2011);

// Saturday, 24th December 2011
compare('2011 51 6', $date->format2('IYYY IW ID'), 'IW (2012 -8)');

$date->addDays(1);

// Sunday, 25th December 2011
compare('2011 51 7', $date->format2('IYYY IW ID'), 'IW (2012 -7)');

$date->addDays(1);

// Monday, 26th December 2011
compare('2011 52 1', $date->format2('IYYY IW ID'), 'IW (2012 -6)');

$date->addDays(1);

// Tuesday, 27th December 2011
compare('2011 52 2', $date->format2('IYYY IW ID'), 'IW (2012 -5)');

$date->addDays(1);

// Wednesday, 28th December 2011
compare('2011 52 3', $date->format2('IYYY IW ID'), 'IW (2012 -4)');

$date->addDays(1);

// Thursday, 29th December 2011
compare('2011 52 4', $date->format2('IYYY IW ID'), 'IW (2012 -3)');

$date->addDays(1);

// Friday, 30th December 2011
compare('2011 52 5', $date->format2('IYYY IW ID'), 'IW (2012 -2)');

$date->addDays(1);

// Saturday, 31st December 2011
compare('2011 52 6', $date->format2('IYYY IW ID'), 'IW (2012 -1)');

$date->addDays(1);

// Sunday, 1st January 2012
compare('2011 52 7', $date->format2('IYYY IW ID'), 'IW (2012 0)');

$date->addDays(1);

// Monday, 2nd January 2012
compare('2012 01 1', $date->format2('IYYY IW ID'), 'IW (2012 1)');

$date->addDays(1);

// Tuesday, 3rd January 2012
compare('2012 01 2', $date->format2('IYYY IW ID'), 'IW (2012 2)');

$date->addDays(1);

// Wednesday, 4th January 2012
compare('2012 01 3', $date->format2('IYYY IW ID'), 'IW (2012 3)');

$date->addDays(1);

// Thursday, 5th January 2012
compare('2012 01 4', $date->format2('IYYY IW ID'), 'IW (2012 4)');

$date->addDays(1);

// Friday, 6th January 2012
compare('2012 01 5', $date->format2('IYYY IW ID'), 'IW (2012 5)');

$date->addDays(1);

// Saturday, 7th January 2012
compare('2012 01 6', $date->format2('IYYY IW ID'), 'IW (2012 6)');

$date->addDays(1);

// Sunday, 8th January 2012
compare('2012 01 7', $date->format2('IYYY IW ID'), 'IW (2012 7)');


?>