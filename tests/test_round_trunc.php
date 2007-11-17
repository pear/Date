<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Tests Date:round() and Date::trunc()
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

$date = new Date("19871109T16:12:24.171878000");

$od = new Date($date);
$od->round(-6);
compare('0000-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-6 (1)');
$od = new Date($date);
$od->round(-5);
compare('2000-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-5 (1)');
$od = new Date($date);
$od->round(-4);
compare('2000-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-4 (1)');
$od = new Date($date);
$od->round(-3);
compare('1990-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-3 (1)');
$od = new Date($date);
$od->round(-2);
compare('1988-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-2 (1)');
$od = new Date($date);
$od->round(-1);
compare('1987-11-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-1 (1)');
$od = new Date($date);
$od->round(0);
compare('1987-11-10 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '0 (1)');
$od = new Date($date);
$od->round(1);
compare('1987-11-09 16.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '1 (1)');
$od = new Date($date);
$od->round(2);
compare('1987-11-09 16.10.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '2 (1)');
$od = new Date($date);
$od->round(3);
compare('1987-11-09 16.12.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '3 (1)');
$od = new Date($date);
$od->round(4);
compare('1987-11-09 16.12.20.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '4 (1)');
$od = new Date($date);
$od->round(5);
compare('1987-11-09 16.12.24.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '5 (1)');
$od = new Date($date);
$od->round(6);
compare('1987-11-09 16.12.24.200000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '6 (1)');
$od = new Date($date);
$od->round(7);
compare('1987-11-09 16.12.24.170000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '7 (1)');
$od = new Date($date);
$od->round(8);
compare('1987-11-09 16.12.24.172000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '8 (1)');
$od = new Date($date);
$od->round(9);
compare('1987-11-09 16.12.24.171900000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '9 (1)');
$od = new Date($date);
$od->round(10);
compare('1987-11-09 16.12.24.171880000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '10 (1)');
$od = new Date($date);
$od->round(11);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '11 (1)');
$od = new Date($date);
$od->round(12);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '12 (1)');
$od = new Date($date);
$od->round(13);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '13 (1)');
$od = new Date($date);
$od->round(14);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '14 (1)');

$od = new Date($date);
$od->trunc(-6);
compare('0000-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-6 (1)');
$od = new Date($date);
$od->trunc(-5);
compare('1000-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-5 (1)');
$od = new Date($date);
$od->trunc(-4);
compare('1900-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-4 (1)');
$od = new Date($date);
$od->trunc(-3);
compare('1980-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-3 (1)');
$od = new Date($date);
$od->trunc(-2);
compare('1987-00-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-2 (1)');
$od = new Date($date);
$od->trunc(-1);
compare('1987-11-00 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '-1 (1)');
$od = new Date($date);
$od->trunc(0);
compare('1987-11-09 00.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '0 (1)');
$od = new Date($date);
$od->trunc(1);
compare('1987-11-09 16.00.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '1 (1)');
$od = new Date($date);
$od->trunc(2);
compare('1987-11-09 16.10.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '2 (1)');
$od = new Date($date);
$od->trunc(3);
compare('1987-11-09 16.12.00.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '3 (1)');
$od = new Date($date);
$od->trunc(4);
compare('1987-11-09 16.12.20.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '4 (1)');
$od = new Date($date);
$od->trunc(5);
compare('1987-11-09 16.12.24.000000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '5 (1)');
$od = new Date($date);
$od->trunc(6);
compare('1987-11-09 16.12.24.100000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '6 (1)');
$od = new Date($date);
$od->trunc(7);
compare('1987-11-09 16.12.24.170000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '7 (1)');
$od = new Date($date);
$od->trunc(8);
compare('1987-11-09 16.12.24.171000000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '8 (1)');
$od = new Date($date);
$od->trunc(9);
compare('1987-11-09 16.12.24.171800000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '9 (1)');
$od = new Date($date);
$od->trunc(10);
compare('1987-11-09 16.12.24.171870000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '10 (1)');
$od = new Date($date);
$od->trunc(11);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '11 (1)');
$od = new Date($date);
$od->trunc(12);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '12 (1)');
$od = new Date($date);
$od->trunc(13);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '13 (1)');
$od = new Date($date);
$od->trunc(14);
compare('1987-11-09 16.12.24.171878000', $od->format2('YYYY-MM-DD HH.MI.SS.FFFFFFFFF'), '14 (1)');


$od = new Date("19870709T12:00:00");
$od->round(DATE_PRECISION_DAY);
compare('1987-07-10 00.00.00', $od->format2('YYYY-MM-DD HH.MI.SS'), 'Midday test 1');
$od = new Date("19870709T11:59:59.999999");
$od->round(DATE_PRECISION_DAY);
compare('1987-07-09 00.00.00', $od->format2('YYYY-MM-DD HH.MI.SS'), 'Midday test 2');




?>