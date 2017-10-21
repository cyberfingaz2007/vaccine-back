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
function welcomeSubmit() {
	document.frmInstall.actionResponse.value  = 'WELCOMEOK';
	document.frmInstall.submit();
}
</script>
	<div id="content">
		<h2>Welcome to the TeconHRM ver 1.0.1 Setup Wizard</h2>


		<p>This installer creates the TeconHRM database tables and sets the
        configuration files that you need to start.</p>
                <p>
                    If you already use TeconHRM, consider <a href="../upgrader/web/index.php/">upgrading</a>.
                </p>              
                
        <p>
		Click <b>[Next]</b> to Start the Wizard.</p>
        <input class="button" type="button" value="Back" onclick="back();" disabled="disabled">
		<input type="button" name="next" value="Next" onclick="welcomeSubmit();" id="next" tabindex="1">
     </div>
		<h4 id="welcomeLink"><a href="http://www.teconhrm.com" target="_blank" tabindex="36">TeconHRM.com</a></h4>

