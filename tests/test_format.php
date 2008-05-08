<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Tests for the Date::formatLikeStrftime(), Date::formatLikeSQL(),
 * and Date::formatLikeDate()
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

compare('Thu', $date->formatLikeStrftime('%a'), '%a');
compare('Thursday', $date->formatLikeStrftime('%A'), '%A');
compare('Nov', $date->formatLikeStrftime('%b'), '%b');
compare('November', $date->formatLikeStrftime('%B'), '%B');
compare('20', $date->formatLikeStrftime('%C'), '%C');
compare('29', $date->formatLikeStrftime('%d'), '%d');
compare('11/29/2007', $date->formatLikeStrftime('%D'), '%D');
compare('29', $date->formatLikeStrftime('%e'), '%e');
compare('2454434', $date->formatLikeStrftime('%E'), '%E');
compare('07', $date->formatLikeStrftime('%g'), '%g');
compare('2007', $date->formatLikeStrftime('%G'), '%G');
compare('23', $date->formatLikeStrftime('%h'), '%h');
compare('23', $date->formatLikeStrftime('%H'), '%H');
compare('11', $date->formatLikeStrftime('%i'), '%i');
compare('11', $date->formatLikeStrftime('%I'), '%I');
compare('333', $date->formatLikeStrftime('%j'), '%j');
compare('11', $date->formatLikeStrftime('%m'), '%m');
compare('13', $date->formatLikeStrftime('%M'), '%M');
compare("\n", $date->formatLikeStrftime('%n'), '%n');
compare('+01:00', $date->formatLikeStrftime('%o'), '%o');
compare('+01:00', $date->formatLikeStrftime('%O'), '%O');
compare('pm', $date->formatLikeStrftime('%p'), '%p');
compare('PM', $date->formatLikeStrftime('%P'), '%P');
compare('11:13:46 PM', $date->formatLikeStrftime('%r'), '%r');
compare('23:13', $date->formatLikeStrftime('%R'), '%R');
compare('46.090020', $date->formatLikeStrftime('%s'), '%s');
compare('46', $date->formatLikeStrftime('%S'), '%S');
compare("\t", $date->formatLikeStrftime('%t'), '%t');
compare('23:13:46', $date->formatLikeStrftime('%T'), '%T');
compare('4', $date->formatLikeStrftime('%u'), '%u');
compare('47', $date->formatLikeStrftime('%U'), '%U');
compare('48', $date->formatLikeStrftime('%V'), '%V');
compare('4', $date->formatLikeStrftime('%w'), '%w');
compare('48', $date->formatLikeStrftime('%W'), '%W');
compare('07', $date->formatLikeStrftime('%y'), '%y');
compare('2007', $date->formatLikeStrftime('%Y'), '%Y');
compare('CET', $date->formatLikeStrftime('%Z'), '%Z');
compare('%', $date->formatLikeStrftime('%%'), '%%');

// Invalid character:
//
compare('x', $date->formatLikeStrftime('x'), 'x');

compare(' ¬!£$%^&*()_+{}:@~<>?[];\'#,./-=`\\|', $date->formatLikeSQL(' ¬!£$%^&*()_+{}:@~<>?[];\'#,./-=`\\|'), ' ¬!£$%^&*()_+{}:@~<>?[];\'#,./-=`\\|');

compare('text "   \\', $date->formatLikeSQL('"text \"   \\\\"'), '"text \"   \\\\"');

compare('AD', $date->formatLikeSQL('AD'), 'AD');
compare('A.D.', $date->formatLikeSQL('A.D.'), 'A.D.');
compare('ad', $date->formatLikeSQL('ad'), 'ad');
compare('a.d.', $date->formatLikeSQL('a.d.'), 'a.d.');

compare('PM', $date->formatLikeSQL('AM'), 'AM');
compare('P.M.', $date->formatLikeSQL('A.M.'), 'A.M.');
compare('pm', $date->formatLikeSQL('am'), 'am');
compare('p.m.', $date->formatLikeSQL('a.m.'), 'a.m.');

compare('AD', $date->formatLikeSQL('BC'), 'BC');
compare('A.D.', $date->formatLikeSQL('B.C.'), 'B.C.');
compare('ad', $date->formatLikeSQL('bc'), 'bc');
compare('a.d.', $date->formatLikeSQL('b.c.'), 'b.c.');

compare('0', $date->formatLikeSQL('C'), 'C');
compare('20', $date->formatLikeSQL('CC'), 'CC');
compare('020', $date->formatLikeSQL('CCC'), 'CCC');
compare('0020', $date->formatLikeSQL('CCCC'), 'CCCC');
compare(' 0', $date->formatLikeSQL('SC'), 'SC');
compare(' 20', $date->formatLikeSQL('SCC'), 'SCC');
compare(' 020', $date->formatLikeSQL('SCCC'), 'SCCC');
compare(' 0020', $date->formatLikeSQL('SCCCC'), 'SCCCC');
compare('0', $date->formatLikeSQL('NPC'), 'NPC');
compare('20', $date->formatLikeSQL('NPCC'), 'NPCC');
compare('20', $date->formatLikeSQL('NPCCC'), 'NPCCC');
compare('20', $date->formatLikeSQL('NPCCCC'), 'NPCCCC');
compare('0', $date->formatLikeSQL('NPSC'), 'NPSC');
compare('20', $date->formatLikeSQL('NPSCC'), 'NPSCC');
compare('20', $date->formatLikeSQL('NPSCCC'), 'NPSCCC');
compare('20', $date->formatLikeSQL('NPSCCCC'), 'NPSCCCC');

compare('CE ', $date->formatLikeSQL('BCE'), 'BCE');
compare('C.E.  ', $date->formatLikeSQL('B.C.E.'), 'B.C.E.');
compare('ce ', $date->formatLikeSQL('bce'), 'bce');
compare('c.e.  ', $date->formatLikeSQL('b.c.e.'), 'b.c.e.');
compare('CE', $date->formatLikeSQL('NPBCE'), 'NPBCE');
compare('C.E.', $date->formatLikeSQL('NPB.C.E.'), 'NPB.C.E.');
compare('ce', $date->formatLikeSQL('NPbce'), 'NPbce');
compare('c.e.', $date->formatLikeSQL('NPb.c.e.'), 'NPb.c.e.');

compare('4', $date->formatLikeSQL('D'), 'D');
compare('4TH', $date->formatLikeSQL('DTH'), 'DTH');
compare('4th', $date->formatLikeSQL('Dth'), 'Dth');
compare('FOUR', $date->formatLikeSQL('DSP'), 'DSP');
compare('FOURTH', $date->formatLikeSQL('DSPTH'), 'DSPTH');
compare('FOURTH', $date->formatLikeSQL('DTHSP'), 'DTHSP');
compare('four', $date->formatLikeSQL('Dsp'), 'Dsp');
compare('fourth', $date->formatLikeSQL('Dspth'), 'Dspth');
compare('fourth', $date->formatLikeSQL('Dthsp'), 'Dthsp');

compare('THURSDAY ', $date->formatLikeSQL('DAY'), 'DAY');
compare('Thursday ', $date->formatLikeSQL('Day'), 'Day');
compare('thursday ', $date->formatLikeSQL('day'), 'day');
compare('THURSDAY', $date->formatLikeSQL('NPDAY'), 'NPDAY');
compare('Thursday', $date->formatLikeSQL('NPDay'), 'NPDay');
compare('thursday', $date->formatLikeSQL('NPday'), 'NPday');

compare('29', $date->formatLikeSQL('DD'), 'DD');
compare('29TH', $date->formatLikeSQL('DDTH'), 'DDTH');
compare('29th', $date->formatLikeSQL('DDth'), 'DDth');
compare('TWENTY-NINE', $date->formatLikeSQL('DDSP'), 'DDSP');
compare('TWENTY-NINTH', $date->formatLikeSQL('DDSPTH'), 'DDSPTH');
compare('TWENTY-NINTH', $date->formatLikeSQL('DDTHSP'), 'DDTHSP');
compare('twenty-nine', $date->formatLikeSQL('DDsp'), 'DDsp');
compare('twenty-ninth', $date->formatLikeSQL('DDspth'), 'DDspth');
compare('twenty-ninth', $date->formatLikeSQL('DDthsp'), 'DDthsp');

compare('333', $date->formatLikeSQL('DDD'), 'DDD');
compare('333RD', $date->formatLikeSQL('DDDTH'), 'DDDTH');
compare('333rd', $date->formatLikeSQL('DDDth'), 'DDDth');
compare('THREE HUNDRED THIRTY-THREE', $date->formatLikeSQL('DDDSP'), 'DDDSP');
compare('THREE HUNDRED THIRTY-THIRD', $date->formatLikeSQL('DDDSPTH'), 'DDDSPTH');
compare('THREE HUNDRED THIRTY-THIRD', $date->formatLikeSQL('DDDTHSP'), 'DDDTHSP');
compare('three hundred thirty-three', $date->formatLikeSQL('DDDsp'), 'DDDsp');
compare('three hundred thirty-third', $date->formatLikeSQL('DDDspth'), 'DDDspth');
compare('three hundred thirty-third', $date->formatLikeSQL('DDDthsp'), 'DDDthsp');

compare('THU', $date->formatLikeSQL('DY'), 'DY');
compare('Thu', $date->formatLikeSQL('Dy'), 'Dy');
compare('thu', $date->formatLikeSQL('dy'), 'dy');

compare('0', $date->formatLikeSQL('F'), 'F');
compare('09', $date->formatLikeSQL('FF'), 'FF');
compare('090', $date->formatLikeSQL('FFF'), 'FFF');
compare('0900', $date->formatLikeSQL('FFFF'), 'FFFF');
compare('09002', $date->formatLikeSQL('FFFFF'), 'FFFFF');
compare('090020', $date->formatLikeSQL('FFFFFF'), 'FFFFFF');
compare('0900200', $date->formatLikeSQL('FFFFFFF'), 'FFFFFFF');
compare('09002000', $date->formatLikeSQL('FFFFFFFF'), 'FFFFFFFF');
compare('090020000', $date->formatLikeSQL('FFFFFFFFF'), 'FFFFFFFFF');
compare('0900200000', $date->formatLikeSQL('FFFFFFFFFF'), 'FFFFFFFFFF');
compare('0', $date->formatLikeSQL('F1'), 'F1');
compare('09', $date->formatLikeSQL('F2'), 'F2');
compare('090', $date->formatLikeSQL('F3'), 'F3');
compare('0900', $date->formatLikeSQL('F4'), 'F4');
compare('09002', $date->formatLikeSQL('F5'), 'F5');
compare('090020', $date->formatLikeSQL('F6'), 'F6');
compare('0900200', $date->formatLikeSQL('F7'), 'F7');
compare('09002000', $date->formatLikeSQL('F8'), 'F8');
compare('090020000', $date->formatLikeSQL('F9'), 'F9');
compare('0900200000', $date->formatLikeSQL('F10'), 'F10');
compare('09002000000', $date->formatLikeSQL('F11'), 'F11');
compare('090020000000', $date->formatLikeSQL('F12'), 'F12');
compare('0900200000000', $date->formatLikeSQL('F13'), 'F13');
compare('09002000000000', $date->formatLikeSQL('F14'), 'F14');
compare('09002' . str_repeat("0", 39), $date->formatLikeSQL('F44'), 'F44');

compare('23', $date->formatLikeSQL('HH'), 'HH');
compare('11', $date->formatLikeSQL('HH12'), 'HH12');
compare('23', $date->formatLikeSQL('HH24'), 'HH24');

compare('4', $date->formatLikeSQL('ID'), 'ID');

compare('48', $date->formatLikeSQL('IW'), 'IW');

compare('7', $date->formatLikeSQL('I'), 'I');
compare('07', $date->formatLikeSQL('IY'), 'IY');
compare('007', $date->formatLikeSQL('IYY'), 'IYY');
compare('2007', $date->formatLikeSQL('IYYY'), 'IYYY');
compare('02007', $date->formatLikeSQL('IYYYY'), 'IYYYY');
compare('002007', $date->formatLikeSQL('IYYYYY'), 'IYYYYY');
compare('7', $date->formatLikeSQL('NPSI'), 'NPSI');
compare('7', $date->formatLikeSQL('NPSIY'), 'NPSIY');
compare('7', $date->formatLikeSQL('NPSIYY'), 'NPSIYY');
compare('2007', $date->formatLikeSQL('NPSIYYY'), 'NPSIYYY');
compare('2007', $date->formatLikeSQL('NPSIYYYY'), 'NPSIYYYY');
compare('2007', $date->formatLikeSQL('NPSIYYYYY'), 'NPSIYYYYY');
compare(' 7', $date->formatLikeSQL('SI'), 'SI');
compare(' 07', $date->formatLikeSQL('SIY'), 'SIY');
compare(' 007', $date->formatLikeSQL('SIYY'), 'SIYY');
compare(' 2007', $date->formatLikeSQL('SIYYY'), 'SIYYY');
compare(' 02007', $date->formatLikeSQL('SIYYYY'), 'SIYYYY');
compare(' 002007', $date->formatLikeSQL('SIYYYYY'), 'SIYYYYY');
compare('7', $date->formatLikeSQL('NPIYY'), 'NPIYY');
compare('2007', $date->formatLikeSQL('NPIYYYYY'), 'NPIYYYYY');
compare('TWO THOUSAND SEVEN', $date->formatLikeSQL('NPIYYYYYSP'), 'NPIYYYYYSP');
compare('two thousand seventh', $date->formatLikeSQL('NPIYYYYYTHsp'), 'NPIYYYYYTHsp');

compare('2454434', $date->formatLikeSQL('J'), 'J');
compare('Two Million Four Hundred Fifty-four Thousand Four Hundred Thirty-four', $date->formatLikeSQL('JSp'), 'JSp');
compare('Two Million Four Hundred Fifty-four Thousand Four Hundred Thirty-fourth', $date->formatLikeSQL('JSpth'), 'JSpth');

compare('13', $date->formatLikeSQL('MI'), 'MI');
compare('thirteen', $date->formatLikeSQL('MIsP'), 'MIsP');
compare('13th', $date->formatLikeSQL('MItH'), 'MItH');
compare('13TH', $date->formatLikeSQL('MITh'), 'MITh');
compare('thirteenth', $date->formatLikeSQL('MIsPTH'), 'MIsPTH');
compare('Thirteenth', $date->formatLikeSQL('MISpth'), 'MISpth');
compare('THIRTEENTH', $date->formatLikeSQL('MISPth'), 'MISPth');

compare('11', $date->formatLikeSQL('MM'), 'MM');
compare('11', $date->formatLikeSQL('MM'), 'MM');
compare('ELEVEN', $date->formatLikeSQL('MMSP'), 'MMSP');
compare('ELEVENTH', $date->formatLikeSQL('MMSPTH'), 'MMSPTH');
compare('ELEVENTH', $date->formatLikeSQL('MMTHSP'), 'MMTHSP');
compare('Eleven', $date->formatLikeSQL('MMSp'), 'MMSp');
compare('Eleventh', $date->formatLikeSQL('MMSpTH'), 'MMSpTH');
compare('Eleventh', $date->formatLikeSQL('MMTHSp'), 'MMTHSp');
compare('eleven', $date->formatLikeSQL('MMsp'), 'MMsp');
compare('eleventh', $date->formatLikeSQL('MMspTH'), 'MMspTH');
compare('eleventh', $date->formatLikeSQL('MMTHsp'), 'MMTHsp');

compare('NOV', $date->formatLikeSQL('MON'), 'MON');
compare('Nov', $date->formatLikeSQL('Mon'), 'Mon');
compare('nov', $date->formatLikeSQL('mon'), 'mon');

compare('NOVEMBER ', $date->formatLikeSQL('MONTH'), 'MONTH');
compare('November ', $date->formatLikeSQL('Month'), 'Month');
compare('november ', $date->formatLikeSQL('month'), 'month');
compare('NOVEMBER', $date->formatLikeSQL('NPMONTH'), 'NPMONTH');
compare('November', $date->formatLikeSQL('NPMonth'), 'NPMonth');
compare('november', $date->formatLikeSQL('NPmonth'), 'NPmonth');

compare('PM', $date->formatLikeSQL('PM'), 'PM');
compare('P.M.', $date->formatLikeSQL('P.M.'), 'P.M.');
compare('pm', $date->formatLikeSQL('pm'), 'pm');
compare('p.m.', $date->formatLikeSQL('p.m.'), 'p.m.');

compare('4', $date->formatLikeSQL('Q'), 'Q');
compare('FOUR', $date->formatLikeSQL('QSP'), 'QSP');
compare('fourth', $date->formatLikeSQL('QTHsp'), 'QTHsp');

compare('  xi', $date->formatLikeSQL('rm'), 'rm');
compare('  XI', $date->formatLikeSQL('RM'), 'RM');
compare('xi', $date->formatLikeSQL('NPrm'), 'NPrm');
compare('XI', $date->formatLikeSQL('NPRM'), 'NPRM');

compare('46', $date->formatLikeSQL('SS'), 'SS');

compare('83626', $date->formatLikeSQL('SSSSS'), 'SSSSS');

compare('CET', $date->formatLikeSQL('TZC'), 'TZC');
compare('01', $date->formatLikeSQL('TZH'), 'TZH');
compare('+01', $date->formatLikeSQL('STZH'), 'STZH');
compare('1', $date->formatLikeSQL('NPTZH'), 'NPTZH');
compare('+1', $date->formatLikeSQL('NPSTZH'), 'NPSTZH');
compare('+One', $date->formatLikeSQL('NPSTZHSp'), 'NPSTZHSp');
compare('+First', $date->formatLikeSQL('NPSTZHSpth'), 'NPSTZHSpth');
compare('0', $date->formatLikeSQL('TZI'), 'TZI');
compare('00', $date->formatLikeSQL('TZM'), 'TZM');
compare('0', $date->formatLikeSQL('NPTZM'), 'NPTZM');
compare('Central European Time', $date->formatLikeSQL('TZN'), 'TZN');
compare('+01:00', $date->formatLikeSQL('TZO'), 'TZO');
compare('+01:00', $date->formatLikeSQL('NPTZO'), 'NPTZO');
compare('03600', $date->formatLikeSQL('TZS'), 'TZS');
compare(' 03600', $date->formatLikeSQL('STZS'), 'STZS');
compare('3600', $date->formatLikeSQL('NPTZS'), 'NPTZS');
compare('3600', $date->formatLikeSQL('NPSTZS'), 'NPSTZS');
compare('THREE THOUSAND SIX HUNDRED', $date->formatLikeSQL('TZSSP'), 'TZSSP');
compare('THREE THOUSAND SIX HUNDRED', $date->formatLikeSQL('NPSTZSSP'), 'NPSTZSSP');
compare('Europe/Amsterdam', $date->formatLikeSQL('TZR'), 'TZR');

$date2 = new Date($date);
$date2->setTZbyID("America/Chicago");

compare('CST', $date2->formatLikeSQL('TZC'), 'TZC (2)');
compare('06', $date2->formatLikeSQL('TZH'), 'TZH (2)');
compare('-06', $date2->formatLikeSQL('STZH'), 'STZH (2)');
compare('6', $date2->formatLikeSQL('NPTZH'), 'NPTZH (2)');
compare('-6', $date2->formatLikeSQL('NPSTZH'), 'NPSTZH (2)');
compare('-six', $date2->formatLikeSQL('NPSTZHsp'), 'NPSTZHsp (2)');
compare('-sixth', $date2->formatLikeSQL('NPSTZHspth'), 'NPSTZHspth (2)');
compare('0', $date2->formatLikeSQL('TZI'), 'TZI (2)');
compare('00', $date2->formatLikeSQL('TZM'), 'TZM (2)');
compare('0', $date2->formatLikeSQL('NPTZM'), 'NPTZM (2)');
compare('Central Standard Time', $date2->formatLikeSQL('TZN'), 'TZN (2)');
compare('-06:00', $date2->formatLikeSQL('TZO'), 'TZO (2)');
compare('-06:00', $date2->formatLikeSQL('NPTZO'), 'NPTZO (2)');
compare('21600', $date2->formatLikeSQL('TZS'), 'TZS (2)');
compare('-21600', $date2->formatLikeSQL('STZS'), 'STZS (2)');
compare('21600', $date2->formatLikeSQL('NPTZS'), 'NPTZS (2)');
compare('-21600', $date2->formatLikeSQL('NPSTZS'), 'NPSTZS (2)');
compare('TWENTY-ONE THOUSAND SIX HUNDRED', $date2->formatLikeSQL('TZSSP'), 'TZSSP (2)');
compare('MINUS TWENTY-ONE THOUSAND SIX HUNDRED', $date2->formatLikeSQL('NPSTZSSP'), 'NPSTZSSP (2)');
compare('America/Chicago', $date2->formatLikeSQL('TZR'), 'TZR (2)');

$date3 = new Date($date);
$date3->setTZbyID("UTC");

compare('UTC', $date3->formatLikeSQL('TZC'), 'TZC (formatLikeDate)');
compare('00', $date3->formatLikeSQL('TZH'), 'TZH (formatLikeDate)');
compare('+00', $date3->formatLikeSQL('STZH'), 'STZH (formatLikeDate)');
compare('0', $date3->formatLikeSQL('NPTZH'), 'NPTZH (formatLikeDate)');
compare('+0', $date3->formatLikeSQL('NPSTZH'), 'NPSTZH (formatLikeDate)');
compare('ZERO', $date3->formatLikeSQL('NPTZHSP'), 'NPTZHSP (formatLikeDate)');
compare('+ZEROTH', $date3->formatLikeSQL('NPSTZHSPTH'), 'NPSTZHSPTH (formatLikeDate)');
compare('0', $date3->formatLikeSQL('TZI'), 'TZI (formatLikeDate)');
compare('00', $date3->formatLikeSQL('TZM'), 'TZM (formatLikeDate)');
compare('0', $date3->formatLikeSQL('NPTZM'), 'NPTZM (formatLikeDate)');
compare('Coordinated Universal Time', $date3->formatLikeSQL('TZN'), 'TZN (formatLikeDate)');
compare('00000', $date3->formatLikeSQL('TZS'), 'TZS (formatLikeDate)');
compare(' 00000', $date3->formatLikeSQL('STZS'), 'STZS (formatLikeDate)');
compare('0', $date3->formatLikeSQL('NPTZS'), 'NPTZS (formatLikeDate)');
compare('0', $date3->formatLikeSQL('NPSTZS'), 'NPSTZS (formatLikeDate)');
compare('zero', $date3->formatLikeSQL('TZSsp'), 'NPSTZSsp (formatLikeDate)');
compare('Zero', $date3->formatLikeSQL('NPSTZSSp'), 'NPSTZSSp (formatLikeDate)');
compare('Z     ', $date3->formatLikeSQL('TZO'), 'TZO (formatLikeDate)');
compare('Z', $date3->formatLikeSQL('NPTZO'), 'NPTZO (formatLikeDate)');
compare('UTC', $date3->formatLikeSQL('TZR'), 'TZR (formatLikeDate)');

compare('1196374426', $date->formatLikeSQL('U'), 'U');

compare('5', $date->formatLikeSQL('W'), 'W');
compare('5', $date->formatLikeSQL('W'), 'W');

// N.B. For 2007 all the week numbers match because the
// year starts on a Monday:
//
compare('48', $date->formatLikeSQL('W1'), 'W1');
compare('48', $date->formatLikeSQL('NPW1'), 'W1');

compare('48', $date->formatLikeSQL('W4'), 'W4');
compare('48', $date->formatLikeSQL('NPW4'), 'W4');

compare('48', $date->formatLikeSQL('W7'), 'W7');
compare('48', $date->formatLikeSQL('NPW7'), 'W7');

compare('48', $date->formatLikeSQL('WW'), 'WW');
compare('48', $date->formatLikeSQL('NPWW'), 'WW');

compare('TWO THOUSAND SEVEN', $date->formatLikeSQL('YEAR'), 'YEAR');
compare('Two Thousand Seven', $date->formatLikeSQL('Year'), 'Year');
compare('two thousand seven', $date->formatLikeSQL('year'), 'year');
compare('TWO THOUSAND SEVEN', $date->formatLikeSQL('NPSYEAR'), 'NPSYEAR');
compare('TWO THOUSAND SEVEN', $date->formatLikeSQL('NPSYEAR'), 'NPSYEAR');

compare('7', $date->formatLikeSQL('Y'), 'Y');
compare('07', $date->formatLikeSQL('YY'), 'YY');
compare('007', $date->formatLikeSQL('YYY'), 'YYY');
compare('2007', $date->formatLikeSQL('YYYY'), 'YYYY');
compare('02007', $date->formatLikeSQL('YYYYY'), 'YYYYY');
compare('002007', $date->formatLikeSQL('YYYYYY'), 'YYYYYY');
compare(' 7', $date->formatLikeSQL('SY'), 'SY');
compare(' 07', $date->formatLikeSQL('SYY'), 'SYY');
compare(' 007', $date->formatLikeSQL('SYYY'), 'SYYY');
compare(' 2007', $date->formatLikeSQL('SYYYY'), 'SYYYY');
compare(' 02007', $date->formatLikeSQL('SYYYYY'), 'SYYYYY');
compare(' 002007', $date->formatLikeSQL('SYYYYYY'), 'SYYYYYY');
compare('7', $date->formatLikeSQL('NPSY'), 'NPSY');
compare('7', $date->formatLikeSQL('NPSYY'), 'NPSYY');
compare('7', $date->formatLikeSQL('NPSYYY'), 'NPSYYY');
compare('2007', $date->formatLikeSQL('NPSYYYY'), 'NPSYYYY');
compare('2007', $date->formatLikeSQL('NPSYYYYY'), 'NPSYYYYY');
compare('2007', $date->formatLikeSQL('NPSYYYYYY'), 'NPSYYYYYY');
compare('TWO THOUSAND SEVEN', $date->formatLikeSQL('NPSYYYYYYSP'), 'NPSYYYYYYSP');
compare('Two Thousand Seven', $date->formatLikeSQL('NPSYYYYYYSp'), 'NPSYYYYYYSp');
compare('two thousand seven', $date->formatLikeSQL('NPSYYYYYYsp'), 'NPSYYYYYYsp');
compare('TWO THOUSAND SEVENTH', $date->formatLikeSQL('NPSYYYYYYSPth'), 'NPSYYYYYYSPth');
compare('Two Thousand Seventh', $date->formatLikeSQL('NPSYYYYYYSpth'), 'NPSYYYYYYSpth');
compare('two thousand seventh', $date->formatLikeSQL('NPSYYYYYYthsp'), 'NPSYYYYYYthsp');
compare('2007th', $date->formatLikeSQL('NPSYYYYYYth'), 'NPSYYYYYYth');
compare('2007TH', $date->formatLikeSQL('NPSYYYYYYTH'), 'NPSYYYYYYTH');

compare('7', $date->formatLikeSQL('Y'), 'Y');
compare('07', $date->formatLikeSQL('YY'), 'YY');
compare('007', $date->formatLikeSQL('YYY'), 'YYY');
compare('2,007', $date->formatLikeSQL('Y,YYY'), 'Y,YYY');
compare('02.007', $date->formatLikeSQL('YY.YYY'), 'YY.YYY');
compare('002·007', $date->formatLikeSQL('YYY·YYY'), 'YYY·YYY');
compare(' 7', $date->formatLikeSQL('SY'), 'SY');
compare(' 07', $date->formatLikeSQL('SYY'), 'SYY');
compare(' 007', $date->formatLikeSQL('SYYY'), 'SYYY');
compare(' 2\'007', $date->formatLikeSQL('SY\'YYY'), 'SY\'YYY');
compare(' 02 007', $date->formatLikeSQL('SYY YYY'), 'SYY YYY');

// The semi-colon (':') is an invalid separator:
//
compare(' 007:007', $date->formatLikeSQL('SYYY:YYY'), 'SYYY:YYY');
compare('2,007', $date->formatLikeSQL('NPSYYY,YYY,YYY'), 'NPSYYY,YYY,YYY');

compare('29', $date->formatLikeDate('d'), 'd (formatLikeDate)');
compare('Thu', $date->formatLikeDate('D'), 'D (formatLikeDate)');
compare('29', $date->formatLikeDate('j'), 'j (formatLikeDate)');
compare('Thursday', $date->formatLikeDate('l'), 'l (formatLikeDate)');
compare('4', $date->formatLikeDate('N'), 'N (formatLikeDate)');
compare('29th', $date->formatLikeDate('dS'), 'dS (formatLikeDate)');
compare('4', $date->formatLikeDate('w'), 'w (formatLikeDate)');
compare('332', $date->formatLikeDate('z'), 'z (formatLikeDate)');
compare('48', $date->formatLikeDate('W'), 'W (formatLikeDate)');
compare('November', $date->formatLikeDate('F'), 'F (formatLikeDate)');
compare('11', $date->formatLikeDate('m'), 'm (formatLikeDate)');
compare('Nov', $date->formatLikeDate('M'), 'M (formatLikeDate)');
compare('11', $date->formatLikeDate('n'), 'n (formatLikeDate)');
compare('30', $date->formatLikeDate('t'), 't (formatLikeDate)');
compare('0', $date->formatLikeDate('L'), 'L (formatLikeDate)');
compare('2007', $date->formatLikeDate('o'), 'o (formatLikeDate)');
compare('2007', $date->formatLikeDate('Y'), 'Y (formatLikeDate)');
compare('07', $date->formatLikeDate('y'), 'y (formatLikeDate)');
compare("pm", $date->formatLikeDate('a'), 'a (formatLikeDate)');
compare('PM', $date->formatLikeDate('A'), 'A (formatLikeDate)');
compare('11', $date->formatLikeDate('g'), 'g (formatLikeDate)');
compare('23', $date->formatLikeDate('G'), 'G (formatLikeDate)');
compare('11', $date->formatLikeDate('h'), 'h (formatLikeDate)');
compare('23', $date->formatLikeDate('H'), 'H (formatLikeDate)');
compare('13', $date->formatLikeDate('i'), 'i (formatLikeDate)');
compare('46', $date->formatLikeDate('s'), 's (formatLikeDate)');
compare('46090', $date->formatLikeDate('u'), 'u (formatLikeDate)');
compare("Europe/Amsterdam", $date->formatLikeDate('e'), 'e (formatLikeDate)');
compare('0', $date->formatLikeDate('I'), 'I (formatLikeDate)');
compare('+0100', $date->formatLikeDate('O'), 'O (formatLikeDate)');
compare('+01:00', $date->formatLikeDate('P'), 'P (formatLikeDate)');
compare('CET', $date->formatLikeDate('T'), 'T (formatLikeDate)');
compare('03600', $date->formatLikeDate('Z'), 'Z (formatLikeDate)');
compare('2007-11-29T23:13:46+01:00', $date->formatLikeDate('c'), 'c (formatLikeDate)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->formatLikeDate('r'), 'r (formatLikeDate)');
compare('1196374426', $date->formatLikeDate('U'), 'U (formatLikeDate)');
compare('text\\', $date->formatLikeDate('\t\e\x\t\\\\'), '\\t\\e\\x\\t\\\\ (formatLikeDate)');
compare('"', $date->formatLikeDate('"'), '" (formatLikeDate)');
compare(' ', $date->formatLikeDate(' '), 'blank space (formatLikeDate)');

compare('2007-11-29T23:13:46+01:00', $date->formatLikeDate(DATE_ATOM), 'DATE_ATOM [' . DATE_ATOM . '] (formatLikeDate)');
compare('Thursday, 29-Nov-07 23:13:46 CET', $date->formatLikeDate(DATE_COOKIE), 'DATE_COOKIE [' . DATE_COOKIE . '] (formatLikeDate)');
compare('2007-11-29T23:13:46+0100', $date->formatLikeDate(DATE_ISO8601), 'DATE_ISO8601 [' . DATE_ISO8601 . '] (formatLikeDate)');
compare('Thu, 29 Nov 07 23:13:46 +0100', $date->formatLikeDate(DATE_RFC822), 'DATE_RFC822 [' . DATE_RFC822 . '] (formatLikeDate)');
compare('Thursday, 29-Nov-07 23:13:46 CET', $date->formatLikeDate(DATE_RFC850), 'DATE_RFC850 [' . DATE_RFC850 . '] (formatLikeDate)');
compare('Thu, 29 Nov 07 23:13:46 +0100', $date->formatLikeDate(DATE_RFC1036), 'DATE_RFC1036 [' . DATE_RFC1036 . '] (formatLikeDate)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->formatLikeDate(DATE_RFC1123), 'DATE_RFC1123 [' . DATE_RFC1123 . '] (formatLikeDate)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->formatLikeDate(DATE_RFC2822), 'DATE_RFC2822 [' . DATE_RFC2822 . '] (formatLikeDate)');
compare('2007-11-29T23:13:46+01:00', $date->formatLikeDate(DATE_RFC3339), 'DATE_RFC3339 [' . DATE_RFC3339 . '] (formatLikeDate)');
compare('Thu, 29 Nov 2007 23:13:46 +0100', $date->formatLikeDate(DATE_RSS), 'DATE_RSS [' . DATE_RSS . '] (formatLikeDate)');
compare('2007-11-29T23:13:46+01:00', $date->formatLikeDate(DATE_W3C), 'DATE_W3C [' . DATE_W3C . '] (formatLikeDate)');

?>