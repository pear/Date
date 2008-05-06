--TEST--
Bug #8518: Date::copy() doest not copy the parts of a second.
--FILE--
<?php
/**
 * Test for: Date
 * Parts tested: Date::copy()
 * $Id$
 */

require_once 'Date.php';

$date = new Date('2006-11-08 10:19:25.9942');
$date->setTZbyID("UTC");

$tmp = new Date;
$tmp->copy($date);
echo $tmp->format('%Y-%m-%d %H:%M:%s%O'."\n");
?>
--EXPECT--
2006-11-08 10:19:25.994200+00:00
