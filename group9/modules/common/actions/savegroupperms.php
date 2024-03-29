<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('administrate',$loc)) {

  $groups = explode(';',$_POST['permdata']);
    
	if (!defined('SYS_USERS')) include_once(BASE.'subsystems/users.php');
	foreach ($groups as $group_str) {
		$perms = explode(':',$group_str);
		$g = exponent_users_getGroupById($perms[0]);
		exponent_permissions_revokeAllGroup($g,$loc);
		for ($i = 1; $i < count($perms); $i++) {
			exponent_permissions_grantGroup($g,$perms[$i],$loc);
		}
	}
	exponent_permissions_triggerRefresh();
	
	exponent_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>
