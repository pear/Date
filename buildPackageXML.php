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
    'pathtopackagefile' => basename(__FILE__),
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
which is a huge limitation for php programs.  Includes time zone data,
time zone conversions and many date/time conversions.
It does not rely on 32-bit system date stamps, so
you can display calendars and compare dates that date
pre 1970 and post 2038. This package also provides a class
to convert date strings between Gregorian and Human calendar formats.

EOT;

$notes = <<<EOT
* Fix bug #8912: putenv() causes crashes in DateTimeZone::inDaylightTime() under windows
* Fix bug #9409: Date_Calc, fatal error using a non-array variable as an array
* Fix bug #9414: Date::addSeconds() fails to work properly with negative numbers
* Many cosmetics update
* Moved bug test files to tests/bugs/
* Removed unused files
EOT;

$summary = <<<EOT
Generic date/time handling class for PEAR
EOT;

// Some hard-coded stuffs.
$pkg->setPackage('Date');
$pkg->setSummary($summary);
$pkg->setDescription($desc);
$pkg->setChannel('pear.php.net');
$pkg->setAPIVersion('1.4');
$pkg->setReleaseVersion('1.4.7');
$pkg->setReleaseStability('stable');
$pkg->setAPIStability('stable');
$pkg->setNotes($notes);
$pkg->setPackageType('php');
$pkg->setLicense('BSD License', 'http://www.opensource.org/licenses/bsd-license.php');

// Add maintainers.
$pkg->addMaintainer('lead', 'baba', 'Baba Buehler', 'baba@babaz.com', 'no');
$pkg->addMaintainer('lead', 'pajoye', 'Pierre-Alain Joye', 'pajoye@php.net', 'no');
$pkg->addMaintainer('lead', 'mohrt', 'Monte Ohrt', 'mohrt@php.net', 'no');
$pkg->addMaintainer('lead', 'firman', 'Firman Wandayandi', 'firman@php.net');
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
    throw new Exception('Unable to write package file. Got message: ' . $e->getMessage());
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