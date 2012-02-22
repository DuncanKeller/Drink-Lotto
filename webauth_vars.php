<?php
	function getInfo(){
	
		// sasl bind to LDAP
		$conn = ldap_connect('ldap://ldap.csh.rit.edu');
		ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		
		ldap_bind($conn) or die("Could not bind to LDAP 1 (ldap://ldap.csh.rit.edu): ".error());
		
		if(isset($_SERVER["KRB5CCNAME"])){
			putenv("KRB5CCNAME=" . $_SERVER["KRB5CCNAME"]);
			ldap_sasl_bind($conn,"","","GSSAPI") or die("Could not bind to LDAP 2: ");
		} else {
			echo "FATAL ERROR: WEBAUTH inproperly configured (missing KRB5CCNAME).";
			die(0);
		}
		
		// search for current users ibutton and drink balance

		$res = ldap_search($conn, "ou=Users,dc=csh,dc=rit,dc=edu", "(uid=" . $_SERVER['WEBAUTH_USER']. ")", array('ibutton', 'drinkBalance', 'uid'));
		
			
		// get the result set
		$results = ldap_get_entries($conn, $res);
		  
		//echo '<pre>';
		return($results);
		//echo '</pre>';

	}
	
?>
