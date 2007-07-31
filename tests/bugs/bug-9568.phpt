--TEST--
Bug #9568:
Date_Calc::beginOfMonthBySpan() and Date_Calc::endOfMonthBySpan() -
December was always shifted up one year
--FILE--
<?php
/**
 * Test for: Date_Calc
 * Parts tested: Date_Calc::beginOfMonthBySpan()
 */

require_once 'Date/Calc.php';

$DateCalc = new Date_Calc();

$month = 1;     // January
$year = 2006;   // Year
$sequence = 25; // Number of sequence

$out = '';
for ($months = 1; $months <= $sequence; $months++) {
    $date = $DateCalc->beginOfMonthBySpan(-$months, $month, $year, '%d.%m.%Y');
    $date_ex = explode( '.', $date);
    $out = sprintf('%d - %s.%s.%s', $months, $date_ex[0], $date_ex[1], $date_ex[2]);

    if($date_ex[1] == 12 ) {
        $out .= ' **';
    }

    echo $out . "\n";
}

echo "\n";

$out = '';
for ($months = 1; $months <= $sequence; $months++) {
    $date = $DateCalc->endOfMonthBySpan(-$months, $month, $year, '%d.%m.%Y');
    $date_ex = explode( '.', $date);
    $out = sprintf('%d - %s.%s.%s', $months, $date_ex[0], $date_ex[1], $date_ex[2]);

    if($date_ex[1] == 12 ) {
        $out .= ' **';
    }

    echo $out . "\n";
}
?>
--EXPECT--
1 - 01.12.2005 **
2 - 01.11.2005
3 - 01.10.2005
4 - 01.09.2005
5 - 01.08.2005
6 - 01.07.2005
7 - 01.06.2005
8 - 01.05.2005
9 - 01.04.2005
10 - 01.03.2005
11 - 01.02.2005
12 - 01.01.2005
13 - 01.12.2004 **
14 - 01.11.2004
15 - 01.10.2004
16 - 01.09.2004
17 - 01.08.2004
18 - 01.07.2004
19 - 01.06.2004
20 - 01.05.2004
21 - 01.04.2004
22 - 01.03.2004
23 - 01.02.2004
24 - 01.01.2004
25 - 01.12.2003 **

1 - 31.12.2005 **
2 - 30.11.2005
3 - 31.10.2005
4 - 30.09.2005
5 - 31.08.2005
6 - 31.07.2005
7 - 30.06.2005
8 - 31.05.2005
9 - 30.04.2005
10 - 31.03.2005
11 - 28.02.2005
12 - 31.01.2005
13 - 31.12.2004 **
14 - 30.11.2004
15 - 31.10.2004
16 - 30.09.2004
17 - 31.08.2004
18 - 31.07.2004
19 - 30.06.2004
20 - 31.05.2004
21 - 30.04.2004
22 - 31.03.2004
23 - 29.02.2004
24 - 31.01.2004
25 - 31.12.2003 **
