<?php

/**
 * TeconHRM is a customized and comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * http://www.Teconnghrm.com
 *
 * TeconHRM is not free software and is provided to the client TECON Oil Services LTD under
 * for the company use only. The solution shall not be redistributed, copied or manipulated
 * in any form, unless expressly permitted by the solution provider DEOSENTIOS LTD.
 * The solution remains the project of the so named provider, but provided under certain terms to
 * the user.
 *
 *
 * TeconHRM is distributed in the hope that it will be useful, but with 3 months warranty period after
 * which scheduled maintenance would be carried out by the solution provider.
 *
 */

/* For logging PHP errors */

//die();

//include_once('lib/confs/log_settings.php');

$installed = true;

define('ROOT_PATH', dirname(__FILE__));
/*
if (!is_file(ROOT_PATH . '/lib/confs/Conf.php')) {
    $installed = false;
}

if (!$installed) {
    header('Location: ./install.php');
    exit();
}
*/
header("Location: ./cloud/web/app_dev.php");
exit();
