<?php
if (!defined("EXPONENT")) exit("");

	$listing = null;		
	if (isset($_GET['id'])) {
		$listing = $db->selectObject('donhang', 'madh='.$_GET['id']);
		if ($listing != null) {
			$loc = unserialize($listing->location_data);
		}
	}
	
	if ($listing) {
		$loc = unserialize($listing->location_data);
		if (exponent_permissions_check("manage",$loc)) {
			$db->delete('donhang', 'madh='.$_GET['id']);
			exponent_flow_redirect();
		} else {
			echo SITE_403_HTML;
		}
	} else {
		echo SITE_404_HTML;
	}

?>