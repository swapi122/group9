<?php


class khuyenmaimodule {
	function name() { return 'Listing Module'; }
	function description() { return 'A module for creating listings.  For example you could use this module to create personal bio pages for employees, or house listings for a realator'; }
	function author() { return 'Adam Kessler'; }
	
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
		
		$template = new template('listingmodule',$view,$loc);
		
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
		$directory = 'files/listingmodule/' . $loc->src;
		if (!file_exists(BASE.$directory)) {
			$err = exponent_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
		
		$listings = $db->selectObjects('listing',"location_data='".serialize($loc)."'");
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
		return 'Danh sách các bộ phận';
	}
	
	function spiderContent($item = null) {
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = 'Listings';
		$search->ref_module = 'listingmodule';
		$search->ref_type = 'listing';
		
		if ($item) {
			$db->delete('search',"ref_module='listingmodule' AND ref_type='listing' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->title = ' ' . $item->name . ' ';
			$search->view_link = 'index.php?module=listingmodule&action=view_listing&id='.$item->id;
			$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='listingmodule' AND ref_type='listing'");
			foreach ($db->selectObjects('listing') as $item) {
				$search->original_id = $item->id;
				$search->title = ' ' . $item->name . ' ';
				$search->view_link = 'index.php?module=listingmodule&action=view_listing&id='.$item->id;
				$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>
