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


$date = new Date("1972-07-01 01:59:58.987654",
                 true); // count leap seconds
$date->setTZbyID("Europe/Paris");

$datetest = new Date($date);
$datetest->addSeconds(1, true);
compare("01/07/1972 01.59.59.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1");
$datetest = new Date($date);
$datetest->addSeconds(2, true);
compare("01/07/1972 01.59.60.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "2"); // leap second
$datetest = new Date($date);
$datetest->addSeconds(3, true);
compare("01/07/1972 02.00.00.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3");
$datetest = new Date($date);
$datetest->addSeconds(4, true);
compare("01/07/1972 02.00.01.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "4");
$datetest = new Date($date);
$datetest->addSeconds(5, true);
compare("01/07/1972 02.00.02.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "5");
$datetest = new Date($date);
$datetest->addSeconds(6, true);
compare("01/07/1972 02.00.03.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "6");
$datetest = new Date($date);
$datetest->addSeconds(7, true);
compare("01/07/1972 02.00.04.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7");
$datetest = new Date($date);
$datetest->addSeconds(8, true);
compare("01/07/1972 02.00.05.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "8");
$datetest = new Date($date);
$datetest->addSeconds(9, true);
compare("01/07/1972 02.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "9");
$datetest = new Date($date);
$datetest->addSeconds(10, true);
compare("01/07/1972 02.00.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "10");
$datetest = new Date($date);
$datetest->addSeconds(60, true);
compare("01/07/1972 02.00.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "60");
$datetest = new Date($date);
$datetest->addSeconds(3599, true);
compare("01/07/1972 02.59.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3599");
$datetest = new Date($date);
$datetest->addSeconds(3600, true);
compare("01/07/1972 02.59.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3600");
$datetest = new Date($date);
$datetest->addSeconds(3601, true);
compare("01/07/1972 02.59.58.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "3601");
$datetest = new Date($date);
$datetest->addSeconds(7199, true);
compare("01/07/1972 03.59.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7199");
$datetest = new Date($date);
$datetest->addSeconds(7200, true);
compare("01/07/1972 03.59.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7200");
$datetest = new Date($date);
$datetest->addSeconds(7201, true);
compare("01/07/1972 03.59.58.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "7201");
$datetest = new Date($date);
$datetest->addSeconds(86400, true);
compare("02/07/1972 01.59.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "86400");
$datetest = new Date($date);
$datetest->addSeconds(864000, true);
compare("11/07/1972 01.59.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "864000");
$datetest = new Date($date);
$datetest->addSeconds(8640000, true);
compare("09/10/1972 01.59.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "8640000");
$datetest = new Date($date);
$datetest->addSeconds(31622400, true);
compare("02/07/1973 01.59.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "31622400"); // 2 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(63244800, true);
compare("03/07/1974 01.59.55.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "63244800"); // 3 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(94867200, true);
compare("04/07/1975 01.59.54.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "94867200"); // 4 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(126489600, true);
compare("04/07/1976 01.59.53.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "126489600"); // etc.
$datetest = new Date($date);
$datetest->addSeconds(158112000, true);
compare("05/07/1977 01.59.52.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "158112000");
$datetest = new Date($date);
$datetest->addSeconds(189734400, true);
compare("06/07/1978 01.59.51.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "189734400");
$datetest = new Date($date);
$datetest->addSeconds(221356800, true);
compare("07/07/1979 01.59.50.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "221356800");
$datetest = new Date($date);
$datetest->addSeconds(252979200, true);
compare("07/07/1980 01.59.49.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "252979200");
$datetest = new Date($date);
$datetest->addSeconds(284601600, true);
compare("08/07/1981 01.59.48.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "284601600"); // leap second in June 1981
$datetest = new Date($date);
$datetest->addSeconds(316224000, true);
compare("09/07/1982 01.59.47.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "316224000");
$datetest = new Date($date);
$datetest->addSeconds(347846400, true);
compare("10/07/1983 01.59.46.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "347846400");
$datetest = new Date($date);
$datetest->addSeconds(379468800, true);
compare("10/07/1984 01.59.46.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "379468800"); // no leap second in 1984
$datetest = new Date($date);
$datetest->addSeconds(411091200, true);
compare("11/07/1985 01.59.45.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "411091200"); // leap second in June 1985
$datetest = new Date($date);
$datetest->addSeconds(442713600, true);
compare("12/07/1986 01.59.45.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "442713600"); // no leap second in 1986
$datetest = new Date($date);
$datetest->addSeconds(474336000, true);
compare("13/07/1987 01.59.45.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "474336000");
$datetest = new Date($date);
$datetest->addSeconds(505958400, true);
compare("13/07/1988 01.59.44.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "505958400"); // leap second in Dec 1987
$datetest = new Date($date);
$datetest->addSeconds(537580800, true);
compare("14/07/1989 01.59.44.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "537580800");
$datetest = new Date($date);
$datetest->addSeconds(569203200, true);
compare("15/07/1990 01.59.43.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "569203200");
$datetest = new Date($date);
$datetest->addSeconds(600825600, true);
compare("16/07/1991 01.59.42.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "600825600");
$datetest = new Date($date);
$datetest->addSeconds(632448000, true);
compare("16/07/1992 01.59.41.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "632448000");
$datetest = new Date($date);
$datetest->addSeconds(664070400, true);
compare("17/07/1993 01.59.40.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "664070400");
$datetest = new Date($date);
$datetest->addSeconds(695692800, true);
compare("18/07/1994 01.59.39.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "695692800");
$datetest = new Date($date);
$datetest->addSeconds(727315200, true);
compare("19/07/1995 01.59.39.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "727315200");
$datetest = new Date($date);
$datetest->addSeconds(758937600, true);
compare("19/07/1996 01.59.38.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "758937600");
$datetest = new Date($date);
$datetest->addSeconds(790560000, true);
compare("20/07/1997 01.59.37.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "790560000");
$datetest = new Date($date);
$datetest->addSeconds(822182400, true);
compare("21/07/1998 01.59.37.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "822182400");
$datetest = new Date($date);
$datetest->addSeconds(853804800, true);
compare("22/07/1999 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "853804800");
$datetest = new Date($date);
$datetest->addSeconds(885427200, true);
compare("22/07/2000 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "885427200");
$datetest = new Date($date);
$datetest->addSeconds(917049600, true);
compare("23/07/2001 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "917049600");
$datetest = new Date($date);
$datetest->addSeconds(948672000, true);
compare("24/07/2002 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "948672000");
$datetest = new Date($date);
$datetest->addSeconds(980294400, true);
compare("25/07/2003 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "980294400");
$datetest = new Date($date);
$datetest->addSeconds(1011916800, true);
compare("25/07/2004 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1011916800");
$datetest = new Date($date);
$datetest->addSeconds(1043539200, true);
compare("26/07/2005 01.59.36.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1043539200");
$datetest = new Date($date);
$datetest->addSeconds(1075161600, true);
compare("27/07/2006 01.59.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1075161600"); // 23rd leap second in Dec 2005
$datetest = new Date($date);
$datetest->addSeconds(1106784000, true);
compare("28/07/2007 01.59.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1106784000");
$datetest = new Date($date);
$datetest->addSeconds(1138406400, true);
compare("28/07/2008 01.59.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1138406400");
$datetest = new Date($date);
$datetest->addSeconds(1170028800, true);
compare("29/07/2009 01.59.35.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "1170028800");


$date->setDate("2006-01-01 01:00:05.987654");

$datetest = new Date($date);
$datetest->addSeconds(-1, true);
compare("01/01/2006 01.00.04.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1");
$datetest = new Date($date);
$datetest->addSeconds(-2, true);
compare("01/01/2006 01.00.03.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-2");
$datetest = new Date($date);
$datetest->addSeconds(-3, true);
compare("01/01/2006 01.00.02.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3");
$datetest = new Date($date);
$datetest->addSeconds(-4, true);
compare("01/01/2006 01.00.01.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-4");
$datetest = new Date($date);
$datetest->addSeconds(-5, true);
compare("01/01/2006 01.00.00.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-5");
$datetest = new Date($date);
$datetest->addSeconds(-6, true);
compare("01/01/2006 00.59.60.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-6"); // leap second
$datetest = new Date($date);
$datetest->addSeconds(-7, true);
compare("01/01/2006 00.59.59.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7");
$datetest = new Date($date);
$datetest->addSeconds(-8, true);
compare("01/01/2006 00.59.58.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-8");
$datetest = new Date($date);
$datetest->addSeconds(-9, true);
compare("01/01/2006 00.59.57.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-9");
$datetest = new Date($date);
$datetest->addSeconds(-10, true);
compare("01/01/2006 00.59.56.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-10");
$datetest = new Date($date);
$datetest->addSeconds(-60, true);
compare("01/01/2006 00.59.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-60");
$datetest = new Date($date);
$datetest->addSeconds(-3599, true);
compare("01/01/2006 00.00.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3599");
$datetest = new Date($date);
$datetest->addSeconds(-3600, true);
compare("01/01/2006 00.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3600");
$datetest = new Date($date);
$datetest->addSeconds(-3601, true);
compare("01/01/2006 00.00.05.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-3601");
$datetest = new Date($date);
$datetest->addSeconds(-7199, true);
compare("31/12/2005 23.00.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7199");
$datetest = new Date($date);
$datetest->addSeconds(-7200, true);
compare("31/12/2005 23.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7200");
$datetest = new Date($date);
$datetest->addSeconds(-7201, true);
compare("31/12/2005 23.00.05.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-7201");
$datetest = new Date($date);
$datetest->addSeconds(-86400, true);
compare("31/12/2005 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-86400");
$datetest = new Date($date);
$datetest->addSeconds(-864000, true);
compare("22/12/2005 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-864000");
$datetest = new Date($date);
$datetest->addSeconds(-8640000, true);
compare("23/09/2005 02.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-8640000");
$datetest = new Date($date);
$datetest->addSeconds(-31622400, true);
compare("31/12/2004 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-31622400");
$datetest = new Date($date);
$datetest->addSeconds(-63244800, true);
compare("31/12/2003 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-63244800");
$datetest = new Date($date);
$datetest->addSeconds(-94867200, true);
compare("30/12/2002 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-94867200");
$datetest = new Date($date);
$datetest->addSeconds(-126489600, true);
compare("29/12/2001 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-126489600");
$datetest = new Date($date);
$datetest->addSeconds(-158112000, true);
compare("28/12/2000 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-158112000");
$datetest = new Date($date);
$datetest->addSeconds(-189734400, true);
compare("28/12/1999 01.00.06.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-189734400");
$datetest = new Date($date);
$datetest->addSeconds(-221356800, true);
compare("27/12/1998 01.00.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-221356800"); // 2 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(-252979200, true);
compare("26/12/1997 01.00.07.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-252979200");
$datetest = new Date($date);
$datetest->addSeconds(-284601600, true);
compare("25/12/1996 01.00.08.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-284601600"); // leap second in June 1997
$datetest = new Date($date);
$datetest->addSeconds(-316224000, true);
compare("25/12/1995 01.00.09.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-316224000"); // leap second in Dec 1995
$datetest = new Date($date);
$datetest->addSeconds(-347846400, true);
compare("24/12/1994 01.00.09.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-347846400");
$datetest = new Date($date);
$datetest->addSeconds(-379468800, true);
compare("23/12/1993 01.00.10.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-379468800"); // leap second in June 1994
$datetest = new Date($date);
$datetest->addSeconds(-411091200, true);
compare("22/12/1992 01.00.11.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-411091200"); // leap second in June 1993
$datetest = new Date($date);
$datetest->addSeconds(-442713600, true);
compare("22/12/1991 01.00.12.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-442713600"); // leap second in June 1992
$datetest = new Date($date);
$datetest->addSeconds(-474336000, true);
compare("21/12/1990 01.00.13.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-474336000"); // leap second in Dec 1990
$datetest = new Date($date);
$datetest->addSeconds(-505958400, true);
compare("20/12/1989 01.00.14.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-505958400"); // leap second in Dec 1989
$datetest = new Date($date);
$datetest->addSeconds(-537580800, true);
compare("19/12/1988 01.00.14.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-537580800");
$datetest = new Date($date);
$datetest->addSeconds(-569203200, true);
compare("19/12/1987 01.00.15.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-569203200"); // leap second in Dec 1987
$datetest = new Date($date);
$datetest->addSeconds(-600825600, true);
compare("18/12/1986 01.00.15.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-600825600");
$datetest = new Date($date);
$datetest->addSeconds(-632448000, true);
compare("17/12/1985 01.00.15.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-632448000");
$datetest = new Date($date);
$datetest->addSeconds(-664070400, true);
compare("16/12/1984 01.00.16.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-664070400"); // leap second in June 1985
$datetest = new Date($date);
$datetest->addSeconds(-695692800, true);
compare("16/12/1983 01.00.16.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-695692800");
$datetest = new Date($date);
$datetest->addSeconds(-727315200, true);
compare("15/12/1982 01.00.17.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-727315200");
$datetest = new Date($date);
$datetest->addSeconds(-758937600, true);
compare("14/12/1981 01.00.18.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-758937600");
$datetest = new Date($date);
$datetest->addSeconds(-790560000, true);
compare("13/12/1980 01.00.19.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-790560000");
$datetest = new Date($date);
$datetest->addSeconds(-822182400, true);
compare("13/12/1979 01.00.20.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-822182400");
$datetest = new Date($date);
$datetest->addSeconds(-853804800, true);
compare("12/12/1978 01.00.21.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-853804800");
$datetest = new Date($date);
$datetest->addSeconds(-885427200, true);
compare("11/12/1977 01.00.22.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-885427200");
$datetest = new Date($date);
$datetest->addSeconds(-917049600, true);
compare("10/12/1976 01.00.23.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-917049600");
$datetest = new Date($date);
$datetest->addSeconds(-948672000, true);
compare("10/12/1975 01.00.24.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-948672000");
$datetest = new Date($date);
$datetest->addSeconds(-980294400, true);
compare("09/12/1974 01.00.25.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-980294400");
$datetest = new Date($date);
$datetest->addSeconds(-1011916800, true);
compare("08/12/1973 01.00.26.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1011916800");
$datetest = new Date($date);
$datetest->addSeconds(-1043539200, true);
compare("07/12/1972 01.00.27.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1043539200");
$datetest = new Date($date);
$datetest->addSeconds(-1075161600, true);
compare("07/12/1971 01.00.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1075161600"); // 23 leap seconds
$datetest = new Date($date);
$datetest->addSeconds(-1106784000, true);
compare("06/12/1970 01.00.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1106784000");
$datetest = new Date($date);
$datetest->addSeconds(-1138406400, true);
compare("05/12/1969 01.00.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1138406400");
$datetest = new Date($date);
$datetest->addSeconds(-1170028800, true);
compare("04/12/1968 01.00.28.98765", $datetest->format2("DD/MM/YYYY HH.MI.SS.FFFFF"), "-1170028800");



?>