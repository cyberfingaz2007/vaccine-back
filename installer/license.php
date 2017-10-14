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


$license_file_name = ROOT_PATH . "/license/LICENSE.TXT";
$fh = fopen( $license_file_name, 'r' ) or die( "License file not found!" );
$license_file = fread( $fh, filesize( $license_file_name ) );
fclose( $fh );
?>
<script language="JavaScript">
function licenseAccept() {
	document.frmInstall.actionResponse.value  = 'LICENSEOK';
	document.frmInstall.submit();
}
</script>

	<div id="content">

  		<h2>Step 1: License Acceptance</h2>

		<p>Please read the license and click <b>[I Accept]</b> to continue. </p>
    	<textarea cols="80" rows="20" readonly tabindex="1"><?php echo $license_file?></textarea><br /><br />

    	<input class="button" type="button" value="Back" onclick="cancel();" tabindex="3">
		<input type="button" onClick='licenseAccept();' value="I Accept" tabindex="2">

	</div>