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

function submitDefUserInfo() {

	frm = document.frmInstall;
	if(frm.OHRMAdminUserName.value.length < 5) {
		alert('TeconHRM Admin User-name should be at least 5 char. long!');
		frm.OHRMAdminUserName.focus();
		return;
	}

	if(frm.OHRMAdminPassword.value == '') {
		alert('OrangeHRM Admin Password left Empty!');
		frm.OHRMAdminPassword.focus();
		return;
	}

	if(frm.OHRMAdminPassword.value != frm.OHRMAdminPasswordConfirm.value) {
		alert('TeconHRM Admin Password and Confirm TeconHRM Admin Password don\'t match!');
		frm.OHRMAdminPassword.focus();
		return;
	}

document.frmInstall.actionResponse.value  = 'DEFUSERINFO';
document.frmInstall.submit();
}
</script>
<link href="style.css" rel="stylesheet" type="text/css" />


<div id="content">
	<h2>Step 4: Admin User Creation</h2>

        <p>After TeconHRM is configured you will need an Administrator Account to Login into TeconHRM. <br />
        Please fill in the Username and User Password for the Administrator login. </p>

        <table cellpadding="0" cellspacing="0" border="0" class="table">
<tr><th colspan="3" align="left">Admin User Creation</th></tr>
<tr>
	<td class="tdComponent_n">TeconHRM Admin Username</td>
	<td class="tdValues_n"><input type="text" name="OHRMAdminUserName" value="Admin" tabindex="1"/></td>
</tr>
<tr>
	<td class="tdComponent_n">TeconHRM Admin User Password</td>
	<td class="tdValues_n"><input type="password" name="OHRMAdminPassword" value="" tabindex="2"/></td>
</tr>
<tr>
	<td class="tdComponent_n">Confirm TeconHRM Admin User Password</td>
	<td class="tdValues_n"><input type="password" name="OHRMAdminPasswordConfirm" value="" tabindex="3"/></td>
</tr>

</table><br />
<input class="button" type="button" value="Back" onclick="back();" tabindex="5"/>
<input type="button" value="Next" onclick="submitDefUserInfo()" tabindex="4"/>
</div>