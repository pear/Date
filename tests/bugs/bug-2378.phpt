--TEST--
Bug #2378: Date::getDate(DATE_FORMAT_UNIXTIME) doesn't convert to GMT
--FILE--
<?php
/**
 * Test for: Date
 * Parts tested: Date::getTime(), Date::getDate(DATE_FORMAT_UNIXTIME)
 */

require_once 'Date.php';

$dates = array(
  '1969-12-31T18:30:00-05:30',    // 0
  '1970-01-01T07:00:00+07:00',    // 0
  '1970-01-01T00:00:00Z',         // 0
  '1998-12-31T23:59:59Z',         // 915148799
//  '1998-12-31T23:59:60Z',         // 915148800
  '1999-01-01T00:00:00Z',         // 915148800  (no leap second)
  '2001-09-09T01:46:40Z',         // 1000000000
  '2004-01-10T13:37:04Z',         // 2^30
  '2005-03-18T01:58:31Z',         // 1111111111
  '2006-12-08T01:00:00Z',         // 1165539600
  '2009-02-13T23:31:30Z',         // 1234567890
  '2033-05-18T03:33:20Z',         // 2000000000
  );

$date = new Date();
foreach ($dates as $hs_date) {
    $date->setDate($hs_date);

    if (PEAR::isError($res = $date->convertTZbyID('UTC'))) { print_r($res); exit(); }
    $ts = $date->getTime();
    echo 'Greenwich       = ' . str_pad($ts, 10) . ' - ' . $date->format2('YYYY-MM-DD HH:MI:SSSTZH:TZM') . "\n";

    if (PEAR::isError($res = $date->convertTZbyID('Europe/London'))) { print_r($res); exit(); }
    $ts = $date->getTime();
    echo 'London  ' . $date->format2('("UTC"NPSTZH)') . " = " . str_pad($ts, 10) . ' - ' . $date->format2('YYYY-MM-DD HH:MI:SSSTZH:TZM') . "\n";

    if (PEAR::isError($res = $date->convertTZbyID('Europe/Paris'))) { print_r($res); exit(); }
    $ts = $date->getTime();
    echo 'Paris   ' . $date->format2('("UTC"NPSTZH)') . " = " . str_pad($ts, 10) . ' - ' . $date->format2('YYYY-MM-DD HH:MI:SSSTZH:TZM') . "\n";

    if (PEAR::isError($res = $date->convertTZbyID('Asia/Jakarta'))) { print_r($res); exit(); }
    $ts = $date->getTime();
    echo 'Jakarta ' . $date->format2('("UTC"NPSTZH)') . " = " . str_pad($ts, 10) . ' - ' . $date->format2('YYYY-MM-DD HH:MI:SSSTZH:TZM') . "\n";
}
?>
--EXPECT--
Greenwich       = 0          - 1970-01-01 00:00:00+00:00
London  (UTC+0) = 0          - 1970-01-01 00:00:00+00:00
Paris   (UTC+1) = 0          - 1970-01-01 01:00:00+01:00
Jakarta (UTC+7) = 0          - 1970-01-01 07:00:00+07:00
Greenwich       = 0          - 1970-01-01 00:00:00+00:00
London  (UTC+0) = 0          - 1970-01-01 00:00:00+00:00
Paris   (UTC+1) = 0          - 1970-01-01 01:00:00+01:00
Jakarta (UTC+7) = 0          - 1970-01-01 07:00:00+07:00
Greenwich       = 0          - 1970-01-01 00:00:00+00:00
London  (UTC+0) = 0          - 1970-01-01 00:00:00+00:00
Paris   (UTC+1) = 0          - 1970-01-01 01:00:00+01:00
Jakarta (UTC+7) = 0          - 1970-01-01 07:00:00+07:00
Greenwich       = 915148799  - 1998-12-31 23:59:59+00:00
London  (UTC+0) = 915148799  - 1998-12-31 23:59:59+00:00
Paris   (UTC+1) = 915148799  - 1999-01-01 00:59:59+01:00
Jakarta (UTC+7) = 915148799  - 1999-01-01 06:59:59+07:00
Greenwich       = 915148800  - 1999-01-01 00:00:00+00:00
London  (UTC+0) = 915148800  - 1999-01-01 00:00:00+00:00
Paris   (UTC+1) = 915148800  - 1999-01-01 01:00:00+01:00
Jakarta (UTC+7) = 915148800  - 1999-01-01 07:00:00+07:00
Greenwich       = 1000000000 - 2001-09-09 01:46:40+00:00
London  (UTC+1) = 1000000000 - 2001-09-09 02:46:40+01:00
Paris   (UTC+2) = 1000000000 - 2001-09-09 03:46:40+02:00
Jakarta (UTC+7) = 1000000000 - 2001-09-09 08:46:40+07:00
Greenwich       = 1073741824 - 2004-01-10 13:37:04+00:00
London  (UTC+0) = 1073741824 - 2004-01-10 13:37:04+00:00
Paris   (UTC+1) = 1073741824 - 2004-01-10 14:37:04+01:00
Jakarta (UTC+7) = 1073741824 - 2004-01-10 20:37:04+07:00
Greenwich       = 1111111111 - 2005-03-18 01:58:31+00:00
London  (UTC+0) = 1111111111 - 2005-03-18 01:58:31+00:00
Paris   (UTC+1) = 1111111111 - 2005-03-18 02:58:31+01:00
Jakarta (UTC+7) = 1111111111 - 2005-03-18 08:58:31+07:00
Greenwich       = 1165539600 - 2006-12-08 01:00:00+00:00
London  (UTC+0) = 1165539600 - 2006-12-08 01:00:00+00:00
Paris   (UTC+1) = 1165539600 - 2006-12-08 02:00:00+01:00
Jakarta (UTC+7) = 1165539600 - 2006-12-08 08:00:00+07:00
Greenwich       = 1234567890 - 2009-02-13 23:31:30+00:00
London  (UTC+0) = 1234567890 - 2009-02-13 23:31:30+00:00
Paris   (UTC+1) = 1234567890 - 2009-02-14 00:31:30+01:00
Jakarta (UTC+7) = 1234567890 - 2009-02-14 06:31:30+07:00
Greenwich       = 2000000000 - 2033-05-18 03:33:20+00:00
London  (UTC+1) = 2000000000 - 2033-05-18 04:33:20+01:00
Paris   (UTC+2) = 2000000000 - 2033-05-18 05:33:20+02:00
Jakarta (UTC+7) = 2000000000 - 2033-05-18 10:33:20+07:00
