<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Tests for the Date_Calc day of week functions
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


define('DATE_CALC_BEGIN_WEEKDAY', 3);

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

$date = new Date("1998-12-24 00:00:00Z");

// First day of week is Wednesday
//

// Thursday, 24th December 1998
compare('52', $date->format2('WW'), 'WW (-8)');
compare('52', $date->format2('W1'), 'W1 (-8)');
compare('52', $date->format2('W4'), 'W4 (-8)');
compare('51', $date->format2('W7'), 'W7 (-8)');
compare('52', $date->format2('IW'), 'IW (-8)');

$date->addDays(1);

// Friday, 25th December 1998
compare('52', $date->format2('WW'), 'WW (-7)');
compare('52', $date->format2('W1'), 'W1 (-7)');
compare('52', $date->format2('W4'), 'W4 (-7)');
compare('51', $date->format2('W7'), 'W7 (-7)');
compare('52', $date->format2('IW'), 'IW (-7)');

$date->addDays(1);

// Saturday, 26th December 1998
compare('52', $date->format2('WW'), 'WW (-6)');
compare('52', $date->format2('W1'), 'W1 (-6)');
compare('52', $date->format2('W4'), 'W4 (-6)');
compare('51', $date->format2('W7'), 'W7 (-6)');
compare('52', $date->format2('IW'), 'IW (-6)');

$date->addDays(1);

// Sunday, 27th December 1998
compare('52', $date->format2('WW'), 'WW (-5)');
compare('52', $date->format2('W1'), 'W1 (-5)');
compare('52', $date->format2('W4'), 'W4 (-5)');
compare('51', $date->format2('W7'), 'W7 (-5)');
compare('52', $date->format2('IW'), 'IW (-5)');

$date->addDays(1);

// Monday, 28th December 1998
compare('52', $date->format2('WW'), 'WW (-4)');
compare('52', $date->format2('W1'), 'W1 (-4)');
compare('52', $date->format2('W4'), 'W4 (-4)');
compare('51', $date->format2('W7'), 'W7 (-4)');
compare('53', $date->format2('IW'), 'IW (-4)');

$date->addDays(1);

// Tuesday, 29th December 1998
compare('52', $date->format2('WW'), 'WW (-3)');
compare('52', $date->format2('W1'), 'W1 (-3)');
compare('52', $date->format2('W4'), 'W4 (-3)');
compare('51', $date->format2('W7'), 'W7 (-3)');
compare('53', $date->format2('IW'), 'IW (-3)');

$date->addDays(1);

// Wednesday, 30th December 1998
compare('52', $date->format2('WW'), 'WW (-2)');
compare('53', $date->format2('W1'), 'W1 (-2)');
compare('53', $date->format2('W4'), 'W4 (-2)');
compare('52', $date->format2('W7'), 'W7 (-2)');
compare('53', $date->format2('IW'), 'IW (-2)');

$date->addDays(1);

// Thursday, 31st December 1998
compare('53', $date->format2('WW'), 'WW (-1)');
compare('53', $date->format2('W1'), 'W1 (-1)');
compare('53', $date->format2('W4'), 'W4 (-1)');
compare('52', $date->format2('W7'), 'W7 (-1)');
compare('53', $date->format2('IW'), 'IW (-1)');

$date->addDays(1);

// Friday, 1st January 1999
compare('01', $date->format2('WW'), 'WW (0)');
compare('01', $date->format2('W1'), 'W1 (0)');
compare('01', $date->format2('W4'), 'W4 (0)');
compare('52', $date->format2('W7'), 'W7 (0)');
compare('53', $date->format2('IW'), 'IW (0)');

$date->addDays(1);

// Saturday, 2nd January 1999
compare('01', $date->format2('WW'), 'WW (1)');
compare('01', $date->format2('W1'), 'W1 (1)');
compare('01', $date->format2('W4'), 'W4 (1)');
compare('52', $date->format2('W7'), 'W7 (1)');
compare('53', $date->format2('IW'), 'IW (1)');

$date->addDays(1);

// Sunday, 3rd January 1999
compare('01', $date->format2('WW'), 'WW (2)');
compare('01', $date->format2('W1'), 'W1 (2)');
compare('01', $date->format2('W4'), 'W4 (2)');
compare('52', $date->format2('W7'), 'W7 (2)');
compare('53', $date->format2('IW'), 'IW (2)');

$date->addDays(1);

// Monday, 4th January 1999
compare('01', $date->format2('WW'), 'WW (3)');
compare('01', $date->format2('W1'), 'W1 (3)');
compare('01', $date->format2('W4'), 'W4 (3)');
compare('52', $date->format2('W7'), 'W7 (3)');
compare('01', $date->format2('IW'), 'IW (3)');

$date->addDays(1);

// Tuesday, 5th January 1999
compare('01', $date->format2('WW'), 'WW (4)');
compare('01', $date->format2('W1'), 'W1 (4)');
compare('01', $date->format2('W4'), 'W4 (4)');
compare('52', $date->format2('W7'), 'W7 (4)');
compare('01', $date->format2('IW'), 'IW (4)');

$date->addDays(1);

// Wednesday, 6th January 1999
compare('01', $date->format2('WW'), 'WW (5)');
compare('02', $date->format2('W1'), 'W1 (5)');
compare('02', $date->format2('W4'), 'W4 (5)');
compare('01', $date->format2('W7'), 'W7 (5)');
compare('01', $date->format2('IW'), 'IW (5)');

$date->addDays(1);

// Thursday, 7th January 1999
compare('01', $date->format2('WW'), 'WW (6)');
compare('02', $date->format2('W1'), 'W1 (6)');
compare('02', $date->format2('W4'), 'W4 (6)');
compare('01', $date->format2('W7'), 'W7 (6)');
compare('01', $date->format2('IW'), 'IW (6)');

$date->addDays(1);

// Friday, 8th January 1999
compare('02', $date->format2('WW'), 'WW (7)');
compare('02', $date->format2('W1'), 'W1 (7)');
compare('02', $date->format2('W4'), 'W4 (7)');
compare('01', $date->format2('W7'), 'W7 (7)');
compare('01', $date->format2('IW'), 'IW (7)');

$date->addDays(1);

// Saturday, 9th January 1999
compare('02', $date->format2('WW'), 'WW (8)');
compare('02', $date->format2('W1'), 'W1 (8)');
compare('02', $date->format2('W4'), 'W4 (8)');
compare('01', $date->format2('W7'), 'W7 (8)');
compare('01', $date->format2('IW'), 'IW (8)');

$date->addDays(1);

// Sunday, 10th January 1999
compare('02', $date->format2('WW'), 'WW (9)');
compare('02', $date->format2('W1'), 'W1 (9)');
compare('02', $date->format2('W4'), 'W4 (9)');
compare('01', $date->format2('W7'), 'W7 (9)');
compare('01', $date->format2('IW'), 'IW (9)');

$date->addDays(1);

// Monday, 11th January 1999
compare('02', $date->format2('WW'), 'WW (10)');
compare('02', $date->format2('W1'), 'W1 (10)');
compare('02', $date->format2('W4'), 'W4 (10)');
compare('01', $date->format2('W7'), 'W7 (10)');
compare('02', $date->format2('IW'), 'IW (10)');

$date->addDays(1);

// Tuesday, 12th January 1999
compare('02', $date->format2('WW'), 'WW (11)');
compare('02', $date->format2('W1'), 'W1 (11)');
compare('02', $date->format2('W4'), 'W4 (11)');
compare('01', $date->format2('W7'), 'W7 (11)');
compare('02', $date->format2('IW'), 'IW (11)');

$date->addDays(1);

// Wednesday, 13th January 1999
compare('02', $date->format2('WW'), 'WW (12)');
compare('03', $date->format2('W1'), 'W1 (12)');
compare('03', $date->format2('W4'), 'W4 (12)');
compare('02', $date->format2('W7'), 'W7 (12)');
compare('02', $date->format2('IW'), 'IW (12)');

$date->addDays(1);

// Thursday, 14th January 1999
compare('02', $date->format2('WW'), 'WW (13)');
compare('03', $date->format2('W1'), 'W1 (13)');
compare('03', $date->format2('W4'), 'W4 (13)');
compare('02', $date->format2('W7'), 'W7 (13)');
compare('02', $date->format2('IW'), 'IW (13)');

$date->addDays(1);

// Friday, 15th January 1999
compare('03', $date->format2('WW'), 'WW (14)');
compare('03', $date->format2('W1'), 'W1 (14)');
compare('03', $date->format2('W4'), 'W4 (14)');
compare('02', $date->format2('W7'), 'W7 (14)');
compare('02', $date->format2('IW'), 'IW (14)');

$date->addDays(1);

// Saturday, 16th January 1999
compare('03', $date->format2('WW'), 'WW (15)');
compare('03', $date->format2('W1'), 'W1 (15)');
compare('03', $date->format2('W4'), 'W4 (15)');
compare('02', $date->format2('W7'), 'W7 (15)');
compare('02', $date->format2('IW'), 'IW (15)');

$date->addDays(1);

// Sunday, 17th January 1999
compare('03', $date->format2('WW'), 'WW (16)');
compare('03', $date->format2('W1'), 'W1 (16)');
compare('03', $date->format2('W4'), 'W4 (16)');
compare('02', $date->format2('W7'), 'W7 (16)');
compare('02', $date->format2('IW'), 'IW (16)');

$date->addDays(1);

// Monday, 18th January 1999
compare('03', $date->format2('WW'), 'WW (17)');
compare('03', $date->format2('W1'), 'W1 (17)');
compare('03', $date->format2('W4'), 'W4 (17)');
compare('02', $date->format2('W7'), 'W7 (17)');
compare('03', $date->format2('IW'), 'IW (17)');

$date->addDays(1);

// Tuesday, 19th January 1999
compare('03', $date->format2('WW'), 'WW (18)');
compare('03', $date->format2('W1'), 'W1 (18)');
compare('03', $date->format2('W4'), 'W4 (18)');
compare('02', $date->format2('W7'), 'W7 (18)');
compare('03', $date->format2('IW'), 'IW (18)');

$date->addDays(1);

// Wednesday, 20th January 1999
compare('03', $date->format2('WW'), 'WW (19)');
compare('04', $date->format2('W1'), 'W1 (19)');
compare('04', $date->format2('W4'), 'W4 (19)');
compare('03', $date->format2('W7'), 'W7 (19)');
compare('03', $date->format2('IW'), 'IW (19)');

$date->addDays(1);

// Thursday, 21st January 1999
compare('03', $date->format2('WW'), 'WW (20)');
compare('04', $date->format2('W1'), 'W1 (20)');
compare('04', $date->format2('W4'), 'W4 (20)');
compare('03', $date->format2('W7'), 'W7 (20)');
compare('03', $date->format2('IW'), 'IW (20)');

$date->addDays(1);

// Friday, 22nd January 1999
compare('04', $date->format2('WW'), 'WW (21)');
compare('04', $date->format2('W1'), 'W1 (21)');
compare('04', $date->format2('W4'), 'W4 (21)');
compare('03', $date->format2('W7'), 'W7 (21)');
compare('03', $date->format2('IW'), 'IW (21)');

$date->addDays(1);

// Saturday, 23rd January 1999
compare('04', $date->format2('WW'), 'WW (22)');
compare('04', $date->format2('W1'), 'W1 (22)');
compare('04', $date->format2('W4'), 'W4 (22)');
compare('03', $date->format2('W7'), 'W7 (22)');
compare('03', $date->format2('IW'), 'IW (22)');

$date->addDays(1);

// Sunday, 24th January 1999
compare('04', $date->format2('WW'), 'WW (23)');
compare('04', $date->format2('W1'), 'W1 (23)');
compare('04', $date->format2('W4'), 'W4 (23)');
compare('03', $date->format2('W7'), 'W7 (23)');
compare('03', $date->format2('IW'), 'IW (23)');

$date->addDays(1);

// Monday, 25th January 1999
compare('04', $date->format2('WW'), 'WW (24)');
compare('04', $date->format2('W1'), 'W1 (24)');
compare('04', $date->format2('W4'), 'W4 (24)');
compare('03', $date->format2('W7'), 'W7 (24)');
compare('04', $date->format2('IW'), 'IW (24)');

$date->addDays(1);

// Tuesday, 26th January 1999
compare('04', $date->format2('WW'), 'WW (25)');
compare('04', $date->format2('W1'), 'W1 (25)');
compare('04', $date->format2('W4'), 'W4 (25)');
compare('03', $date->format2('W7'), 'W7 (25)');
compare('04', $date->format2('IW'), 'IW (25)');

$date->addDays(1);

// Wednesday, 27th January 1999
compare('04', $date->format2('WW'), 'WW (26)');
compare('05', $date->format2('W1'), 'W1 (26)');
compare('05', $date->format2('W4'), 'W4 (26)');
compare('04', $date->format2('W7'), 'W7 (26)');
compare('04', $date->format2('IW'), 'IW (26)');

$date->addDays(1);

// Thursday, 28th January 1999
compare('04', $date->format2('WW'), 'WW (27)');
compare('05', $date->format2('W1'), 'W1 (27)');
compare('05', $date->format2('W4'), 'W4 (27)');
compare('04', $date->format2('W7'), 'W7 (27)');
compare('04', $date->format2('IW'), 'IW (27)');

$date->addDays(1);

// Friday, 29th January 1999
compare('05', $date->format2('WW'), 'WW (28)');
compare('05', $date->format2('W1'), 'W1 (28)');
compare('05', $date->format2('W4'), 'W4 (28)');
compare('04', $date->format2('W7'), 'W7 (28)');
compare('04', $date->format2('IW'), 'IW (28)');

$date->addDays(1);

// Saturday, 30th January 1999
compare('05', $date->format2('WW'), 'WW (29)');
compare('05', $date->format2('W1'), 'W1 (29)');
compare('05', $date->format2('W4'), 'W4 (29)');
compare('04', $date->format2('W7'), 'W7 (29)');
compare('04', $date->format2('IW'), 'IW (29)');

$date->addDays(1);

// Sunday, 31st January 1999
compare('05', $date->format2('WW'), 'WW (30)');
compare('05', $date->format2('W1'), 'W1 (30)');
compare('05', $date->format2('W4'), 'W4 (30)');
compare('04', $date->format2('W7'), 'W7 (30)');
compare('04', $date->format2('IW'), 'IW (30)');

$date->addDays(1);

// Monday, 1st February 1999
compare('05', $date->format2('WW'), 'WW (31)');
compare('05', $date->format2('W1'), 'W1 (31)');
compare('05', $date->format2('W4'), 'W4 (31)');
compare('04', $date->format2('W7'), 'W7 (31)');
compare('05', $date->format2('IW'), 'IW (31)');

$date->addDays(1);

// Tuesday, 2nd February 1999
compare('05', $date->format2('WW'), 'WW (32)');
compare('05', $date->format2('W1'), 'W1 (32)');
compare('05', $date->format2('W4'), 'W4 (32)');
compare('04', $date->format2('W7'), 'W7 (32)');
compare('05', $date->format2('IW'), 'IW (32)');

$date->addDays(1);

// Wednesday, 3rd February 1999
compare('05', $date->format2('WW'), 'WW (33)');
compare('06', $date->format2('W1'), 'W1 (33)');
compare('06', $date->format2('W4'), 'W4 (33)');
compare('05', $date->format2('W7'), 'W7 (33)');
compare('05', $date->format2('IW'), 'IW (33)');

$date->addDays(1);

// Thursday, 4th February 1999
compare('05', $date->format2('WW'), 'WW (34)');
compare('06', $date->format2('W1'), 'W1 (34)');
compare('06', $date->format2('W4'), 'W4 (34)');
compare('05', $date->format2('W7'), 'W7 (34)');
compare('05', $date->format2('IW'), 'IW (34)');

$date->addDays(1);

// Friday, 5th February 1999
compare('06', $date->format2('WW'), 'WW (35)');
compare('06', $date->format2('W1'), 'W1 (35)');
compare('06', $date->format2('W4'), 'W4 (35)');
compare('05', $date->format2('W7'), 'W7 (35)');
compare('05', $date->format2('IW'), 'IW (35)');

$date->addDays(1);

// Saturday, 6th February 1999
compare('06', $date->format2('WW'), 'WW (36)');
compare('06', $date->format2('W1'), 'W1 (36)');
compare('06', $date->format2('W4'), 'W4 (36)');
compare('05', $date->format2('W7'), 'W7 (36)');
compare('05', $date->format2('IW'), 'IW (36)');

$date->addDays(1);

// Sunday, 7th February 1999
compare('06', $date->format2('WW'), 'WW (37)');
compare('06', $date->format2('W1'), 'W1 (37)');
compare('06', $date->format2('W4'), 'W4 (37)');
compare('05', $date->format2('W7'), 'W7 (37)');
compare('05', $date->format2('IW'), 'IW (37)');

$date->addDays(1);

// Monday, 8th February 1999
compare('06', $date->format2('WW'), 'WW (38)');
compare('06', $date->format2('W1'), 'W1 (38)');
compare('06', $date->format2('W4'), 'W4 (38)');
compare('05', $date->format2('W7'), 'W7 (38)');
compare('06', $date->format2('IW'), 'IW (38)');

$date->addDays(1);

// Tuesday, 9th February 1999
compare('06', $date->format2('WW'), 'WW (39)');
compare('06', $date->format2('W1'), 'W1 (39)');
compare('06', $date->format2('W4'), 'W4 (39)');
compare('05', $date->format2('W7'), 'W7 (39)');
compare('06', $date->format2('IW'), 'IW (39)');

$date->addDays(1);

// Wednesday, 10th February 1999
compare('06', $date->format2('WW'), 'WW (40)');
compare('07', $date->format2('W1'), 'W1 (40)');
compare('07', $date->format2('W4'), 'W4 (40)');
compare('06', $date->format2('W7'), 'W7 (40)');
compare('06', $date->format2('IW'), 'IW (40)');

$date->addDays(1);

// Thursday, 11th February 1999
compare('06', $date->format2('WW'), 'WW (41)');
compare('07', $date->format2('W1'), 'W1 (41)');
compare('07', $date->format2('W4'), 'W4 (41)');
compare('06', $date->format2('W7'), 'W7 (41)');
compare('06', $date->format2('IW'), 'IW (41)');

$date->addDays(1);

// Friday, 12th February 1999
compare('07', $date->format2('WW'), 'WW (42)');
compare('07', $date->format2('W1'), 'W1 (42)');
compare('07', $date->format2('W4'), 'W4 (42)');
compare('06', $date->format2('W7'), 'W7 (42)');
compare('06', $date->format2('IW'), 'IW (42)');

$date->addDays(1);

// Saturday, 13th February 1999
compare('07', $date->format2('WW'), 'WW (43)');
compare('07', $date->format2('W1'), 'W1 (43)');
compare('07', $date->format2('W4'), 'W4 (43)');
compare('06', $date->format2('W7'), 'W7 (43)');
compare('06', $date->format2('IW'), 'IW (43)');

$date->addDays(1);

// Sunday, 14th February 1999
compare('07', $date->format2('WW'), 'WW (44)');
compare('07', $date->format2('W1'), 'W1 (44)');
compare('07', $date->format2('W4'), 'W4 (44)');
compare('06', $date->format2('W7'), 'W7 (44)');
compare('06', $date->format2('IW'), 'IW (44)');

$date->addDays(1);

// Monday, 15th February 1999
compare('07', $date->format2('WW'), 'WW (45)');
compare('07', $date->format2('W1'), 'W1 (45)');
compare('07', $date->format2('W4'), 'W4 (45)');
compare('06', $date->format2('W7'), 'W7 (45)');
compare('07', $date->format2('IW'), 'IW (45)');

$date->addDays(1);

// Tuesday, 16th February 1999
compare('07', $date->format2('WW'), 'WW (46)');
compare('07', $date->format2('W1'), 'W1 (46)');
compare('07', $date->format2('W4'), 'W4 (46)');
compare('06', $date->format2('W7'), 'W7 (46)');
compare('07', $date->format2('IW'), 'IW (46)');

$date->addDays(1);

// Wednesday, 17th February 1999
compare('07', $date->format2('WW'), 'WW (47)');
compare('08', $date->format2('W1'), 'W1 (47)');
compare('08', $date->format2('W4'), 'W4 (47)');
compare('07', $date->format2('W7'), 'W7 (47)');
compare('07', $date->format2('IW'), 'IW (47)');

$date->addDays(1);

// Thursday, 18th February 1999
compare('07', $date->format2('WW'), 'WW (48)');
compare('08', $date->format2('W1'), 'W1 (48)');
compare('08', $date->format2('W4'), 'W4 (48)');
compare('07', $date->format2('W7'), 'W7 (48)');
compare('07', $date->format2('IW'), 'IW (48)');

$date->addDays(1);

// Friday, 19th February 1999
compare('08', $date->format2('WW'), 'WW (49)');
compare('08', $date->format2('W1'), 'W1 (49)');
compare('08', $date->format2('W4'), 'W4 (49)');
compare('07', $date->format2('W7'), 'W7 (49)');
compare('07', $date->format2('IW'), 'IW (49)');

$date->addDays(1);

// Saturday, 20th February 1999
compare('08', $date->format2('WW'), 'WW (50)');
compare('08', $date->format2('W1'), 'W1 (50)');
compare('08', $date->format2('W4'), 'W4 (50)');
compare('07', $date->format2('W7'), 'W7 (50)');
compare('07', $date->format2('IW'), 'IW (50)');

$date->addDays(1);

// Sunday, 21st February 1999
compare('08', $date->format2('WW'), 'WW (51)');
compare('08', $date->format2('W1'), 'W1 (51)');
compare('08', $date->format2('W4'), 'W4 (51)');
compare('07', $date->format2('W7'), 'W7 (51)');
compare('07', $date->format2('IW'), 'IW (51)');

$date->addDays(1);

// Monday, 22nd February 1999
compare('08', $date->format2('WW'), 'WW (52)');
compare('08', $date->format2('W1'), 'W1 (52)');
compare('08', $date->format2('W4'), 'W4 (52)');
compare('07', $date->format2('W7'), 'W7 (52)');
compare('08', $date->format2('IW'), 'IW (52)');

$date->addDays(1);

// Tuesday, 23rd February 1999
compare('08', $date->format2('WW'), 'WW (53)');
compare('08', $date->format2('W1'), 'W1 (53)');
compare('08', $date->format2('W4'), 'W4 (53)');
compare('07', $date->format2('W7'), 'W7 (53)');
compare('08', $date->format2('IW'), 'IW (53)');

$date->addDays(1);

// Wednesday, 24th February 1999
compare('08', $date->format2('WW'), 'WW (54)');
compare('09', $date->format2('W1'), 'W1 (54)');
compare('09', $date->format2('W4'), 'W4 (54)');
compare('08', $date->format2('W7'), 'W7 (54)');
compare('08', $date->format2('IW'), 'IW (54)');

$date->addDays(1);

// Thursday, 25th February 1999
compare('08', $date->format2('WW'), 'WW (55)');
compare('09', $date->format2('W1'), 'W1 (55)');
compare('09', $date->format2('W4'), 'W4 (55)');
compare('08', $date->format2('W7'), 'W7 (55)');
compare('08', $date->format2('IW'), 'IW (55)');

$date->addDays(1);

// Friday, 26th February 1999
compare('09', $date->format2('WW'), 'WW (56)');
compare('09', $date->format2('W1'), 'W1 (56)');
compare('09', $date->format2('W4'), 'W4 (56)');
compare('08', $date->format2('W7'), 'W7 (56)');
compare('08', $date->format2('IW'), 'IW (56)');

$date->addDays(1);

// Saturday, 27th February 1999
compare('09', $date->format2('WW'), 'WW (57)');
compare('09', $date->format2('W1'), 'W1 (57)');
compare('09', $date->format2('W4'), 'W4 (57)');
compare('08', $date->format2('W7'), 'W7 (57)');
compare('08', $date->format2('IW'), 'IW (57)');

$date->addDays(1);

// Sunday, 28th February 1999
compare('09', $date->format2('WW'), 'WW (58)');
compare('09', $date->format2('W1'), 'W1 (58)');
compare('09', $date->format2('W4'), 'W4 (58)');
compare('08', $date->format2('W7'), 'W7 (58)');
compare('08', $date->format2('IW'), 'IW (58)');

$date->addDays(1);

// Monday, 1st March 1999
compare('09', $date->format2('WW'), 'WW (59)');
compare('09', $date->format2('W1'), 'W1 (59)');
compare('09', $date->format2('W4'), 'W4 (59)');
compare('08', $date->format2('W7'), 'W7 (59)');
compare('09', $date->format2('IW'), 'IW (59)');

$date->addDays(1);

// Tuesday, 2nd March 1999
compare('09', $date->format2('WW'), 'WW (60)');
compare('09', $date->format2('W1'), 'W1 (60)');
compare('09', $date->format2('W4'), 'W4 (60)');
compare('08', $date->format2('W7'), 'W7 (60)');
compare('09', $date->format2('IW'), 'IW (60)');

$date->addDays(1);

// Wednesday, 3rd March 1999
compare('09', $date->format2('WW'), 'WW (61)');
compare('10', $date->format2('W1'), 'W1 (61)');
compare('10', $date->format2('W4'), 'W4 (61)');
compare('09', $date->format2('W7'), 'W7 (61)');
compare('09', $date->format2('IW'), 'IW (61)');

$date->addDays(1);

// Thursday, 4th March 1999
compare('09', $date->format2('WW'), 'WW (62)');
compare('10', $date->format2('W1'), 'W1 (62)');
compare('10', $date->format2('W4'), 'W4 (62)');
compare('09', $date->format2('W7'), 'W7 (62)');
compare('09', $date->format2('IW'), 'IW (62)');

$date->addDays(1);

// Friday, 5th March 1999
compare('10', $date->format2('WW'), 'WW (63)');
compare('10', $date->format2('W1'), 'W1 (63)');
compare('10', $date->format2('W4'), 'W4 (63)');
compare('09', $date->format2('W7'), 'W7 (63)');
compare('09', $date->format2('IW'), 'IW (63)');

$date->addDays(1);

// Saturday, 6th March 1999
compare('10', $date->format2('WW'), 'WW (64)');
compare('10', $date->format2('W1'), 'W1 (64)');
compare('10', $date->format2('W4'), 'W4 (64)');
compare('09', $date->format2('W7'), 'W7 (64)');
compare('09', $date->format2('IW'), 'IW (64)');

$date->addDays(1);

// Sunday, 7th March 1999
compare('10', $date->format2('WW'), 'WW (65)');
compare('10', $date->format2('W1'), 'W1 (65)');
compare('10', $date->format2('W4'), 'W4 (65)');
compare('09', $date->format2('W7'), 'W7 (65)');
compare('09', $date->format2('IW'), 'IW (65)');

$date->addDays(1);

// Monday, 8th March 1999
compare('10', $date->format2('WW'), 'WW (66)');
compare('10', $date->format2('W1'), 'W1 (66)');
compare('10', $date->format2('W4'), 'W4 (66)');
compare('09', $date->format2('W7'), 'W7 (66)');
compare('10', $date->format2('IW'), 'IW (66)');

$date->addDays(1);

// Tuesday, 9th March 1999
compare('10', $date->format2('WW'), 'WW (67)');
compare('10', $date->format2('W1'), 'W1 (67)');
compare('10', $date->format2('W4'), 'W4 (67)');
compare('09', $date->format2('W7'), 'W7 (67)');
compare('10', $date->format2('IW'), 'IW (67)');

$date->addDays(1);

// Wednesday, 10th March 1999
compare('10', $date->format2('WW'), 'WW (68)');
compare('11', $date->format2('W1'), 'W1 (68)');
compare('11', $date->format2('W4'), 'W4 (68)');
compare('10', $date->format2('W7'), 'W7 (68)');
compare('10', $date->format2('IW'), 'IW (68)');

$date->addDays(1);

// Thursday, 11th March 1999
compare('10', $date->format2('WW'), 'WW (69)');
compare('11', $date->format2('W1'), 'W1 (69)');
compare('11', $date->format2('W4'), 'W4 (69)');
compare('10', $date->format2('W7'), 'W7 (69)');
compare('10', $date->format2('IW'), 'IW (69)');

$date->addDays(1);

// Friday, 12th March 1999
compare('11', $date->format2('WW'), 'WW (70)');
compare('11', $date->format2('W1'), 'W1 (70)');
compare('11', $date->format2('W4'), 'W4 (70)');
compare('10', $date->format2('W7'), 'W7 (70)');
compare('10', $date->format2('IW'), 'IW (70)');

$date->addDays(1);

// Saturday, 13th March 1999
compare('11', $date->format2('WW'), 'WW (71)');
compare('11', $date->format2('W1'), 'W1 (71)');
compare('11', $date->format2('W4'), 'W4 (71)');
compare('10', $date->format2('W7'), 'W7 (71)');
compare('10', $date->format2('IW'), 'IW (71)');

$date->addDays(1);

// Sunday, 14th March 1999
compare('11', $date->format2('WW'), 'WW (72)');
compare('11', $date->format2('W1'), 'W1 (72)');
compare('11', $date->format2('W4'), 'W4 (72)');
compare('10', $date->format2('W7'), 'W7 (72)');
compare('10', $date->format2('IW'), 'IW (72)');

$date->addDays(1);

// Monday, 15th March 1999
compare('11', $date->format2('WW'), 'WW (73)');
compare('11', $date->format2('W1'), 'W1 (73)');
compare('11', $date->format2('W4'), 'W4 (73)');
compare('10', $date->format2('W7'), 'W7 (73)');
compare('11', $date->format2('IW'), 'IW (73)');

$date->addDays(1);

// Tuesday, 16th March 1999
compare('11', $date->format2('WW'), 'WW (74)');
compare('11', $date->format2('W1'), 'W1 (74)');
compare('11', $date->format2('W4'), 'W4 (74)');
compare('10', $date->format2('W7'), 'W7 (74)');
compare('11', $date->format2('IW'), 'IW (74)');

$date->addDays(1);

// Wednesday, 17th March 1999
compare('11', $date->format2('WW'), 'WW (75)');
compare('12', $date->format2('W1'), 'W1 (75)');
compare('12', $date->format2('W4'), 'W4 (75)');
compare('11', $date->format2('W7'), 'W7 (75)');
compare('11', $date->format2('IW'), 'IW (75)');

$date->addDays(1);

// Thursday, 18th March 1999
compare('11', $date->format2('WW'), 'WW (76)');
compare('12', $date->format2('W1'), 'W1 (76)');
compare('12', $date->format2('W4'), 'W4 (76)');
compare('11', $date->format2('W7'), 'W7 (76)');
compare('11', $date->format2('IW'), 'IW (76)');

$date->addDays(1);

// Friday, 19th March 1999
compare('12', $date->format2('WW'), 'WW (77)');
compare('12', $date->format2('W1'), 'W1 (77)');
compare('12', $date->format2('W4'), 'W4 (77)');
compare('11', $date->format2('W7'), 'W7 (77)');
compare('11', $date->format2('IW'), 'IW (77)');

$date->addDays(1);

// Saturday, 20th March 1999
compare('12', $date->format2('WW'), 'WW (78)');
compare('12', $date->format2('W1'), 'W1 (78)');
compare('12', $date->format2('W4'), 'W4 (78)');
compare('11', $date->format2('W7'), 'W7 (78)');
compare('11', $date->format2('IW'), 'IW (78)');

$date->addDays(1);

// Sunday, 21st March 1999
compare('12', $date->format2('WW'), 'WW (79)');
compare('12', $date->format2('W1'), 'W1 (79)');
compare('12', $date->format2('W4'), 'W4 (79)');
compare('11', $date->format2('W7'), 'W7 (79)');
compare('11', $date->format2('IW'), 'IW (79)');

$date->addDays(1);

// Monday, 22nd March 1999
compare('12', $date->format2('WW'), 'WW (80)');
compare('12', $date->format2('W1'), 'W1 (80)');
compare('12', $date->format2('W4'), 'W4 (80)');
compare('11', $date->format2('W7'), 'W7 (80)');
compare('12', $date->format2('IW'), 'IW (80)');

$date->addDays(1);

// Tuesday, 23rd March 1999
compare('12', $date->format2('WW'), 'WW (81)');
compare('12', $date->format2('W1'), 'W1 (81)');
compare('12', $date->format2('W4'), 'W4 (81)');
compare('11', $date->format2('W7'), 'W7 (81)');
compare('12', $date->format2('IW'), 'IW (81)');

$date->addDays(1);

// Wednesday, 24th March 1999
compare('12', $date->format2('WW'), 'WW (82)');
compare('13', $date->format2('W1'), 'W1 (82)');
compare('13', $date->format2('W4'), 'W4 (82)');
compare('12', $date->format2('W7'), 'W7 (82)');
compare('12', $date->format2('IW'), 'IW (82)');

$date->addDays(1);

// Thursday, 25th March 1999
compare('12', $date->format2('WW'), 'WW (83)');
compare('13', $date->format2('W1'), 'W1 (83)');
compare('13', $date->format2('W4'), 'W4 (83)');
compare('12', $date->format2('W7'), 'W7 (83)');
compare('12', $date->format2('IW'), 'IW (83)');

$date->addDays(1);

// Friday, 26th March 1999
compare('13', $date->format2('WW'), 'WW (84)');
compare('13', $date->format2('W1'), 'W1 (84)');
compare('13', $date->format2('W4'), 'W4 (84)');
compare('12', $date->format2('W7'), 'W7 (84)');
compare('12', $date->format2('IW'), 'IW (84)');

$date->addDays(1);

// Saturday, 27th March 1999
compare('13', $date->format2('WW'), 'WW (85)');
compare('13', $date->format2('W1'), 'W1 (85)');
compare('13', $date->format2('W4'), 'W4 (85)');
compare('12', $date->format2('W7'), 'W7 (85)');
compare('12', $date->format2('IW'), 'IW (85)');

$date->addDays(1);

// Sunday, 28th March 1999
compare('13', $date->format2('WW'), 'WW (86)');
compare('13', $date->format2('W1'), 'W1 (86)');
compare('13', $date->format2('W4'), 'W4 (86)');
compare('12', $date->format2('W7'), 'W7 (86)');
compare('12', $date->format2('IW'), 'IW (86)');

$date->addDays(1);

// Monday, 29th March 1999
compare('13', $date->format2('WW'), 'WW (87)');
compare('13', $date->format2('W1'), 'W1 (87)');
compare('13', $date->format2('W4'), 'W4 (87)');
compare('12', $date->format2('W7'), 'W7 (87)');
compare('13', $date->format2('IW'), 'IW (87)');

$date->addDays(1);

// Tuesday, 30th March 1999
compare('13', $date->format2('WW'), 'WW (88)');
compare('13', $date->format2('W1'), 'W1 (88)');
compare('13', $date->format2('W4'), 'W4 (88)');
compare('12', $date->format2('W7'), 'W7 (88)');
compare('13', $date->format2('IW'), 'IW (88)');

$date->addDays(1);

// Wednesday, 31st March 1999
compare('13', $date->format2('WW'), 'WW (89)');
compare('14', $date->format2('W1'), 'W1 (89)');
compare('14', $date->format2('W4'), 'W4 (89)');
compare('13', $date->format2('W7'), 'W7 (89)');
compare('13', $date->format2('IW'), 'IW (89)');

$date->addDays(1);

// Thursday, 1st April 1999
compare('13', $date->format2('WW'), 'WW (90)');
compare('14', $date->format2('W1'), 'W1 (90)');
compare('14', $date->format2('W4'), 'W4 (90)');
compare('13', $date->format2('W7'), 'W7 (90)');
compare('13', $date->format2('IW'), 'IW (90)');

$date->addDays(1);

// Friday, 2nd April 1999
compare('14', $date->format2('WW'), 'WW (91)');
compare('14', $date->format2('W1'), 'W1 (91)');
compare('14', $date->format2('W4'), 'W4 (91)');
compare('13', $date->format2('W7'), 'W7 (91)');
compare('13', $date->format2('IW'), 'IW (91)');

$date->addDays(1);

// Saturday, 3rd April 1999
compare('14', $date->format2('WW'), 'WW (92)');
compare('14', $date->format2('W1'), 'W1 (92)');
compare('14', $date->format2('W4'), 'W4 (92)');
compare('13', $date->format2('W7'), 'W7 (92)');
compare('13', $date->format2('IW'), 'IW (92)');

$date->addDays(1);

// Sunday, 4th April 1999
compare('14', $date->format2('WW'), 'WW (93)');
compare('14', $date->format2('W1'), 'W1 (93)');
compare('14', $date->format2('W4'), 'W4 (93)');
compare('13', $date->format2('W7'), 'W7 (93)');
compare('13', $date->format2('IW'), 'IW (93)');

$date->addDays(1);

// Monday, 5th April 1999
compare('14', $date->format2('WW'), 'WW (94)');
compare('14', $date->format2('W1'), 'W1 (94)');
compare('14', $date->format2('W4'), 'W4 (94)');
compare('13', $date->format2('W7'), 'W7 (94)');
compare('14', $date->format2('IW'), 'IW (94)');

$date->addDays(1);

// Tuesday, 6th April 1999
compare('14', $date->format2('WW'), 'WW (95)');
compare('14', $date->format2('W1'), 'W1 (95)');
compare('14', $date->format2('W4'), 'W4 (95)');
compare('13', $date->format2('W7'), 'W7 (95)');
compare('14', $date->format2('IW'), 'IW (95)');

$date->addDays(1);

// Wednesday, 7th April 1999
compare('14', $date->format2('WW'), 'WW (96)');
compare('15', $date->format2('W1'), 'W1 (96)');
compare('15', $date->format2('W4'), 'W4 (96)');
compare('14', $date->format2('W7'), 'W7 (96)');
compare('14', $date->format2('IW'), 'IW (96)');

$date->addDays(1);

// Thursday, 8th April 1999
compare('14', $date->format2('WW'), 'WW (97)');
compare('15', $date->format2('W1'), 'W1 (97)');
compare('15', $date->format2('W4'), 'W4 (97)');
compare('14', $date->format2('W7'), 'W7 (97)');
compare('14', $date->format2('IW'), 'IW (97)');

$date->addDays(1);

// Friday, 9th April 1999
compare('15', $date->format2('WW'), 'WW (98)');
compare('15', $date->format2('W1'), 'W1 (98)');
compare('15', $date->format2('W4'), 'W4 (98)');
compare('14', $date->format2('W7'), 'W7 (98)');
compare('14', $date->format2('IW'), 'IW (98)');

$date->addDays(1);

// Saturday, 10th April 1999
compare('15', $date->format2('WW'), 'WW (99)');
compare('15', $date->format2('W1'), 'W1 (99)');
compare('15', $date->format2('W4'), 'W4 (99)');
compare('14', $date->format2('W7'), 'W7 (99)');
compare('14', $date->format2('IW'), 'IW (99)');

$date->addDays(1);

// Sunday, 11th April 1999
compare('15', $date->format2('WW'), 'WW (100)');
compare('15', $date->format2('W1'), 'W1 (100)');
compare('15', $date->format2('W4'), 'W4 (100)');
compare('14', $date->format2('W7'), 'W7 (100)');
compare('14', $date->format2('IW'), 'IW (100)');

$date->addDays(1);

// Monday, 12th April 1999
compare('15', $date->format2('WW'), 'WW (101)');
compare('15', $date->format2('W1'), 'W1 (101)');
compare('15', $date->format2('W4'), 'W4 (101)');
compare('14', $date->format2('W7'), 'W7 (101)');
compare('15', $date->format2('IW'), 'IW (101)');

$date->addDays(1);

// Tuesday, 13th April 1999
compare('15', $date->format2('WW'), 'WW (102)');
compare('15', $date->format2('W1'), 'W1 (102)');
compare('15', $date->format2('W4'), 'W4 (102)');
compare('14', $date->format2('W7'), 'W7 (102)');
compare('15', $date->format2('IW'), 'IW (102)');

$date->addDays(1);

// Wednesday, 14th April 1999
compare('15', $date->format2('WW'), 'WW (103)');
compare('16', $date->format2('W1'), 'W1 (103)');
compare('16', $date->format2('W4'), 'W4 (103)');
compare('15', $date->format2('W7'), 'W7 (103)');
compare('15', $date->format2('IW'), 'IW (103)');

$date->addDays(1);

// Thursday, 15th April 1999
compare('15', $date->format2('WW'), 'WW (104)');
compare('16', $date->format2('W1'), 'W1 (104)');
compare('16', $date->format2('W4'), 'W4 (104)');
compare('15', $date->format2('W7'), 'W7 (104)');
compare('15', $date->format2('IW'), 'IW (104)');

$date->addDays(1);

// Friday, 16th April 1999
compare('16', $date->format2('WW'), 'WW (105)');
compare('16', $date->format2('W1'), 'W1 (105)');
compare('16', $date->format2('W4'), 'W4 (105)');
compare('15', $date->format2('W7'), 'W7 (105)');
compare('15', $date->format2('IW'), 'IW (105)');

$date->addDays(1);

// Saturday, 17th April 1999
compare('16', $date->format2('WW'), 'WW (106)');
compare('16', $date->format2('W1'), 'W1 (106)');
compare('16', $date->format2('W4'), 'W4 (106)');
compare('15', $date->format2('W7'), 'W7 (106)');
compare('15', $date->format2('IW'), 'IW (106)');

$date->addDays(1);

// Sunday, 18th April 1999
compare('16', $date->format2('WW'), 'WW (107)');
compare('16', $date->format2('W1'), 'W1 (107)');
compare('16', $date->format2('W4'), 'W4 (107)');
compare('15', $date->format2('W7'), 'W7 (107)');
compare('15', $date->format2('IW'), 'IW (107)');

$date->addDays(1);

// Monday, 19th April 1999
compare('16', $date->format2('WW'), 'WW (108)');
compare('16', $date->format2('W1'), 'W1 (108)');
compare('16', $date->format2('W4'), 'W4 (108)');
compare('15', $date->format2('W7'), 'W7 (108)');
compare('16', $date->format2('IW'), 'IW (108)');

$date->addDays(1);

// Tuesday, 20th April 1999
compare('16', $date->format2('WW'), 'WW (109)');
compare('16', $date->format2('W1'), 'W1 (109)');
compare('16', $date->format2('W4'), 'W4 (109)');
compare('15', $date->format2('W7'), 'W7 (109)');
compare('16', $date->format2('IW'), 'IW (109)');

$date->addDays(1);

// Wednesday, 21st April 1999
compare('16', $date->format2('WW'), 'WW (110)');
compare('17', $date->format2('W1'), 'W1 (110)');
compare('17', $date->format2('W4'), 'W4 (110)');
compare('16', $date->format2('W7'), 'W7 (110)');
compare('16', $date->format2('IW'), 'IW (110)');

$date->addDays(1);

// Thursday, 22nd April 1999
compare('16', $date->format2('WW'), 'WW (111)');
compare('17', $date->format2('W1'), 'W1 (111)');
compare('17', $date->format2('W4'), 'W4 (111)');
compare('16', $date->format2('W7'), 'W7 (111)');
compare('16', $date->format2('IW'), 'IW (111)');

$date->addDays(1);

// Friday, 23rd April 1999
compare('17', $date->format2('WW'), 'WW (112)');
compare('17', $date->format2('W1'), 'W1 (112)');
compare('17', $date->format2('W4'), 'W4 (112)');
compare('16', $date->format2('W7'), 'W7 (112)');
compare('16', $date->format2('IW'), 'IW (112)');

$date->addDays(1);

// Saturday, 24th April 1999
compare('17', $date->format2('WW'), 'WW (113)');
compare('17', $date->format2('W1'), 'W1 (113)');
compare('17', $date->format2('W4'), 'W4 (113)');
compare('16', $date->format2('W7'), 'W7 (113)');
compare('16', $date->format2('IW'), 'IW (113)');

$date->addDays(1);

// Sunday, 25th April 1999
compare('17', $date->format2('WW'), 'WW (114)');
compare('17', $date->format2('W1'), 'W1 (114)');
compare('17', $date->format2('W4'), 'W4 (114)');
compare('16', $date->format2('W7'), 'W7 (114)');
compare('16', $date->format2('IW'), 'IW (114)');

$date->addDays(1);

// Monday, 26th April 1999
compare('17', $date->format2('WW'), 'WW (115)');
compare('17', $date->format2('W1'), 'W1 (115)');
compare('17', $date->format2('W4'), 'W4 (115)');
compare('16', $date->format2('W7'), 'W7 (115)');
compare('17', $date->format2('IW'), 'IW (115)');

$date->addDays(1);

// Tuesday, 27th April 1999
compare('17', $date->format2('WW'), 'WW (116)');
compare('17', $date->format2('W1'), 'W1 (116)');
compare('17', $date->format2('W4'), 'W4 (116)');
compare('16', $date->format2('W7'), 'W7 (116)');
compare('17', $date->format2('IW'), 'IW (116)');

$date->addDays(1);

// Wednesday, 28th April 1999
compare('17', $date->format2('WW'), 'WW (117)');
compare('18', $date->format2('W1'), 'W1 (117)');
compare('18', $date->format2('W4'), 'W4 (117)');
compare('17', $date->format2('W7'), 'W7 (117)');
compare('17', $date->format2('IW'), 'IW (117)');

$date->addDays(1);

// Thursday, 29th April 1999
compare('17', $date->format2('WW'), 'WW (118)');
compare('18', $date->format2('W1'), 'W1 (118)');
compare('18', $date->format2('W4'), 'W4 (118)');
compare('17', $date->format2('W7'), 'W7 (118)');
compare('17', $date->format2('IW'), 'IW (118)');

$date->addDays(1);

// Friday, 30th April 1999
compare('18', $date->format2('WW'), 'WW (119)');
compare('18', $date->format2('W1'), 'W1 (119)');
compare('18', $date->format2('W4'), 'W4 (119)');
compare('17', $date->format2('W7'), 'W7 (119)');
compare('17', $date->format2('IW'), 'IW (119)');

$date->addDays(1);

// Saturday, 1st May 1999
compare('18', $date->format2('WW'), 'WW (120)');
compare('18', $date->format2('W1'), 'W1 (120)');
compare('18', $date->format2('W4'), 'W4 (120)');
compare('17', $date->format2('W7'), 'W7 (120)');
compare('17', $date->format2('IW'), 'IW (120)');

$date->addDays(1);

// Sunday, 2nd May 1999
compare('18', $date->format2('WW'), 'WW (121)');
compare('18', $date->format2('W1'), 'W1 (121)');
compare('18', $date->format2('W4'), 'W4 (121)');
compare('17', $date->format2('W7'), 'W7 (121)');
compare('17', $date->format2('IW'), 'IW (121)');

$date->addDays(1);

// Monday, 3rd May 1999
compare('18', $date->format2('WW'), 'WW (122)');
compare('18', $date->format2('W1'), 'W1 (122)');
compare('18', $date->format2('W4'), 'W4 (122)');
compare('17', $date->format2('W7'), 'W7 (122)');
compare('18', $date->format2('IW'), 'IW (122)');

$date->addDays(1);

// Tuesday, 4th May 1999
compare('18', $date->format2('WW'), 'WW (123)');
compare('18', $date->format2('W1'), 'W1 (123)');
compare('18', $date->format2('W4'), 'W4 (123)');
compare('17', $date->format2('W7'), 'W7 (123)');
compare('18', $date->format2('IW'), 'IW (123)');

$date->addDays(1);

// Wednesday, 5th May 1999
compare('18', $date->format2('WW'), 'WW (124)');
compare('19', $date->format2('W1'), 'W1 (124)');
compare('19', $date->format2('W4'), 'W4 (124)');
compare('18', $date->format2('W7'), 'W7 (124)');
compare('18', $date->format2('IW'), 'IW (124)');

$date->addDays(1);

// Thursday, 6th May 1999
compare('18', $date->format2('WW'), 'WW (125)');
compare('19', $date->format2('W1'), 'W1 (125)');
compare('19', $date->format2('W4'), 'W4 (125)');
compare('18', $date->format2('W7'), 'W7 (125)');
compare('18', $date->format2('IW'), 'IW (125)');

$date->addDays(1);

// Friday, 7th May 1999
compare('19', $date->format2('WW'), 'WW (126)');
compare('19', $date->format2('W1'), 'W1 (126)');
compare('19', $date->format2('W4'), 'W4 (126)');
compare('18', $date->format2('W7'), 'W7 (126)');
compare('18', $date->format2('IW'), 'IW (126)');

$date->addDays(1);

// Saturday, 8th May 1999
compare('19', $date->format2('WW'), 'WW (127)');
compare('19', $date->format2('W1'), 'W1 (127)');
compare('19', $date->format2('W4'), 'W4 (127)');
compare('18', $date->format2('W7'), 'W7 (127)');
compare('18', $date->format2('IW'), 'IW (127)');

$date->addDays(1);

// Sunday, 9th May 1999
compare('19', $date->format2('WW'), 'WW (128)');
compare('19', $date->format2('W1'), 'W1 (128)');
compare('19', $date->format2('W4'), 'W4 (128)');
compare('18', $date->format2('W7'), 'W7 (128)');
compare('18', $date->format2('IW'), 'IW (128)');

$date->addDays(1);

// Monday, 10th May 1999
compare('19', $date->format2('WW'), 'WW (129)');
compare('19', $date->format2('W1'), 'W1 (129)');
compare('19', $date->format2('W4'), 'W4 (129)');
compare('18', $date->format2('W7'), 'W7 (129)');
compare('19', $date->format2('IW'), 'IW (129)');

$date->addDays(1);

// Tuesday, 11th May 1999
compare('19', $date->format2('WW'), 'WW (130)');
compare('19', $date->format2('W1'), 'W1 (130)');
compare('19', $date->format2('W4'), 'W4 (130)');
compare('18', $date->format2('W7'), 'W7 (130)');
compare('19', $date->format2('IW'), 'IW (130)');

$date->addDays(1);

// Wednesday, 12th May 1999
compare('19', $date->format2('WW'), 'WW (131)');
compare('20', $date->format2('W1'), 'W1 (131)');
compare('20', $date->format2('W4'), 'W4 (131)');
compare('19', $date->format2('W7'), 'W7 (131)');
compare('19', $date->format2('IW'), 'IW (131)');

$date->addDays(1);

// Thursday, 13th May 1999
compare('19', $date->format2('WW'), 'WW (132)');
compare('20', $date->format2('W1'), 'W1 (132)');
compare('20', $date->format2('W4'), 'W4 (132)');
compare('19', $date->format2('W7'), 'W7 (132)');
compare('19', $date->format2('IW'), 'IW (132)');

$date->addDays(1);

// Friday, 14th May 1999
compare('20', $date->format2('WW'), 'WW (133)');
compare('20', $date->format2('W1'), 'W1 (133)');
compare('20', $date->format2('W4'), 'W4 (133)');
compare('19', $date->format2('W7'), 'W7 (133)');
compare('19', $date->format2('IW'), 'IW (133)');

$date->addDays(1);

// Saturday, 15th May 1999
compare('20', $date->format2('WW'), 'WW (134)');
compare('20', $date->format2('W1'), 'W1 (134)');
compare('20', $date->format2('W4'), 'W4 (134)');
compare('19', $date->format2('W7'), 'W7 (134)');
compare('19', $date->format2('IW'), 'IW (134)');

$date->addDays(1);

// Sunday, 16th May 1999
compare('20', $date->format2('WW'), 'WW (135)');
compare('20', $date->format2('W1'), 'W1 (135)');
compare('20', $date->format2('W4'), 'W4 (135)');
compare('19', $date->format2('W7'), 'W7 (135)');
compare('19', $date->format2('IW'), 'IW (135)');

$date->addDays(1);

// Monday, 17th May 1999
compare('20', $date->format2('WW'), 'WW (136)');
compare('20', $date->format2('W1'), 'W1 (136)');
compare('20', $date->format2('W4'), 'W4 (136)');
compare('19', $date->format2('W7'), 'W7 (136)');
compare('20', $date->format2('IW'), 'IW (136)');

$date->addDays(1);

// Tuesday, 18th May 1999
compare('20', $date->format2('WW'), 'WW (137)');
compare('20', $date->format2('W1'), 'W1 (137)');
compare('20', $date->format2('W4'), 'W4 (137)');
compare('19', $date->format2('W7'), 'W7 (137)');
compare('20', $date->format2('IW'), 'IW (137)');

$date->addDays(1);

// Wednesday, 19th May 1999
compare('20', $date->format2('WW'), 'WW (138)');
compare('21', $date->format2('W1'), 'W1 (138)');
compare('21', $date->format2('W4'), 'W4 (138)');
compare('20', $date->format2('W7'), 'W7 (138)');
compare('20', $date->format2('IW'), 'IW (138)');

$date->addDays(1);

// Thursday, 20th May 1999
compare('20', $date->format2('WW'), 'WW (139)');
compare('21', $date->format2('W1'), 'W1 (139)');
compare('21', $date->format2('W4'), 'W4 (139)');
compare('20', $date->format2('W7'), 'W7 (139)');
compare('20', $date->format2('IW'), 'IW (139)');

$date->addDays(1);

// Friday, 21st May 1999
compare('21', $date->format2('WW'), 'WW (140)');
compare('21', $date->format2('W1'), 'W1 (140)');
compare('21', $date->format2('W4'), 'W4 (140)');
compare('20', $date->format2('W7'), 'W7 (140)');
compare('20', $date->format2('IW'), 'IW (140)');

$date->addDays(1);

// Saturday, 22nd May 1999
compare('21', $date->format2('WW'), 'WW (141)');
compare('21', $date->format2('W1'), 'W1 (141)');
compare('21', $date->format2('W4'), 'W4 (141)');
compare('20', $date->format2('W7'), 'W7 (141)');
compare('20', $date->format2('IW'), 'IW (141)');

$date->addDays(1);

// Sunday, 23rd May 1999
compare('21', $date->format2('WW'), 'WW (142)');
compare('21', $date->format2('W1'), 'W1 (142)');
compare('21', $date->format2('W4'), 'W4 (142)');
compare('20', $date->format2('W7'), 'W7 (142)');
compare('20', $date->format2('IW'), 'IW (142)');

$date->addDays(1);

// Monday, 24th May 1999
compare('21', $date->format2('WW'), 'WW (143)');
compare('21', $date->format2('W1'), 'W1 (143)');
compare('21', $date->format2('W4'), 'W4 (143)');
compare('20', $date->format2('W7'), 'W7 (143)');
compare('21', $date->format2('IW'), 'IW (143)');

$date->addDays(1);

// Tuesday, 25th May 1999
compare('21', $date->format2('WW'), 'WW (144)');
compare('21', $date->format2('W1'), 'W1 (144)');
compare('21', $date->format2('W4'), 'W4 (144)');
compare('20', $date->format2('W7'), 'W7 (144)');
compare('21', $date->format2('IW'), 'IW (144)');

$date->addDays(1);

// Wednesday, 26th May 1999
compare('21', $date->format2('WW'), 'WW (145)');
compare('22', $date->format2('W1'), 'W1 (145)');
compare('22', $date->format2('W4'), 'W4 (145)');
compare('21', $date->format2('W7'), 'W7 (145)');
compare('21', $date->format2('IW'), 'IW (145)');

$date->addDays(1);

// Thursday, 27th May 1999
compare('21', $date->format2('WW'), 'WW (146)');
compare('22', $date->format2('W1'), 'W1 (146)');
compare('22', $date->format2('W4'), 'W4 (146)');
compare('21', $date->format2('W7'), 'W7 (146)');
compare('21', $date->format2('IW'), 'IW (146)');

$date->addDays(1);

// Friday, 28th May 1999
compare('22', $date->format2('WW'), 'WW (147)');
compare('22', $date->format2('W1'), 'W1 (147)');
compare('22', $date->format2('W4'), 'W4 (147)');
compare('21', $date->format2('W7'), 'W7 (147)');
compare('21', $date->format2('IW'), 'IW (147)');

$date->addDays(1);

// Saturday, 29th May 1999
compare('22', $date->format2('WW'), 'WW (148)');
compare('22', $date->format2('W1'), 'W1 (148)');
compare('22', $date->format2('W4'), 'W4 (148)');
compare('21', $date->format2('W7'), 'W7 (148)');
compare('21', $date->format2('IW'), 'IW (148)');

$date->addDays(1);

// Sunday, 30th May 1999
compare('22', $date->format2('WW'), 'WW (149)');
compare('22', $date->format2('W1'), 'W1 (149)');
compare('22', $date->format2('W4'), 'W4 (149)');
compare('21', $date->format2('W7'), 'W7 (149)');
compare('21', $date->format2('IW'), 'IW (149)');

$date->addDays(1);

// Monday, 31st May 1999
compare('22', $date->format2('WW'), 'WW (150)');
compare('22', $date->format2('W1'), 'W1 (150)');
compare('22', $date->format2('W4'), 'W4 (150)');
compare('21', $date->format2('W7'), 'W7 (150)');
compare('22', $date->format2('IW'), 'IW (150)');

$date->addDays(1);

// Tuesday, 1st June 1999
compare('22', $date->format2('WW'), 'WW (151)');
compare('22', $date->format2('W1'), 'W1 (151)');
compare('22', $date->format2('W4'), 'W4 (151)');
compare('21', $date->format2('W7'), 'W7 (151)');
compare('22', $date->format2('IW'), 'IW (151)');

$date->addDays(1);

// Wednesday, 2nd June 1999
compare('22', $date->format2('WW'), 'WW (152)');
compare('23', $date->format2('W1'), 'W1 (152)');
compare('23', $date->format2('W4'), 'W4 (152)');
compare('22', $date->format2('W7'), 'W7 (152)');
compare('22', $date->format2('IW'), 'IW (152)');

$date->addDays(1);

// Thursday, 3rd June 1999
compare('22', $date->format2('WW'), 'WW (153)');
compare('23', $date->format2('W1'), 'W1 (153)');
compare('23', $date->format2('W4'), 'W4 (153)');
compare('22', $date->format2('W7'), 'W7 (153)');
compare('22', $date->format2('IW'), 'IW (153)');

$date->addDays(1);

// Friday, 4th June 1999
compare('23', $date->format2('WW'), 'WW (154)');
compare('23', $date->format2('W1'), 'W1 (154)');
compare('23', $date->format2('W4'), 'W4 (154)');
compare('22', $date->format2('W7'), 'W7 (154)');
compare('22', $date->format2('IW'), 'IW (154)');

$date->addDays(1);

// Saturday, 5th June 1999
compare('23', $date->format2('WW'), 'WW (155)');
compare('23', $date->format2('W1'), 'W1 (155)');
compare('23', $date->format2('W4'), 'W4 (155)');
compare('22', $date->format2('W7'), 'W7 (155)');
compare('22', $date->format2('IW'), 'IW (155)');

$date->addDays(1);

// Sunday, 6th June 1999
compare('23', $date->format2('WW'), 'WW (156)');
compare('23', $date->format2('W1'), 'W1 (156)');
compare('23', $date->format2('W4'), 'W4 (156)');
compare('22', $date->format2('W7'), 'W7 (156)');
compare('22', $date->format2('IW'), 'IW (156)');

$date->addDays(1);

// Monday, 7th June 1999
compare('23', $date->format2('WW'), 'WW (157)');
compare('23', $date->format2('W1'), 'W1 (157)');
compare('23', $date->format2('W4'), 'W4 (157)');
compare('22', $date->format2('W7'), 'W7 (157)');
compare('23', $date->format2('IW'), 'IW (157)');

$date->addDays(1);

// Tuesday, 8th June 1999
compare('23', $date->format2('WW'), 'WW (158)');
compare('23', $date->format2('W1'), 'W1 (158)');
compare('23', $date->format2('W4'), 'W4 (158)');
compare('22', $date->format2('W7'), 'W7 (158)');
compare('23', $date->format2('IW'), 'IW (158)');

$date->addDays(1);

// Wednesday, 9th June 1999
compare('23', $date->format2('WW'), 'WW (159)');
compare('24', $date->format2('W1'), 'W1 (159)');
compare('24', $date->format2('W4'), 'W4 (159)');
compare('23', $date->format2('W7'), 'W7 (159)');
compare('23', $date->format2('IW'), 'IW (159)');

$date->addDays(1);

// Thursday, 10th June 1999
compare('23', $date->format2('WW'), 'WW (160)');
compare('24', $date->format2('W1'), 'W1 (160)');
compare('24', $date->format2('W4'), 'W4 (160)');
compare('23', $date->format2('W7'), 'W7 (160)');
compare('23', $date->format2('IW'), 'IW (160)');

$date->addDays(1);

// Friday, 11th June 1999
compare('24', $date->format2('WW'), 'WW (161)');
compare('24', $date->format2('W1'), 'W1 (161)');
compare('24', $date->format2('W4'), 'W4 (161)');
compare('23', $date->format2('W7'), 'W7 (161)');
compare('23', $date->format2('IW'), 'IW (161)');

$date->addDays(1);

// Saturday, 12th June 1999
compare('24', $date->format2('WW'), 'WW (162)');
compare('24', $date->format2('W1'), 'W1 (162)');
compare('24', $date->format2('W4'), 'W4 (162)');
compare('23', $date->format2('W7'), 'W7 (162)');
compare('23', $date->format2('IW'), 'IW (162)');

$date->addDays(1);

// Sunday, 13th June 1999
compare('24', $date->format2('WW'), 'WW (163)');
compare('24', $date->format2('W1'), 'W1 (163)');
compare('24', $date->format2('W4'), 'W4 (163)');
compare('23', $date->format2('W7'), 'W7 (163)');
compare('23', $date->format2('IW'), 'IW (163)');

$date->addDays(1);

// Monday, 14th June 1999
compare('24', $date->format2('WW'), 'WW (164)');
compare('24', $date->format2('W1'), 'W1 (164)');
compare('24', $date->format2('W4'), 'W4 (164)');
compare('23', $date->format2('W7'), 'W7 (164)');
compare('24', $date->format2('IW'), 'IW (164)');

$date->addDays(1);

// Tuesday, 15th June 1999
compare('24', $date->format2('WW'), 'WW (165)');
compare('24', $date->format2('W1'), 'W1 (165)');
compare('24', $date->format2('W4'), 'W4 (165)');
compare('23', $date->format2('W7'), 'W7 (165)');
compare('24', $date->format2('IW'), 'IW (165)');

$date->addDays(1);

// Wednesday, 16th June 1999
compare('24', $date->format2('WW'), 'WW (166)');
compare('25', $date->format2('W1'), 'W1 (166)');
compare('25', $date->format2('W4'), 'W4 (166)');
compare('24', $date->format2('W7'), 'W7 (166)');
compare('24', $date->format2('IW'), 'IW (166)');

$date->addDays(1);

// Thursday, 17th June 1999
compare('24', $date->format2('WW'), 'WW (167)');
compare('25', $date->format2('W1'), 'W1 (167)');
compare('25', $date->format2('W4'), 'W4 (167)');
compare('24', $date->format2('W7'), 'W7 (167)');
compare('24', $date->format2('IW'), 'IW (167)');

$date->addDays(1);

// Friday, 18th June 1999
compare('25', $date->format2('WW'), 'WW (168)');
compare('25', $date->format2('W1'), 'W1 (168)');
compare('25', $date->format2('W4'), 'W4 (168)');
compare('24', $date->format2('W7'), 'W7 (168)');
compare('24', $date->format2('IW'), 'IW (168)');

$date->addDays(1);

// Saturday, 19th June 1999
compare('25', $date->format2('WW'), 'WW (169)');
compare('25', $date->format2('W1'), 'W1 (169)');
compare('25', $date->format2('W4'), 'W4 (169)');
compare('24', $date->format2('W7'), 'W7 (169)');
compare('24', $date->format2('IW'), 'IW (169)');

$date->addDays(1);

// Sunday, 20th June 1999
compare('25', $date->format2('WW'), 'WW (170)');
compare('25', $date->format2('W1'), 'W1 (170)');
compare('25', $date->format2('W4'), 'W4 (170)');
compare('24', $date->format2('W7'), 'W7 (170)');
compare('24', $date->format2('IW'), 'IW (170)');

$date->addDays(1);

// Monday, 21st June 1999
compare('25', $date->format2('WW'), 'WW (171)');
compare('25', $date->format2('W1'), 'W1 (171)');
compare('25', $date->format2('W4'), 'W4 (171)');
compare('24', $date->format2('W7'), 'W7 (171)');
compare('25', $date->format2('IW'), 'IW (171)');

$date->addDays(1);

// Tuesday, 22nd June 1999
compare('25', $date->format2('WW'), 'WW (172)');
compare('25', $date->format2('W1'), 'W1 (172)');
compare('25', $date->format2('W4'), 'W4 (172)');
compare('24', $date->format2('W7'), 'W7 (172)');
compare('25', $date->format2('IW'), 'IW (172)');

$date->addDays(1);

// Wednesday, 23rd June 1999
compare('25', $date->format2('WW'), 'WW (173)');
compare('26', $date->format2('W1'), 'W1 (173)');
compare('26', $date->format2('W4'), 'W4 (173)');
compare('25', $date->format2('W7'), 'W7 (173)');
compare('25', $date->format2('IW'), 'IW (173)');

$date->addDays(1);

// Thursday, 24th June 1999
compare('25', $date->format2('WW'), 'WW (174)');
compare('26', $date->format2('W1'), 'W1 (174)');
compare('26', $date->format2('W4'), 'W4 (174)');
compare('25', $date->format2('W7'), 'W7 (174)');
compare('25', $date->format2('IW'), 'IW (174)');

$date->addDays(1);

// Friday, 25th June 1999
compare('26', $date->format2('WW'), 'WW (175)');
compare('26', $date->format2('W1'), 'W1 (175)');
compare('26', $date->format2('W4'), 'W4 (175)');
compare('25', $date->format2('W7'), 'W7 (175)');
compare('25', $date->format2('IW'), 'IW (175)');

$date->addDays(1);

// Saturday, 26th June 1999
compare('26', $date->format2('WW'), 'WW (176)');
compare('26', $date->format2('W1'), 'W1 (176)');
compare('26', $date->format2('W4'), 'W4 (176)');
compare('25', $date->format2('W7'), 'W7 (176)');
compare('25', $date->format2('IW'), 'IW (176)');

$date->addDays(1);

// Sunday, 27th June 1999
compare('26', $date->format2('WW'), 'WW (177)');
compare('26', $date->format2('W1'), 'W1 (177)');
compare('26', $date->format2('W4'), 'W4 (177)');
compare('25', $date->format2('W7'), 'W7 (177)');
compare('25', $date->format2('IW'), 'IW (177)');

$date->addDays(1);

// Monday, 28th June 1999
compare('26', $date->format2('WW'), 'WW (178)');
compare('26', $date->format2('W1'), 'W1 (178)');
compare('26', $date->format2('W4'), 'W4 (178)');
compare('25', $date->format2('W7'), 'W7 (178)');
compare('26', $date->format2('IW'), 'IW (178)');

$date->addDays(1);

// Tuesday, 29th June 1999
compare('26', $date->format2('WW'), 'WW (179)');
compare('26', $date->format2('W1'), 'W1 (179)');
compare('26', $date->format2('W4'), 'W4 (179)');
compare('25', $date->format2('W7'), 'W7 (179)');
compare('26', $date->format2('IW'), 'IW (179)');

$date->addDays(1);

// Wednesday, 30th June 1999
compare('26', $date->format2('WW'), 'WW (180)');
compare('27', $date->format2('W1'), 'W1 (180)');
compare('27', $date->format2('W4'), 'W4 (180)');
compare('26', $date->format2('W7'), 'W7 (180)');
compare('26', $date->format2('IW'), 'IW (180)');

$date->addDays(1);

// Thursday, 1st July 1999
compare('26', $date->format2('WW'), 'WW (181)');
compare('27', $date->format2('W1'), 'W1 (181)');
compare('27', $date->format2('W4'), 'W4 (181)');
compare('26', $date->format2('W7'), 'W7 (181)');
compare('26', $date->format2('IW'), 'IW (181)');

$date->addDays(1);

// Friday, 2nd July 1999
compare('27', $date->format2('WW'), 'WW (182)');
compare('27', $date->format2('W1'), 'W1 (182)');
compare('27', $date->format2('W4'), 'W4 (182)');
compare('26', $date->format2('W7'), 'W7 (182)');
compare('26', $date->format2('IW'), 'IW (182)');

$date->addDays(1);

// Saturday, 3rd July 1999
compare('27', $date->format2('WW'), 'WW (183)');
compare('27', $date->format2('W1'), 'W1 (183)');
compare('27', $date->format2('W4'), 'W4 (183)');
compare('26', $date->format2('W7'), 'W7 (183)');
compare('26', $date->format2('IW'), 'IW (183)');

$date->addDays(1);

// Sunday, 4th July 1999
compare('27', $date->format2('WW'), 'WW (184)');
compare('27', $date->format2('W1'), 'W1 (184)');
compare('27', $date->format2('W4'), 'W4 (184)');
compare('26', $date->format2('W7'), 'W7 (184)');
compare('26', $date->format2('IW'), 'IW (184)');

$date->addDays(1);

// Monday, 5th July 1999
compare('27', $date->format2('WW'), 'WW (185)');
compare('27', $date->format2('W1'), 'W1 (185)');
compare('27', $date->format2('W4'), 'W4 (185)');
compare('26', $date->format2('W7'), 'W7 (185)');
compare('27', $date->format2('IW'), 'IW (185)');

$date->addDays(1);

// Tuesday, 6th July 1999
compare('27', $date->format2('WW'), 'WW (186)');
compare('27', $date->format2('W1'), 'W1 (186)');
compare('27', $date->format2('W4'), 'W4 (186)');
compare('26', $date->format2('W7'), 'W7 (186)');
compare('27', $date->format2('IW'), 'IW (186)');

$date->addDays(1);

// Wednesday, 7th July 1999
compare('27', $date->format2('WW'), 'WW (187)');
compare('28', $date->format2('W1'), 'W1 (187)');
compare('28', $date->format2('W4'), 'W4 (187)');
compare('27', $date->format2('W7'), 'W7 (187)');
compare('27', $date->format2('IW'), 'IW (187)');

$date->addDays(1);

// Thursday, 8th July 1999
compare('27', $date->format2('WW'), 'WW (188)');
compare('28', $date->format2('W1'), 'W1 (188)');
compare('28', $date->format2('W4'), 'W4 (188)');
compare('27', $date->format2('W7'), 'W7 (188)');
compare('27', $date->format2('IW'), 'IW (188)');

$date->addDays(1);

// Friday, 9th July 1999
compare('28', $date->format2('WW'), 'WW (189)');
compare('28', $date->format2('W1'), 'W1 (189)');
compare('28', $date->format2('W4'), 'W4 (189)');
compare('27', $date->format2('W7'), 'W7 (189)');
compare('27', $date->format2('IW'), 'IW (189)');

$date->addDays(1);

// Saturday, 10th July 1999
compare('28', $date->format2('WW'), 'WW (190)');
compare('28', $date->format2('W1'), 'W1 (190)');
compare('28', $date->format2('W4'), 'W4 (190)');
compare('27', $date->format2('W7'), 'W7 (190)');
compare('27', $date->format2('IW'), 'IW (190)');

$date->addDays(1);

// Sunday, 11th July 1999
compare('28', $date->format2('WW'), 'WW (191)');
compare('28', $date->format2('W1'), 'W1 (191)');
compare('28', $date->format2('W4'), 'W4 (191)');
compare('27', $date->format2('W7'), 'W7 (191)');
compare('27', $date->format2('IW'), 'IW (191)');

$date->addDays(1);

// Monday, 12th July 1999
compare('28', $date->format2('WW'), 'WW (192)');
compare('28', $date->format2('W1'), 'W1 (192)');
compare('28', $date->format2('W4'), 'W4 (192)');
compare('27', $date->format2('W7'), 'W7 (192)');
compare('28', $date->format2('IW'), 'IW (192)');

$date->addDays(1);

// Tuesday, 13th July 1999
compare('28', $date->format2('WW'), 'WW (193)');
compare('28', $date->format2('W1'), 'W1 (193)');
compare('28', $date->format2('W4'), 'W4 (193)');
compare('27', $date->format2('W7'), 'W7 (193)');
compare('28', $date->format2('IW'), 'IW (193)');

$date->addDays(1);

// Wednesday, 14th July 1999
compare('28', $date->format2('WW'), 'WW (194)');
compare('29', $date->format2('W1'), 'W1 (194)');
compare('29', $date->format2('W4'), 'W4 (194)');
compare('28', $date->format2('W7'), 'W7 (194)');
compare('28', $date->format2('IW'), 'IW (194)');

$date->addDays(1);

// Thursday, 15th July 1999
compare('28', $date->format2('WW'), 'WW (195)');
compare('29', $date->format2('W1'), 'W1 (195)');
compare('29', $date->format2('W4'), 'W4 (195)');
compare('28', $date->format2('W7'), 'W7 (195)');
compare('28', $date->format2('IW'), 'IW (195)');

$date->addDays(1);

// Friday, 16th July 1999
compare('29', $date->format2('WW'), 'WW (196)');
compare('29', $date->format2('W1'), 'W1 (196)');
compare('29', $date->format2('W4'), 'W4 (196)');
compare('28', $date->format2('W7'), 'W7 (196)');
compare('28', $date->format2('IW'), 'IW (196)');

$date->addDays(1);

// Saturday, 17th July 1999
compare('29', $date->format2('WW'), 'WW (197)');
compare('29', $date->format2('W1'), 'W1 (197)');
compare('29', $date->format2('W4'), 'W4 (197)');
compare('28', $date->format2('W7'), 'W7 (197)');
compare('28', $date->format2('IW'), 'IW (197)');

$date->addDays(1);

// Sunday, 18th July 1999
compare('29', $date->format2('WW'), 'WW (198)');
compare('29', $date->format2('W1'), 'W1 (198)');
compare('29', $date->format2('W4'), 'W4 (198)');
compare('28', $date->format2('W7'), 'W7 (198)');
compare('28', $date->format2('IW'), 'IW (198)');

$date->addDays(1);

// Monday, 19th July 1999
compare('29', $date->format2('WW'), 'WW (199)');
compare('29', $date->format2('W1'), 'W1 (199)');
compare('29', $date->format2('W4'), 'W4 (199)');
compare('28', $date->format2('W7'), 'W7 (199)');
compare('29', $date->format2('IW'), 'IW (199)');

$date->addDays(1);

// Tuesday, 20th July 1999
compare('29', $date->format2('WW'), 'WW (200)');
compare('29', $date->format2('W1'), 'W1 (200)');
compare('29', $date->format2('W4'), 'W4 (200)');
compare('28', $date->format2('W7'), 'W7 (200)');
compare('29', $date->format2('IW'), 'IW (200)');

$date->addDays(1);

// Wednesday, 21st July 1999
compare('29', $date->format2('WW'), 'WW (201)');
compare('30', $date->format2('W1'), 'W1 (201)');
compare('30', $date->format2('W4'), 'W4 (201)');
compare('29', $date->format2('W7'), 'W7 (201)');
compare('29', $date->format2('IW'), 'IW (201)');

$date->addDays(1);

// Thursday, 22nd July 1999
compare('29', $date->format2('WW'), 'WW (202)');
compare('30', $date->format2('W1'), 'W1 (202)');
compare('30', $date->format2('W4'), 'W4 (202)');
compare('29', $date->format2('W7'), 'W7 (202)');
compare('29', $date->format2('IW'), 'IW (202)');

$date->addDays(1);

// Friday, 23rd July 1999
compare('30', $date->format2('WW'), 'WW (203)');
compare('30', $date->format2('W1'), 'W1 (203)');
compare('30', $date->format2('W4'), 'W4 (203)');
compare('29', $date->format2('W7'), 'W7 (203)');
compare('29', $date->format2('IW'), 'IW (203)');

$date->addDays(1);

// Saturday, 24th July 1999
compare('30', $date->format2('WW'), 'WW (204)');
compare('30', $date->format2('W1'), 'W1 (204)');
compare('30', $date->format2('W4'), 'W4 (204)');
compare('29', $date->format2('W7'), 'W7 (204)');
compare('29', $date->format2('IW'), 'IW (204)');

$date->addDays(1);

// Sunday, 25th July 1999
compare('30', $date->format2('WW'), 'WW (205)');
compare('30', $date->format2('W1'), 'W1 (205)');
compare('30', $date->format2('W4'), 'W4 (205)');
compare('29', $date->format2('W7'), 'W7 (205)');
compare('29', $date->format2('IW'), 'IW (205)');

$date->addDays(1);

// Monday, 26th July 1999
compare('30', $date->format2('WW'), 'WW (206)');
compare('30', $date->format2('W1'), 'W1 (206)');
compare('30', $date->format2('W4'), 'W4 (206)');
compare('29', $date->format2('W7'), 'W7 (206)');
compare('30', $date->format2('IW'), 'IW (206)');

$date->addDays(1);

// Tuesday, 27th July 1999
compare('30', $date->format2('WW'), 'WW (207)');
compare('30', $date->format2('W1'), 'W1 (207)');
compare('30', $date->format2('W4'), 'W4 (207)');
compare('29', $date->format2('W7'), 'W7 (207)');
compare('30', $date->format2('IW'), 'IW (207)');

$date->addDays(1);

// Wednesday, 28th July 1999
compare('30', $date->format2('WW'), 'WW (208)');
compare('31', $date->format2('W1'), 'W1 (208)');
compare('31', $date->format2('W4'), 'W4 (208)');
compare('30', $date->format2('W7'), 'W7 (208)');
compare('30', $date->format2('IW'), 'IW (208)');

$date->addDays(1);

// Thursday, 29th July 1999
compare('30', $date->format2('WW'), 'WW (209)');
compare('31', $date->format2('W1'), 'W1 (209)');
compare('31', $date->format2('W4'), 'W4 (209)');
compare('30', $date->format2('W7'), 'W7 (209)');
compare('30', $date->format2('IW'), 'IW (209)');

$date->addDays(1);

// Friday, 30th July 1999
compare('31', $date->format2('WW'), 'WW (210)');
compare('31', $date->format2('W1'), 'W1 (210)');
compare('31', $date->format2('W4'), 'W4 (210)');
compare('30', $date->format2('W7'), 'W7 (210)');
compare('30', $date->format2('IW'), 'IW (210)');

$date->addDays(1);

// Saturday, 31st July 1999
compare('31', $date->format2('WW'), 'WW (211)');
compare('31', $date->format2('W1'), 'W1 (211)');
compare('31', $date->format2('W4'), 'W4 (211)');
compare('30', $date->format2('W7'), 'W7 (211)');
compare('30', $date->format2('IW'), 'IW (211)');

$date->addDays(1);

// Sunday, 1st August 1999
compare('31', $date->format2('WW'), 'WW (212)');
compare('31', $date->format2('W1'), 'W1 (212)');
compare('31', $date->format2('W4'), 'W4 (212)');
compare('30', $date->format2('W7'), 'W7 (212)');
compare('30', $date->format2('IW'), 'IW (212)');

$date->addDays(1);

// Monday, 2nd August 1999
compare('31', $date->format2('WW'), 'WW (213)');
compare('31', $date->format2('W1'), 'W1 (213)');
compare('31', $date->format2('W4'), 'W4 (213)');
compare('30', $date->format2('W7'), 'W7 (213)');
compare('31', $date->format2('IW'), 'IW (213)');

$date->addDays(1);

// Tuesday, 3rd August 1999
compare('31', $date->format2('WW'), 'WW (214)');
compare('31', $date->format2('W1'), 'W1 (214)');
compare('31', $date->format2('W4'), 'W4 (214)');
compare('30', $date->format2('W7'), 'W7 (214)');
compare('31', $date->format2('IW'), 'IW (214)');

$date->addDays(1);

// Wednesday, 4th August 1999
compare('31', $date->format2('WW'), 'WW (215)');
compare('32', $date->format2('W1'), 'W1 (215)');
compare('32', $date->format2('W4'), 'W4 (215)');
compare('31', $date->format2('W7'), 'W7 (215)');
compare('31', $date->format2('IW'), 'IW (215)');

$date->addDays(1);

// Thursday, 5th August 1999
compare('31', $date->format2('WW'), 'WW (216)');
compare('32', $date->format2('W1'), 'W1 (216)');
compare('32', $date->format2('W4'), 'W4 (216)');
compare('31', $date->format2('W7'), 'W7 (216)');
compare('31', $date->format2('IW'), 'IW (216)');

$date->addDays(1);

// Friday, 6th August 1999
compare('32', $date->format2('WW'), 'WW (217)');
compare('32', $date->format2('W1'), 'W1 (217)');
compare('32', $date->format2('W4'), 'W4 (217)');
compare('31', $date->format2('W7'), 'W7 (217)');
compare('31', $date->format2('IW'), 'IW (217)');

$date->addDays(1);

// Saturday, 7th August 1999
compare('32', $date->format2('WW'), 'WW (218)');
compare('32', $date->format2('W1'), 'W1 (218)');
compare('32', $date->format2('W4'), 'W4 (218)');
compare('31', $date->format2('W7'), 'W7 (218)');
compare('31', $date->format2('IW'), 'IW (218)');

$date->addDays(1);

// Sunday, 8th August 1999
compare('32', $date->format2('WW'), 'WW (219)');
compare('32', $date->format2('W1'), 'W1 (219)');
compare('32', $date->format2('W4'), 'W4 (219)');
compare('31', $date->format2('W7'), 'W7 (219)');
compare('31', $date->format2('IW'), 'IW (219)');

$date->addDays(1);

// Monday, 9th August 1999
compare('32', $date->format2('WW'), 'WW (220)');
compare('32', $date->format2('W1'), 'W1 (220)');
compare('32', $date->format2('W4'), 'W4 (220)');
compare('31', $date->format2('W7'), 'W7 (220)');
compare('32', $date->format2('IW'), 'IW (220)');

$date->addDays(1);

// Tuesday, 10th August 1999
compare('32', $date->format2('WW'), 'WW (221)');
compare('32', $date->format2('W1'), 'W1 (221)');
compare('32', $date->format2('W4'), 'W4 (221)');
compare('31', $date->format2('W7'), 'W7 (221)');
compare('32', $date->format2('IW'), 'IW (221)');

$date->addDays(1);

// Wednesday, 11th August 1999
compare('32', $date->format2('WW'), 'WW (222)');
compare('33', $date->format2('W1'), 'W1 (222)');
compare('33', $date->format2('W4'), 'W4 (222)');
compare('32', $date->format2('W7'), 'W7 (222)');
compare('32', $date->format2('IW'), 'IW (222)');

$date->addDays(1);

// Thursday, 12th August 1999
compare('32', $date->format2('WW'), 'WW (223)');
compare('33', $date->format2('W1'), 'W1 (223)');
compare('33', $date->format2('W4'), 'W4 (223)');
compare('32', $date->format2('W7'), 'W7 (223)');
compare('32', $date->format2('IW'), 'IW (223)');

$date->addDays(1);

// Friday, 13th August 1999
compare('33', $date->format2('WW'), 'WW (224)');
compare('33', $date->format2('W1'), 'W1 (224)');
compare('33', $date->format2('W4'), 'W4 (224)');
compare('32', $date->format2('W7'), 'W7 (224)');
compare('32', $date->format2('IW'), 'IW (224)');

$date->addDays(1);

// Saturday, 14th August 1999
compare('33', $date->format2('WW'), 'WW (225)');
compare('33', $date->format2('W1'), 'W1 (225)');
compare('33', $date->format2('W4'), 'W4 (225)');
compare('32', $date->format2('W7'), 'W7 (225)');
compare('32', $date->format2('IW'), 'IW (225)');

$date->addDays(1);

// Sunday, 15th August 1999
compare('33', $date->format2('WW'), 'WW (226)');
compare('33', $date->format2('W1'), 'W1 (226)');
compare('33', $date->format2('W4'), 'W4 (226)');
compare('32', $date->format2('W7'), 'W7 (226)');
compare('32', $date->format2('IW'), 'IW (226)');

$date->addDays(1);

// Monday, 16th August 1999
compare('33', $date->format2('WW'), 'WW (227)');
compare('33', $date->format2('W1'), 'W1 (227)');
compare('33', $date->format2('W4'), 'W4 (227)');
compare('32', $date->format2('W7'), 'W7 (227)');
compare('33', $date->format2('IW'), 'IW (227)');

$date->addDays(1);

// Tuesday, 17th August 1999
compare('33', $date->format2('WW'), 'WW (228)');
compare('33', $date->format2('W1'), 'W1 (228)');
compare('33', $date->format2('W4'), 'W4 (228)');
compare('32', $date->format2('W7'), 'W7 (228)');
compare('33', $date->format2('IW'), 'IW (228)');

$date->addDays(1);

// Wednesday, 18th August 1999
compare('33', $date->format2('WW'), 'WW (229)');
compare('34', $date->format2('W1'), 'W1 (229)');
compare('34', $date->format2('W4'), 'W4 (229)');
compare('33', $date->format2('W7'), 'W7 (229)');
compare('33', $date->format2('IW'), 'IW (229)');

$date->addDays(1);

// Thursday, 19th August 1999
compare('33', $date->format2('WW'), 'WW (230)');
compare('34', $date->format2('W1'), 'W1 (230)');
compare('34', $date->format2('W4'), 'W4 (230)');
compare('33', $date->format2('W7'), 'W7 (230)');
compare('33', $date->format2('IW'), 'IW (230)');

$date->addDays(1);

// Friday, 20th August 1999
compare('34', $date->format2('WW'), 'WW (231)');
compare('34', $date->format2('W1'), 'W1 (231)');
compare('34', $date->format2('W4'), 'W4 (231)');
compare('33', $date->format2('W7'), 'W7 (231)');
compare('33', $date->format2('IW'), 'IW (231)');

$date->addDays(1);

// Saturday, 21st August 1999
compare('34', $date->format2('WW'), 'WW (232)');
compare('34', $date->format2('W1'), 'W1 (232)');
compare('34', $date->format2('W4'), 'W4 (232)');
compare('33', $date->format2('W7'), 'W7 (232)');
compare('33', $date->format2('IW'), 'IW (232)');

$date->addDays(1);

// Sunday, 22nd August 1999
compare('34', $date->format2('WW'), 'WW (233)');
compare('34', $date->format2('W1'), 'W1 (233)');
compare('34', $date->format2('W4'), 'W4 (233)');
compare('33', $date->format2('W7'), 'W7 (233)');
compare('33', $date->format2('IW'), 'IW (233)');

$date->addDays(1);

// Monday, 23rd August 1999
compare('34', $date->format2('WW'), 'WW (234)');
compare('34', $date->format2('W1'), 'W1 (234)');
compare('34', $date->format2('W4'), 'W4 (234)');
compare('33', $date->format2('W7'), 'W7 (234)');
compare('34', $date->format2('IW'), 'IW (234)');

$date->addDays(1);

// Tuesday, 24th August 1999
compare('34', $date->format2('WW'), 'WW (235)');
compare('34', $date->format2('W1'), 'W1 (235)');
compare('34', $date->format2('W4'), 'W4 (235)');
compare('33', $date->format2('W7'), 'W7 (235)');
compare('34', $date->format2('IW'), 'IW (235)');

$date->addDays(1);

// Wednesday, 25th August 1999
compare('34', $date->format2('WW'), 'WW (236)');
compare('35', $date->format2('W1'), 'W1 (236)');
compare('35', $date->format2('W4'), 'W4 (236)');
compare('34', $date->format2('W7'), 'W7 (236)');
compare('34', $date->format2('IW'), 'IW (236)');

$date->addDays(1);

// Thursday, 26th August 1999
compare('34', $date->format2('WW'), 'WW (237)');
compare('35', $date->format2('W1'), 'W1 (237)');
compare('35', $date->format2('W4'), 'W4 (237)');
compare('34', $date->format2('W7'), 'W7 (237)');
compare('34', $date->format2('IW'), 'IW (237)');

$date->addDays(1);

// Friday, 27th August 1999
compare('35', $date->format2('WW'), 'WW (238)');
compare('35', $date->format2('W1'), 'W1 (238)');
compare('35', $date->format2('W4'), 'W4 (238)');
compare('34', $date->format2('W7'), 'W7 (238)');
compare('34', $date->format2('IW'), 'IW (238)');

$date->addDays(1);

// Saturday, 28th August 1999
compare('35', $date->format2('WW'), 'WW (239)');
compare('35', $date->format2('W1'), 'W1 (239)');
compare('35', $date->format2('W4'), 'W4 (239)');
compare('34', $date->format2('W7'), 'W7 (239)');
compare('34', $date->format2('IW'), 'IW (239)');

$date->addDays(1);

// Sunday, 29th August 1999
compare('35', $date->format2('WW'), 'WW (240)');
compare('35', $date->format2('W1'), 'W1 (240)');
compare('35', $date->format2('W4'), 'W4 (240)');
compare('34', $date->format2('W7'), 'W7 (240)');
compare('34', $date->format2('IW'), 'IW (240)');

$date->addDays(1);

// Monday, 30th August 1999
compare('35', $date->format2('WW'), 'WW (241)');
compare('35', $date->format2('W1'), 'W1 (241)');
compare('35', $date->format2('W4'), 'W4 (241)');
compare('34', $date->format2('W7'), 'W7 (241)');
compare('35', $date->format2('IW'), 'IW (241)');

$date->addDays(1);

// Tuesday, 31st August 1999
compare('35', $date->format2('WW'), 'WW (242)');
compare('35', $date->format2('W1'), 'W1 (242)');
compare('35', $date->format2('W4'), 'W4 (242)');
compare('34', $date->format2('W7'), 'W7 (242)');
compare('35', $date->format2('IW'), 'IW (242)');

$date->addDays(1);

// Wednesday, 1st September 1999
compare('35', $date->format2('WW'), 'WW (243)');
compare('36', $date->format2('W1'), 'W1 (243)');
compare('36', $date->format2('W4'), 'W4 (243)');
compare('35', $date->format2('W7'), 'W7 (243)');
compare('35', $date->format2('IW'), 'IW (243)');

$date->addDays(1);

// Thursday, 2nd September 1999
compare('35', $date->format2('WW'), 'WW (244)');
compare('36', $date->format2('W1'), 'W1 (244)');
compare('36', $date->format2('W4'), 'W4 (244)');
compare('35', $date->format2('W7'), 'W7 (244)');
compare('35', $date->format2('IW'), 'IW (244)');

$date->addDays(1);

// Friday, 3rd September 1999
compare('36', $date->format2('WW'), 'WW (245)');
compare('36', $date->format2('W1'), 'W1 (245)');
compare('36', $date->format2('W4'), 'W4 (245)');
compare('35', $date->format2('W7'), 'W7 (245)');
compare('35', $date->format2('IW'), 'IW (245)');

$date->addDays(1);

// Saturday, 4th September 1999
compare('36', $date->format2('WW'), 'WW (246)');
compare('36', $date->format2('W1'), 'W1 (246)');
compare('36', $date->format2('W4'), 'W4 (246)');
compare('35', $date->format2('W7'), 'W7 (246)');
compare('35', $date->format2('IW'), 'IW (246)');

$date->addDays(1);

// Sunday, 5th September 1999
compare('36', $date->format2('WW'), 'WW (247)');
compare('36', $date->format2('W1'), 'W1 (247)');
compare('36', $date->format2('W4'), 'W4 (247)');
compare('35', $date->format2('W7'), 'W7 (247)');
compare('35', $date->format2('IW'), 'IW (247)');

$date->addDays(1);

// Monday, 6th September 1999
compare('36', $date->format2('WW'), 'WW (248)');
compare('36', $date->format2('W1'), 'W1 (248)');
compare('36', $date->format2('W4'), 'W4 (248)');
compare('35', $date->format2('W7'), 'W7 (248)');
compare('36', $date->format2('IW'), 'IW (248)');

$date->addDays(1);

// Tuesday, 7th September 1999
compare('36', $date->format2('WW'), 'WW (249)');
compare('36', $date->format2('W1'), 'W1 (249)');
compare('36', $date->format2('W4'), 'W4 (249)');
compare('35', $date->format2('W7'), 'W7 (249)');
compare('36', $date->format2('IW'), 'IW (249)');

$date->addDays(1);

// Wednesday, 8th September 1999
compare('36', $date->format2('WW'), 'WW (250)');
compare('37', $date->format2('W1'), 'W1 (250)');
compare('37', $date->format2('W4'), 'W4 (250)');
compare('36', $date->format2('W7'), 'W7 (250)');
compare('36', $date->format2('IW'), 'IW (250)');

$date->addDays(1);

// Thursday, 9th September 1999
compare('36', $date->format2('WW'), 'WW (251)');
compare('37', $date->format2('W1'), 'W1 (251)');
compare('37', $date->format2('W4'), 'W4 (251)');
compare('36', $date->format2('W7'), 'W7 (251)');
compare('36', $date->format2('IW'), 'IW (251)');

$date->addDays(1);

// Friday, 10th September 1999
compare('37', $date->format2('WW'), 'WW (252)');
compare('37', $date->format2('W1'), 'W1 (252)');
compare('37', $date->format2('W4'), 'W4 (252)');
compare('36', $date->format2('W7'), 'W7 (252)');
compare('36', $date->format2('IW'), 'IW (252)');

$date->addDays(1);

// Saturday, 11th September 1999
compare('37', $date->format2('WW'), 'WW (253)');
compare('37', $date->format2('W1'), 'W1 (253)');
compare('37', $date->format2('W4'), 'W4 (253)');
compare('36', $date->format2('W7'), 'W7 (253)');
compare('36', $date->format2('IW'), 'IW (253)');

$date->addDays(1);

// Sunday, 12th September 1999
compare('37', $date->format2('WW'), 'WW (254)');
compare('37', $date->format2('W1'), 'W1 (254)');
compare('37', $date->format2('W4'), 'W4 (254)');
compare('36', $date->format2('W7'), 'W7 (254)');
compare('36', $date->format2('IW'), 'IW (254)');

$date->addDays(1);

// Monday, 13th September 1999
compare('37', $date->format2('WW'), 'WW (255)');
compare('37', $date->format2('W1'), 'W1 (255)');
compare('37', $date->format2('W4'), 'W4 (255)');
compare('36', $date->format2('W7'), 'W7 (255)');
compare('37', $date->format2('IW'), 'IW (255)');

$date->addDays(1);

// Tuesday, 14th September 1999
compare('37', $date->format2('WW'), 'WW (256)');
compare('37', $date->format2('W1'), 'W1 (256)');
compare('37', $date->format2('W4'), 'W4 (256)');
compare('36', $date->format2('W7'), 'W7 (256)');
compare('37', $date->format2('IW'), 'IW (256)');

$date->addDays(1);

// Wednesday, 15th September 1999
compare('37', $date->format2('WW'), 'WW (257)');
compare('38', $date->format2('W1'), 'W1 (257)');
compare('38', $date->format2('W4'), 'W4 (257)');
compare('37', $date->format2('W7'), 'W7 (257)');
compare('37', $date->format2('IW'), 'IW (257)');

$date->addDays(1);

// Thursday, 16th September 1999
compare('37', $date->format2('WW'), 'WW (258)');
compare('38', $date->format2('W1'), 'W1 (258)');
compare('38', $date->format2('W4'), 'W4 (258)');
compare('37', $date->format2('W7'), 'W7 (258)');
compare('37', $date->format2('IW'), 'IW (258)');

$date->addDays(1);

// Friday, 17th September 1999
compare('38', $date->format2('WW'), 'WW (259)');
compare('38', $date->format2('W1'), 'W1 (259)');
compare('38', $date->format2('W4'), 'W4 (259)');
compare('37', $date->format2('W7'), 'W7 (259)');
compare('37', $date->format2('IW'), 'IW (259)');

$date->addDays(1);

// Saturday, 18th September 1999
compare('38', $date->format2('WW'), 'WW (260)');
compare('38', $date->format2('W1'), 'W1 (260)');
compare('38', $date->format2('W4'), 'W4 (260)');
compare('37', $date->format2('W7'), 'W7 (260)');
compare('37', $date->format2('IW'), 'IW (260)');

$date->addDays(1);

// Sunday, 19th September 1999
compare('38', $date->format2('WW'), 'WW (261)');
compare('38', $date->format2('W1'), 'W1 (261)');
compare('38', $date->format2('W4'), 'W4 (261)');
compare('37', $date->format2('W7'), 'W7 (261)');
compare('37', $date->format2('IW'), 'IW (261)');

$date->addDays(1);

// Monday, 20th September 1999
compare('38', $date->format2('WW'), 'WW (262)');
compare('38', $date->format2('W1'), 'W1 (262)');
compare('38', $date->format2('W4'), 'W4 (262)');
compare('37', $date->format2('W7'), 'W7 (262)');
compare('38', $date->format2('IW'), 'IW (262)');

$date->addDays(1);

// Tuesday, 21st September 1999
compare('38', $date->format2('WW'), 'WW (263)');
compare('38', $date->format2('W1'), 'W1 (263)');
compare('38', $date->format2('W4'), 'W4 (263)');
compare('37', $date->format2('W7'), 'W7 (263)');
compare('38', $date->format2('IW'), 'IW (263)');

$date->addDays(1);

// Wednesday, 22nd September 1999
compare('38', $date->format2('WW'), 'WW (264)');
compare('39', $date->format2('W1'), 'W1 (264)');
compare('39', $date->format2('W4'), 'W4 (264)');
compare('38', $date->format2('W7'), 'W7 (264)');
compare('38', $date->format2('IW'), 'IW (264)');

$date->addDays(1);

// Thursday, 23rd September 1999
compare('38', $date->format2('WW'), 'WW (265)');
compare('39', $date->format2('W1'), 'W1 (265)');
compare('39', $date->format2('W4'), 'W4 (265)');
compare('38', $date->format2('W7'), 'W7 (265)');
compare('38', $date->format2('IW'), 'IW (265)');

$date->addDays(1);

// Friday, 24th September 1999
compare('39', $date->format2('WW'), 'WW (266)');
compare('39', $date->format2('W1'), 'W1 (266)');
compare('39', $date->format2('W4'), 'W4 (266)');
compare('38', $date->format2('W7'), 'W7 (266)');
compare('38', $date->format2('IW'), 'IW (266)');

$date->addDays(1);

// Saturday, 25th September 1999
compare('39', $date->format2('WW'), 'WW (267)');
compare('39', $date->format2('W1'), 'W1 (267)');
compare('39', $date->format2('W4'), 'W4 (267)');
compare('38', $date->format2('W7'), 'W7 (267)');
compare('38', $date->format2('IW'), 'IW (267)');

$date->addDays(1);

// Sunday, 26th September 1999
compare('39', $date->format2('WW'), 'WW (268)');
compare('39', $date->format2('W1'), 'W1 (268)');
compare('39', $date->format2('W4'), 'W4 (268)');
compare('38', $date->format2('W7'), 'W7 (268)');
compare('38', $date->format2('IW'), 'IW (268)');

$date->addDays(1);

// Monday, 27th September 1999
compare('39', $date->format2('WW'), 'WW (269)');
compare('39', $date->format2('W1'), 'W1 (269)');
compare('39', $date->format2('W4'), 'W4 (269)');
compare('38', $date->format2('W7'), 'W7 (269)');
compare('39', $date->format2('IW'), 'IW (269)');

$date->addDays(1);

// Tuesday, 28th September 1999
compare('39', $date->format2('WW'), 'WW (270)');
compare('39', $date->format2('W1'), 'W1 (270)');
compare('39', $date->format2('W4'), 'W4 (270)');
compare('38', $date->format2('W7'), 'W7 (270)');
compare('39', $date->format2('IW'), 'IW (270)');

$date->addDays(1);

// Wednesday, 29th September 1999
compare('39', $date->format2('WW'), 'WW (271)');
compare('40', $date->format2('W1'), 'W1 (271)');
compare('40', $date->format2('W4'), 'W4 (271)');
compare('39', $date->format2('W7'), 'W7 (271)');
compare('39', $date->format2('IW'), 'IW (271)');

$date->addDays(1);

// Thursday, 30th September 1999
compare('39', $date->format2('WW'), 'WW (272)');
compare('40', $date->format2('W1'), 'W1 (272)');
compare('40', $date->format2('W4'), 'W4 (272)');
compare('39', $date->format2('W7'), 'W7 (272)');
compare('39', $date->format2('IW'), 'IW (272)');

$date->addDays(1);

// Friday, 1st October 1999
compare('40', $date->format2('WW'), 'WW (273)');
compare('40', $date->format2('W1'), 'W1 (273)');
compare('40', $date->format2('W4'), 'W4 (273)');
compare('39', $date->format2('W7'), 'W7 (273)');
compare('39', $date->format2('IW'), 'IW (273)');

$date->addDays(1);

// Saturday, 2nd October 1999
compare('40', $date->format2('WW'), 'WW (274)');
compare('40', $date->format2('W1'), 'W1 (274)');
compare('40', $date->format2('W4'), 'W4 (274)');
compare('39', $date->format2('W7'), 'W7 (274)');
compare('39', $date->format2('IW'), 'IW (274)');

$date->addDays(1);

// Sunday, 3rd October 1999
compare('40', $date->format2('WW'), 'WW (275)');
compare('40', $date->format2('W1'), 'W1 (275)');
compare('40', $date->format2('W4'), 'W4 (275)');
compare('39', $date->format2('W7'), 'W7 (275)');
compare('39', $date->format2('IW'), 'IW (275)');

$date->addDays(1);

// Monday, 4th October 1999
compare('40', $date->format2('WW'), 'WW (276)');
compare('40', $date->format2('W1'), 'W1 (276)');
compare('40', $date->format2('W4'), 'W4 (276)');
compare('39', $date->format2('W7'), 'W7 (276)');
compare('40', $date->format2('IW'), 'IW (276)');

$date->addDays(1);

// Tuesday, 5th October 1999
compare('40', $date->format2('WW'), 'WW (277)');
compare('40', $date->format2('W1'), 'W1 (277)');
compare('40', $date->format2('W4'), 'W4 (277)');
compare('39', $date->format2('W7'), 'W7 (277)');
compare('40', $date->format2('IW'), 'IW (277)');

$date->addDays(1);

// Wednesday, 6th October 1999
compare('40', $date->format2('WW'), 'WW (278)');
compare('41', $date->format2('W1'), 'W1 (278)');
compare('41', $date->format2('W4'), 'W4 (278)');
compare('40', $date->format2('W7'), 'W7 (278)');
compare('40', $date->format2('IW'), 'IW (278)');

$date->addDays(1);

// Thursday, 7th October 1999
compare('40', $date->format2('WW'), 'WW (279)');
compare('41', $date->format2('W1'), 'W1 (279)');
compare('41', $date->format2('W4'), 'W4 (279)');
compare('40', $date->format2('W7'), 'W7 (279)');
compare('40', $date->format2('IW'), 'IW (279)');

$date->addDays(1);

// Friday, 8th October 1999
compare('41', $date->format2('WW'), 'WW (280)');
compare('41', $date->format2('W1'), 'W1 (280)');
compare('41', $date->format2('W4'), 'W4 (280)');
compare('40', $date->format2('W7'), 'W7 (280)');
compare('40', $date->format2('IW'), 'IW (280)');

$date->addDays(1);

// Saturday, 9th October 1999
compare('41', $date->format2('WW'), 'WW (281)');
compare('41', $date->format2('W1'), 'W1 (281)');
compare('41', $date->format2('W4'), 'W4 (281)');
compare('40', $date->format2('W7'), 'W7 (281)');
compare('40', $date->format2('IW'), 'IW (281)');

$date->addDays(1);

// Sunday, 10th October 1999
compare('41', $date->format2('WW'), 'WW (282)');
compare('41', $date->format2('W1'), 'W1 (282)');
compare('41', $date->format2('W4'), 'W4 (282)');
compare('40', $date->format2('W7'), 'W7 (282)');
compare('40', $date->format2('IW'), 'IW (282)');

$date->addDays(1);

// Monday, 11th October 1999
compare('41', $date->format2('WW'), 'WW (283)');
compare('41', $date->format2('W1'), 'W1 (283)');
compare('41', $date->format2('W4'), 'W4 (283)');
compare('40', $date->format2('W7'), 'W7 (283)');
compare('41', $date->format2('IW'), 'IW (283)');

$date->addDays(1);

// Tuesday, 12th October 1999
compare('41', $date->format2('WW'), 'WW (284)');
compare('41', $date->format2('W1'), 'W1 (284)');
compare('41', $date->format2('W4'), 'W4 (284)');
compare('40', $date->format2('W7'), 'W7 (284)');
compare('41', $date->format2('IW'), 'IW (284)');

$date->addDays(1);

// Wednesday, 13th October 1999
compare('41', $date->format2('WW'), 'WW (285)');
compare('42', $date->format2('W1'), 'W1 (285)');
compare('42', $date->format2('W4'), 'W4 (285)');
compare('41', $date->format2('W7'), 'W7 (285)');
compare('41', $date->format2('IW'), 'IW (285)');

$date->addDays(1);

// Thursday, 14th October 1999
compare('41', $date->format2('WW'), 'WW (286)');
compare('42', $date->format2('W1'), 'W1 (286)');
compare('42', $date->format2('W4'), 'W4 (286)');
compare('41', $date->format2('W7'), 'W7 (286)');
compare('41', $date->format2('IW'), 'IW (286)');

$date->addDays(1);

// Friday, 15th October 1999
compare('42', $date->format2('WW'), 'WW (287)');
compare('42', $date->format2('W1'), 'W1 (287)');
compare('42', $date->format2('W4'), 'W4 (287)');
compare('41', $date->format2('W7'), 'W7 (287)');
compare('41', $date->format2('IW'), 'IW (287)');

$date->addDays(1);

// Saturday, 16th October 1999
compare('42', $date->format2('WW'), 'WW (288)');
compare('42', $date->format2('W1'), 'W1 (288)');
compare('42', $date->format2('W4'), 'W4 (288)');
compare('41', $date->format2('W7'), 'W7 (288)');
compare('41', $date->format2('IW'), 'IW (288)');

$date->addDays(1);

// Sunday, 17th October 1999
compare('42', $date->format2('WW'), 'WW (289)');
compare('42', $date->format2('W1'), 'W1 (289)');
compare('42', $date->format2('W4'), 'W4 (289)');
compare('41', $date->format2('W7'), 'W7 (289)');
compare('41', $date->format2('IW'), 'IW (289)');

$date->addDays(1);

// Monday, 18th October 1999
compare('42', $date->format2('WW'), 'WW (290)');
compare('42', $date->format2('W1'), 'W1 (290)');
compare('42', $date->format2('W4'), 'W4 (290)');
compare('41', $date->format2('W7'), 'W7 (290)');
compare('42', $date->format2('IW'), 'IW (290)');

$date->addDays(1);

// Tuesday, 19th October 1999
compare('42', $date->format2('WW'), 'WW (291)');
compare('42', $date->format2('W1'), 'W1 (291)');
compare('42', $date->format2('W4'), 'W4 (291)');
compare('41', $date->format2('W7'), 'W7 (291)');
compare('42', $date->format2('IW'), 'IW (291)');

$date->addDays(1);

// Wednesday, 20th October 1999
compare('42', $date->format2('WW'), 'WW (292)');
compare('43', $date->format2('W1'), 'W1 (292)');
compare('43', $date->format2('W4'), 'W4 (292)');
compare('42', $date->format2('W7'), 'W7 (292)');
compare('42', $date->format2('IW'), 'IW (292)');

$date->addDays(1);

// Thursday, 21st October 1999
compare('42', $date->format2('WW'), 'WW (293)');
compare('43', $date->format2('W1'), 'W1 (293)');
compare('43', $date->format2('W4'), 'W4 (293)');
compare('42', $date->format2('W7'), 'W7 (293)');
compare('42', $date->format2('IW'), 'IW (293)');

$date->addDays(1);

// Friday, 22nd October 1999
compare('43', $date->format2('WW'), 'WW (294)');
compare('43', $date->format2('W1'), 'W1 (294)');
compare('43', $date->format2('W4'), 'W4 (294)');
compare('42', $date->format2('W7'), 'W7 (294)');
compare('42', $date->format2('IW'), 'IW (294)');

$date->addDays(1);

// Saturday, 23rd October 1999
compare('43', $date->format2('WW'), 'WW (295)');
compare('43', $date->format2('W1'), 'W1 (295)');
compare('43', $date->format2('W4'), 'W4 (295)');
compare('42', $date->format2('W7'), 'W7 (295)');
compare('42', $date->format2('IW'), 'IW (295)');

$date->addDays(1);

// Sunday, 24th October 1999
compare('43', $date->format2('WW'), 'WW (296)');
compare('43', $date->format2('W1'), 'W1 (296)');
compare('43', $date->format2('W4'), 'W4 (296)');
compare('42', $date->format2('W7'), 'W7 (296)');
compare('42', $date->format2('IW'), 'IW (296)');

$date->addDays(1);

// Monday, 25th October 1999
compare('43', $date->format2('WW'), 'WW (297)');
compare('43', $date->format2('W1'), 'W1 (297)');
compare('43', $date->format2('W4'), 'W4 (297)');
compare('42', $date->format2('W7'), 'W7 (297)');
compare('43', $date->format2('IW'), 'IW (297)');

$date->addDays(1);

// Tuesday, 26th October 1999
compare('43', $date->format2('WW'), 'WW (298)');
compare('43', $date->format2('W1'), 'W1 (298)');
compare('43', $date->format2('W4'), 'W4 (298)');
compare('42', $date->format2('W7'), 'W7 (298)');
compare('43', $date->format2('IW'), 'IW (298)');

$date->addDays(1);

// Wednesday, 27th October 1999
compare('43', $date->format2('WW'), 'WW (299)');
compare('44', $date->format2('W1'), 'W1 (299)');
compare('44', $date->format2('W4'), 'W4 (299)');
compare('43', $date->format2('W7'), 'W7 (299)');
compare('43', $date->format2('IW'), 'IW (299)');

$date->addDays(1);

// Thursday, 28th October 1999
compare('43', $date->format2('WW'), 'WW (300)');
compare('44', $date->format2('W1'), 'W1 (300)');
compare('44', $date->format2('W4'), 'W4 (300)');
compare('43', $date->format2('W7'), 'W7 (300)');
compare('43', $date->format2('IW'), 'IW (300)');

$date->addDays(1);

// Friday, 29th October 1999
compare('44', $date->format2('WW'), 'WW (301)');
compare('44', $date->format2('W1'), 'W1 (301)');
compare('44', $date->format2('W4'), 'W4 (301)');
compare('43', $date->format2('W7'), 'W7 (301)');
compare('43', $date->format2('IW'), 'IW (301)');

$date->addDays(1);

// Saturday, 30th October 1999
compare('44', $date->format2('WW'), 'WW (302)');
compare('44', $date->format2('W1'), 'W1 (302)');
compare('44', $date->format2('W4'), 'W4 (302)');
compare('43', $date->format2('W7'), 'W7 (302)');
compare('43', $date->format2('IW'), 'IW (302)');

$date->addDays(1);

// Sunday, 31st October 1999
compare('44', $date->format2('WW'), 'WW (303)');
compare('44', $date->format2('W1'), 'W1 (303)');
compare('44', $date->format2('W4'), 'W4 (303)');
compare('43', $date->format2('W7'), 'W7 (303)');
compare('43', $date->format2('IW'), 'IW (303)');

$date->addDays(1);

// Monday, 1st November 1999
compare('44', $date->format2('WW'), 'WW (304)');
compare('44', $date->format2('W1'), 'W1 (304)');
compare('44', $date->format2('W4'), 'W4 (304)');
compare('43', $date->format2('W7'), 'W7 (304)');
compare('44', $date->format2('IW'), 'IW (304)');

$date->addDays(1);

// Tuesday, 2nd November 1999
compare('44', $date->format2('WW'), 'WW (305)');
compare('44', $date->format2('W1'), 'W1 (305)');
compare('44', $date->format2('W4'), 'W4 (305)');
compare('43', $date->format2('W7'), 'W7 (305)');
compare('44', $date->format2('IW'), 'IW (305)');

$date->addDays(1);

// Wednesday, 3rd November 1999
compare('44', $date->format2('WW'), 'WW (306)');
compare('45', $date->format2('W1'), 'W1 (306)');
compare('45', $date->format2('W4'), 'W4 (306)');
compare('44', $date->format2('W7'), 'W7 (306)');
compare('44', $date->format2('IW'), 'IW (306)');

$date->addDays(1);

// Thursday, 4th November 1999
compare('44', $date->format2('WW'), 'WW (307)');
compare('45', $date->format2('W1'), 'W1 (307)');
compare('45', $date->format2('W4'), 'W4 (307)');
compare('44', $date->format2('W7'), 'W7 (307)');
compare('44', $date->format2('IW'), 'IW (307)');

$date->addDays(1);

// Friday, 5th November 1999
compare('45', $date->format2('WW'), 'WW (308)');
compare('45', $date->format2('W1'), 'W1 (308)');
compare('45', $date->format2('W4'), 'W4 (308)');
compare('44', $date->format2('W7'), 'W7 (308)');
compare('44', $date->format2('IW'), 'IW (308)');

$date->addDays(1);

// Saturday, 6th November 1999
compare('45', $date->format2('WW'), 'WW (309)');
compare('45', $date->format2('W1'), 'W1 (309)');
compare('45', $date->format2('W4'), 'W4 (309)');
compare('44', $date->format2('W7'), 'W7 (309)');
compare('44', $date->format2('IW'), 'IW (309)');

$date->addDays(1);

// Sunday, 7th November 1999
compare('45', $date->format2('WW'), 'WW (310)');
compare('45', $date->format2('W1'), 'W1 (310)');
compare('45', $date->format2('W4'), 'W4 (310)');
compare('44', $date->format2('W7'), 'W7 (310)');
compare('44', $date->format2('IW'), 'IW (310)');

$date->addDays(1);

// Monday, 8th November 1999
compare('45', $date->format2('WW'), 'WW (311)');
compare('45', $date->format2('W1'), 'W1 (311)');
compare('45', $date->format2('W4'), 'W4 (311)');
compare('44', $date->format2('W7'), 'W7 (311)');
compare('45', $date->format2('IW'), 'IW (311)');

$date->addDays(1);

// Tuesday, 9th November 1999
compare('45', $date->format2('WW'), 'WW (312)');
compare('45', $date->format2('W1'), 'W1 (312)');
compare('45', $date->format2('W4'), 'W4 (312)');
compare('44', $date->format2('W7'), 'W7 (312)');
compare('45', $date->format2('IW'), 'IW (312)');

$date->addDays(1);

// Wednesday, 10th November 1999
compare('45', $date->format2('WW'), 'WW (313)');
compare('46', $date->format2('W1'), 'W1 (313)');
compare('46', $date->format2('W4'), 'W4 (313)');
compare('45', $date->format2('W7'), 'W7 (313)');
compare('45', $date->format2('IW'), 'IW (313)');

$date->addDays(1);

// Thursday, 11th November 1999
compare('45', $date->format2('WW'), 'WW (314)');
compare('46', $date->format2('W1'), 'W1 (314)');
compare('46', $date->format2('W4'), 'W4 (314)');
compare('45', $date->format2('W7'), 'W7 (314)');
compare('45', $date->format2('IW'), 'IW (314)');

$date->addDays(1);

// Friday, 12th November 1999
compare('46', $date->format2('WW'), 'WW (315)');
compare('46', $date->format2('W1'), 'W1 (315)');
compare('46', $date->format2('W4'), 'W4 (315)');
compare('45', $date->format2('W7'), 'W7 (315)');
compare('45', $date->format2('IW'), 'IW (315)');

$date->addDays(1);

// Saturday, 13th November 1999
compare('46', $date->format2('WW'), 'WW (316)');
compare('46', $date->format2('W1'), 'W1 (316)');
compare('46', $date->format2('W4'), 'W4 (316)');
compare('45', $date->format2('W7'), 'W7 (316)');
compare('45', $date->format2('IW'), 'IW (316)');

$date->addDays(1);

// Sunday, 14th November 1999
compare('46', $date->format2('WW'), 'WW (317)');
compare('46', $date->format2('W1'), 'W1 (317)');
compare('46', $date->format2('W4'), 'W4 (317)');
compare('45', $date->format2('W7'), 'W7 (317)');
compare('45', $date->format2('IW'), 'IW (317)');

$date->addDays(1);

// Monday, 15th November 1999
compare('46', $date->format2('WW'), 'WW (318)');
compare('46', $date->format2('W1'), 'W1 (318)');
compare('46', $date->format2('W4'), 'W4 (318)');
compare('45', $date->format2('W7'), 'W7 (318)');
compare('46', $date->format2('IW'), 'IW (318)');

$date->addDays(1);

// Tuesday, 16th November 1999
compare('46', $date->format2('WW'), 'WW (319)');
compare('46', $date->format2('W1'), 'W1 (319)');
compare('46', $date->format2('W4'), 'W4 (319)');
compare('45', $date->format2('W7'), 'W7 (319)');
compare('46', $date->format2('IW'), 'IW (319)');

$date->addDays(1);

// Wednesday, 17th November 1999
compare('46', $date->format2('WW'), 'WW (320)');
compare('47', $date->format2('W1'), 'W1 (320)');
compare('47', $date->format2('W4'), 'W4 (320)');
compare('46', $date->format2('W7'), 'W7 (320)');
compare('46', $date->format2('IW'), 'IW (320)');

$date->addDays(1);

// Thursday, 18th November 1999
compare('46', $date->format2('WW'), 'WW (321)');
compare('47', $date->format2('W1'), 'W1 (321)');
compare('47', $date->format2('W4'), 'W4 (321)');
compare('46', $date->format2('W7'), 'W7 (321)');
compare('46', $date->format2('IW'), 'IW (321)');

$date->addDays(1);

// Friday, 19th November 1999
compare('47', $date->format2('WW'), 'WW (322)');
compare('47', $date->format2('W1'), 'W1 (322)');
compare('47', $date->format2('W4'), 'W4 (322)');
compare('46', $date->format2('W7'), 'W7 (322)');
compare('46', $date->format2('IW'), 'IW (322)');

$date->addDays(1);

// Saturday, 20th November 1999
compare('47', $date->format2('WW'), 'WW (323)');
compare('47', $date->format2('W1'), 'W1 (323)');
compare('47', $date->format2('W4'), 'W4 (323)');
compare('46', $date->format2('W7'), 'W7 (323)');
compare('46', $date->format2('IW'), 'IW (323)');

$date->addDays(1);

// Sunday, 21st November 1999
compare('47', $date->format2('WW'), 'WW (324)');
compare('47', $date->format2('W1'), 'W1 (324)');
compare('47', $date->format2('W4'), 'W4 (324)');
compare('46', $date->format2('W7'), 'W7 (324)');
compare('46', $date->format2('IW'), 'IW (324)');

$date->addDays(1);

// Monday, 22nd November 1999
compare('47', $date->format2('WW'), 'WW (325)');
compare('47', $date->format2('W1'), 'W1 (325)');
compare('47', $date->format2('W4'), 'W4 (325)');
compare('46', $date->format2('W7'), 'W7 (325)');
compare('47', $date->format2('IW'), 'IW (325)');

$date->addDays(1);

// Tuesday, 23rd November 1999
compare('47', $date->format2('WW'), 'WW (326)');
compare('47', $date->format2('W1'), 'W1 (326)');
compare('47', $date->format2('W4'), 'W4 (326)');
compare('46', $date->format2('W7'), 'W7 (326)');
compare('47', $date->format2('IW'), 'IW (326)');

$date->addDays(1);

// Wednesday, 24th November 1999
compare('47', $date->format2('WW'), 'WW (327)');
compare('48', $date->format2('W1'), 'W1 (327)');
compare('48', $date->format2('W4'), 'W4 (327)');
compare('47', $date->format2('W7'), 'W7 (327)');
compare('47', $date->format2('IW'), 'IW (327)');

$date->addDays(1);

// Thursday, 25th November 1999
compare('47', $date->format2('WW'), 'WW (328)');
compare('48', $date->format2('W1'), 'W1 (328)');
compare('48', $date->format2('W4'), 'W4 (328)');
compare('47', $date->format2('W7'), 'W7 (328)');
compare('47', $date->format2('IW'), 'IW (328)');

$date->addDays(1);

// Friday, 26th November 1999
compare('48', $date->format2('WW'), 'WW (329)');
compare('48', $date->format2('W1'), 'W1 (329)');
compare('48', $date->format2('W4'), 'W4 (329)');
compare('47', $date->format2('W7'), 'W7 (329)');
compare('47', $date->format2('IW'), 'IW (329)');

$date->addDays(1);

// Saturday, 27th November 1999
compare('48', $date->format2('WW'), 'WW (330)');
compare('48', $date->format2('W1'), 'W1 (330)');
compare('48', $date->format2('W4'), 'W4 (330)');
compare('47', $date->format2('W7'), 'W7 (330)');
compare('47', $date->format2('IW'), 'IW (330)');

$date->addDays(1);

// Sunday, 28th November 1999
compare('48', $date->format2('WW'), 'WW (331)');
compare('48', $date->format2('W1'), 'W1 (331)');
compare('48', $date->format2('W4'), 'W4 (331)');
compare('47', $date->format2('W7'), 'W7 (331)');
compare('47', $date->format2('IW'), 'IW (331)');

$date->addDays(1);

// Monday, 29th November 1999
compare('48', $date->format2('WW'), 'WW (332)');
compare('48', $date->format2('W1'), 'W1 (332)');
compare('48', $date->format2('W4'), 'W4 (332)');
compare('47', $date->format2('W7'), 'W7 (332)');
compare('48', $date->format2('IW'), 'IW (332)');

$date->addDays(1);

// Tuesday, 30th November 1999
compare('48', $date->format2('WW'), 'WW (333)');
compare('48', $date->format2('W1'), 'W1 (333)');
compare('48', $date->format2('W4'), 'W4 (333)');
compare('47', $date->format2('W7'), 'W7 (333)');
compare('48', $date->format2('IW'), 'IW (333)');

$date->addDays(1);

// Wednesday, 1st December 1999
compare('48', $date->format2('WW'), 'WW (334)');
compare('49', $date->format2('W1'), 'W1 (334)');
compare('49', $date->format2('W4'), 'W4 (334)');
compare('48', $date->format2('W7'), 'W7 (334)');
compare('48', $date->format2('IW'), 'IW (334)');

$date->addDays(1);

// Thursday, 2nd December 1999
compare('48', $date->format2('WW'), 'WW (335)');
compare('49', $date->format2('W1'), 'W1 (335)');
compare('49', $date->format2('W4'), 'W4 (335)');
compare('48', $date->format2('W7'), 'W7 (335)');
compare('48', $date->format2('IW'), 'IW (335)');

$date->addDays(1);

// Friday, 3rd December 1999
compare('49', $date->format2('WW'), 'WW (336)');
compare('49', $date->format2('W1'), 'W1 (336)');
compare('49', $date->format2('W4'), 'W4 (336)');
compare('48', $date->format2('W7'), 'W7 (336)');
compare('48', $date->format2('IW'), 'IW (336)');

$date->addDays(1);

// Saturday, 4th December 1999
compare('49', $date->format2('WW'), 'WW (337)');
compare('49', $date->format2('W1'), 'W1 (337)');
compare('49', $date->format2('W4'), 'W4 (337)');
compare('48', $date->format2('W7'), 'W7 (337)');
compare('48', $date->format2('IW'), 'IW (337)');

$date->addDays(1);

// Sunday, 5th December 1999
compare('49', $date->format2('WW'), 'WW (338)');
compare('49', $date->format2('W1'), 'W1 (338)');
compare('49', $date->format2('W4'), 'W4 (338)');
compare('48', $date->format2('W7'), 'W7 (338)');
compare('48', $date->format2('IW'), 'IW (338)');

$date->addDays(1);

// Monday, 6th December 1999
compare('49', $date->format2('WW'), 'WW (339)');
compare('49', $date->format2('W1'), 'W1 (339)');
compare('49', $date->format2('W4'), 'W4 (339)');
compare('48', $date->format2('W7'), 'W7 (339)');
compare('49', $date->format2('IW'), 'IW (339)');

$date->addDays(1);

// Tuesday, 7th December 1999
compare('49', $date->format2('WW'), 'WW (340)');
compare('49', $date->format2('W1'), 'W1 (340)');
compare('49', $date->format2('W4'), 'W4 (340)');
compare('48', $date->format2('W7'), 'W7 (340)');
compare('49', $date->format2('IW'), 'IW (340)');

$date->addDays(1);

// Wednesday, 8th December 1999
compare('49', $date->format2('WW'), 'WW (341)');
compare('50', $date->format2('W1'), 'W1 (341)');
compare('50', $date->format2('W4'), 'W4 (341)');
compare('49', $date->format2('W7'), 'W7 (341)');
compare('49', $date->format2('IW'), 'IW (341)');

$date->addDays(1);

// Thursday, 9th December 1999
compare('49', $date->format2('WW'), 'WW (342)');
compare('50', $date->format2('W1'), 'W1 (342)');
compare('50', $date->format2('W4'), 'W4 (342)');
compare('49', $date->format2('W7'), 'W7 (342)');
compare('49', $date->format2('IW'), 'IW (342)');

$date->addDays(1);

// Friday, 10th December 1999
compare('50', $date->format2('WW'), 'WW (343)');
compare('50', $date->format2('W1'), 'W1 (343)');
compare('50', $date->format2('W4'), 'W4 (343)');
compare('49', $date->format2('W7'), 'W7 (343)');
compare('49', $date->format2('IW'), 'IW (343)');

$date->addDays(1);

// Saturday, 11th December 1999
compare('50', $date->format2('WW'), 'WW (344)');
compare('50', $date->format2('W1'), 'W1 (344)');
compare('50', $date->format2('W4'), 'W4 (344)');
compare('49', $date->format2('W7'), 'W7 (344)');
compare('49', $date->format2('IW'), 'IW (344)');

$date->addDays(1);

// Sunday, 12th December 1999
compare('50', $date->format2('WW'), 'WW (345)');
compare('50', $date->format2('W1'), 'W1 (345)');
compare('50', $date->format2('W4'), 'W4 (345)');
compare('49', $date->format2('W7'), 'W7 (345)');
compare('49', $date->format2('IW'), 'IW (345)');

$date->addDays(1);

// Monday, 13th December 1999
compare('50', $date->format2('WW'), 'WW (346)');
compare('50', $date->format2('W1'), 'W1 (346)');
compare('50', $date->format2('W4'), 'W4 (346)');
compare('49', $date->format2('W7'), 'W7 (346)');
compare('50', $date->format2('IW'), 'IW (346)');

$date->addDays(1);

// Tuesday, 14th December 1999
compare('50', $date->format2('WW'), 'WW (347)');
compare('50', $date->format2('W1'), 'W1 (347)');
compare('50', $date->format2('W4'), 'W4 (347)');
compare('49', $date->format2('W7'), 'W7 (347)');
compare('50', $date->format2('IW'), 'IW (347)');

$date->addDays(1);

// Wednesday, 15th December 1999
compare('50', $date->format2('WW'), 'WW (348)');
compare('51', $date->format2('W1'), 'W1 (348)');
compare('51', $date->format2('W4'), 'W4 (348)');
compare('50', $date->format2('W7'), 'W7 (348)');
compare('50', $date->format2('IW'), 'IW (348)');

$date->addDays(1);

// Thursday, 16th December 1999
compare('50', $date->format2('WW'), 'WW (349)');
compare('51', $date->format2('W1'), 'W1 (349)');
compare('51', $date->format2('W4'), 'W4 (349)');
compare('50', $date->format2('W7'), 'W7 (349)');
compare('50', $date->format2('IW'), 'IW (349)');

$date->addDays(1);

// Friday, 17th December 1999
compare('51', $date->format2('WW'), 'WW (350)');
compare('51', $date->format2('W1'), 'W1 (350)');
compare('51', $date->format2('W4'), 'W4 (350)');
compare('50', $date->format2('W7'), 'W7 (350)');
compare('50', $date->format2('IW'), 'IW (350)');

$date->addDays(1);

// Saturday, 18th December 1999
compare('51', $date->format2('WW'), 'WW (351)');
compare('51', $date->format2('W1'), 'W1 (351)');
compare('51', $date->format2('W4'), 'W4 (351)');
compare('50', $date->format2('W7'), 'W7 (351)');
compare('50', $date->format2('IW'), 'IW (351)');

$date->addDays(1);

// Sunday, 19th December 1999
compare('51', $date->format2('WW'), 'WW (352)');
compare('51', $date->format2('W1'), 'W1 (352)');
compare('51', $date->format2('W4'), 'W4 (352)');
compare('50', $date->format2('W7'), 'W7 (352)');
compare('50', $date->format2('IW'), 'IW (352)');

$date->addDays(1);

// Monday, 20th December 1999
compare('51', $date->format2('WW'), 'WW (353)');
compare('51', $date->format2('W1'), 'W1 (353)');
compare('51', $date->format2('W4'), 'W4 (353)');
compare('50', $date->format2('W7'), 'W7 (353)');
compare('51', $date->format2('IW'), 'IW (353)');

$date->addDays(1);

// Tuesday, 21st December 1999
compare('51', $date->format2('WW'), 'WW (354)');
compare('51', $date->format2('W1'), 'W1 (354)');
compare('51', $date->format2('W4'), 'W4 (354)');
compare('50', $date->format2('W7'), 'W7 (354)');
compare('51', $date->format2('IW'), 'IW (354)');

$date->addDays(1);

// Wednesday, 22nd December 1999
compare('51', $date->format2('WW'), 'WW (355)');
compare('52', $date->format2('W1'), 'W1 (355)');
compare('52', $date->format2('W4'), 'W4 (355)');
compare('51', $date->format2('W7'), 'W7 (355)');
compare('51', $date->format2('IW'), 'IW (355)');

$date->addDays(1);

// Thursday, 23rd December 1999
compare('51', $date->format2('WW'), 'WW (356)');
compare('52', $date->format2('W1'), 'W1 (356)');
compare('52', $date->format2('W4'), 'W4 (356)');
compare('51', $date->format2('W7'), 'W7 (356)');
compare('51', $date->format2('IW'), 'IW (356)');

$date->addDays(1);

// Friday, 24th December 1999
compare('52', $date->format2('WW'), 'WW (357)');
compare('52', $date->format2('W1'), 'W1 (357)');
compare('52', $date->format2('W4'), 'W4 (357)');
compare('51', $date->format2('W7'), 'W7 (357)');
compare('51', $date->format2('IW'), 'IW (357)');

$date->addDays(1);

// Saturday, 25th December 1999
compare('52', $date->format2('WW'), 'WW (358)');
compare('52', $date->format2('W1'), 'W1 (358)');
compare('52', $date->format2('W4'), 'W4 (358)');
compare('51', $date->format2('W7'), 'W7 (358)');
compare('51', $date->format2('IW'), 'IW (358)');

$date->addDays(1);

// Sunday, 26th December 1999
compare('52', $date->format2('WW'), 'WW (359)');
compare('52', $date->format2('W1'), 'W1 (359)');
compare('52', $date->format2('W4'), 'W4 (359)');
compare('51', $date->format2('W7'), 'W7 (359)');
compare('51', $date->format2('IW'), 'IW (359)');

$date->addDays(1);

// Monday, 27th December 1999
compare('52', $date->format2('WW'), 'WW (360)');
compare('52', $date->format2('W1'), 'W1 (360)');
compare('52', $date->format2('W4'), 'W4 (360)');
compare('51', $date->format2('W7'), 'W7 (360)');
compare('52', $date->format2('IW'), 'IW (360)');

$date->addDays(1);

// Tuesday, 28th December 1999
compare('52', $date->format2('WW'), 'WW (361)');
compare('52', $date->format2('W1'), 'W1 (361)');
compare('52', $date->format2('W4'), 'W4 (361)');
compare('51', $date->format2('W7'), 'W7 (361)');
compare('52', $date->format2('IW'), 'IW (361)');

$date->addDays(1);

// Wednesday, 29th December 1999
compare('52', $date->format2('WW'), 'WW (362)');
compare('53', $date->format2('W1'), 'W1 (362)');
compare('53', $date->format2('W4'), 'W4 (362)');
compare('52', $date->format2('W7'), 'W7 (362)');
compare('52', $date->format2('IW'), 'IW (362)');

$date->addDays(1);

// Thursday, 30th December 1999
compare('52', $date->format2('WW'), 'WW (363)');
compare('53', $date->format2('W1'), 'W1 (363)');
compare('53', $date->format2('W4'), 'W4 (363)');
compare('52', $date->format2('W7'), 'W7 (363)');
compare('52', $date->format2('IW'), 'IW (363)');

$date->addDays(1);

// Friday, 31st December 1999
compare('53', $date->format2('WW'), 'WW (364)');
compare('53', $date->format2('W1'), 'W1 (364)');
compare('53', $date->format2('W4'), 'W4 (364)');
compare('52', $date->format2('W7'), 'W7 (364)');
compare('52', $date->format2('IW'), 'IW (364)');

$date->addDays(1);

// Saturday, 1st January 2000
compare('01', $date->format2('WW'), 'WW (365)');
compare('01', $date->format2('W1'), 'W1 (365)');
compare('01', $date->format2('W4'), 'W4 (365)');
compare('52', $date->format2('W7'), 'W7 (365)');
compare('52', $date->format2('IW'), 'IW (365)');

$date->addDays(1);

// Sunday, 2nd January 2000
compare('01', $date->format2('WW'), 'WW (366)');
compare('01', $date->format2('W1'), 'W1 (366)');
compare('01', $date->format2('W4'), 'W4 (366)');
compare('52', $date->format2('W7'), 'W7 (366)');
compare('52', $date->format2('IW'), 'IW (366)');

$date->addDays(1);

// Monday, 3rd January 2000
compare('01', $date->format2('WW'), 'WW (367)');
compare('01', $date->format2('W1'), 'W1 (367)');
compare('01', $date->format2('W4'), 'W4 (367)');
compare('52', $date->format2('W7'), 'W7 (367)');
compare('01', $date->format2('IW'), 'IW (367)');

$date->addDays(1);

// Tuesday, 4th January 2000
compare('01', $date->format2('WW'), 'WW (368)');
compare('01', $date->format2('W1'), 'W1 (368)');
compare('01', $date->format2('W4'), 'W4 (368)');
compare('52', $date->format2('W7'), 'W7 (368)');
compare('01', $date->format2('IW'), 'IW (368)');

$date->addDays(1);

// Wednesday, 5th January 2000
compare('01', $date->format2('WW'), 'WW (369)');
compare('02', $date->format2('W1'), 'W1 (369)');
compare('02', $date->format2('W4'), 'W4 (369)');
compare('01', $date->format2('W7'), 'W7 (369)');
compare('01', $date->format2('IW'), 'IW (369)');

$date->addDays(1);

// Thursday, 6th January 2000
compare('01', $date->format2('WW'), 'WW (370)');
compare('02', $date->format2('W1'), 'W1 (370)');
compare('02', $date->format2('W4'), 'W4 (370)');
compare('01', $date->format2('W7'), 'W7 (370)');
compare('01', $date->format2('IW'), 'IW (370)');

$date->addDays(1);

// Friday, 7th January 2000
compare('01', $date->format2('WW'), 'WW (371)');
compare('02', $date->format2('W1'), 'W1 (371)');
compare('02', $date->format2('W4'), 'W4 (371)');
compare('01', $date->format2('W7'), 'W7 (371)');
compare('01', $date->format2('IW'), 'IW (371)');

$date->addDays(1);

// Saturday, 8th January 2000
compare('02', $date->format2('WW'), 'WW (372)');
compare('02', $date->format2('W1'), 'W1 (372)');
compare('02', $date->format2('W4'), 'W4 (372)');
compare('01', $date->format2('W7'), 'W7 (372)');
compare('01', $date->format2('IW'), 'IW (372)');


?>