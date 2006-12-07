<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */
// CVS: $Id$
?>
--TEST--
Bug #9568: Date_Calc::beginOfMonthBySpan() - December was always shifted up one year
--FILE--
<?php
/**
 * Test for: Date_Calc
 * Parts tested: Date_Calc::beginOfMonthBySpan()
 */

require_once 'Date/Calc.php';

$DateCalc = new Date_Calc();

$day = '07';    // Day
$month = 1;     // January
$year = 2006;   // Year
$sequence = 25; // Number of sequence

$out = '';
for ($months = 1; $months <= $sequence; $months++) {
    $date = $DateCalc->beginOfMonthBySpan(-$months, $month, $year, '%d.%m.%Y');
    $date_ex = explode( '.', $date);
    $out = sprintf('%d - %s.%s.%s', $months, $day, $date_ex[1], $date_ex[2]);

    if($date_ex[1] == 12 ) {
        $out .= ' **';
    }

    echo $out . "\n";
}
?>
--EXPECT--
1 - 07.12.2005 **
2 - 07.11.2005
3 - 07.10.2005
4 - 07.09.2005
5 - 07.08.2005
6 - 07.07.2005
7 - 07.06.2005
8 - 07.05.2005
9 - 07.04.2005
10 - 07.03.2005
11 - 07.02.2005
12 - 07.01.2005
13 - 07.12.2004 **
14 - 07.11.2004
15 - 07.10.2004
16 - 07.09.2004
17 - 07.08.2004
18 - 07.07.2004
19 - 07.06.2004
20 - 07.05.2004
21 - 07.04.2004
22 - 07.03.2004
23 - 07.02.2004
24 - 07.01.2004
25 - 07.12.2003 **
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