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

class quanlydonhangmodule {
	function name() { return 'Đơn hàng  Module'; }
	function description() { return 'Hiện danh sách các đơn hàng'; }
	function author() { return 'Vttnghia & Phong'; }
	
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
		
		$template = new template('quanlydonhangmodule',$view,$loc);
		
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
		
		$data = $db->selectObjects('donhang');
		$count = count($data);
 		$page_count=0;
 		$page=isset($_REQUEST['page'])?$_REQUEST['page']:0;
 		$max_item=25;
		if ($count % $max_item > 0) // chia có dư th2i thêm 1 trang
  			$page_count = $count / $max_item + 1;
  		else
 			$page_count = $count/$max_item;
 		
 		$start_index = $page * $max_item;
		$listings = $db->selectObjects("donhang"," 0<1 LIMIT {$start_index},{$max_item}");
		$template->register_permissions(array('administrate','configure'),$loc);
		
		// vì smarty không hỗ trợ cấu trúc for loop nên mình đành dùng foreach
		$mypages;
		$count=10;
		for ($i=0;$i<$count;$i++)
			$mypages[$i]=$i;
		
		$template->assign('listings', $listings);
		$template->assign('page', $page);
		$template->assign('page_count', $page_count);
		$template->assign('pages', $mypages);
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
		return 'Danh sách các đơn hàng';
	}
	
	function spiderContent($item = null) {
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = 'Listings';
		$search->ref_module = 'quanlydonhangmodule';
		$search->ref_type = 'listing';
		
		if ($item) {
			$db->delete('search',"ref_module='quanlydonhangmodule' AND ref_type='listing' AND original_id=" . $item->madh);
			$search->original_id = $item->madh;
			$search->title = ' ' . $item->name . ' ';
			$search->view_link = 'index.php?module=quanlydonhangmodule&action=view_listing&id='.$item->madh;
			$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='quanlydonhangmodule' AND ref_type='listing'");
			foreach ($db->selectObjects('donhang') as $item) {
				$search->original_id = $item->madh;
				$search->title = ' ' . $item->name . ' ';
				$search->view_link = 'index.php?module=quanlydonhangmodule&action=view_listing&id='.$item->madh;
				$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>
