<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker */
// $Id$

require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/Cvs.php';

$pkg = new PEAR_PackageFileManager2;

$options = array(
    'simpleoutput'      => true,
    'baseinstalldir'    => '/',
    'packagedirectory'  => dirname(__FILE__),
    'filelistgenerator' => 'Cvs',
    'dir_roles'         => array(
        'tests'         => 'test',
        'docs'          => 'doc',
        'data'          => 'data'
    ),
    'ignore'            => array(
        'package.xml',
        'package2.xml',
        '*.tgz',
        basename(__FILE__)
    )
);

$pkg->setOptions($options);

$desc = <<<EOT
Generic classes for representation and manipulation of
dates, times and time zones without the need of timestamps,
which is a huge limitation for PHP programs.  Includes time zone data,
time zone conversions and many date/time conversions.
It does not rely on 32-bit system date stamps, so
you can display calendars and compare dates that date
pre 1970 and post 2038.

EOT;

$notes = <<<EOT
* Fixed bug #2378: getDate(DATE_FORMAT_UNIXTIME) doesn't convert to GMT
* Fixed bug #7439: US/Indiana Daylight Savings Change
* Implemented request #9700: Incorrect timestamps allowd
* Fixed bug #10349: Wrong offset in timezones
* Fixed bug #10591: inDaylightTime fails
* Implemented request #11090: microtime is not set by default constructor
* Fixed bug #11313: DST time change not handled correctly
* Fixed bug #11475: Date::copy don't copy milisecond part
* Fixed bug #11682: Australia/Perth has DST
* Fixed bug #11708: getWeekdayAbbrname returns wrong lenght if string is unicode
* Fixed bug #12019: Date->after(...) changes the date
* Fixed bug #12420: Date constructor handles iso 8601 timezone offests of zero incorrectly
* Fixed bug #12529: setTZ globally sets your TZ instead of only within date object
* Fixed bug #13376: setFromDateDiff change source dates

* Improved time-zone functionality so that it is entirely handled by the class and not reliant on native functions
* Added leap-second functionality
* Added functions 'Date::round()' and 'Date::trunc()'
* Added formatting function 'Date::format2()' that uses a 'YYYY-MM-DD'-style formatting code
* Added formatting function 'Date::format3()' to allow date-formatting using the formatting code of 'date()'
EOT;

$summary = <<<EOT
Generic date/time handling class for PEAR
EOT;

// Some hard-coded stuffs.
$pkg->setPackage('Date');
$pkg->setSummary($summary);
$pkg->setDescription($desc);
$pkg->setChannel('pear.php.net');
$pkg->setAPIVersion('1.5.0');
$pkg->setReleaseVersion('1.5.0a1');
$pkg->setReleaseStability('alpha');
$pkg->setAPIStability('alpha');
$pkg->setNotes($notes);
$pkg->setPackageType('php');
$pkg->setLicense('BSD License',
    'http://www.opensource.org/licenses/bsd-license.php');

// Add maintainers.
$pkg->addMaintainer('lead', 'baba', 'Baba Buehler', 'baba@babaz.com', 'no');
$pkg->addMaintainer('lead', 'pajoye', 'Pierre-Alain Joye', 'pajoye@php.net', 'no');
$pkg->addMaintainer('lead', 'mohrt', 'Monte Ohrt', 'mohrt@php.net', 'no');
$pkg->addMaintainer('lead', 'firman', 'Firman Wandayandi', 'firman@php.net');
$pkg->addMaintainer('lead', 'c01234', 'C.A. Woodcock', 'c01234@netcomuk.co.uk');
$pkg->addMaintainer('developer', 'alan_k', 'Alan Knowles', 'alan@akbkhome.com');
$pkg->addMaintainer('helper', 'scar', 'Leonardo Dutra', 'scar@php.net');

// Core dependencies.
$pkg->setPhpDep('4.3');
$pkg->setPearinstallerDep('1.4.0');

// Add some replacements.
$pkg->addGlobalReplacement('package-info', '@package_version@', 'version');

// Generate file contents.
$pkg->generateContents();

// Writes a package.xml.
$e = $pkg->writePackageFile();

// Some errors occurs.
if (PEAR::isError($e)) {
    throw new Exception('Unable to write package file. Got message: ' .
                        $e->getMessage());
}

/*
 * Local variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */
?>