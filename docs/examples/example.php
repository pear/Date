<html>
<head>
 <title>Date Example</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <style>
  span.code { font-family:Monospace; }
 </style>
</head>
<body>
<?php

require_once "Date.php";

function echo_code($ps_date) {
  echo '<span class="code">' . $ps_date . "</span><br />\n";
  }


$date = new Date();


?>
<h4>Object is set to currrent time and local time zone by default:</h4>
<?php

echo_code($date->format('%d/%m/%Y %H.%M.%S%O (%Z)'));
echo_code($date->format2('DD/MM/YYYY HH.MI.SSTZO (TZC - TZN)'));
echo_code($date->getDate(DATE_FORMAT_ISO));


?>
<h4>Set date to 1st February, 1991:</h4>
<?php

$date->setDate("1991-02-01 01:02:03");

echo_code($date->format('%d/%m/%Y %H.%M.%S'));
echo_code($date->format2('DD/MM/YYYY HH.MI.SS'));

// Display day, month spelled out:
//
echo_code($date->format('%A, %e %B %Y, %H.%M.%S'));
echo_code($date->format2('NPDay, NPDDth Month YYYY, HH.MI.SS'));


?>
<h4>Time without padding (i.e. leading noughts), and with short year:</h4>
<?php

echo_code($date->format('%e/%m/%y %h.%M.%S'));
echo_code($date->format2('NPDD/NPMM/YY NPHH.MI.SS'));


?>
<h4>Conversion to another time zone:</h4>
<?php

$date->convertTZbyID("Asia/Calcutta");

echo_code($date->format2('"Time zone ID:" TZR'));
echo_code($date->format2('"Time zone name:" TZN'));
echo_code($date->format2('"Time zone code:" TZC'));
echo_code($date->format2('"Time zone offset:" TZO'));
echo "<br />\n";
echo_code($date->format2('DD/MM/YYYY HH.MI.SSTZO (TZC)'));


?>
<h4>Addition/Subtraction:</h4>
<?php

$date->addDays(-1);
echo_code($date->format2('DD/MM/YYYY HH.MI.SS'));

$date->addHours(13);
echo_code($date->format2('DD/MM/YYYY HH.MI.SS'));


?>
<h4>12-hour time:</h4>
<?php

echo_code($date->format('%d/%m/%Y %I.%M.%S %p'));
echo_code($date->format2('DD/MM/YYYY HH12.MI.SS am'));


?>
<h4>Display micro-time:</h4>
<?php

$date->setSecond(3.201282);

echo_code($date->format('%d/%m/%Y %I.%M.%s'));
echo_code($date->format2('DD/MM/YYYY HH12.MI.SS.FFFFFF'));


?>
<h4>Convert to Unix time:</h4>
<?php

echo_code($hn_unixtime = $date->format2('U'));


?>
<h4>Convert Unix time back to Date object:</h4>
<?php

$date2 = new Date($hn_unixtime);

echo_code($date2->format2("DD/MM/YYYY HH.MI.SSTZO"));


?>
<h4>Compare two times for equality:</h4>
<?php

if ($date2->before($date))
  echo "second date is earlier (because Unix time ignores the part-second)<br />\n";

$date->trunc(DATE_PRECISION_SECOND);

if ($date2->equals($date))
  echo "dates are now the same<br />\n";


?>
<br />
<br />
<br />
<br />
</body>
</html>