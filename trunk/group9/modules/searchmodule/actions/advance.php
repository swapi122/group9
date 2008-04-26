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

//GREP:VIEWIFY
if (!defined("EXPONENT")) exit("");
	if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		global $db;

		$template = new template('searchmodule',"Advanced Search",$loc);
	
		$config = $db->selectObject('searchmodule_config', "location_data='".serialize($loc)."'");	
		
		if (isset($config->modules)) {
			$modules = getModuleNames(unserialize($config->modules));
		} else {
			$modules = getModuleNames(null);
		}
		
		$template->assign('modules',$modules);
		$template->assign('loc',$loc);
		$template->assign('moduletitle',$title);
		$template->register_permissions(
		array('administrate','configure'),$loc);
		$template->output();
?>
