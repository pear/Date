<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Tests for the Date::format() and Date::format2()
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

$date = new Date("2007-11-29T23:13:46.09002");
$date->setTZbyID("Europe/Amsterdam");

compare('Thu', $date->format('%a'), '%a');
compare('Thursday', $date->format('%A'), '%A');
compare('Nov', $date->format('%b'), '%b');
compare('November', $date->format('%B'), '%B');
compare('20', $date->format('%C'), '%C');
compare('29', $date->format('%d'), '%d');
compare('11/29/2007', $date->format('%D'), '%D');
compare('29', $date->format('%e'), '%e');
compare('2454434', $date->format('%E'), '%E');
compare('07', $date->format('%g'), '%g');
compare('2007', $date->format('%G'), '%G');
compare('23', $date->format('%h'), '%h');
compare('23', $date->format('%H'), '%H');
compare('11', $date->format('%i'), '%i');
compare('11', $date->format('%I'), '%I');
compare('333', $date->format('%j'), '%j');
compare('11', $date->format('%m'), '%m');
compare('13', $date->format('%M'), '%M');
compare("\n", $date->format('%n'), '%n');
compare('+01:00', $date->format('%o'), '%o');
compare('+01:00', $date->format('%O'), '%O');
compare('pm', $date->format('%p'), '%p');
compare('PM', $date->format('%P'), '%P');
compare('11:13:46 PM', $date->format('%r'), '%r');
compare('23:13', $date->format('%R'), '%R');
compare('46.090020', $date->format('%s'), '%s');
compare('46', $date->format('%S'), '%S');
compare("\t", $date->format('%t'), '%t');
compare('23:13:46', $date->format('%T'), '%T');
compare('4', $date->format('%u'), '%u');
compare('47', $date->format('%U'), '%U');
compare('48', $date->format('%V'), '%V');
compare('4', $date->format('%w'), '%w');
compare('48', $date->format('%W'), '%W');
compare('07', $date->format('%y'), '%y');
compare('2007', $date->format('%Y'), '%Y');
compare('CET', $date->format('%Z'), '%Z');
compare('%', $date->format('%%'), '%%');

// Invalid character:
//
compare('x', $date->format('x'), 'x');

compare(' ¬!£$%^&*()_+{}:@~<>?[];\'#,./-=`\\|', $date->format2(' ¬!£$%^&*()_+{}:@~<>?[];\'#,./-=`\\|'), ' ¬!£$%^&*()_+{}:@~<>?[];\'#,./-=`\\|');

compare('text "   \\', $date->format2('"text \"   \\\\"'), '"text \"   \\\\"');

compare('AD', $date->format2('AD'), 'AD');
compare('A.D.', $date->format2('A.D.'), 'A.D.');
compare('ad', $date->format2('ad'), 'ad');
compare('a.d.', $date->format2('a.d.'), 'a.d.');

compare('PM', $date->format2('AM'), 'AM');
compare('P.M.', $date->format2('A.M.'), 'A.M.');
compare('pm', $date->format2('am'), 'am');
compare('p.m.', $date->format2('a.m.'), 'a.m.');

compare('AD', $date->format2('BC'), 'BC');
compare('A.D.', $date->format2('B.C.'), 'B.C.');
compare('ad', $date->format2('bc'), 'bc');
compare('a.d.', $date->format2('b.c.'), 'b.c.');

compare('0', $date->format2('C'), 'C');
compare('20', $date->format2('CC'), 'CC');
compare('020', $date->format2('CCC'), 'CCC');
compare('0020', $date->format2('CCCC'), 'CCCC');
compare(' 0', $date->format2('SC'), 'SC');
compare(' 20', $date->format2('SCC'), 'SCC');
compare(' 020', $date->format2('SCCC'), 'SCCC');
compare(' 0020', $date->format2('SCCCC'), 'SCCCC');
compare('0', $date->format2('NPC'), 'NPC');
compare('20', $date->format2('NPCC'), 'NPCC');
compare('20', $date->format2('NPCCC'), 'NPCCC');
compare('20', $date->format2('NPCCCC'), 'NPCCCC');
compare('0', $date->format2('NPSC'), 'NPSC');
compare('20', $date->format2('NPSCC'), 'NPSCC');
compare('20', $date->format2('NPSCCC'), 'NPSCCC');
compare('20', $date->format2('NPSCCCC'), 'NPSCCCC');

compare('CE ', $date->format2('BCE'), 'BCE');
compare('C.E.  ', $date->format2('B.C.E.'), 'B.C.E.');
compare('ce ', $date->format2('bce'), 'bce');
compare('c.e.  ', $date->format2('b.c.e.'), 'b.c.e.');
compare('CE', $date->format2('NPBCE'), 'NPBCE');
compare('C.E.', $date->format2('NPB.C.E.'), 'NPB.C.E.');
compare('ce', $date->format2('NPbce'), 'NPbce');
compare('c.e.', $date->format2('NPb.c.e.'), 'NPb.c.e.');

compare('4', $date->format2('D'), 'D');
compare('4TH', $date->format2('DTH'), 'DTH');
compare('4th', $date->format2('Dth'), 'Dth');
compare('FOUR', $date->format2('DSP'), 'DSP');
compare('FOURTH', $date->format2('DSPTH'), 'DSPTH');
compare('FOURTH', $date->format2('DTHSP'), 'DTHSP');
compare('four', $date->format2('Dsp'), 'Dsp');
compare('fourth', $date->format2('Dspth'), 'Dspth');
compare('fourth', $date->format2('Dthsp'), 'Dthsp');

compare('THURSDAY ', $date->format2('DAY'), 'DAY');
compare('Thursday ', $date->format2('Day'), 'Day');
compare('thursday ', $date->format2('day'), 'day');
compare('THURSDAY', $date->format2('NPDAY'), 'NPDAY');
compare('Thursday', $date->format2('NPDay'), 'NPDay');
compare('thursday', $date->format2('NPday'), 'NPday');

compare('29', $date->format2('DD'), 'DD');
compare('29TH', $date->format2('DDTH'), 'DDTH');
compare('29th', $date->format2('DDth'), 'DDth');
compare('TWENTY-NINE', $date->format2('DDSP'), 'DDSP');
compare('TWENTY-NINTH', $date->format2('DDSPTH'), 'DDSPTH');
compare('TWENTY-NINTH', $date->format2('DDTHSP'), 'DDTHSP');
compare('twenty-nine', $date->format2('DDsp'), 'DDsp');
compare('twenty-ninth', $date->format2('DDspth'), 'DDspth');
compare('twenty-ninth', $date->format2('DDthsp'), 'DDthsp');

compare('333', $date->format2('DDD'), 'DDD');
compare('333RD', $date->format2('DDDTH'), 'DDDTH');
compare('333rd', $date->format2('DDDth'), 'DDDth');
compare('THREE HUNDRED THIRTY-THREE', $date->format2('DDDSP'), 'DDDSP');
compare('THREE HUNDRED THIRTY-THIRD', $date->format2('DDDSPTH'), 'DDDSPTH');
compare('THREE HUNDRED THIRTY-THIRD', $date->format2('DDDTHSP'), 'DDDTHSP');
compare('three hundred thirty-three', $date->format2('DDDsp'), 'DDDsp');
compare('three hundred thirty-third', $date->format2('DDDspth'), 'DDDspth');
compare('three hundred thirty-third', $date->format2('DDDthsp'), 'DDDthsp');

compare('THU', $date->format2('DY'), 'DY');
compare('Thu', $date->format2('Dy'), 'Dy');
compare('thu', $date->format2('dy'), 'dy');

compare('0', $date->format2('F'), 'F');
compare('09', $date->format2('FF'), 'FF');
compare('090', $date->format2('FFF'), 'FFF');
compare('0900', $date->format2('FFFF'), 'FFFF');
compare('09002', $date->format2('FFFFF'), 'FFFFF');
compare('090020', $date->format2('FFFFFF'), 'FFFFFF');
compare('0900200', $date->format2('FFFFFFF'), 'FFFFFFF');
compare('09002000', $date->format2('FFFFFFFF'), 'FFFFFFFF');
compare('090020000', $date->format2('FFFFFFFFF'), 'FFFFFFFFF');
compare('0900200000', $date->format2('FFFFFFFFFF'), 'FFFFFFFFFF');
compare('0', $date->format2('F1'), 'F1');
compare('09', $date->format2('F2'), 'F2');
compare('090', $date->format2('F3'), 'F3');
compare('0900', $date->format2('F4'), 'F4');
compare('09002', $date->format2('F5'), 'F5');
compare('090020', $date->format2('F6'), 'F6');
compare('0900200', $date->format2('F7'), 'F7');
compare('09002000', $date->format2('F8'), 'F8');
compare('090020000', $date->format2('F9'), 'F9');
compare('0900200000', $date->format2('F10'), 'F10');
compare('09002000000', $date->format2('F11'), 'F11');
compare('090020000000', $date->format2('F12'), 'F12');
compare('0900200000000', $date->format2('F13'), 'F13');
compare('09002000000000', $date->format2('F14'), 'F14');
compare('09002' . str_repeat("0", 39), $date->format2('F44'), 'F44');

compare('23', $date->format2('HH'), 'HH');
compare('11', $date->format2('HH12'), 'HH12');
compare('23', $date->format2('HH24'), 'HH24');

compare('4', $date->format2('ID'), 'ID');

compare('48', $date->format2('IW'), 'IW');

compare('7', $date->format2('I'), 'I');
compare('07', $date->format2('IY'), 'IY');
compare('007', $date->format2('IYY'), 'IYY');
compare('2007', $date->format2('IYYY'), 'IYYY');
compare('02007', $date->format2('IYYYY'), 'IYYYY');
compare('002007', $date->format2('IYYYYY'), 'IYYYYY');
compare('7', $date->format2('NPSI'), 'NPSI');
compare('7', $date->format2('NPSIY'), 'NPSIY');
compare('7', $date->format2('NPSIYY'), 'NPSIYY');
compare('2007', $date->format2('NPSIYYY'), 'NPSIYYY');
compare('2007', $date->format2('NPSIYYYY'), 'NPSIYYYY');
compare('2007', $date->format2('NPSIYYYYY'), 'NPSIYYYYY');
compare(' 7', $date->format2('SI'), 'SI');
compare(' 07', $date->format2('SIY'), 'SIY');
compare(' 007', $date->format2('SIYY'), 'SIYY');
compare(' 2007', $date->format2('SIYYY'), 'SIYYY');
compare(' 02007', $date->format2('SIYYYY'), 'SIYYYY');
compare(' 002007', $date->format2('SIYYYYY'), 'SIYYYYY');
compare('7', $date->format2('NPIYY'), 'NPIYY');
compare('2007', $date->format2('NPIYYYYY'), 'NPIYYYYY');
compare('TWO THOUSAND SEVEN', $date->format2('NPIYYYYYSP'), 'NPIYYYYYSP');
compare('two thousand seventh', $date->format2('NPIYYYYYTHsp'), 'NPIYYYYYTHsp');

compare('2454434', $date->format2('J'), 'J');
compare('Two Million Four Hundred Fifty-four Thousand Four Hundred Thirty-four', $date->format2('JSp'), 'JSp');
compare('Two Million Four Hundred Fifty-four Thousand Four Hundred Thirty-fourth', $date->format2('JSpth'), 'JSpth');

compare('13', $date->format2('MI'), 'MI');
compare('thirteen', $date->format2('MIsP'), 'MIsP');
compare('13th', $date->format2('MItH'), 'MItH');
compare('13TH', $date->format2('MITh'), 'MITh');
compare('thirteenth', $date->format2('MIsPTH'), 'MIsPTH');
compare('Thirteenth', $date->format2('MISpth'), 'MISpth');
compare('THIRTEENTH', $date->format2('MISPth'), 'MISPth');

compare('11', $date->format2('MM'), 'MM');
compare('11', $date->format2('MM'), 'MM');
compare('ELEVEN', $date->format2('MMSP'), 'MMSP');
compare('ELEVENTH', $date->format2('MMSPTH'), 'MMSPTH');
compare('ELEVENTH', $date->format2('MMTHSP'), 'MMTHSP');
compare('Eleven', $date->format2('MMSp'), 'MMSp');
compare('Eleventh', $date->format2('MMSpTH'), 'MMSpTH');
compare('Eleventh', $date->format2('MMTHSp'), 'MMTHSp');
compare('eleven', $date->format2('MMsp'), 'MMsp');
compare('eleventh', $date->format2('MMspTH'), 'MMspTH');
compare('eleventh', $date->format2('MMTHsp'), 'MMTHsp');

compare('NOV', $date->format2('MON'), 'MON');
compare('Nov', $date->format2('Mon'), 'Mon');
compare('nov', $date->format2('mon'), 'mon');

compare('NOVEMBER ', $date->format2('MONTH'), 'MONTH');
compare('November ', $date->format2('Month'), 'Month');
compare('november ', $date->format2('month'), 'month');
compare('NOVEMBER', $date->format2('NPMONTH'), 'NPMONTH');
compare('November', $date->format2('NPMonth'), 'NPMonth');
compare('november', $date->format2('NPmonth'), 'NPmonth');

compare('PM', $date->format2('PM'), 'PM');
compare('P.M.', $date->format2('P.M.'), 'P.M.');
compare('pm', $date->format2('pm'), 'pm');
compare('p.m.', $date->format2('p.m.'), 'p.m.');

compare('4', $date->format2('Q'), 'Q');
compare('FOUR', $date->format2('QSP'), 'QSP');
compare('fourth', $date->format2('QTHsp'), 'QTHsp');

compare('  xi', $date->format2('rm'), 'rm');
compare('  XI', $date->format2('RM'), 'RM');
compare('xi', $date->format2('NPrm'), 'NPrm');
compare('XI', $date->format2('NPRM'), 'NPRM');

compare('46', $date->format2('SS'), 'SS');

compare('83626', $date->format2('SSSSS'), 'SSSSS');

compare('CET', $date->format2('TZC'), 'TZC');
compare('01', $date->format2('TZH'), 'TZH');
compare('+01', $date->format2('STZH'), 'STZH');
compare('1', $date->format2('NPTZH'), 'NPTZH');
compare('+1', $date->format2('NPSTZH'), 'NPSTZH');
compare('+One', $date->format2('NPSTZHSp'), 'NPSTZHSp');
compare('+First', $date->format2('NPSTZHSpth'), 'NPSTZHSpth');
compare('0', $date->format2('TZI'), 'TZI');
compare('00', $date->format2('TZM'), 'TZM');
compare('0', $date->format2('NPTZM'), 'NPTZM');
compare('Central European Time', $date->format2('TZN'), 'TZN');
compare('+01:00', $date->format2('TZO'), 'TZO');
compare('+01:00', $date->format2('NPTZO'), 'NPTZO');
compare('03600', $date->format2('TZS'), 'TZS');
compare(' 03600', $date->format2('STZS'), 'STZS');
compare('3600', $date->format2('NPTZS'), 'NPTZS');
compare('3600', $date->format2('NPSTZS'), 'NPSTZS');
compare('THREE THOUSAND SIX HUNDRED', $date->format2('TZSSP'), 'TZSSP');
compare('THREE THOUSAND SIX HUNDRED', $date->format2('NPSTZSSP'), 'NPSTZSSP');
compare('Europe/Amsterdam', $date->format2('TZR'), 'TZR');

$date2 = new Date($date);
$date2->setTZbyID("America/Chicago");

compare('CST', $date2->format2('TZC'), 'TZC (2)');
compare('06', $date2->format2('TZH'), 'TZH (2)');
compare('-06', $date2->format2('STZH'), 'STZH (2)');
compare('6', $date2->format2('NPTZH'), 'NPTZH (2)');
compare('-6', $date2->format2('NPSTZH'), 'NPSTZH (2)');
compare('-six', $date2->format2('NPSTZHsp'), 'NPSTZHsp (2)');
compare('-sixth', $date2->format2('NPSTZHspth'), 'NPSTZHspth (2)');
compare('0', $date2->format2('TZI'), 'TZI (2)');
compare('00', $date2->format2('TZM'), 'TZM (2)');
compare('0', $date2->format2('NPTZM'), 'NPTZM (2)');
compare('Central Standard Time', $date2->format2('TZN'), 'TZN (2)');
compare('-06:00', $date2->format2('TZO'), 'TZO (2)');
compare('-06:00', $date2->format2('NPTZO'), 'NPTZO (2)');
compare('21600', $date2->format2('TZS'), 'TZS (2)');
compare('-21600', $date2->format2('STZS'), 'STZS (2)');
compare('21600', $date2->format2('NPTZS'), 'NPTZS (2)');
compare('-21600', $date2->format2('NPSTZS'), 'NPSTZS (2)');
compare('TWENTY-ONE THOUSAND SIX HUNDRED', $date2->format2('TZSSP'), 'TZSSP (2)');
compare('MINUS TWENTY-ONE THOUSAND SIX HUNDRED', $date2->format2('NPSTZSSP'), 'NPSTZSSP (2)');
compare('America/Chicago', $date2->format2('TZR'), 'TZR (2)');

$date3 = new Date($date);
$date3->setTZbyID("UTC");

compare('UTC', $date3->format2('TZC'), 'TZC (format3)');
compare('00', $date3->format2('TZH'), 'TZH (format3)');
compare('+00', $date3->format2('STZH'), 'STZH (format3)');
compare('0', $date3->format2('NPTZH'), 'NPTZH (format3)');
compare('+0', $date3->format2('NPSTZH'), 'NPSTZH (format3)');
compare('ZERO', $date3->format2('NPTZHSP'), 'NPTZHSP (format3)');
compare('+ZEROTH', $date3->format2('NPSTZHSPTH'), 'NPSTZHSPTH (format3)');
compare('0', $date3->format2('TZI'), 'TZI (format3)');
compare('00', $date3->format2('TZM'), 'TZM (format3)');
compare('0', $date3->format2('NPTZM'), 'NPTZM (format3)');
compare('Coordinated Universal Time', $date3->format2('TZN'), 'TZN (format3)');
compare('00000', $date3->format2('TZS'), 'TZS (format3)');
compare(' 00000', $date3->format2('STZS'), 'STZS (format3)');
compare('0', $date3->format2('NPTZS'), 'NPTZS (format3)');
compare('0', $date3->format2('NPSTZS'), 'NPSTZS (format3)');
compare('zero', $date3->format2('TZSsp'), 'NPSTZSsp (format3)');
compare('Zero', $date3->format2('NPSTZSSp'), 'NPSTZSSp (format3)');
compare('Z     ', $date3->format2('TZO'), 'TZO (format3)');
compare('Z', $date3->format2('NPTZO'), 'NPTZO (format3)');
compare('UTC', $date3->format2('TZR'), 'TZR (format3)');

compare('1196374426', $date->format2('U'), 'U');

compare('5', $date->format2('W'), 'W');
compare('5', $date->format2('W'), 'W');

// N.B. For 2007 all the week numbers match because the
// year starts on a Monday:
//
compare('48', $date->format2('W1'), 'W1');
compare('48', $date->format2('NPW1'), 'W1');

compare('48', $date->format2('W4'), 'W4');
compare('48', $date->format2('NPW4'), 'W4');

compare('48', $date->format2('W7'), 'W7');
compare('48', $date->format2('NPW7'), 'W7');

compare('48', $date->format2('WW'), 'WW');
compare('48', $date->format2('NPWW'), 'WW');

compare('TWO THOUSAND SEVEN', $date->format2('YEAR'), 'YEAR');
compare('Two Thousand Seven', $date->format2('Year'), 'Year');
compare('two thousand seven', $date->format2('year'), 'year');
compare('TWO THOUSAND SEVEN', $date->format2('NPSYEAR'), 'NPSYEAR');
compare('TWO THOUSAND SEVEN', $date->format2('NPSYEAR'), 'NPSYEAR');

compare('7', $date->format2('Y'), 'Y');
compare('07', $date->format2('YY'), 'YY');
compare('007', $date->format2('YYY'), 'YYY');
compare('2007', $date->format2('YYYY'), 'YYYY');
compare('02007', $date->format2('YYYYY'), 'YYYYY');
compare('002007', $date->format2('YYYYYY'), 'YYYYYY');
compare(' 7', $date->format2('SY'), 'SY');
compare(' 07', $date->format2('SYY'), 'SYY');
compare(' 007', $date->format2('SYYY'), 'SYYY');
compare(' 2007', $date->format2('SYYYY'), 'SYYYY');
compare(' 02007', $date->format2('SYYYYY'), 'SYYYYY');
compare(' 002007', $date->format2('SYYYYYY'), 'SYYYYYY');
compare('7', $date->format2('NPSY'), 'NPSY');
compare('7', $date->format2('NPSYY'), 'NPSYY');
compare('7', $date->format2('NPSYYY'), 'NPSYYY');
compare('2007', $date->format2('NPSYYYY'), 'NPSYYYY');
compare('2007', $date->format2('NPSYYYYY'), 'NPSYYYYY');
compare('2007', $date->format2('NPSYYYYYY'), 'NPSYYYYYY');
compare('TWO THOUSAND SEVEN', $date->format2('NPSYYYYYYSP'), 'NPSYYYYYYSP');
compare('Two Thousand Seven', $date->format2('NPSYYYYYYSp'), 'NPSYYYYYYSp');
compare('two thousand seven', $date->format2('NPSYYYYYYsp'), 'NPSYYYYYYsp');
compare('TWO THOUSAND SEVENTH', $date->format2('NPSYYYYYYSPth'), 'NPSYYYYYYSPth');
compare('Two Thousand Seventh', $date->format2('NPSYYYYYYSpth'), 'NPSYYYYYYSpth');
compare('two thousand seventh', $date->format2('NPSYYYYYYthsp'), 'NPSYYYYYYthsp');
compare('2007th', $date->format2('NPSYYYYYYth'), 'NPSYYYYYYth');
compare('2007TH', $date->format2('NPSYYYYYYTH'), 'NPSYYYYYYTH');

compare('7', $date->format2('Y'), 'Y');
compare('07', $date->format2('YY'), 'YY');
compare('007', $date->format2('YYY'), 'YYY');
compare('2,007', $date->format2('Y,YYY'), 'Y,YYY');
compare('02.007', $date->format2('YY.YYY'), 'YY.YYY');
compare('002·007', $date->format2('YYY·YYY'), 'YYY·YYY');
compare(' 7', $date->format2('SY'), 'SY');
compare(' 07', $date->format2('SYY'), 'SYY');
compare(' 007', $date->format2('SYYY'), 'SYYY');
compare(' 2\'007', $date->format2('SY\'YYY'), 'SY\'YYY');
compare(' 02 007', $date->format2('SYY YYY'), 'SYY YYY');

// The semi-colon (':') is an invalid separator:
//
compare(' 007:007', $date->format2('SYYY:YYY'), 'SYYY:YYY');
compare('2,007', $date->format2('NPSYYY,YYY,YYY'), 'NPSYYY,YYY,YYY');

compare('29', $date->format3('d'), 'd (format3)');
compare('Thu', $date->format3('D'), 'D (format3)');
compare('29', $date->format3('j'), 'j (format3)');
compare('Thursday', $date->format3('l'), 'l (format3)');
compare('4', $date->format3('N'), 'N (format3)');
compare('29th', $date->format3('dS'), 'dS (format3)');
compare('4', $date->format3('w'), 'w (format3)');
compare('332', $date->format3('z'), 'z (format3)');
compare('48', $date->format3('W'), 'W (format3)');
compare('November', $date->format3('F'), 'F (format3)');
compare('11', $date->format3('m'), 'm (format3)');
compare('Nov', $date->format3('M'), 'M (format3)');
compare('11', $date->format3('n'), 'n (format3)');
compare('30', $date->format3('t'), 't (format3)');
compare('0', $date->format3('L'), 'L (format3)');
compare('2007', $date->format3('o'), 'o (format3)');
compare('2007', $date->format3('Y'), 'Y (format3)');
compare('07', $date->format3('y'), 'y (format3)');
compare("pm", $date->format3('a'), 'a (format3)');
compare('PM', $date->format3('A'), 'A (format3)');
compare('11', $date->format3('g'), 'g (format3)');
compare('23', $date->format3('G'), 'G (format3)');
compare('11', $date->format3('h'), 'h (format3)');
compare('23', $date->format3('H'), 'H (format3)');
compare('13', $date->format3('i'), 'i (format3)');
compare('46', $date->format3('s'), 's (format3)');
compare('46090', $date->format3('u'), 'u (format3)');
compare("Europe/Amsterdam", $date->format3('e'), 'e (format3)');
compare('0', $date->format3('I'), 'I (format3)');
compare('+0100', $date->format3('O'), 'O (format3)');
compare('+01:00', $date->format3('P'), 'P (format3)');
compare('CET', $date->format3('T'), 'T (format3)');
compare('03600', $date->format3('Z'), 'Z (format3)');
compare('2007-11-29T23:13:46+01:00', $date->format3('c'), 'c (format3)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->format3('r'), 'r (format3)');
compare('1196374426', $date->format3('U'), 'U (format3)');
compare('text\\', $date->format3('\t\e\x\t\\\\'), '\\t\\e\\x\\t\\\\ (format3)');
compare('"', $date->format3('"'), '" (format3)');
compare(' ', $date->format3(' '), 'blank space (format3)');

compare('2007-11-29T23:13:46+01:00', $date->format3(DATE_ATOM), 'DATE_ATOM [' . DATE_ATOM . '] (format3)');
compare('Thursday, 29-Nov-07 23:13:46 CET', $date->format3(DATE_COOKIE), 'DATE_COOKIE [' . DATE_COOKIE . '] (format3)');
compare('2007-11-29T23:13:46+0100', $date->format3(DATE_ISO8601), 'DATE_ISO8601 [' . DATE_ISO8601 . '] (format3)');
compare('Thu, 29 Nov 07 23:13:46 +0100', $date->format3(DATE_RFC822), 'DATE_RFC822 [' . DATE_RFC822 . '] (format3)');
compare('Thursday, 29-Nov-07 23:13:46 CET', $date->format3(DATE_RFC850), 'DATE_RFC850 [' . DATE_RFC850 . '] (format3)');
compare('Thu, 29 Nov 07 23:13:46 +0100', $date->format3(DATE_RFC1036), 'DATE_RFC1036 [' . DATE_RFC1036 . '] (format3)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->format3(DATE_RFC1123), 'DATE_RFC1123 [' . DATE_RFC1123 . '] (format3)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->format3(DATE_RFC2822), 'DATE_RFC2822 [' . DATE_RFC2822 . '] (format3)');
compare('2007-11-29T23:13:46+01:00', $date->format3(DATE_RFC3339), 'DATE_RFC3339 [' . DATE_RFC3339 . '] (format3)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->format3(DATE_RSS), 'DATE_RSS [' . DATE_RSS . '] (format3)');
compare('2007-11-29T23:13:46+01:00', $date->format3(DATE_W3C), 'DATE_W3C [' . DATE_W3C . '] (format3)');

?>