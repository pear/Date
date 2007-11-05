<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */

// {{{ Header

/**
 * Generic date handling class for PEAR
 *
 * Generic date handling class for PEAR.  Attempts to be time zone aware
 * through the Date::TimeZone class.  Supports several operations from
 * Date::Calc on Date objects.
 *
 * PHP versions 4 and 5
 *
 * LICENSE:
 *
 * Copyright (c) 1997-2006 Baba Buehler, Pierre-Alain Joye
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted under the terms of the BSD License.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Date and Time
 * @package    Date
 * @author     Baba Buehler <baba@babaz.com>
 * @author     Pierre-Alain Joye <pajoye@php.net>
 * @author     Firman Wandayandi <firman@php.net>
 * @copyright  1997-2006 Baba Buehler, Pierre-Alain Joye
 * @license    http://www.opensource.org/licenses/bsd-license.php
 *             BSD License
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/Date
 */

// }}}

// {{{ Includes


require_once 'PEAR.php';

/**
 * Load Date_TimeZone.
 */
require_once 'Date/TimeZone.php';

/**
 * Load Date_Calc.
 */
require_once 'Date/Calc.php';

/**
 * Load Date_Span.
 */
require_once 'Date/Span.php';

// }}}
// {{{ Constants

// {{{ Output formats Pass this to getDate().

/**
 * "YYYY-MM-DD HH:MM:SS"
 */
define('DATE_FORMAT_ISO', 1);

/**
 * "YYYYMMSSTHHMMSS(Z|(+/-)HHMM)?"
 */
define('DATE_FORMAT_ISO_BASIC', 2);

/**
 * "YYYY-MM-SSTHH:MM:SS(Z|(+/-)HH:MM)?"
 */
define('DATE_FORMAT_ISO_EXTENDED', 3);

/**
 * "YYYY-MM-SSTHH:MM:SS(.S*)?(Z|(+/-)HH:MM)?"
 */
define('DATE_FORMAT_ISO_EXTENDED_MICROTIME', 6);

/**
 * "YYYYMMDDHHMMSS"
 */
define('DATE_FORMAT_TIMESTAMP', 4);

/**
 * long int, seconds since the unix epoch
 */
define('DATE_FORMAT_UNIXTIME', 5);

// }}}

// }}}
// {{{ Class: Date

/**
 * Generic date handling class for PEAR
 *
 * Generic date handling class for PEAR.  Attempts to be time zone aware
 * through the Date::TimeZone class.  Supports several operations from
 * Date::Calc on Date objects.
 *
 * @author     Baba Buehler <baba@babaz.com>
 * @author     Pierre-Alain Joye <pajoye@php.net>
 * @author     Firman Wandayandi <firman@php.net>
 * @copyright  1997-2006 Baba Buehler, Pierre-Alain Joye
 * @license    http://www.opensource.org/licenses/bsd-license.php
 *             BSD License
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/Date
 */
class Date
{
    // {{{ Properties

    /**
     * the year
     *
     * @var      int
     * @since    1.0
     * @access   private
     */
    var $year;

    /**
     * the month
     *
     * @var      int
     * @since    1.0
     * @access   private
     */
    var $month;

    /**
     * the day
     *
     * @var      int
     * @since    1.0
     * @access   private
     */
    var $day;

    /**
     * the hour
     *
     * @var      int
     * @since    1.0
     * @access   private
     */
    var $hour;

    /**
     * the minute
     *
     * @var      int
     * @since    1.0
     * @access   private
     */
    var $minute;

    /**
     * the second
     *
     * @var      int
     * @since    1.0
     * @access   private
     */
    var $second;

    /**
     * the parts of a second
     *
     * @var      float
     * @since    1.4.3
     * @access   private
     */
    var $partsecond;

    /**
     * timezone for this date
     *
     * @var      object Date_TimeZone
     * @since    1.0
     * @access   private
     */
    var $tz;

    /**
     * define the default weekday abbreviation length
     * used by ::format()
     *
     * @var      int
     * @since    1.4.4
     * @access   private
     */
    var $getWeekdayAbbrnameLength = 3;

    // }}}
    // {{{ Constructor

    /**
     * Constructor
     *
     * Creates a new Date Object initialized to the current date/time in the
     * system-default timezone by default.  A date optionally
     * passed in may be in the ISO 8601, TIMESTAMP or UNIXTIME format,
     * or another Date object.  If no date is passed, the current date/time
     * is used.
     *
     * @access public
     * @see setDate()
     * @param mixed $date optional - date/time to initialize
     * @return object Date the new Date object
     */
    function Date($date = null)
    {
        if (is_a($date, 'Date')) {
            $this->copy($date);
        } else {
            // Attempt to get time zone from local machine, or
            // failing that, set to default time zone:
            //
            $this->setTZbyID();

            if (is_null($date)) {
                $this->setDate(date("Y-m-d H:i:s"));
            } else {
                $this->setDate($date);
            }
        }
    }

    // }}}
    // {{{ setDate()

    /**
     * Sets the fields of a Date object based on the input date and format
     *
     * Sets the fields of a Date object based on the input date and format,
     * which is specified by the DATE_FORMAT_* constants.
     *
     * @access public
     * @param string $date input date
     * @param int $format Optional format constant (DATE_FORMAT_*) of the input date.
     *                    This parameter isn't really needed anymore, but you could
     *                    use it to force DATE_FORMAT_UNIXTIME.
     */
    function setDate($date, $format = DATE_FORMAT_ISO)
    {
        if (
            preg_match('/^([0-9]{4,4})-?(0[1-9]|1[0-2])-?(0[1-9]|[12][0-9]|3[01])([T\s]?([01][0-9]|2[0-3]):?([0-5][0-9]):?([0-5][0-9])(\.\d+)?(Z|[+\-][0-9]{2,2}(:?[0-5][0-9])?)?)?$/i', $date, $regs)
            && $format != DATE_FORMAT_UNIXTIME) {
            // DATE_FORMAT_ISO, ISO_BASIC, ISO_EXTENDED, and TIMESTAMP
            // These formats are extremely close to each other.  This regex
            // is very loose and accepts almost any butchered format you could
            // throw at it.  e.g. 2003-10-07 19:45:15 and 2003-10071945:15
            // are the same thing in the eyes of this regex, even though the
            // latter is not a valid ISO 8601 date.
            $this->year       = (int) $regs[1];
            $this->month      = (int) $regs[2];
            $this->day        = (int) $regs[3];

            if (!Date_Calc::isValidDate($this->day, $this->month, $this->year))
                return PEAR::raiseError("'" . $regs[1] . "-" . $regs[2] . "-" . $regs[3] . "' is invalid calendar date");

            $this->hour       = (isset($regs[5]) ? (int) $regs[5] : 0);
            $this->minute     = (isset($regs[6]) ? (int) $regs[6] : 0);
            $this->second     = (isset($regs[7]) ? (int) $regs[7] : 0);
            $this->partsecond = (isset($regs[8]) ? (float) $regs[8] : 0.0);

            if (isset($regs[9])) {
                if ($regs[9] == "Z") {
                    $this->setTZbyID("UTC");
                } else {
                    $this->setTZbyID("UTC" . $regs[9]);
                }
            }
        } elseif (is_numeric($date)) {
            // UNIXTIME
            $this->setDate(date("Y-m-d H:i:s", $date));
        } else {
            return PEAR::raiseError("Date not in ISO 8601 format");
        }
    }

    // }}}
    // {{{ getDate()

    /**
     * Get a string (or other) representation of this date
     *
     * Get a string (or other) representation of this date in the
     * format specified by the DATE_FORMAT_* constants.
     *
     * @access public
     * @param int $format format constant (DATE_FORMAT_*) of the output date
     * @return string the date in the requested format
     */
    function getDate($format = DATE_FORMAT_ISO)
    {
        switch ($format) {
        case DATE_FORMAT_ISO:
            return $this->format("%Y-%m-%d %T");
            break;
        case DATE_FORMAT_ISO_BASIC:
            $format = "%Y%m%dT%H%M%S";
            if ($this->tz->getID() == 'UTC') {
                $format .= "Z";
            }
            return $this->format($format);
            break;
        case DATE_FORMAT_ISO_EXTENDED:
            $format = "%Y-%m-%dT%H:%M:%S";
            if ($this->tz->getID() == 'UTC') {
                $format .= "Z";
            }
            return $this->format($format);
            break;
        case DATE_FORMAT_ISO_EXTENDED_MICROTIME:
            $format = "%Y-%m-%dT%H:%M:%s";
            if ($this->tz->getID() == 'UTC') {
                $format .= "Z";
            }
            return $this->format($format);
            break;
        case DATE_FORMAT_TIMESTAMP:
            return $this->format("%Y%m%d%H%M%S");
            break;
        case DATE_FORMAT_UNIXTIME:
            return mktime($this->hour, $this->minute, $this->second, $this->month, $this->day, $this->year);
            break;
        }
    }


    // }}}
    // {{{ copy()

    /**
     * Copy values from another Date object
     *
     * Makes this Date a copy of another Date object.
     *
     * @access public
     * @param object Date $date Date to copy from
     */
    function copy($date)
    {
        $this->year = $date->getYear();
        $this->month = $date->getMonth();
        $this->day = $date->getDay();
        $this->hour = $date->getHour();
        $this->minute = $date->getMinute();
        $this->second = $date->getSecond();
        $this->partsecond = $date->getPartSecond();
        $this->setTZByID($date->getTZID());
    }


    // }}}
/*
 * PHP5 only:
 *
    function __clone()
    {
        $this->tz = clone $this->tz;
    }
 *
 */
    // {{{ format()

    /**
     *  Date pretty printing, similar to strftime()
     *
     *  Formats the date in the given format, much like
     *  strftime().  Most strftime() options are supported.<br><br>
     *
     *  formatting options:<br><br>
     *
     *  <code>%a  </code>  abbreviated weekday name (Sun, Mon, Tue) <br>
     *  <code>%A  </code>  full weekday name (Sunday, Monday, Tuesday) <br>
     *  <code>%b  </code>  abbreviated month name (Jan, Feb, Mar) <br>
     *  <code>%B  </code>  full month name (January, February, March) <br>
     *  <code>%C  </code>  century number (the year divided by 100 and truncated to an integer, range 00 to 99) <br>
     *  <code>%d  </code>  day of month (range 00 to 31) <br>
     *  <code>%D  </code>  same as "%m/%d/%y" <br>
     *  <code>%e  </code>  day of month, single digit (range 0 to 31) <br>
     *  <code>%E  </code>  number of days since unspecified epoch (integer, Date_Calc::dateToDays()) <br>
     *  <code>%H  </code>  hour as decimal number (00 to 23) <br>
     *  <code>%I  </code>  hour as decimal number on 12-hour clock (01 to 12) <br>
     *  <code>%j  </code>  day of year (range 001 to 366) <br>
     *  <code>%m  </code>  month as decimal number (range 01 to 12) <br>
     *  <code>%M  </code>  minute as a decimal number (00 to 59) <br>
     *  <code>%n  </code>  newline character (\n) <br>
     *  <code>%O  </code>  dst-corrected timezone offset expressed as "+/-HH:MM" <br>
     *  <code>%o  </code>  raw timezone offset expressed as "+/-HH:MM" <br>
     *  <code>%p  </code>  either 'am' or 'pm' depending on the time <br>
     *  <code>%P  </code>  either 'AM' or 'PM' depending on the time <br>
     *  <code>%r  </code>  time in am/pm notation, same as "%I:%M:%S %p" <br>
     *  <code>%R  </code>  time in 24-hour notation, same as "%H:%M" <br>
     *  <code>%s  </code>  seconds including the decimal representation smaller than one second <br>
     *  <code>%S  </code>  seconds as a decimal number (00 to 59) <br>
     *  <code>%t  </code>  tab character (\t) <br>
     *  <code>%T  </code>  current time, same as "%H:%M:%S" <br>
     *  <code>%w  </code>  weekday as decimal (0 = Sunday) <br>
     *  <code>%U  </code>  week number of current year, first sunday as first week <br>
     *  <code>%y  </code>  year as decimal (range 00 to 99) <br>
     *  <code>%Y  </code>  year as decimal including century (range 0000 to 9999) <br>
     *  <code>%%  </code>  literal '%' <br>
     * <br>
     *
     * @access public
     * @param string format the format string for returned date/time
     * @return string date/time in given format
     */
    function format($format)
    {
        $output = "";

        for($strpos = 0; $strpos < strlen($format); $strpos++) {
            $char = substr($format,$strpos,1);
            if ($char == "%") {
                $nextchar = substr($format,$strpos + 1,1);
                switch ($nextchar) {
                case "a":
                    $output .= Date_Calc::getWeekdayAbbrname($this->day,$this->month,$this->year, $this->getWeekdayAbbrnameLength);
                    break;
                case "A":
                    $output .= Date_Calc::getWeekdayFullname($this->day,$this->month,$this->year);
                    break;
                case "b":
                    $output .= Date_Calc::getMonthAbbrname($this->month);
                    break;
                case "B":
                    $output .= Date_Calc::getMonthFullname($this->month);
                    break;
                case "C":
                    $output .= sprintf("%02d", intval($this->year / 100));
                    break;
                case "d":
                    $output .= sprintf("%02d",$this->day);
                    break;
                case "D":
                    $output .= sprintf("%02d/%02d/%02d",$this->month,$this->day,$this->year);
                    break;
                case "e":
                    $output .= $this->day;
                    break;
                case "E":
                    $output .= Date_Calc::dateToDays($this->day,$this->month,$this->year);
                    break;
                case "H":
                    $output .= sprintf("%02d", $this->hour);
                    break;
                case 'h':
                    $output .= sprintf("%d", $this->hour);
                    break;
                case "I":
                    $hour = ($this->hour + 1) > 12 ? $this->hour - 12 : $this->hour;
                    $output .= sprintf("%02d", $hour==0 ? 12 : $hour);
                    break;
                case "i":
                    $hour = ($this->hour + 1) > 12 ? $this->hour - 12 : $this->hour;
                    $output .= sprintf("%d", $hour==0 ? 12 : $hour);
                    break;
                case "j":
                    $output .= sprintf("%03d", Date_Calc::dayOfYear($this->day,$this->month,$this->year));
                    break;
                case "m":
                    $output .= sprintf("%02d",$this->month);
                    break;
                case "M":
                    $output .= sprintf("%02d",$this->minute);
                    break;
                case "n":
                    $output .= "\n";
                    break;
                case "O":
                    $offms = $this->tz->getOffset($this);
                    $direction = $offms >= 0 ? "+" : "-";
                    $offmins = abs($offms) / 1000 / 60;
                    $hours = $offmins / 60;
                    $minutes = $offmins % 60;
                    $output .= sprintf("%s%02d:%02d", $direction, $hours, $minutes);
                    break;
                case "o":
                    $offms = $this->tz->getRawOffset($this);
                    $direction = $offms >= 0 ? "+" : "-";
                    $offmins = abs($offms) / 1000 / 60;
                    $hours = $offmins / 60;
                    $minutes = $offmins % 60;
                    $output .= sprintf("%s%02d:%02d", $direction, $hours, $minutes);
                    break;
                case "p":
                    $output .= $this->hour >= 12 ? "pm" : "am";
                    break;
                case "P":
                    $output .= $this->hour >= 12 ? "PM" : "AM";
                    break;
                case "r":
                    $hour = ($this->hour + 1) > 12 ? $this->hour - 12 : $this->hour;
                    $output .= sprintf("%02d:%02d:%02d %s", $hour==0 ?  12 : $hour, $this->minute, $this->second, $this->hour >= 12 ? "PM" : "AM");
                    break;
                case "R":
                    $output .= sprintf("%02d:%02d", $this->hour, $this->minute);
                    break;
                case "s":
                    $output .= str_replace(',', '.', sprintf("%09f", (float)((float)$this->second + $this->partsecond)));
                    break;
                case "S":
                    $output .= sprintf("%02d", $this->second);
                    break;
                case "t":
                    $output .= "\t";
                    break;
                case "T":
                    $output .= sprintf("%02d:%02d:%02d", $this->hour, $this->minute, $this->second);
                    break;
                case "w":
                    $output .= Date_Calc::dayOfWeek($this->day,$this->month,$this->year);
                    break;
                case "U":
                    $output .= Date_Calc::weekOfYear($this->day,$this->month,$this->year);
                    break;
                case "y":
                    $output .= sprintf("%02d", $this->year % 100);
                    break;
                case "Y":
                    $output .= sprintf("%04d", $this->year);
                    break;
                case "Z":
                    $output .= $this->tz->inDaylightTime($this) ? $this->tz->getDSTShortName() : $this->tz->getShortName();
                    break;
                case "%":
                    $output .= "%";
                    break;
                default:
                    $output .= $char.$nextchar;
                }
                $strpos++;
            } else {
                $output .= $char;
            }
        }
        return $output;

    }


    // }}}
    // {{{ getOrdinalSuffix()

    /**
     * Returns appropriate ordinal suffix (i.e. 'th', 'st', 'nd' or 'rd') for integer
     *
     * @param    int        $pn_num                       number with which to determine suffix
     * @param    bool       $pb_uppercase                 boolean specifying if the suffix should be capitalized
     *
     * @return   string
     * @access   private
     */
    function getOrdinalSuffix($pn_num, $pb_uppercase = true)
    {
        switch (($pn_numabs = abs($pn_num)) % 100) {
        case 11:
        case 12:
        case 13:
            $hs_suffix = "th";
            break;
        default:
            switch ($pn_numabs % 10) {
            case 1:
                $hs_suffix = "st";
                break;
            case 2:
                $hs_suffix = "nd";
                break;
            case 3:
                $hs_suffix = "rd";
                break;
            default:
                $hs_suffix = "th";
            }
        }

        return $pb_uppercase ? strtoupper($hs_suffix) : $hs_suffix;
    }


    // }}}
    // {{{ spellNumber()

    /**
     * Converts a number to its word representation
     *
     * Private helper function, particularly for 'format2()'.  N.B. The
     * second argument is the 'SP' code which can be specified in the
     * format string for 'format2()' and is interpreted as follows:
     *  'SP' - returns upper-case spelling, e.g. 'FOUR HUNDRED'
     *  'Sp' - returns spelling with first character of each word
     *         capitalized, e.g. 'Four Hundred'
     *  'sp' - returns lower-case spelling, e.g. 'four hundred'
     *
     * @param    int        $pn_num                       number to be converted to words
     * @param    bool       $pb_ordinal                   boolean specifying if the number should be ordinal
     * @param    string     $ps_capitalization            string for specifying capitalization options
     * @param    string     $ps_locale                    language name abbreviation used for formatting
     *                                                     numbers as spelled-out words
     *
     * @return   string
     * @access   private
     */
    function spellNumber($pn_num, $pb_ordinal = false, $ps_capitalization = "SP", $ps_locale = "en_GB")
    {
        require_once "Numbers/Words.php";
        $hs_words = Numbers_Words::toWords($pn_num, $ps_locale);
        if (Pear::isError($hs_words)) {
            return $hs_words;
        }

        if ($pb_ordinal && substr($ps_locale, 0, 2) == "en") {
            if (($pn_rem = ($pn_numabs = abs($pn_num)) % 100) == 12) {
                $hs_words = substr($hs_words, 0, -2) . "fth";
            } else if ($pn_rem >= 11 && $pn_rem <= 15) {
                $hs_words .= "th";
            } else {
                switch ($pn_numabs % 10) {
                case 1:
                    $hs_words = substr($hs_words, 0, -3) . "first";
                    break;
                case 2:
                    $hs_words = substr($hs_words, 0, -3) . "second";
                    break;
                case 3:
                    $hs_words = substr($hs_words, 0, -3) . "ird";
                    break;
                case 4:
                    $hs_words = substr($hs_words, 0, -2) . "rth";
                    break;
                case 5:
                    $hs_words = substr($hs_words, 0, -2) . "fth";
                    break;
                default:
                    switch (substr($hs_words, -1)) {
                    case "e":
                        $hs_words = substr($hs_words, 0, -1) . "th";
                        break;
                    case "t":
                        $hs_words .= "h";
                        break;
                    case "y":
                        $hs_words = substr($hs_words, 0, -1) . "ieth";
                        break;
                    default:
                        $hs_words .= "th";
                    }
                }
            }
        }

        if (($hs_char = substr($ps_capitalization, 0, 1)) == strtolower($hs_char)) {
            $hb_upper = false;
            $hs_words = strtolower($hs_words);
        } else if (($hs_char = substr($ps_capitalization, 1, 1)) == strtolower($hs_char)) {
            $hb_upper = false;
            $hs_words = ucwords($hs_words);
        } else {
            $hb_upper = true;
            $hs_words = strtoupper($hs_words);
        }

        return $hs_words;
    }


    // }}}
    // {{{ formatNumber()

    /**
     * Formats a number according to the specified format string
     *
     * Private helper function, for 'format2()', which interprets the
     * codes 'SP' and 'TH' and the combination of the two as follows:
     *
     *  <code>TH</code>Ordinal number<br />
     *  <code>SP</code>Spelled cardinal number<br />
     *  <code>SPTH</code>Spelled ordinal number (combination of 'SP' and 'TH'<br />
     *                   in any order)<br />
     *  <code>THSP</code><br />
     *
     * Code 'SP' can have the following three variations (which can also be used
     * in combination with 'TH'):
     *
     *  <code>SP</code>returns upper-case spelling, e.g. 'FOUR HUNDRED'<br />
     *  <code>Sp</code>returns spelling with first character of each word<br />
     *                 capitalized, e.g. 'Four Hundred'<br />
     *  <code>sp</code>returns lower-case spelling, e.g. 'four hundred'<br />
     *
     * Code 'TH' can have the following two variations (although in combination
     * with code 'SP', the case specification of 'SP' takes precedence):
     *
     *  <code>TH</code>returns upper-case ordinal suffix, e.g. 400TH<br />
     *  <code>th</code>returns lower-case ordinal suffix, e.g. 400th<br />
     *
     * N.B. The format string is passed by reference, in order to pass back
     * the part of the format string that matches the valid codes 'SP' and
     * 'TH'.  If none of these are found, then it is set to an empty string;
     * If both codes are found then a string is returned with code 'SP'
     * preceding code 'TH' (i.e. 'SPTH', 'Spth' or 'spth').
     *
     * @param    int        $pn_num                       integer to be converted to words
     * @param    string     &$ps_format                   string of formatting codes (max. length 4)
     * @param    int        $pn_numofdigits               no of digits to display if displayed as
     *                                                     numeral (i.e. not spelled out), not including
     *                                                     the sign (if negative); to allow all digits
     *                                                     specify 0
     * @param    bool       $pb_nopad                     boolean specifying whether to suppress padding
     *                                                     with leading noughts (if displayed as numeral)
     * @param    bool       $pb_nosign                    boolean specifying whether to suppress the
     *                                                     display of the sign (if negative)
     * @param    string     $ps_locale                    language name abbreviation used for formatting
     * @param    string     $ps_thousandsep               optional thousand-separator (e.g. a comma)
     *                                                     numbers as spelled-out words
     * @param    int        $pn_padtype                   optional integer to specify padding (if
     *                                                     displayed as numeral) - can be STR_PAD_LEFT
     *                                                     or STR_PAD_RIGHT
     *
     * @return   string
     * @access   private
     */
    function formatNumber($pn_num, &$ps_format, $pn_numofdigits, $pb_nopad = false, $pb_nosign = false, $ps_locale = "en_GB", $ps_thousandsep = null, $pn_padtype = STR_PAD_LEFT)
    {
        $hs_code1 = substr($ps_format, 0, 2);
        $hs_code2 = substr($ps_format, 2, 2);

        $hs_sp = null;
        $hs_th = null;
        if (strtoupper($hs_code1) == "SP") {
            $hs_sp = $hs_code1;
            if (strtoupper($hs_code2) == "TH") {
                $hs_th = $hs_code2;
            }
        } else if (strtoupper($hs_code1) == "TH") {
            $hs_th = $hs_code1;
            if (strtoupper($hs_code2) == "SP") {
                $hs_sp = $hs_code2;
            }
        }

        $hn_absnum = abs($pn_num);
        if ($pn_numofdigits > 0 && strlen($hn_absnum) > $pn_numofdigits) {
            $hn_absnum = intval(substr($hn_absnum, -$pn_numofdigits));
        }
        $hs_num = $hn_absnum;

        if (!is_null($hs_sp)) {
            // Spell out number:
            //
            $ps_format = $hs_sp . (is_null($hs_th) ? "" : ($hs_sp == "SP" ? "TH" : "th"));
            return $this->spellNumber(!$pb_nosign && $pn_num < 0 ? $hn_absnum * -1 : $hn_absnum, !is_null($hs_th), $hs_sp, $ps_locale);
        } else {
            // Display number as Arabic numeral:
            //
            if (!$pb_nopad) {
                $hs_num = str_pad($hs_num, $pn_numofdigits, "0", $pn_padtype);
            }

            if (!is_null($ps_thousandsep)) {
                for ($i = strlen($hs_num) - 3; $i > 0; $i -= 3) {
                    $hs_num = substr($hs_num, 0, $i) . $ps_thousandsep . substr($hs_num, $i);
                }
            }

            if (!$pb_nosign) {
                if ($pn_num < 0)
                    $hs_num = "-" . $hs_num;
                else if (!$pb_nopad)
                    $hs_num = " " . $hs_num;
                }

            if (!is_null($hs_th)) {
                $ps_format = $hs_th;
                return $hs_num . $this->getOrdinalSuffix($pn_num, substr($hs_th, 0, 1) == "T");
            } else {
                $ps_format = "";
                return $hs_num;
            }
        }
    }


    // }}}
    // {{{ format2()

    /**
     * Extended version of 'format2()' with variable-length formatting codes
     *
     * Formatting options:
     *
     *  <code>-</code>Punctuation, white-space and quoted text is reproduced in the result<br />
     *  <code>/</code><br />
     *  <code>,</code><br />
     *  <code>.</code><br />
     *  <code>;</code><br />
     *  <code>:</code><br />
     *  <code> </code><br />
     *  <code>"text"</code><br />
     *  <code>AD</code>AD indicator with or without full stops<br />
     *  <code>A.D.</code><br />
     *  <code>AM</code>Meridian indicator with or without full stops<br />
     *  <code>A.M.</code><br />
     *  <code>BC</code>BC indicator with or without full stops<br />
     *  <code>B.C.</code><br />
     *  <code>BCE</code>BCE indicator with or without full stops<br />
     *  <code>B.C.E.</code><br />
     *  <code>CC</code>Century, i.e. the year divided by 100, discarding the remainder; 'S' prefixes negative years with a minus sign<br />
     *  <code>SCC</code><br />
     *  <code>CE</code>CE indicator with or without full stops<br />
     *  <code>C.E.</code><br />
     *  <code>D</code>Day of week (0-6), where 0 represents Sunday<br />
     *  <code>DAY</code>Name of day, padded with blanks to display width of the widest name of day in the date language used for this element<br />
     *  <code>DD</code>Day of month (1-31)<br />
     *  <code>DDD</code>Day of year (1-366)<br />
     *  <code>DY</code>Abbreviated name of day<br />
     *  <code>F [1..9]</code>Fractional seconds; no radix character is printed (use the X format element to add the radix character)<br />
     *                       Use the numbers 1 to 9 after FF to specify the number of digits in the fractional second portion of the datetime value returned<br />
                             If you do not specify a digit, then Oracle Database uses the precision specified for the datetime datatype or the datatype's default precision<br />
     *                       e.g. 'HH:MI:SS.F'<br />
     *  <code>HH</code>Hour of day (0-23)<br />
     *  <code>HH12</code>Hour of day (1-12)<br />
     *  <code>HH24</code>Hour of day (0-23)<br />
     *  <code>ID</code>Day of week (1-7) based on the ISO standard<br />
     *  <code>IW</code>Week of year (1-52 or 1-53) based on the ISO standard<br />
     *  <code>IYY</code>Last 3, 2, or 1 digit(s) of ISO year<br />
     *  <code>IY</code><br />
     *  <code>I</code><br />
     *  <code>IYYY</code>4-digit year based on the ISO standard; 'S' prefixes negative years with a minus sign<br />
     *  <code>SIYYY</code><br />
     *  <code>J</code>Julian day; the number of days since Monday, November 24, 4714 B.C. (Proleptic Gregorian
     *                calendar); number specified with J must be integers<br />
     *  <code>MI</code>Minute (0-59)<br />
     *  <code>MM</code>Month (01-12; January = 01)<br />
     *  <code>MON</code>Abbreviated name of month<br />
     *  <code>MONTH</code>Name of month, padded with blanks to display width of the widest name of month in the date language used for this element<br />
     *  <code>PM</code>Meridian indicator with or without full stops<br />
     *  <code>P.M.</code><br />
     *  <code>Q</code>Quarter of year (1, 2, 3, 4; January - March = 1)<br />
     *  <code>RM</code>Roman numeral month (I-XII; January = I)<br />
     *  <code>SS</code>Second (0-59)<br />
     *  <code>SSSSS</code>Seconds past midnight (0-86399)<br />
     *  <code>TZD</code>Daylight savings information; the TZD value is an abbreviated time zone string with daylight savings information<br />
     *                  It must correspond with the region specified in TZR<br />
     *                  e.g. PST (for US/Pacific standard time); PDT (for US/Pacific daylight time)<br />
     *  <code>TZH</code>Time zone hour (See TZM format element)<br />
     *                  e.g. 'HH:MI:SS.FFTZH:TZM'<br />
     *  <code>TZM</code>Time zone minute (See TZH format element)<br />
     *                  e.g. 'HH:MI:SS.FFTZH:TZM'<br />
     *  <code>TZR</code>Time zone region, that is, the name or ID of the time zone<br />
     *                  e.g. 'Europe/London';  N.B. this value is unique for each
     *                  time zone<br />
     *  <code>U</code>Seconds since the Unix Epoch - January 1 1970 00:00:00 GMT<br />
     *  <code>WW</code>'Absolute' week of year (1-53), counting week 1 as 1st-7th of the year, regardless of the day<br />
     *  <code>W1</code>Week of year (1-54), counting week 1 as the week that contains 1st January<br />
     *  <code>W4</code>Week of year (1-53), counting week 1 as the week that contains 4th January (i.e. first week with at least 4 days)<br />
     *  <code>W7</code>Week of year (1-53), counting week 1 as the week that contains 7th January (i.e. first full week)<br />
     *  <code>W</code>'Absolute' week of month (1-5), counting week 1 as 1st-7th of the year, regardless of the day<br />
     *  <code>Y,YYY</code>Year with thousands-separator in this position; five possible separators<br />
     *  <code>Y.YYY</code><br />
     *  <code>Y·YYY</code>N.B. space-dot (mid-dot, interpunct) is valid only in ISO 8859-1<br />
     *  <code>Y'YYY</code><br />
     *  <code>Y YYY</code><br />
     *  <code>YEAR</code>Year, spelled out; 'S' prefixes negative years with 'MINUS'<br />
     *                   N.B. 'YEAR' differs from 'YYYYSP' in that the first will render 1923, for example,<br />
     *                   as 'NINETEEN TWENTY-THREE, and the second as 'ONE THOUSAND NINE HUNDRED TWENTY-THREE'<br />
     *  <code>SYEAR</code><br />
     *  <code>YYYY</code>4-digit year; 'S' prefixes negative years with a minus sign<br />
     *  <code>SYYYY</code><br />
     *  <code>YYY</code>Last 3, 2, or 1 digit(s) of year<br />
     *  <code>YY</code><br />
     *  <code>Y</code><br />
     *
     * Most character-returning codes, such as 'MONTH', will
     * set the capitalization according to the code, so for example:
     *
     *  <code>MONTH</code>returns upper-case spelling, e.g. 'JANUARY'<br />
     *  <code>Month</code>returns spelling with first character of each word<br />
     *                 capitalized, e.g. 'January'<br />
     *  <code>month</code>returns lower-case spelling, e.g. 'january'<br />
     *
     * In addition the following codes can be used in combination with other
     * codes;
     *  Codes that modify the next code in the format string:
     *
     *  <code>NP</code>'No Padding' - Returns a value with no trailing blanks and<br />
     *                  no leading or trailing noughts; N.B. that the default is to
     *                  include this padding in the return string<br />
     *
     *  Codes that modify the previous code in the format string (can only
     *  be used with integral codes such as 'MM'):
     *
     *  <code>TH</code>Ordinal number<br />
     *  <code>SP</code>Spelled cardinal number<br />
     *  <code>SPTH</code>Spelled ordinal number (combination of 'SP' and 'TH'<br />
     *                   in any order)<br />
     *  <code>THSP</code><br />
     *
     * Code 'SP' can have the following three variations (which can also be used
     * in combination with 'TH'):
     *
     *  <code>SP</code>returns upper-case spelling, e.g. 'FOUR HUNDRED'<br />
     *  <code>Sp</code>returns spelling with first character of each word<br />
     *                 capitalized, e.g. 'Four Hundred'<br />
     *  <code>sp</code>returns lower-case spelling, e.g. 'four hundred'<br />
     *
     * Code 'TH' can have the following two variations (although in combination
     * with code 'SP', the case specification of 'SP' takes precedence):
     *
     *  <code>TH</code>returns upper-case ordinal suffix, e.g. 400TH<br />
     *  <code>th</code>returns lower-case ordinal suffix, e.g. 400th<br />
     *
     * @param    string     $ps_format                    format string for returned date/time
     * @param    string     $ps_locale                    language name abbreviation used for formatting
     *                                                     numbers as spelled-out words
     *
     * @return   string     date/time in given format
     * @access   public
     */
    function format2($ps_format, $ps_locale = "en_GB")
    {
        if (!preg_match($h='/^("([^"\\\\]|\\\\\\\\|\\\\")*"|(D{1,3}|S?C+|HH(12|24)?|I[DW]|S?IY*|J|M[IM]|Q|SS(SSS)?|W[W147]?|S?Y{1,3}([,.·\' ]?YYY)*)(SP(TH)?|TH(SP)?)?|AD|A\.D\.|AM|A\.M\.|BCE?|B\.C\.(E\.)?|CE|C\.E\.|DAY|DY|F([1-9][0-9]*)?|MON(TH)?|NP|PM|P\.M\.|RM|R{2,}|TS|TZ[DHMR]|S?YEAR|[^A-Z0-9"])*$/i', $ps_format)) {
            return PEAR::raiseError("Invalid date format '$ps_format'");
        }

        $ret = "";
        $i = 0;
        $hb_nopadflag = false;
        $hb_showsignflag = false;

        $hn_weekdaypad = null;
        $hn_monthpad = null;
        $hn_isoyear = null;
        $hn_isoweek = null;
        $hn_isoday = null;

        while ($i < strlen($ps_format)) {
            $hb_lower = false;

            if ($hb_nopadflag) {
                $hb_nopad = true;
            } else {
                $hb_nopad = false;
            }
            if ($hb_showsignflag) {
                $hb_nosign = false;
            } else {
                $hb_nosign = true;
            }
            $hb_nopadflag = false;
            $hb_showsignflag = false;

            switch ($hs_char = substr($ps_format, $i, 1)) {
                case "-":
                case "/":
                case ",":
                case ".":
                case ";":
                case ":":
                case " ":
                    $ret .= $hs_char;
                    $i += 1;
                    break;
                case "\"":
                    preg_match('/(([^"\\\\]|\\\\\\\\|\\\\")*)"/', $ps_format, $ha_matches, PREG_OFFSET_CAPTURE, $i + 1);
                    $ret .= str_replace(array('\\\\', '\\"'), array('\\', '"'), $ha_matches[1][0]);
                    $i += strlen($ha_matches[0][0]) + 1;
                    break;
                case "a":
                    $hb_lower = true;
                case "A":
                    if (strtoupper(substr($ps_format, $i, 4)) == "A.D.") {
                        $ret .= $this->year >= 0 ? ($hb_lower ? "a.d." : "A.D.") : ($hb_lower ? "b.c." : "B.C.");
                        $i += 4;
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "AD") {
                        $ret .= $this->year >= 0 ? ($hb_lower ? "ad" : "AD") : ($hb_lower ? "bc" : "BC");
                        $i += 2;
                    } else if (strtoupper(substr($ps_format, $i, 4)) == "A.M.") {
                        $ret .= $this->hour < 12 ? ($hb_lower ? "a.m." : "A.M.") : ($hb_lower ? "p.m." : "P.M.");
                        $i += 4;
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "AM") {
                        $ret .= $this->hour < 12 ? ($hb_lower ? "am" : "AM") : ($hb_lower ? "pm" : "PM");
                        $i += 2;
                    }

                    break;
                case "b":
                    $hb_lower = true;
                case "B":
                    // Check for 'B.C.E.' first:
                    //
                    if (strtoupper(substr($ps_format, $i, 6)) == "B.C.E.") {
                        if ($this->year >= 0) {
                            $hs_era = $hb_lower ? "c.e." : "C.E.";
                            $ret .= $hb_nopad ? $hs_era : str_pad($hs_era, 6, " ", STR_PAD_RIGHT);
                        } else {
                            $ret .= $hb_lower ? "b.c.e." : "B.C.E.";
                        }
                        $i += 6;
                    } else if (strtoupper(substr($ps_format, $i, 3)) == "BCE") {
                        if ($this->year >= 0) {
                            $hs_era = $hb_lower ? "ce" : "CE";
                            $ret .= $hb_nopad ? $hs_era : str_pad($hs_era, 3, " ", STR_PAD_RIGHT);
                        } else {
                            $ret .= $hb_lower ? "bce" : "BCE";
                        }
                        $i += 3;
                    } else if (strtoupper(substr($ps_format, $i, 4)) == "B.C.") {
                        $ret .= $this->year >= 0 ? ($hb_lower ? "a.d." : "A.D.") : ($hb_lower ? "b.c." : "B.C.");
                        $i += 4;
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "BC") {
                        $ret .= $this->year >= 0 ? ($hb_lower ? "ad" : "AD") : ($hb_lower ? "bc" : "BC");
                        $i += 2;
                    }

                    break;
                case "c":
                    $hb_lower = true;
                case "C":
                    if (strtoupper(substr($ps_format, $i, 4)) == "C.E.") {
                        if ($this->year >= 0) {
                            $hs_era = $hb_lower ? "c.e." : "C.E.";
                            $ret .= $hb_nopad ? $hs_era : str_pad($hs_era, 6, " ", STR_PAD_RIGHT);
                        } else {
                            $ret .= $hb_lower ? "b.c.e." : "B.C.E.";
                        }
                        $i += 4;
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "CE") {
                        if ($this->year >= 0) {
                            $hs_era = $hb_lower ? "ce" : "CE";
                            $ret .= $hb_nopad ? $hs_era : str_pad($hs_era, 3, " ", STR_PAD_RIGHT);
                        } else {
                            $ret .= $hb_lower ? "bce" : "BCE";
                        }
                        $i += 2;
                    } else {
                        // Code C(CCC...):
                        //
                        $hn_codelen = 1;
                        while (strtoupper(substr($ps_format, $i + $hn_codelen, 1)) == "C")
                            ++$hn_codelen;

                        // Check next code is not 'CE' or 'C.E.'
                        //
                        if ($hn_codelen > 1 &&
                            (strtoupper(substr($ps_format, $i + $hn_codelen - 1, 4)) == "C.E." ||
                             strtoupper(substr($ps_format, $i + $hn_codelen - 1, 2)) == "CE"
                             ))
                            --$hn_codelen;

                        $hn_century = intval($this->year / 100);
                        $hs_numberformat = substr($ps_format, $i + $hn_codelen, 4);
                        $hs_century = $this->formatNumber($hn_century, $hs_numberformat, $hn_codelen, $hb_nopad, $hb_nosign, $ps_locale);
                        if (Pear::isError($hs_century))
                            return $hs_century;

                        $ret .= $hs_century;
                        $i += $hn_codelen + strlen($hs_numberformat);
                    }

                    break;
                case "d":
                    $hb_lower = true;
                case "D":
                    if (strtoupper(substr($ps_format, $i, 3)) == "DAY") {
                        $hs_day = Date_Calc::getWeekdayFullname($this->day, $this->month, $this->year);

                        if (!$hb_nopad) {
                            if (is_null($hn_weekdaypad)) {
                                // Set week-day padding variable:
                                //
                                $hn_weekdaypad = 0;
                                foreach (Date_Calc::getWeekDays() as $hs_weekday)
                                    $hn_weekdaypad = max($hn_weekdaypad, strlen($hs_weekday));
                            }
                            $hs_day = str_pad($hs_day, $hn_weekdaypad, " ", STR_PAD_RIGHT);
                        }

                        $ret .= $hb_lower ? strtolower($hs_day) : (substr($ps_format, $i + 1, 1) == "A" ? strtoupper($hs_day) : $hs_day);
                        $i += 3;
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "DY") {
                        $hs_day = Date_Calc::getWeekdayAbbrname($this->day, $this->month, $this->year);
                        $ret .= $hb_lower ? strtolower($hs_day) : (substr($ps_format, $i + 1, 1) == "Y" ? strtoupper($hs_day) : $hs_day);
                        $i += 2;
                    } else if (strtoupper(substr($ps_format, $i, 3)) == "DDD" &&
                               strtoupper(substr($ps_format, $i + 2, 3)) != "DAY" &&
                               strtoupper(substr($ps_format, $i + 2, 2)) != "DY"
                               ) {
                        $hn_day = Date_Calc::dayOfYear($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 3, 4);
                        $hs_day = $this->formatNumber($hn_day, $hs_numberformat, 3, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_day))
                            return $hs_day;

                        $ret .= $hs_day;
                        $i += 3 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "DD" &&
                               strtoupper(substr($ps_format, $i + 1, 3)) != "DAY" &&
                               strtoupper(substr($ps_format, $i + 1, 2)) != "DY"
                               ) {
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_day = $this->formatNumber($this->day, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_day))
                            return $hs_day;

                        $ret .= $hs_day;
                        $i += 2 + strlen($hs_numberformat);
                    } else {
                        // Code 'D':
                        //
                        $hn_day = Date_Calc::dayOfWeek($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 1, 4);
                        $hs_day = $this->formatNumber($hn_day, $hs_numberformat, 1, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_day))
                            return $hs_day;

                        $ret .= $hs_day;
                        $i += 1 + strlen($hs_numberformat);
                    }

                    break;
                case "f":
                case "F":
                    $hn_codelen = 1;
                    if (is_numeric(substr($ps_format, $i + $hn_codelen, 1))) {
                        ++$hn_codelen;
                        while (is_numeric(substr($ps_format, $i + $hn_codelen, 1)))
                            ++$hn_codelen;

                        $hn_partsecdigits = substr($ps_format, $i + 1, $hn_codelen - 1);
                        $hs_partsec = floor($this->partsecond * pow(10, $hn_partsecdigits));
                    } else {
                        while (strtoupper(substr($ps_format, $i + $hn_codelen, 1)) == "F")
                            ++$hn_codelen;

                        // Check next code is not F[numeric]:
                        //
                        if ($hn_codelen > 1 && is_numeric(substr($ps_format, $i + $hn_codelen, 1)))
                            --$hn_codelen;

                        $hn_partsecdigits = $hn_codelen;
                        $hs_partsec = floor($this->partsecond * pow(10, $hn_partsecdigits));
                    }

                    // 'formatNumber() will not work for this because the part-second is
                    // an int, and we want it to behave like a float:
                    //
                    if ($hb_nopad) {
                        $hs_partsec = rtrim($hs_partsec, "0");
                        if ($hs_partsec == "")
                            $hs_partsec = "0";
                    } else if ($hs_partsec == 0) {
                        $hs_partsec = str_pad($hs_partsec, $hn_partsecdigits, "0", STR_PAD_RIGHT);
                    }

                    $ret .= $hs_partsec;
                    $i += $hn_codelen;
                    break;
                case "h":
                case "H":
                    if (strtoupper(substr($ps_format, $i, 4)) == "HH12") {
                        $hn_hour = $this->hour % 12;
                        if ($hn_hour == 0)
                            $hn_hour = 12;

                        $hn_codelen = 4;
                    } else {
                        // Code 'HH' or 'HH24':
                        //
                        $hn_hour = $this->hour;
                        $hn_codelen = strtoupper(substr($ps_format, $i, 4)) == "HH24" ? 4 : 2;
                    }

                    $hs_numberformat = substr($ps_format, $i + $hn_codelen, 4);
                    $hs_hour = $this->formatNumber($hn_hour, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                    if (Pear::isError($hs_hour))
                        return $hs_hour;

                    $ret .= $hs_hour;
                    $i += $hn_codelen + strlen($hs_numberformat);
                    break;
                case "i":
                case "I":
                    if (is_null($hn_isoyear))
                        list($hn_isoyear, $hn_isoweek, $hn_isoday) = Date_Calc::isoWeekDate($this->day, $this->month, $this->year);

                    if (strtoupper(substr($ps_format, $i, 2)) == "ID" &&
                        strtoupper(substr($ps_format, $i + 1, 3)) != "DAY"
                        ) {
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_isoday = $this->formatNumber($hn_isoday, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_isoday))
                            return $hs_isoday;

                        $ret .= $hs_isoday;
                        $i += 2 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "IW") {
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_isoweek = $this->formatNumber($hn_isoweek, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_isoweek))
                            return $hs_isoweek;

                        $ret .= $hs_isoweek;
                        $i += 2 + strlen($hs_numberformat);
                    } else {
                        // Code I(YYY...):
                        //
                        $hn_codelen = 1;
                        while (strtoupper(substr($ps_format, $i + $hn_codelen, 1)) == "Y")
                            ++$hn_codelen;

                        $hs_numberformat = substr($ps_format, $i + $hn_codelen, 4);
                        $hs_isoyear = $this->formatNumber($hn_isoyear, $hs_numberformat, $hn_codelen, $hb_nopad, $hb_nosign, $ps_locale);
                        if (Pear::isError($hs_isoyear))
                            return $hs_isoyear;

                        $ret .= $hs_isoyear;
                        $i += $hn_codelen + strlen($hs_numberformat);
                    }

                    break;
                case "j":
                case "J":
                    $hn_jd = Date_Calc::dateToDays($this->day, $this->month, $this->year);
                    $hs_numberformat = substr($ps_format, $i + 1, 4);

                    // Allow sign if negative; allow all digits (specify nought); suppress padding:
                    //
                    $hs_jd = $this->formatNumber($hn_jd, $hs_numberformat, 0, true, false, $ps_locale);
                    if (Pear::isError($hs_jd))
                        return $hs_jd;

                    $ret .= $hs_jd;
                    $i += 1 + strlen($hs_numberformat);
                    break;
                case "m":
                    $hb_lower = true;
                case "M":
                    if (strtoupper(substr($ps_format, $i, 2)) == "MI") {
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_minute = $this->formatNumber($this->minute, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_minute))
                            return $hs_minute;

                        $ret .= $hs_minute;
                        $i += 2 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "MM") {
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_month = $this->formatNumber($this->month, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_month))
                            return $hs_month;

                        $ret .= $hs_month;
                        $i += 2 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 5)) == "MONTH") {
                        $hs_month = Date_Calc::getMonthFullname($this->month);

                        if (!$hb_nopad) {
                            if (is_null($hn_monthpad)) {
                                // Set month padding variable:
                                //
                                $hn_monthpad = 0;
                                foreach (Date_Calc::getMonthNames() as $hs_monthofyear)
                                    $hn_monthpad = max($hn_monthpad, strlen($hs_monthofyear));
                            }
                            $hs_month = str_pad($hs_month, $hn_monthpad, " ", STR_PAD_RIGHT);
                        }

                        $ret .= $hb_lower ? strtolower($hs_month) : (substr($ps_format, $i + 1, 1) == "O" ? strtoupper($hs_month) : $hs_month);
                        $i += 5;
                    } else if (strtoupper(substr($ps_format, $i, 3)) == "MON") {
                        $hs_month = Date_Calc::getMonthAbbrname($this->month);
                        $ret .= $hb_lower ? strtolower($hs_month) : (substr($ps_format, $i + 1, 1) == "O" ? strtoupper($hs_month) : $hs_month);
                        $i += 3;
                    }

                    break;
                case "n":
                case "N":
                    // No-Padding rule 'NP' applies to the next code (either trailing
                    // spaces or leading/trailing noughts):
                    //
                    $hb_nopadflag = true;
                    $i += 2;
                    break;
                case "p":
                    $hb_lower = true;
                case "P":
                    if (strtoupper(substr($ps_format, $i, 4)) == "P.M.") {
                        $ret .= $this->hour < 12 ? ($hb_lower ? "a.m." : "A.M.") : ($hb_lower ? "p.m." : "P.M.");
                        $i += 4;
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "PM") {
                        $ret .= $this->hour < 12 ? ($hb_lower ? "am" : "AM") : ($hb_lower ? "pm" : "PM");
                        $i += 2;
                    }

                    break;
                case "q":
                case "Q":
                    // N.B. Current implementation ignores the day and year, but
                    // it is possible that a different implementation might be
                    // desired, so pass these parameters anyway:
                    //
                    $hn_quarter = Date_Calc::quarterOfYear($this->day, $this->month, $this->year);
                    $hs_numberformat = substr($ps_format, $i + 1, 4);
                    $hs_quarter = $this->formatNumber($hn_quarter, $hs_numberformat, 1, $hb_nopad, true, $ps_locale);
                    if (Pear::isError($hs_quarter))
                        return $hs_quarter;

                    $ret .= $hs_quarter;
                    $i += 1 + strlen($hs_numberformat);
                    break;
                case "r":
                    $hb_lower = true;
                case "R":
                    // Code 'RM':
                    //
                    switch ($this->month) {
                    case 1:
                        $hs_monthroman = "i";
                        break;
                    case 2:
                        $hs_monthroman = "ii";
                        break;
                    case 3:
                        $hs_monthroman = "iii";
                        break;
                    case 4:
                        $hs_monthroman = "iv";
                        break;
                    case 5:
                        $hs_monthroman = "v";
                        break;
                    case 6:
                        $hs_monthroman = "vi";
                        break;
                    case 7:
                        $hs_monthroman = "vii";
                        break;
                    case 8:
                        $hs_monthroman = "viii";
                        break;
                    case 9:
                        $hs_monthroman = "ix";
                        break;
                    case 10:
                        $hs_monthroman = "x";
                        break;
                    case 11:
                        $hs_monthroman = "xi";
                        break;
                    case 12:
                        $hs_monthroman = "xii";
                        break;
                    }

                    $hs_monthroman = $hb_lower ? $hs_monthroman : strtoupper($hs_monthroman);
                    $ret .= $hb_nopad ? $hs_monthroman : str_pad($hs_monthroman, 4, " ", STR_PAD_RIGHT);
                    $i += 2;
                    break;
                case "s":
                case "S":
                    // Check for 'SSSSS' before 'SS':
                    //
                    if (strtoupper(substr($ps_format, $i, 5)) == "SSSSS") {
                        $hs_numberformat = substr($ps_format, $i + 5, 4);
                        $hs_second = $this->formatNumber(Date_Calc::secondsPastMidnight, $hs_numberformat, 5, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_second))
                            return $hs_second;

                        $ret .= $hs_second;
                        $i += 5 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "SS") {
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_second = $this->formatNumber($this->second, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_second))
                            return $hs_second;

                        $ret .= $hs_second;
                        $i += 2 + strlen($hs_numberformat);
                    } else {
                        // Code 'SC(CCC...)', 'SY(YYY...)', 'SIY(YYY...)', or 'SYEAR':
                        //
                        $hb_showsignflag = true;
                        if ($hb_nopad)
                            $hb_nopadflag = true;
                        ++$i;
                    }

                    break;
                case "u":
                case "U":
                    $hn_unixtime = $this->getTime();
                    $hs_numberformat = substr($ps_format, $i + 1, 4);

                    // Allow sign if negative; allow all digits (specify nought); suppress padding:
                    //
                    $hs_unixtime = $this->formatNumber($hn_unixtime, $hs_numberformat, 0, true, false, $ps_locale);
                    if (Pear::isError($hs_unixtime))
                        return $hs_unixtime;

                    $ret .= $hs_unixtime;
                    $i += 1 + strlen($hs_numberformat);
                    break;
                case "w":
                case "W":
                    // Check for 'WW' before 'W':
                    //
                    if (strtoupper(substr($ps_format, $i, 2)) == "WW") {
                        $hn_week = Date_Calc::weekOfYearAbsolute($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_week = $this->formatNumber($hn_week, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_week))
                            return $hs_week;

                        $ret .= $hs_week;
                        $i += 2 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "W1") {
                        $hn_week = Date_Calc::weekOfYear1st($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_week = $this->formatNumber($hn_week, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_week))
                            return $hs_week;

                        $ret .= $hs_week;
                        $i += 2 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "W4") {
                        $hn_week = Date_Calc::weekOfYear4th($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_week = $this->formatNumber($hn_week, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_week))
                            return $hs_week;

                        $ret .= $hs_week;
                        $i += 2 + strlen($hs_numberformat);
                    } else if (strtoupper(substr($ps_format, $i, 2)) == "W7") {
                        $hn_week = Date_Calc::weekOfYear7th($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 2, 4);
                        $hs_week = $this->formatNumber($hn_week, $hs_numberformat, 2, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_week))
                            return $hs_week;

                        $ret .= $hs_week;
                        $i += 2 + strlen($hs_numberformat);
                    } else {
                        // Code 'W':
                        //
                        $hn_week = Date_Calc::weekOfMonthAbsolute($this->day, $this->month, $this->year);
                        $hs_numberformat = substr($ps_format, $i + 1, 4);
                        $hs_week = $this->formatNumber($hn_week, $hs_numberformat, 1, $hb_nopad, true, $ps_locale);
                        if (Pear::isError($hs_week))
                            return $hs_week;

                        $ret .= $hs_week;
                        $i += 1 + strlen($hs_numberformat);
                    }

                    break;
                case "y":
                case "Y":
                    // Check for 'YEAR' first:
                    //
                    if (strtoupper(substr($ps_format, $i, 4)) == "YEAR") {
                        switch (substr($ps_format, $i, 2)) {
                        case "YE":
                            $hs_spformat = "SP";
                            break;
                        case "Ye":
                            $hs_spformat = "Sp";
                            break;
                        default:
                            $hs_spformat = "sp";
                        }

                        if (($hn_yearabs = abs($this->year)) < 100 || $hn_yearabs % 100 < 10) {
                            $hs_numberformat = $hs_spformat;

                            // Allow all digits (specify nought); padding irrelevant:
                            //
                            $hs_year = $this->formatNumber($this->year, $hs_numberformat, 0, true, $hb_nosign, $ps_locale);
                            if (Pear::isError($hs_year))
                                return $hs_year;

                            $ret .= $hs_year;
                        } else {
                            // Year is spelled 'Nineteen Twelve' rather than 'One thousand Nine Hundred Twelve':
                            //
                            $hn_century = intval($this->year / 100);
                            $hs_numberformat = $hs_spformat;

                            // Allow all digits (specify nought); padding irrelevant:
                            //
                            $hs_century = $this->formatNumber($hn_century, $hs_numberformat, 0, true, $hb_nosign, $ps_locale);
                            if (Pear::isError($hs_century))
                                return $hs_century;

                            $ret .= $hs_century . " ";

                            $hs_numberformat = $hs_spformat;

                            // Discard sign; padding irrelevant:
                            //
                            $hs_year = $this->formatNumber($this->year, $hs_numberformat, 2, false, true, $ps_locale);
                            if (Pear::isError($hs_year))
                                return $hs_year;

                            $ret .= $hs_year;
                        }

                        $i += 4;
                    } else {
                        // Code Y(YYY...):
                        //
                        $hn_codelen = 1;
                        while (strtoupper(substr($ps_format, $i + $hn_codelen, 1)) == "Y")
                            ++$hn_codelen;

                        $hs_thousandsep = null;
                        $hn_thousandseps = 0;
                        if ($hn_codelen <= 3) {
                            while (preg_match('/([,.·\' ])YYY/i', substr($ps_format, $i + $hn_codelen, 4), $ha_matches)) {
                                $hn_codelen += 4;
                                $hs_thousandsep = $ha_matches[1];
                                ++$hn_thousandseps;
                            }
                        }

                        // Check next code is not 'YEAR'
                        //
                        if ($hn_codelen > 1 && strtoupper(substr($ps_format, $i + $hn_codelen - 1, 4)) == "YEAR")
                            --$hn_codelen;

                        $hs_numberformat = substr($ps_format, $i + $hn_codelen, 4);
                        $hs_year = $this->formatNumber($this->year, $hs_numberformat, $hn_codelen - $hn_thousandseps, $hb_nopad, $hb_nosign, $ps_locale, $hs_thousandsep);
                        if (Pear::isError($hs_year))
                            return $hs_year;

                        $ret .= $hs_year;
                        $i += $hn_codelen + strlen($hs_numberformat);
                    }

                    break;
            }
        }
        return $ret;
    }

    // }}}
    // {{{ getTime()

    /**
     * Get this date/time in Unix time() format
     *
     * Get a representation of this date in Unix time() format.  This may only be
     * valid for dates from 1970 to ~2038.
     *
     * @access public
     * @return int number of seconds since the unix epoch
     */
    function getTime()
    {
        return $this->getDate(DATE_FORMAT_UNIXTIME);
    }

    // }}}
    // {{{ getTZID()

    /**
     * Returns the time zone ID of the object
     *
     * Returns the time zone ID of the object, e.g. "America/Chicago"
     *
     * @access public
     */
    function getTZID()
    {
        return $this->tz->getID();
    }

    // }}}
    // {{{ setTZ()

    /**
     * Sets the time zone of this Date
     *
     * Sets the time zone of this date with the given
     * Date_TimeZone object.  Does not alter the date/time,
     * only assigns a new time zone.  For conversion, use
     * convertTZ().
     *
     * @param object Date_TimeZone $tz the Date_TimeZone object to use, if called
     * with a paramater that is not a Date_TimeZone object, will fall through to
     * setTZbyID().
     *
     * @return   void
     * @access   public
     */
    function setTZ($tz)
    {
        if(is_a($tz, 'Date_Timezone')) {
            $this->tz = $tz;
        } else {
            $this->setTZbyID($tz);
        }
    }


    // }}}
    // {{{ setTZbyID()

    /**
     * Sets the time zone of this date with the given time zone ID
     *
     * If no time-zone is specified and PHP version >= 5.1.0, the time-zone
     * is set automatically.  Sets the time zone to the system default if the
     * given ID is invalid.  Does not alter the date/time, only assigns a
     * new time zone.  For conversion, use 'convertTZ()'.
     *
     * @param    string     $ps_id                        a valid time zone id, e.g. 'Europe/London'
     *
     * @return   void
     * @access   public
     */
    function setTZbyID($ps_id = null)
    {
        if (is_null($ps_id) && function_exists('version_compare') && version_compare(phpversion(), "5.1.0", ">=")) {
            $ps_id = date("e");
        }
        if (Date_TimeZone::isValidID($ps_id)) {
            $this->tz = new Date_TimeZone($ps_id);
        } else {
            $this->tz = Date_TimeZone::getDefault();
        }
    }


    // }}}
    // {{{ inDaylightTime()

    /**
     * Tests if this date/time is in DST
     *
     * Returns true if daylight savings time is in effect for
     * this date in this date's time zone.  See Date_TimeZone::inDaylightTime()
     * for compatability information.
     *
     * @access public
     * @return boolean true if DST is in effect for this date
     */
    function inDaylightTime()
    {
        return $this->tz->inDaylightTime($this);
    }

    // }}}
    // {{{ toUTC()

    /**
     * Converts this date to UTC and sets this date's timezone to UTC
     *
     * Converts this date to UTC and sets this date's timezone to UTC
     *
     * @access public
     */
    function toUTC()
    {
        if ($this->tz->getOffset($this) > 0) {
            $this->subtractSeconds(intval($this->tz->getOffset($this) / 1000));
        } else {
            $this->addSeconds(intval(abs($this->tz->getOffset($this)) / 1000));
        }
        $this->tz = new Date_TimeZone('UTC');
    }

    // }}}
    // {{{ convertTZ()

    /**
     * Converts this date to a new time zone
     *
     * Converts this date to a new time zone.
     * WARNING: This may not work correctly if your system does not allow
     * putenv() or if localtime() does not work in your environment.  See
     * Date::TimeZone::inDaylightTime() for more information.
     *
     * @access public
     * @param object Date_TimeZone $tz the Date::TimeZone object for the conversion time zone
     */
    function convertTZ($tz)
    {
        // convert to UTC
        if ($this->tz->getOffset($this) > 0) {
            $this->subtractSeconds(intval(abs($this->tz->getOffset($this)) / 1000));
        } else {
            $this->addSeconds(intval(abs($this->tz->getOffset($this)) / 1000));
        }
        // convert UTC to new timezone
        if ($tz->getOffset($this) > 0) {
            $this->addSeconds(intval(abs($tz->getOffset($this)) / 1000));
        } else {
            $this->subtractSeconds(intval(abs($tz->getOffset($this)) / 1000));
        }
        $this->tz = $tz;
    }

    // }}}
    // {{{ convertTZbyID()

    /**
     * Converts this date to a new time zone, given a valid time zone ID
     *
     * Converts this date to a new time zone, given a valid time zone ID
     * WARNING: This may not work correctly if your system does not allow
     * putenv() or if localtime() does not work in your environment.  See
     * Date::TimeZone::inDaylightTime() for more information.
     *
     * @access public
     * @param string id a time zone id
     */
    function convertTZbyID($id)
    {
       if (Date_TimeZone::isValidID($id)) {
          $tz = new Date_TimeZone($id);
       } else {
          $tz = Date_TimeZone::getDefault();
       }
       $this->convertTZ($tz);
    }

    // }}}
    // {{{ toUTCbyOffset()

    function toUTCbyOffset($offset)
    {
        if ($offset == "Z" || $offset == "+00:00" || $offset == "+0000") {
            $this->toUTC();
            return true;
        }

        if (preg_match('/([\+\-])(\d{2}):?(\d{2})/', $offset, $regs)) {
            // convert offset to seconds
            $hours  = (int) isset($regs[2])?$regs[2]:0;
            $mins   = (int) isset($regs[3])?$regs[3]:0;
            $offset = ($hours * 3600) + ($mins * 60);

            if (isset($regs[1]) && $regs[1] == "-") {                $offset *= -1;
            }

            if ($offset > 0) {
                $this->subtractSeconds(intval($offset));
            } else {
                $this->addSeconds(intval(abs($offset)));
            }

            $this->tz = new Date_TimeZone('UTC');
            return true;
        }

        return false;
    }

    // }}}
    // {{{ addYears()

    /**
     * Converts the date to the specified no of years from the given date
     *
     * To subtract years use a negative value for the '$pn_years'
     * parameter
     *
     * @param    int        $pn_years                     years to add
     *
     * @return   void
     * @access   public
     */
    function addYears($pn_years)
    {
        list($hs_year, $hs_month, $hs_day) = explode(" ", Date_Calc::addYears($pn_years, $this->day, $this->month, $this->year, "%Y %m %d"));
        $this->setDayMonthYear($hs_day, $hs_month, $hs_year, false);
    }


    // }}}
    // {{{ addMonths()

    /**
     * Converts the date to the specified no of months from the given date
     *
     * To subtract months use a negative value for the '$pn_months'
     * parameter
     *
     * @param    int        $pn_months                    months to add
     *
     * @return   void
     * @access   public
     */
    function addMonths($pn_months)
    {
        list($hs_year, $hs_month, $hs_day) = explode(" ", Date_Calc::addMonths($pn_months, $this->day, $this->month, $this->year, "%Y %m %d"));
        $this->setDayMonthYear($hs_day, $hs_month, $hs_year, false);
    }


    // }}}
    // {{{ addDays()

    /**
     * Converts the date to the specified no of days from the given date
     *
     * To subtract days use a negative value for the '$pn_days' parameter
     *
     * @param    int        $pn_days                      days to add
     *
     * @return   void
     * @access   public
     */
    function addDays($pn_days)
    {
        list($hs_year, $hs_month, $hs_day) = explode(" ", Date_Calc::addDays($pn_days, $this->day, $this->month, $this->year, "%Y %m %d"));
        $this->setDayMonthYear($hs_day, $hs_month, $hs_year, false);
    }


    // }}}
    // {{{ addSpan()

    /**
     * Adds a time span to the date
     *
     * @param object Date_Span $span the time span to add
     *
     * @return   void
     * @access   public
     */
    function addSpan($span)
    {
        if (!is_a($span, 'Date_Span')) {
            return;
        }

        $this->second += $span->second;
        if ($this->second >= 60) {
            $this->minute++;
            $this->second -= 60;
        }

        $this->minute += $span->minute;
        if ($this->minute >= 60) {
            $this->hour++;
            if ($this->hour >= 24) {
                list($this->year, $this->month, $this->day) =
                    sscanf(Date_Calc::nextDay($this->day, $this->month, $this->year), "%04s%02s%02s");
                $this->hour -= 24;
            }
            $this->minute -= 60;
        }

        $this->hour += $span->hour;
        if ($this->hour >= 24) {
            list($this->year, $this->month, $this->day) =
                sscanf(Date_Calc::nextDay($this->day, $this->month, $this->year), "%04s%02s%02s");
            $this->hour -= 24;
        }

        $d = Date_Calc::dateToDays($this->day, $this->month, $this->year);
        $d += $span->day;

        list($this->year, $this->month, $this->day) =
            sscanf(Date_Calc::daysToDate($d), "%04s%02s%02s");
        $this->year  = intval($this->year);
        $this->month = intval($this->month);
        $this->day   = intval($this->day);
    }


    // }}}
    // {{{ subtractSpan()

    /**
     * Subtracts a time span to the date
     *
     * @param object Date_Span $span the time span to subtract
     *
     * @return   void
     * @access   public
     */
    function subtractSpan($span)
    {
        if (!is_a($span, 'Date_Span')) {
            return;
        }
        if ($span->isEmpty()) {
            return;
        }

        $this->second -= $span->second;
        if ($this->second < 0) {
            $this->minute--;
            $this->second += 60;
        }

        $this->minute -= $span->minute;
        if ($this->minute < 0) {
            $this->hour--;
            if ($this->hour < 0) {
                list($this->year, $this->month, $this->day) =
                    sscanf(Date_Calc::prevDay($this->day, $this->month, $this->year), "%04s%02s%02s");
                $this->hour += 24;
            }
            $this->minute += 60;
        }

        $this->hour -= $span->hour;
        if ($this->hour < 0) {
            list($this->year, $this->month, $this->day) =
                sscanf(Date_Calc::prevDay($this->day, $this->month, $this->year), "%04s%02s%02s");
            $this->hour += 24;
        }

        $d = Date_Calc::dateToDays($this->day, $this->month, $this->year);
        $d -= $span->day;

        list($this->year, $this->month, $this->day) =
            sscanf(Date_Calc::daysToDate($d), "%04s%02s%02s");
        $this->year  = intval($this->year);
        $this->month = intval($this->month);
        $this->day   = intval($this->day);
    }

    // }}}
    // {{{ addSeconds()

    /**
     * Adds a given number of seconds to the date
     *
     * @access public
     * @param int $sec the number of seconds to add
     */
    function addSeconds($sec)
    {
        settype($sec, 'int');

        // Negative value given.
        if ($sec < 0) {
            $this->subtractSeconds(abs($sec));
            return;
        }

        $this->addSpan(new Date_Span($sec));
    }

    // }}}
    // {{{ subtractSeconds()

    /**
     * Subtracts a given number of seconds from the date
     *
     * @access public
     * @param int $sec the number of seconds to subtract
     */
    function subtractSeconds($sec)
    {
        settype($sec, 'int');

        // Negative value given.
        if ($sec < 0) {
            $this->addSeconds(abs($sec));
            return;
        }

        $this->subtractSpan(new Date_Span($sec));
    }

    // }}}
    // {{{ compare()

    /**
     * Compares two dates
     *
     * Compares two dates.  Suitable for use
     * in sorting functions.
     *
     * @access public
     * @param object Date $d1 the first date
     * @param object Date $d2 the second date
     * @return int 0 if the dates are equal, -1 if d1 is before d2, 1 if d1 is after d2
     */
    function compare($od1, $od2)
    {
        $d1 = new Date($od1);
        $d2 = new Date($od2);

        $d1->convertTZ(new Date_TimeZone('UTC'));
        $d2->convertTZ(new Date_TimeZone('UTC'));
        $days1 = Date_Calc::dateToDays($d1->day, $d1->month, $d1->year);
        $days2 = Date_Calc::dateToDays($d2->day, $d2->month, $d2->year);
        if ($days1 < $days2) return -1;
        if ($days1 > $days2) return 1;
        if ($d1->hour < $d2->hour) return -1;
        if ($d1->hour > $d2->hour) return 1;
        if ($d1->minute < $d2->minute) return -1;
        if ($d1->minute > $d2->minute) return 1;
        if ($d1->second < $d2->second) return -1;
        if ($d1->second > $d2->second) return 1;
        return 0;
    }

    // }}}
    // {{{ before()

    /**
     * Test if this date/time is before a certain date/time
     *
     * Test if this date/time is before a certain date/time
     *
     * @access public
     * @param object Date $when the date to test against
     * @return boolean true if this date is before $when
     */
    function before($when)
    {
        if (Date::compare($this,$when) == -1) {
            return true;
        } else {
            return false;
        }
    }

    // }}}
    // {{{ after()

    /**
     * Test if this date/time is after a certian date/time
     *
     * Test if this date/time is after a certian date/time
     *
     * @access public
     * @param object Date $when the date to test against
     * @return boolean true if this date is after $when
     */
    function after($when)
    {
        if (Date::compare($this,$when) == 1) {
            return true;
        } else {
            return false;
        }
    }

    // }}}
    // {{{ equals()

    /**
     * Test if this date/time is exactly equal to a certian date/time
     *
     * Test if this date/time is exactly equal to a certian date/time
     *
     * @access public
     * @param object Date $when the date to test against
     * @return boolean true if this date is exactly equal to $when
     */
    function equals($when)
    {
        if (Date::compare($this,$when) == 0) {
            return true;
        } else {
            return false;
        }
    }

    // }}}
    // {{{ isFuture()

    /**
     * Determine if this date is in the future
     *
     * Determine if this date is in the future
     *
     * @access public
     * @return boolean true if this date is in the future
     */
    function isFuture()
    {
        $now = new Date();
        if ($this->after($now)) {
            return true;
        } else {
            return false;
        }
    }

    // }}}
    // {{{ isPast()

    /**
     * Determine if this date is in the past
     *
     * Determine if this date is in the past
     *
     * @access public
     * @return boolean true if this date is in the past
     */
    function isPast()
    {
        $now = new Date();
        if ($this->before($now)) {
            return true;
        } else {
            return false;
        }
    }

    // }}}
    // {{{ isLeapYear()

    /**
     * Determine if the year in this date is a leap year
     *
     * Determine if the year in this date is a leap year
     *
     * @access public
     * @return boolean true if this year is a leap year
     */
    function isLeapYear()
    {
        return Date_Calc::isLeapYear($this->year);
    }


    // }}}
    // {{{ getJulianDate()

    /**
     * Get the Julian date for this date
     *
     * @access public
     * @return int the Julian date
     */
    function getJulianDate()
    {
        return Date_Calc::julianDate($this->day, $this->month, $this->year);
    }


    // }}}
    // {{{ getDayOfYear()

    /**
     * Returns the no of days (1-366) since 31st December of the previous year
     *
     * @return   int        an integer between 1 and 366
     * @access   public
     */
    function getDayOfYear()
    {
        return Date_Calc::dayOfYear($this->day, $this->month, $this->year);
    }


    // }}}
    // {{{ getDayOfWeek()

    /**
     * Gets the day of the week for this date
     *
     * Gets the day of the week for this date (0=Sunday)
     *
     * @access public
     * @return int the day of the week (0=Sunday)
     */
    function getDayOfWeek()
    {
        return Date_Calc::dayOfWeek($this->day, $this->month, $this->year);
    }

    // }}}
    // {{{ getWeekOfYear()

    /**
     * Gets the week of the year for this date
     *
     * Gets the week of the year for this date
     *
     * @access public
     * @return int the week of the year
     */
    function getWeekOfYear()
    {
        return Date_Calc::weekOfYear($this->day, $this->month, $this->year);
    }

    // }}}
    // {{{ getQuarterOfYear()

    /**
     * Gets the quarter of the year for this date
     *
     * Gets the quarter of the year for this date
     *
     * @access public
     * @return int the quarter of the year (1-4)
     */
    function getQuarterOfYear()
    {
        return Date_Calc::quarterOfYear($this->day, $this->month, $this->year);
    }

    // }}}
    // {{{ getDaysInMonth()

    /**
     * Gets number of days in the month for this date
     *
     * Gets number of days in the month for this date
     *
     * @access public
     * @return int number of days in this month
     */
    function getDaysInMonth()
    {
        return Date_Calc::daysInMonth($this->month, $this->year);
    }

    // }}}
    // {{{ getWeeksInMonth()

    /**
     * Gets the number of weeks in the month for this date
     *
     * Gets the number of weeks in the month for this date
     *
     * @access public
     * @return int number of weeks in this month
     */
    function getWeeksInMonth()
    {
        return Date_Calc::weeksInMonth($this->month, $this->year);
    }

    // }}}
    // {{{ getDayName()

    /**
     * Gets the full name or abbriviated name of this weekday
     *
     * Gets the full name or abbriviated name of this weekday
     *
     * @access public
     * @param boolean $abbr abbrivate the name
     * @return string name of this day
     */
    function getDayName($abbr = false, $length = 3)
    {
        if ($abbr) {
            return Date_Calc::getWeekdayAbbrname($this->day, $this->month, $this->year, $length);
        } else {
            return Date_Calc::getWeekdayFullname($this->day, $this->month, $this->year);
        }
    }

    // }}}
    // {{{ getMonthName()

    /**
     * Gets the full name or abbriviated name of this month
     *
     * Gets the full name or abbriviated name of this month
     *
     * @access public
     * @param boolean $abbr abbrivate the name
     * @return string name of this month
     */
    function getMonthName($abbr = false)
    {
        if ($abbr) {
            return Date_Calc::getMonthAbbrname($this->month);
        } else {
            return Date_Calc::getMonthFullname($this->month);
        }
    }

    // }}}
    // {{{ getNextDay()

    /**
     * Get a Date object for the day after this one
     *
     * Get a Date object for the day after this one.
     * The time of the returned Date object is the same as this time.
     *
     * @access public
     * @return object Date Date representing the next day
     */
    function getNextDay()
    {
        $day = Date_Calc::nextDay($this->day, $this->month, $this->year, "%Y-%m-%d");
        $date = sprintf("%s %02d:%02d:%02d", $day, $this->hour, $this->minute, $this->second);
        $newDate = new Date();
        $newDate->setDate($date);
        return $newDate;
    }

    // }}}
    // {{{ getPrevDay()

    /**
     * Get a Date object for the day before this one
     *
     * Get a Date object for the day before this one.
     * The time of the returned Date object is the same as this time.
     *
     * @access public
     * @return object Date Date representing the previous day
     */
    function getPrevDay()
    {
        $day = Date_Calc::prevDay($this->day, $this->month, $this->year, "%Y-%m-%d");
        $date = sprintf("%s %02d:%02d:%02d", $day, $this->hour, $this->minute, $this->second);
        $newDate = new Date();
        $newDate->setDate($date);
        return $newDate;
    }

    // }}}
    // {{{ getNextWeekday()

    /**
     * Get a Date object for the weekday after this one
     *
     * Get a Date object for the weekday after this one.
     * The time of the returned Date object is the same as this time.
     *
     * @access public
     * @return object Date Date representing the next weekday
     */
    function getNextWeekday()
    {
        $day = Date_Calc::nextWeekday($this->day, $this->month, $this->year, "%Y-%m-%d");
        $date = sprintf("%s %02d:%02d:%02d", $day, $this->hour, $this->minute, $this->second);
        $newDate = new Date();
        $newDate->setDate($date);
        return $newDate;
    }

    // }}}
    // {{{ getPrevWeekday()

    /**
     * Get a Date object for the weekday before this one
     *
     * Get a Date object for the weekday before this one.
     * The time of the returned Date object is the same as this time.
     *
     * @access public
     * @return object Date Date representing the previous weekday
     */
    function getPrevWeekday()
    {
        $day = Date_Calc::prevWeekday($this->day, $this->month, $this->year, "%Y-%m-%d");
        $date = sprintf("%s %02d:%02d:%02d", $day, $this->hour, $this->minute, $this->second);
        $newDate = new Date();
        $newDate->setDate($date);
        return $newDate;
    }


    // }}}
    // {{{ getYear()

    /**
     * Returns the year field of the date object
     *
     * Returns the year field of the date object
     *
     * @access public
     * @return int the year
     */
    function getYear()
    {
        return $this->year;
    }


    // }}}
    // {{{ getMonth()

    /**
     * Returns the month field of the date object
     *
     * Returns the month field of the date object
     *
     * @access public
     * @return int the month
     */
    function getMonth()
    {
        return $this->month;
    }


    // }}}
    // {{{ getDay()

    /**
     * Returns the day field of the date object
     *
     * Returns the day field of the date object
     *
     * @access public
     * @return int the day
     */
    function getDay()
    {
        return $this->day;
    }


    // }}}
    // {{{ getHour()

    /**
     * Returns the hour field of the date object
     *
     * Returns the hour field of the date object
     *
     * @access public
     * @return int the hour
     */
    function getHour()
    {
        return $this->hour;
    }


    // }}}
    // {{{ getMinute()

    /**
     * Returns the minute field of the date object
     *
     * Returns the minute field of the date object
     *
     * @access public
     * @return int the minute
     */
    function getMinute()
    {
        return $this->minute;
    }


    // }}}
    // {{{ getSecond()

    /**
     * Returns the second field of the date object
     *
     * Returns the second field of the date object
     *
     * @access public
     * @return int the second
     */
    function getSecond()
    {
         return $this->second;
    }


    // }}}
    // {{{ getSecondsPastMidnight()

    /**
     * Returns the no of seconds since midnight (0-86400) as float
     *
     * @return   float      float which is at least 0 and less than 86400
     * @access   public
     */
    function getSecondsPastMidnight()
    {
         return Date_Calc::secondsPastMidnight($this->hour, $this->minute, $this->second) + $this->partsecond;
    }


    // }}}
    // {{{ getPartSecond()

    /**
     * Returns the part-second field of the date object
     *
     * @return   int        the part-second
     * @access   public
     */
    function getPartSecond()
    {
        return $this->partsecond;
    }


    // }}}
    // {{{ setYear()

    /**
     * Sets the year field of the date object
     *
     * If specified year forms an invalid date, then PEAR error will be
     * returned, unless the validation is over-ridden using the second
     * parameter.
     *
     * @param    int        $y                            the year
     * @param    bool       $pb_validate                  whether to check that the new date is valid
     *
     * @return   void
     * @access   public
     */
    function setYear($y, $pb_validate = true)
    {
        if ($pb_validate && !Date_Calc::isValidDate($this->day, $this->month, $y)) {
            return PEAR::raiseError("'" . Date_Calc::dateFormat($this->day, $this->month, $y, "%Y-%m-%d") . "' is invalid calendar date");
        } else {
            $this->year = (int) $y;
        }
    }


    // }}}
    // {{{ setMonth()

    /**
     * Sets the month field of the date object
     *
     * If specified year forms an invalid date, then PEAR error will be
     * returned, unless the validation is over-ridden using the second
     * parameter.
     *
     * @param    int        $m                            the month
     * @param    bool       $pb_validate                  whether to check that the new date is valid
     *
     * @return   void
     * @access   public
     */
    function setMonth($m, $pb_validate = true)
    {
        if ($pb_validate && !Date_Calc::isValidDate($this->day, $m, $this->year)) {
            return PEAR::raiseError("'" . Date_Calc::dateFormat($this->day, $m, $this->year, "%Y-%m-%d") . "' is invalid calendar date");
        } else {
            $this->month = (int) $m;
        }
    }


    // }}}
    // {{{ setDay()

    /**
     * Sets the day field of the date object
     *
     * If specified year forms an invalid date, then PEAR error will be
     * returned, unless the validation is over-ridden using the second
     * parameter.
     *
     * @param    int        $d                            the day
     * @param    bool       $pb_validate                  whether to check that the new date is valid
     *
     * @return   void
     * @access   public
     */
    function setDay($d, $pb_validate = true)
    {
        if ($pb_validate && !Date_Calc::isValidDate($d, $this->month, $this->year)) {
            return PEAR::raiseError("'" . Date_Calc::dateFormat($d, $this->month, $this->year, "%Y-%m-%d") . "' is invalid calendar date");
        } else {
            $this->day = (int) $d;
        }
    }


    // }}}
    // {{{ setDayMonthYear()

    /**
     * Sets the day, month and year fields of the date object
     *
     * If specified year forms an invalid date, then PEAR error will be
     * returned, unless the validation is over-ridden using the second
     * parameter.  Note that setting each of these fields separately
     * may unintentionally return a PEAR error if a transitory date is
     * invalid between setting these fields.
     *
     * @param    int        $d                            the day
     * @param    int        $m                            the month
     * @param    int        $y                            the year
     * @param    bool       $pb_validate                  whether to check that the new date is valid
     *
     * @return   void
     * @access   public
     */
    function setDayMonthYear($d, $m, $y, $pb_validate = true)
    {
        if ($pb_validate && !Date_Calc::isValidDate($d, $m, $y)) {
            return PEAR::raiseError("'" . Date_Calc::dateFormat($d, $m, $y, "%Y-%m-%d") . "' is invalid calendar date");
        } else {
            $this->day = (int) $d;
            $this->month = (int) $m;
            $this->year = (int) $y;
        }
    }


    // }}}
    // {{{ setHour()

    /**
     * Sets the hour field of the date object
     *
     * Sets the hour field of the date object in 24-hour format.
     * Invalid hours (not 0-23) are set to 0.
     *
     * @param int $h the hour
     * @return   void
     * @access   public
     */
    function setHour($h)
    {
        if ($h > 23 || $h < 0) {
            $this->hour = 0;
        } else {
            $this->hour = (int) $h;
        }
    }


    // }}}
    // {{{ setMinute()

    /**
     * Sets the minute field of the date object
     *
     * Sets the minute field of the date object, invalid minutes (not 0-59) are set to 0.
     *
     * @param int $m the minute
     * @return   void
     * @access   public
     */
    function setMinute($m)
    {
        if ($m > 59 || $m < 0) {
            $this->minute = 0;
        } else {
            $this->minute = (int) $m;
        }
    }


    // }}}
    // {{{ setSecond()

    /**
     * Sets the second field of the date object
     *
     * Sets the second field of the date object, invalid seconds (not 0-59) are set to 0.
     *
     * @param int $s the second
     * @return   void
     * @access   public
     */
    function setSecond($s) {
        if ($s > 59 || $s < 0) {
            $this->second = 0;
        } else {
            $this->second = (int) $s;
        }
    }


    // }}}
    // {{{ setPartSecond()

    /**
     * Sets the part-second field of the date object
     *
     * Invalid part-seconds (not < 1) are set to 0.
     *
     * @param    int        $pn_ps                        the part-second
     *
     * @return   void
     * @access   public
     */
    function setPartSecond($pn_ps)
    {
        if ($pn_ps >= 1 || $pn_ps < 0) {
            $this->partsecond = (float) 0;
        } else {
            $this->partsecond = (float) $pn_ps;
        }
    }


    // }}}
}

// }}}

/*
 * Local variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */
?>