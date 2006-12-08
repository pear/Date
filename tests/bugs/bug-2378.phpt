<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */
// CVS: $Id$
?>
--TEST--
Bug #2378: Date::getDate(DATE_FORMAT_UNIXTIME) doesn't convert to GMT
--FILE--
<?php
/**
 * Test for: Date
 * Parts tested: Date::getTime(), Date::getDate(DATE_FORMAT_UNIXTIME)
 */

require_once 'Date.php';

$date =& new Date('2006-12-08T01:00:00Z');
$ts = $date->getTime();
echo 'Greenwich = ' . $ts . ' - ' . date('Y-m-d H:i:s', $ts) . "\n";

$date->convertTZbyID('Asia/Jakarta');
$ts = $date->getTime();
echo 'Jakarta (GMT+0700) = ' . $ts . ' - ' . date('Y-m-d H:i:s', $ts) . "\n";
?>
--EXPECT--
Greenwich = 1165579200 - 2006-12-08 01:00:00
Jakarta (GMT+0700) = 1165579200 - 2006-12-08 08:00:00
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