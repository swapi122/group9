<?php


class khuyenmaimodule {
	function name() { return 'Khuyến mãi Module'; }
	function description() { return 'Hiển thị các sản phẩm khuyến mãi'; }
	function author() { return 'Trung & Trọng Nghĩa'; }
	
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
		$max_sanpham_khuyenmai=10;
		$template = new template('khuyenmaimodule',$view,$loc);
		
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
		
		
		$sanpham=$db->selectObjects("sanpham","khuyenmai = 1","postdate DESC LIMIT 0,{$max_sanpham_khuyenmai}");
		
			// tooltip
		for ($j=0;$j<count($sanpham);$j++)
		{
			$sanpham[$j]->chitiet=str_replace('"',"'",$sanpham[$j]->chitiet);
			$sanpham[$j]->chitiet=str_replace("\r\n","<br>",$sanpham[$j]->chitiet);
			$sanpham[$j]->name=str_replace('"',"'",$sanpham[$j]->name);
			$sanpham[$j]->name=str_replace("\r\n","<br>",$sanpham[$j]->name);
			if ($sanpham[$j]->file_id == 0) {
				$sanpham[$j]->picpath = '';
			} else {
				$file = $db->selectObject('file', 'id='.$sanpham[$j]->file_id);
				$sanpham[$j]->pic_path = $file->directory.'/'.$file->filename;
			}
		}
		
		$title="SẢN PHẨM KHUYẾN MÃI";
		$template->register_permissions(array('administrate','configure'),$loc);
		$template->assign('sanpham', $sanpham);
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
		return 'Danh sách các sản phẩm khuyến mãi';
	}
	
	function spiderContent($item = null) {
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = 'Listings';
		$search->ref_module = 'khuyenmaimodule';
		$search->ref_type = 'listing';
		
		if ($item) {
			$db->delete('search',"ref_module='khuyenmaimodule' AND ref_type='listing' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->title = ' ' . $item->name . ' ';
			$search->view_link = 'index.php?module=khuyenmaimodule&action=view_listing&id='.$item->id;
			$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='khuyenmaimodule' AND ref_type='listing'");
			foreach ($db->selectObjects('listing') as $item) {
				$search->original_id = $item->id;
				$search->title = ' ' . $item->name . ' ';
				$search->view_link = 'index.php?module=khuyenmaimodule&action=view_listing&id='.$item->id;
				$search->body = ' ' . exponent_search_removeHTML($item->body) . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>
