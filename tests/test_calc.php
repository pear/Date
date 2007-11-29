<?php
require_once "Date/Calc.php";

/**
 * Test dates from 1970 to 2029
 * Data from: http://www.merlyn.demon.co.uk/wknotest.txt
 *  [N.B. this link is now broken, although the web-site still exists]
 * Others usefull datas available from:
 * http://www.merlyn.demon.co.uk/#dat
 */

// 'wknotest.txt' is missing and no longer available on the web, and so this
// test is disabled for this reason (it was copyright anyway).
//
$failed_test_data   = false;
// $wkno   = file('wknotest.txt');
// $cnt    = sizeof($wkno);
// for( $i=0;$i<$cnt;$i++ ){
//     $parts      = explode(':',$wkno[$i]);
//     $weeksno[$parts[0]] = str_replace("\n",'',$parts[1]);
// }
// unset($wkno);
// foreach($weeksno as $date=>$iso){
//     $year       = substr($date,0,4);
//     $month      = substr($date,4,2);
//     $day        = substr($date,6);
//     $iso9601 = Date_Calc::gregorianToISO($day,$month,$year);
//     if($iso9601!=$iso){
//         $failed_test_data   = true;
//         echo $date . '(' . $iso . ') =>' . $year.'-'.$month.'-'.$day .'=>' . $iso9601 . " : failed\n";
//     }
// }

/**
 * Bugs #19788
 */
$failed_test_19788  = false;
$pass1  = array(1998, 2, 1)==Date_Calc::isoWeekDate(5,1,1998)?true:false;
$pass2  = array(1998, 2, 2)==Date_Calc::isoWeekDate(6,1,1998)?true:false;
$pass3  = array(2004, 2, 1)==Date_Calc::isoWeekDate(5,1,2004)?true:false;
$pass4  = array(2004, 2, 2)==Date_Calc::isoWeekDate(6,1,2004)?true:false;
if( !($pass1 && $pass2 && $pass3 && $pass4) ){
    $failed_test_19788   = true;
}

if($failed_test_19788 || $failed_test_data){
    echo "Bug #19788: failed\n";
} else {
    echo "Bug #19788: OK\n";
}
?>
