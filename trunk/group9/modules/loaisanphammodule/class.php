<?php

##################################################
#
# Copyright (c) 2004-2005 OIC Group, Inc.
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# Exponent is distributed in the hope that it
# will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR
# PURPOSE.  See the GNU General Public License
# for more details.
#
# You should have received a copy of the GNU
# General Public License along with Exponent; if
# not, write to:
#
# Free Software Foundation, Inc.,
# 59 Temple Place,
# Suite 330,
# Boston, MA 02111-1307  USA
#
# $Id: class.php,v 1.8 2005/07/01 05:19:56 filetreefrog Exp $
##################################################
/*query 
CREATE TABLE IF NOT EXISTS `exponent_loaisanpham` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `location_data` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `exponent_loaisanphammodule_config` (
  `id` int(11) NOT NULL auto_increment,
  `location_data` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

*/
class loaisanphammodule {
	function name() { return 'Loại sản phẩm Module'; }
	function description() { return 'Tạo danh sách các loại sản phẩm'; }
	function author() { return 'Vttnghia'; }
	
	function hasSources() { return true; }
	function hasContent() { return true; }
	function hasViews() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = '') {
		return array(
			'administrate'=>'Administrate',
			'manage'=>'Manage Listings',
			'configure'=>'Configure'
		);
	}
		
	function show($view,$loc = null, $title = '') {
		global $db;
		
		$template = new template('loaisanphammodule',$view,$loc);
		
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		
		$listings = $db->selectObjects('loaisanpham',"location_data='".serialize($loc)."'");
		
		//sort the listings by their rank
		usort($listings, 'exponent_sorting_byNameAscending');
		
		$template->register_permissions(array('administrate','configure'),$loc);
		$template->assign('listings', $listings);
		$template->assign('moduletitle', $title);
		$template->output();
	}
	
	function deleteIn($loc) {
		// IMPLEMENTME:deleteIn for the listing module
	}
	
	function copyContent($oloc,$nloc) {
		// IMPLEMENTME:copyContent for the listing module
	}

	function searchName() {
		return 'Danh sách các nhà sản xuất';
	}
	
	function spiderContent($item = null) {
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = 'Listings';
		$search->ref_module = 'loaisanphammodule';
		$search->ref_type = 'loaisanpham';
		
		if ($item) {
			$db->delete('search',"ref_module='loaisanphammodule' AND ref_type='listing' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->title = ' ' . $item->name . ' ';
			$search->view_link = 'index.php?module=loaisanphammodule&action=view_listing&id='.$item->id;
			$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='loaisanphammodule' AND ref_type='listing'");
			foreach ($db->selectObjects('loaisanpham') as $item) {
				$search->original_id = $item->id;
				$search->title = ' ' . $item->name . ' ';
				$search->view_link = 'index.php?module=loaisanphammodule&action=view_listing&id='.$item->id;
				$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>
