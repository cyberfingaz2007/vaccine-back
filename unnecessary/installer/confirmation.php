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
?>
<script language="JavaScript">
function confirm() {
	document.frmInstall.actionResponse.value  = 'CONFIRMED';
	document.frmInstall.submit();
}
</script>
<link href="style.css" rel="stylesheet" type="text/css" />


  <div id="content">
	<h2>Step 5: Confirmation</h2>

        <p>All information required for TeconHRM installation collected in the earlier
         steps are given below. On confirmation the installer will create the database,
         database users, configuration file, etc.<br />
		 Click <b>[Install]</b> to continue.
		 </p>

         <p><font color="Red"><?php echo isset($error) ? $error : ''?></font></p>

        <table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr>
			<th colspan="3" align="left" class="th">Details</th>
		</tr>
		<tr>
			<td class="tdComponent">Host Name</td>
			<td class="tdValues"><?php echo $_SESSION['dbInfo']['dbHostName']?></td>
		</tr>
		<tr>
			<td class="tdComponent">Database Host Port</td>
			<td class="tdValues"><?php echo $_SESSION['dbInfo']['dbHostPort']?></td>
		</tr>
		<tr>
			<td class="tdComponent">Database Name</td>
			<td class="tdValues"><?php echo $_SESSION['dbInfo']['dbName']?></td>
		</tr>
<?php if($_SESSION['dbCreateMethod'] == 'new') { ?>		
		<tr>
			<td class="tdComponent">Privileged Database User-name</td>
			<td class="tdValues"><?php echo $_SESSION['dbInfo']['dbUserName']?></td>
		</tr>
<?php } ?>
<?php if(isset($_SESSION['dbInfo']['dbOHRMUserName'])) { ?>
		<tr>
			<td class="tdComponent">TeconHRM Database User-name</td>
			<td class="tdValues"><?php echo $_SESSION['dbInfo']['dbOHRMUserName']?></td>
		</tr>
<?php } ?>
		<tr>
			<td class="tdComponent">TeconHRM Admin User Name</td>
			<td class="tdValues"><?php echo $_SESSION['defUser']['AdminUserName']?></td>
		</tr>
<?php if ($_SESSION['ENCRYPTION'] == "Active") {  ?>
		<tr>
			<td class="tdComponent">Data Encryption</td>
			<td class="tdValues">Data Encryption is on. Employee Social Security Number and Employee Basic Salary would be encrypted.
			<br>Please backup encryption key located at lib/confs/cryptokeys/</td>
		</tr>
<?php } elseif ($_SESSION['ENCRYPTION'] == "Failed") { ?>
		<tr>
			<td class="tdComponent">Data Encryption</td>
			<td class="tdValues">Data Encryption configuration failed. Data Encryption would not be enabled.</td>
		</tr>
<?php } ?>
</table>
		<br />
		<input class="button" type="button" value="Back" onclick="back();" tabindex="3"/>
		<input class="button" type="button" value="Cancel Install" onclick="cancel();" tabindex="2"/>
        <input class="button" type="button" value="Install" onclick="confirm();" tabindex="1"/>
  </div>
