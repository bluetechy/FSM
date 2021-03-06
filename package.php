<?php

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$desc = <<<EOT
The FSM package provides a simple class that implements a Finite State Machine.

In addition to maintaining state, this FSM also maintains a user-defined payload, therefore effectively making the machine a Pushdown Automaton (a finite state machine with memory).
EOT;

$version = '1.3.1';
$notes = <<<EOT
Added FSM::getCurrentState(), for returning the machine's current state.
EOT;

$package = new PEAR_PackageFileManager2();

$result = $package->setOptions(array(
    'filelistgenerator' => 'svn',
    'changelogoldtonew' => false,
    'simpleoutput'		=> true,
    'baseinstalldir'    => '/',
    'packagefile'       => 'package.xml',
    'packagedirectory'  => '.'));

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}

$package->setPackage('FSM');
$package->setPackageType('php');
$package->setSummary('Finite State Machine');
$package->setDescription($desc);
$package->setChannel('pear.php.net');
$package->setLicense('MIT License', 'http://www.opensource.org/licenses/mit-license.php');
$package->setAPIVersion('1.0.0');
$package->setAPIStability('stable');
$package->setReleaseVersion($version);
$package->setReleaseStability('stable');
$package->setNotes($notes);
$package->setPhpDep('4.0.4');
$package->setPearinstallerDep('1.4.3');
$package->addMaintainer('lead',  'jon', 'Jon Parise', 'jon@php.net');
$package->addIgnore(array('.gitignore', 'README.rst', 'package.php', 'phpdoc.sh', 'package.xml'));
$package->addPackageDepWithChannel('optional', 'Image_GraphViz', 'pear.php.net');

$package->generateContents();

if ($_SERVER['argv'][1] == 'commit') {
    $result = $package->writePackageFile();
} else {
    $result = $package->debugPackageFile();
}

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}
