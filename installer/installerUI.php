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
include_once('../lib/confs/log_settings.php');

session_start();

$cupath = realpath(dirname(__FILE__).'/../');

define('ROOT_PATH', $cupath);


if(isset($_SESSION['CONFDONE'])) {
	$currScreen = 7;
} elseif(isset($_SESSION['INSTALLING'])) {
	$currScreen = 6;
} elseif(isset($_SESSION['DEFUSER'])) {
	$currScreen = 5;
} elseif(isset($_SESSION['SYSCHECK'])) {
	$currScreen = 4;
} elseif(isset($_SESSION['DBCONFIG'])) {
	$currScreen = 3;
} elseif(isset($_SESSION['LICENSE'])) {
	$currScreen = 2;
} elseif(isset($_SESSION['WELCOME'])) {
	$currScreen = 1;
} else $currScreen = 0;

if (isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
}

if (isset($_SESSION['reqAccept'])) {
	$reqAccept = $_SESSION['reqAccept'];
}

$steps = array('welcome', 'license', 'database configuration', 'system check', 'admin user creation', 'confirmation', 'Installing', 'registration');

$helpLink = array("#welcome", "#license", "#DBCreation", "#systemChk", "#adminUsrCrt", "#confirm", "#installing", "#registration");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>TeconHRM Web Installation Wizard</title>
<link href="favicon.ico" rel="icon" type="image/gif"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript">

function goToScreen(screenNo) {
	document.frmInstall.txtScreen.value = screenNo;
}

function cancel() {
	document.frmInstall.actionResponse.value  = 'CANCEL';
	document.frmInstall.submit();
}

function back() {
	document.frmInstall.actionResponse.value  = 'BACK';
	document.frmInstall.submit();
}

</script>
<link href="./style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="body">
  <a href="http://www.teconhrm.com"><img src="../symfony/web/themes/default/images/logo.png" alt="TeconHRM" name="logo"  width="283" height="56" border="0" id="logo" style="margin-left: 10px;margin-bottom: 15px;" title="TeconHRM"></a>
<form name="frmInstall" action="../install.php" method="POST">
<input type="hidden" name="txtScreen" value="<?php echo $currScreen?>">
<input type="hidden" name="actionResponse">

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
<?php
	$tocome = '';
	for ($i=0; $i < count($steps); $i++) {
		if ($currScreen == $i) {
			$tabState = 'Active';
		} else {
			$tabState = 'Inactive';
		}
?>

    <td nowrap="nowrap" class="left_<?php echo $tabState?>">&nbsp;</td>
    <td nowrap="nowrap" class="middle_<?php echo $tabState.$tocome?>"><?php echo $steps[$i]?></td>
	<td nowrap="nowrap" class="right_<?php echo $tabState?>">&nbsp;</td>

    <?php
		if ($tabState == 'Active') {
			$tocome = '_tocome';
		}
	}
	?>
  </tr>
</table>
<a href="./guide/<?php echo $helpLink[$currScreen]?>" id="help" target="_blank">[Help ?]</a>
<?php

switch ($currScreen) {

	default :
	case 0 	: 	require(ROOT_PATH . '/installer/welcome.php'); break;
	case 1 	: 	require(ROOT_PATH . '/installer/license.php'); break;
	case 2 	: 	require(ROOT_PATH . '/installer/dbConfig.php'); break;
	case 3 	: 	require(ROOT_PATH . '/installer/checkSystem.php'); break;
	case 4 	: 	require(ROOT_PATH . '/installer/defaultUser.php'); break;
	case 5 	: 	require(ROOT_PATH . '/installer/confirmation.php'); break;
	case 6 	: 	require(ROOT_PATH . '/installer/progress.php'); break;
	case 7 	: 	require(ROOT_PATH . '/installer/registration.php'); break;
}
?>

</form>
<div id="footer"><?php include_once(ROOT_PATH . "/symfony/apps/orangehrm/templates/_copyright.php");?></div>  
</div>
</body>
</html>
