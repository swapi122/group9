﻿<?php

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
/*
drop table `exponent_sanpham`;
create table `exponent_sanpham` (
`product_id` int( 10 ) not NULL ,
`product_type_id` int( 10 ) not NULL ,
`producer_id` int( 10 ) not NULL ,
`tensp` varchar( 20 ) collate utf8_unicode_ci not NULL ,
`ngaynhap` datetime not NULL ,
`namsanxuat` smallint,
`xuatxu` varchar( 20 ) collate utf8_unicode_ci ,
`baohanh` tinyint,
`gia` decimal not NULL ,
`kichthuoc` varchar( 20 ) collate utf8_unicode_ci,
`mausac` varchar( 10 ) collate utf8_unicode_ci,
`hinhanh` varchar( 50 ) collate utf8_unicode_ci not NULL ,
`chitiet` varchar( 200 ) collate utf8_unicode_ci,
`download` varchar( 50 ) collate utf8_unicode_ci not NULL ,
`file_id` int(11),
primary key ( `product_id` ) 
) comment = 'hinhanh and download field link to files';
*/
class sanphammodule {
	function name() { return 'Sản phẩm Module'; }
	function description() { return 'Tạo danh sách các sản phẩm'; }
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
		
		$template = new template('sanphammodule',$view,$loc);
		
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
		$directory = 'files/sanphammodule/' . $loc->src;
		if (!file_exists(BASE.$directory)) {
			$err = exponent_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
		
		$listings = $db->selectObjects('sanpham',"location_data='".serialize($loc)."'");
		for($i=0; $i<count($listings); $i++) {
			if ($listings[$i]->file_id == 0) {
				$listings[$i]->picpath = '';
			} else {
				$file = $db->selectObject('file', 'id='.$listings[$i]->file_id);
				$listings[$i]->picpath = $file->directory.'/'.$file->filename;
			}
		}
		
		//sort the listings by their rank
		usort($listings, 'exponent_sorting_byRankAscending');
		
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
		return 'Danh sách các sản phẩm';
	}
	
	function spiderContent($item = null) {
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = 'Listings';
		$search->ref_module = 'sanphammodule';
		$search->ref_type = 'sanpham';
		
		if ($item) {
			$db->delete('search',"ref_module='sanphammodule' AND ref_type='listing' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->title = ' ' . $item->name . ' ';
			$search->view_link = 'index.php?module=sanphammodule&action=view_listing&id='.$item->id;
			$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='sanphammodule' AND ref_type='listing'");
			foreach ($db->selectObjects('sanpham') as $item) {
				$search->original_id = $item->id;
				$search->title = ' ' . $item->name . ' ';
				$search->view_link = 'index.php?module=sanphammodule&action=view_listing&id='.$item->id;
				$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>
