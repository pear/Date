<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Tests for the Date_Calc::addSeconds() function
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


$date = new Date("1972-07-01 05:29:58.987654",
                 true); // count leap seconds
$date->setTZbyID("Asia/Calcutta");

$datetest = new Date($date);
$datetest->addSeconds(1, true);
compare("01/07/1972 05.29.59.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1");
$datetest = new Date($date);
$datetest->addSeconds(2, true);
compare("01/07/1972 05.29.60.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "2"); // leap second
$datetest = new Date($date);
$datetest->addSeconds(3, true);
compare("01/07/1972 05.30.00.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3");
$datetest = new Date($date);
$datetest->addSeconds(4, true);
compare("01/07/1972 05.30.01.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "4");
$datetest = new Date($date);
$datetest->addSeconds(5, true);
compare("01/07/1972 05.30.02.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "5");
$datetest = new Date($date);
$datetest->addSeconds(6, true);
compare("01/07/1972 05.30.03.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "6");
$datetest = new Date($date);
$datetest->addSeconds(7, true);
compare("01/07/1972 05.30.04.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7");
$datetest = new Date($date);
$datetest->addSeconds(8, true);
compare("01/07/1972 05.30.05.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "8");
$datetest = new Date($date);
$datetest->addSeconds(9, true);
compare("01/07/1972 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "9");
$datetest = new Date($date);
$datetest->addSeconds(10, true);
compare("01/07/1972 05.30.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "10");
$datetest = new Date($date);
$datetest->addSeconds(60, true);
compare("01/07/1972 05.30.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "60");
$datetest = new Date($date);
$datetest->addSeconds(3599, true);
compare("01/07/1972 06.29.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3599");
$datetest = new Date($date);
$datetest->addSeconds(3600, true);
compare("01/07/1972 06.29.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3600");
$datetest = new Date($date);
$datetest->addSeconds(3601, true);
compare("01/07/1972 06.29.58.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3601");
$datetest = new Date($date);
$datetest->addSeconds(7199, true);
compare("01/07/1972 07.29.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7199");
$datetest = new Date($date);
$datetest->addSeconds(7200, true);
compare("01/07/1972 07.29.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7200");
$datetest = new Date($date);
$datetest->addSeconds(7201, true);
compare("01/07/1972 07.29.58.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7201");
$datetest = new Date($date);
$datetest->addSeconds(86400, true);
compare("02/07/1972 05.29.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "86400");
$datetest = new Date($date);
$datetest->addSeconds(864000, true);
compare("11/07/1972 05.29.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "864000");
$datetest = new Date($date);
$datetest->addSeconds(8640000, true);
compare("09/10/1972 05.29.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "8640000");
$datetest = new Date($date);
$datetest->addSeconds(31622400, true);
compare("02/07/1973 05.29.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "31622400"); // 2 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(63244800, true);
compare("03/07/1974 05.29.55.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "63244800"); // 3 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(94867200, true);
compare("04/07/1975 05.29.54.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "94867200"); // 4 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(126489600, true);
compare("04/07/1976 05.29.53.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "126489600"); // etc.
$datetest = new Date($date);
$datetest->addSeconds(158112000, true);
compare("05/07/1977 05.29.52.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "158112000");
$datetest = new Date($date);
$datetest->addSeconds(189734400, true);
compare("06/07/1978 05.29.51.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "189734400");
$datetest = new Date($date);
$datetest->addSeconds(221356800, true);
compare("07/07/1979 05.29.50.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "221356800");
$datetest = new Date($date);
$datetest->addSeconds(252979200, true);
compare("07/07/1980 05.29.49.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "252979200");
$datetest = new Date($date);
$datetest->addSeconds(284601600, true);
compare("08/07/1981 05.29.48.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "284601600"); // leap second in June 1981
$datetest = new Date($date);
$datetest->addSeconds(316224000, true);
compare("09/07/1982 05.29.47.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "316224000");
$datetest = new Date($date);
$datetest->addSeconds(347846400, true);
compare("10/07/1983 05.29.46.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "347846400");
$datetest = new Date($date);
$datetest->addSeconds(379468800, true);
compare("10/07/1984 05.29.46.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "379468800"); // no leap second in 1984
$datetest = new Date($date);
$datetest->addSeconds(411091200, true);
compare("11/07/1985 05.29.45.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "411091200"); // leap second in June 1985
$datetest = new Date($date);
$datetest->addSeconds(442713600, true);
compare("12/07/1986 05.29.45.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "442713600"); // no leap second in 1986
$datetest = new Date($date);
$datetest->addSeconds(474336000, true);
compare("13/07/1987 05.29.45.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "474336000");
$datetest = new Date($date);
$datetest->addSeconds(505958400, true);
compare("13/07/1988 05.29.44.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "505958400"); // leap second in Dec 1987
$datetest = new Date($date);
$datetest->addSeconds(537580800, true);
compare("14/07/1989 05.29.44.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "537580800");
$datetest = new Date($date);
$datetest->addSeconds(569203200, true);
compare("15/07/1990 05.29.43.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "569203200");
$datetest = new Date($date);
$datetest->addSeconds(600825600, true);
compare("16/07/1991 05.29.42.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "600825600");
$datetest = new Date($date);
$datetest->addSeconds(632448000, true);
compare("16/07/1992 05.29.41.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "632448000");
$datetest = new Date($date);
$datetest->addSeconds(664070400, true);
compare("17/07/1993 05.29.40.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "664070400");
$datetest = new Date($date);
$datetest->addSeconds(695692800, true);
compare("18/07/1994 05.29.39.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "695692800");
$datetest = new Date($date);
$datetest->addSeconds(727315200, true);
compare("19/07/1995 05.29.39.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "727315200");
$datetest = new Date($date);
$datetest->addSeconds(758937600, true);
compare("19/07/1996 05.29.38.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "758937600");
$datetest = new Date($date);
$datetest->addSeconds(790560000, true);
compare("20/07/1997 05.29.37.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "790560000");
$datetest = new Date($date);
$datetest->addSeconds(822182400, true);
compare("21/07/1998 05.29.37.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "822182400");
$datetest = new Date($date);
$datetest->addSeconds(853804800, true);
compare("22/07/1999 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "853804800");
$datetest = new Date($date);
$datetest->addSeconds(885427200, true);
compare("22/07/2000 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "885427200");
$datetest = new Date($date);
$datetest->addSeconds(917049600, true);
compare("23/07/2001 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "917049600");
$datetest = new Date($date);
$datetest->addSeconds(948672000, true);
compare("24/07/2002 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "948672000");
$datetest = new Date($date);
$datetest->addSeconds(980294400, true);
compare("25/07/2003 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "980294400");
$datetest = new Date($date);
$datetest->addSeconds(1011916800, true);
compare("25/07/2004 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1011916800");
$datetest = new Date($date);
$datetest->addSeconds(1043539200, true);
compare("26/07/2005 05.29.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1043539200");
$datetest = new Date($date);
$datetest->addSeconds(1075161600, true);
compare("27/07/2006 05.29.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1075161600"); // 23rd leap second in Dec 2005
$datetest = new Date($date);
$datetest->addSeconds(1106784000, true);
compare("28/07/2007 05.29.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1106784000");
$datetest = new Date($date);
$datetest->addSeconds(1138406400, true);
compare("28/07/2008 05.29.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1138406400");
$datetest = new Date($date);
$datetest->addSeconds(1170028800, true);
compare("29/07/2009 05.29.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1170028800");


$date->setDate("2006-01-01 05:30:05.987654");

$datetest = new Date($date);
$datetest->addSeconds(-1, true);
compare("01/01/2006 05.30.04.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1");
$datetest = new Date($date);
$datetest->addSeconds(-2, true);
compare("01/01/2006 05.30.03.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-2");
$datetest = new Date($date);
$datetest->addSeconds(-3, true);
compare("01/01/2006 05.30.02.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3");
$datetest = new Date($date);
$datetest->addSeconds(-4, true);
compare("01/01/2006 05.30.01.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-4");
$datetest = new Date($date);
$datetest->addSeconds(-5, true);
compare("01/01/2006 05.30.00.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-5");
$datetest = new Date($date);
$datetest->addSeconds(-6, true);
compare("01/01/2006 05.29.60.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-6"); // leap second
$datetest = new Date($date);
$datetest->addSeconds(-7, true);
compare("01/01/2006 05.29.59.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7");
$datetest = new Date($date);
$datetest->addSeconds(-8, true);
compare("01/01/2006 05.29.58.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-8");
$datetest = new Date($date);
$datetest->addSeconds(-9, true);
compare("01/01/2006 05.29.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-9");
$datetest = new Date($date);
$datetest->addSeconds(-10, true);
compare("01/01/2006 05.29.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-10");
$datetest = new Date($date);
$datetest->addSeconds(-60, true);
compare("01/01/2006 05.29.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-60");
$datetest = new Date($date);
$datetest->addSeconds(-3599, true);
compare("01/01/2006 04.30.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3599");
$datetest = new Date($date);
$datetest->addSeconds(-3600, true);
compare("01/01/2006 04.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3600");
$datetest = new Date($date);
$datetest->addSeconds(-3601, true);
compare("01/01/2006 04.30.05.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3601");
$datetest = new Date($date);
$datetest->addSeconds(-7199, true);
compare("01/01/2006 03.30.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7199");
$datetest = new Date($date);
$datetest->addSeconds(-7200, true);
compare("01/01/2006 03.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7200");
$datetest = new Date($date);
$datetest->addSeconds(-7201, true);
compare("01/01/2006 03.30.05.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7201");
$datetest = new Date($date);
$datetest->addSeconds(-86400, true);
compare("31/12/2005 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-86400");
$datetest = new Date($date);
$datetest->addSeconds(-864000, true);
compare("22/12/2005 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-864000");
$datetest = new Date($date);
$datetest->addSeconds(-8640000, true);
compare("23/09/2005 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-8640000");
$datetest = new Date($date);
$datetest->addSeconds(-31622400, true);
compare("31/12/2004 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-31622400");
$datetest = new Date($date);
$datetest->addSeconds(-63244800, true);
compare("31/12/2003 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-63244800");
$datetest = new Date($date);
$datetest->addSeconds(-94867200, true);
compare("30/12/2002 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-94867200");
$datetest = new Date($date);
$datetest->addSeconds(-126489600, true);
compare("29/12/2001 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-126489600");
$datetest = new Date($date);
$datetest->addSeconds(-158112000, true);
compare("28/12/2000 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-158112000");
$datetest = new Date($date);
$datetest->addSeconds(-189734400, true);
compare("28/12/1999 05.30.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-189734400");
$datetest = new Date($date);
$datetest->addSeconds(-221356800, true);
compare("27/12/1998 05.30.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-221356800"); // 2 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(-252979200, true);
compare("26/12/1997 05.30.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-252979200");
$datetest = new Date($date);
$datetest->addSeconds(-284601600, true);
compare("25/12/1996 05.30.08.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-284601600"); // leap second in June 1997
$datetest = new Date($date);
$datetest->addSeconds(-316224000, true);
compare("25/12/1995 05.30.09.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-316224000"); // leap second in Dec 1995
$datetest = new Date($date);
$datetest->addSeconds(-347846400, true);
compare("24/12/1994 05.30.09.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-347846400");
$datetest = new Date($date);
$datetest->addSeconds(-379468800, true);
compare("23/12/1993 05.30.10.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-379468800"); // leap second in June 1994
$datetest = new Date($date);
$datetest->addSeconds(-411091200, true);
compare("22/12/1992 05.30.11.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-411091200"); // leap second in June 1993
$datetest = new Date($date);
$datetest->addSeconds(-442713600, true);
compare("22/12/1991 05.30.12.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-442713600"); // leap second in June 1992
$datetest = new Date($date);
$datetest->addSeconds(-474336000, true);
compare("21/12/1990 05.30.13.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-474336000"); // leap second in Dec 1990
$datetest = new Date($date);
$datetest->addSeconds(-505958400, true);
compare("20/12/1989 05.30.14.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-505958400"); // leap second in Dec 1989
$datetest = new Date($date);
$datetest->addSeconds(-537580800, true);
compare("19/12/1988 05.30.14.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-537580800");
$datetest = new Date($date);
$datetest->addSeconds(-569203200, true);
compare("19/12/1987 05.30.15.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-569203200"); // leap second in Dec 1987
$datetest = new Date($date);
$datetest->addSeconds(-600825600, true);
compare("18/12/1986 05.30.15.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-600825600");
$datetest = new Date($date);
$datetest->addSeconds(-632448000, true);
compare("17/12/1985 05.30.15.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-632448000");
$datetest = new Date($date);
$datetest->addSeconds(-664070400, true);
compare("16/12/1984 05.30.16.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-664070400"); // leap second in June 1985
$datetest = new Date($date);
$datetest->addSeconds(-695692800, true);
compare("16/12/1983 05.30.16.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-695692800");
$datetest = new Date($date);
$datetest->addSeconds(-727315200, true);
compare("15/12/1982 05.30.17.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-727315200");
$datetest = new Date($date);
$datetest->addSeconds(-758937600, true);
compare("14/12/1981 05.30.18.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-758937600");
$datetest = new Date($date);
$datetest->addSeconds(-790560000, true);
compare("13/12/1980 05.30.19.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-790560000");
$datetest = new Date($date);
$datetest->addSeconds(-822182400, true);
compare("13/12/1979 05.30.20.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-822182400");
$datetest = new Date($date);
$datetest->addSeconds(-853804800, true);
compare("12/12/1978 05.30.21.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-853804800");
$datetest = new Date($date);
$datetest->addSeconds(-885427200, true);
compare("11/12/1977 05.30.22.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-885427200");
$datetest = new Date($date);
$datetest->addSeconds(-917049600, true);
compare("10/12/1976 05.30.23.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-917049600");
$datetest = new Date($date);
$datetest->addSeconds(-948672000, true);
compare("10/12/1975 05.30.24.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-948672000");
$datetest = new Date($date);
$datetest->addSeconds(-980294400, true);
compare("09/12/1974 05.30.25.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-980294400");
$datetest = new Date($date);
$datetest->addSeconds(-1011916800, true);
compare("08/12/1973 05.30.26.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1011916800");
$datetest = new Date($date);
$datetest->addSeconds(-1043539200, true);
compare("07/12/1972 05.30.27.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1043539200");
$datetest = new Date($date);
$datetest->addSeconds(-1075161600, true);
compare("07/12/1971 05.30.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1075161600"); // 23 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(-1106784000, true);
compare("06/12/1970 05.30.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1106784000");
$datetest = new Date($date);
$datetest->addSeconds(-1138406400, true);
compare("05/12/1969 05.30.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1138406400");
$datetest = new Date($date);
$datetest->addSeconds(-1170028800, true);
compare("04/12/1968 05.30.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1170028800");



?>