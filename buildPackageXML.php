<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker */
// $Id$

require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/Git.php';

$pkg = new PEAR_PackageFileManager2;

$options = array(
    'simpleoutput'      => true,
    'baseinstalldir'    => '/',
    'packagefile'       => 'package.xml',
    'packagedirectory'  => dirname(__FILE__),
    'filelistgenerator' => 'Git',
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
QA release.
Users are strongly encouraged to adopt to inbuilt DateTime functionality.

Bug #17730 Patch: Avoid ereg, using preg_match
Doc Bug #15029 large Date_Span's cannot be created
Bug #14929 Timezone summertime
Bug #14856 America/Moncton longname and dstlongname missing
Bug #14084 TZ variable being set wrecks global config
Bug #13615 America/Toronto time-zone is missing longname and dstlongname
Bug #13545 Date_Span::set() doesn't work when passed an int and format
Req #13488 Please rename Methods format2 and format3
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
$pkg->setReleaseVersion('1.5.0a2');
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

//$pkg->addDependency("Numbers_Words", "0.15.0", "eq", "pkg", true);
//$pkg->detectDependencies();

// Add some replacements.
$pkg->addGlobalReplacement('package-info', '@package_version@', 'version');

// Generate file contents.
$pkg->generateContents();

// Writes a package.xml.
if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $e = $pkg->writePackageFile();

    // Some errors occurs.
    if (PEAR::isError($e)) {
        throw new Exception('Unable to write package file. Got message: ' .
                            $e->getMessage());
    }
} else {
    $pkg->debugPackageFile();
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
