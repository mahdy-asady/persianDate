<?php

function getPersianDate($timestamp) {
    $JT = shiftTimestampToJalali($timestamp);

    $year = getYear($JT);

    $JT = minusYear($JT);

    $month = getMonth($JT);

    $JT = minusMonth($JT);

    $day = getDay($JT);

    $JT = minusDay($JT);

    $hour = getHour($JT);

    $JT = minusHour($JT);

    $minute = getMinute($JT);

    $second = minusMinute($JT);



    return $year . "/" . $month . "/" . $day . " " . $hour . ":" . $minute . ":" . $second;
}


function shiftTimestampToJalali($timestamp) {
    return $timestamp + 42531868800;
}

$yearConstant = (365.24219878 * 24*60*60); //
$monthDays = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

define ("minuteInSeconds", 60);
define ("hourInSeconds",   60*60);
define ("dayInSeconds",    60*60*24);


function getYear($Jtimestamp) {
    global $yearConstant;
    return floor($Jtimestamp / $yearConstant) + 1;
}
function minusYear($Jtimestamp) {
    global $yearConstant;
    $years = floor($Jtimestamp / $yearConstant);
    $days = $years * $yearConstant;
    $days = round($days / dayInSeconds);
    return $Jtimestamp - $days * dayInSeconds;
}

function getMonth($Jtimestamp) {
    global $monthDays;
    $i = 0;
    while($Jtimestamp/($monthDays[$i] * dayInSeconds) > 1) {
        $Jtimestamp -= ($monthDays[$i] * dayInSeconds);
        $i++;
    }
    return ++$i;
}
function minusMonth($Jtimestamp) {
    global $monthDays;
    $i = 0;
    while($Jtimestamp/($monthDays[$i] * dayInSeconds) > 1) {
        $Jtimestamp -= ($monthDays[$i] * dayInSeconds);
        $i++;
    }
    return $Jtimestamp;
}

function getDay($Jtimestamp) {
    return floor($Jtimestamp / dayInSeconds) + 1;
}
function minusDay($Jtimestamp) {
    return $Jtimestamp % dayInSeconds;
}

function getHour($Jtimestamp) {
    return floor($Jtimestamp / hourInSeconds);
}
function minusHour($Jtimestamp) {
    return $Jtimestamp % hourInSeconds;
}

function getMinute($Jtimestamp) {
    return floor($Jtimestamp / minuteInSeconds);
}
function minusMinute($Jtimestamp) {
    return $Jtimestamp % minuteInSeconds;
}

?>
