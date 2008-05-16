<?php


##################################################
/*
drop table `exponent_sanpham`;
CREATE TABLE `exponent_SanPham` (
`id` BIGINT NOT NULL ,
`product_type_id` BIGINT NOT NULL ,
`provider_id` BIGINT NOT NULL ,
`name` TEXT NOT NULL ,
`ngaysanxuat` INT( 14 ) NOT NULL ,
`namsanxuat` SMALLINT,
`xuatxu` VARCHAR,
`baohanh` TINYINT,
`gia` BIGINT NOT NULL ,
`kichthuoc` TEXT,
`mausac` TEXT,
`file_id` INT ,
`chitiet` TEXT,
`bigimage_file_id` INT,
`khuyenmai` int
`chitiet_khuyenmai` text
`gia_khuyenmai` int
PRIMARY KEY ( `id` ) 
) 
*/

/*
 * Author: &#272;&#7863;ng Tín Trung & Võ Tr&#7847;n Tr&#7885;ng Ngh&#297;a
 * Write on date:  
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
		
		/*
		 * Các biến sau này cứ việc set cứng giá trị. sau này sẽ chuyển vào config
		 * Hàm này sẽ show ra các sản phẩm nào được add vào mới nhất
		 */ 
		$max_product_per_type = 5;
		exponent_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_SECTIONAL);
		$template = new template('sanphammodule',$view,$loc);
		
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
		$directory = 'files/sanphammodule/';
		if (!file_exists(BASE.$directory)) {
			$err = exponent_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
		
		// lấy loại sản phẩm
		$product_types = $db->selectObjects('loaisanpham');
		// Sort lại theo tên
		usort($product_types, 'exponent_sorting_byNameAscending');
		// ứng với mỗi loại sản phẩm, ta móc từng sản phẩm ra				
		for ($i=0;$i<count($product_types);$i++)
		{
			// lấy product_type ID
			$product_type_id = $product_types[$i]->id;
			// search các sản phẩm trong loại này với ngày giảm dần

			$sanpham=$db->selectObjects("sanpham","product_type_id = {$product_type_id}","postdate DESC LIMIT 0,{$max_product_per_type}");
			// tooltip
			for ($j=0;$j<count($sanpham);$j++)
			{
				$sanpham[$j]->chitiet=str_replace('"',"'",$sanpham[$j]->chitiet);
				$sanpham[$j]->chitiet=str_replace("\r\n","<br>",$sanpham[$j]->chitiet);
				$sanpham[$j]->name=str_replace('"',"'",$sanpham[$j]->name);
				$sanpham[$j]->name=str_replace("\r\n","<br>",$sanpham[$j]->name);
				$sanpham[$j]->chitiet_khuyenmai=str_replace('"',"'",$sanpham[$j]->chitiet_khuyenmai);
				$sanpham[$j]->chitiet_khuyenmai=str_replace("\r\n","<br>",$sanpham[$j]->chitiet_khuyenmai);
				if ($sanpham[$j]->file_id == 0) {
					$sanpham[$j]->picpath = '';
				} else {
					$file = $db->selectObject('file', 'id='.$sanpham[$j]->file_id);
					$sanpham[$j]->pic_path = $file->directory.'/'.$file->filename;
				}
			}
			// nạp vào cho product_type này
			// mình viết như thế này, mặc dầu trong object product_types không hề có thuộc tính sanpham, nhưng PHP sẽ tự thêm vào
			$product_types[$i]->sanpham = $sanpham;
		}
		$template->register_permissions(array('administrate','configure'),$loc);
		$template->assign('product_types', $product_types);
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
		return 'Sản phẩm';
	}
	
	function spiderContent($item = null) {
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = 'Listings';
		$search->ref_module = 'sanphammodule';
		$search->ref_type = 'sanpham';
		
		if ($item) {
			$db->delete('search',"ref_module='sanphammodule' AND ref_type='sanpham' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->title = ' ' . $item->name . ' ';
			$search->view_link = 'index.php?module=sanphammodule&action=view_detail&id='.$item->id;
			$search->body = ' ' . exponent_search_removeHTML($item->chitiet) . ' ';
			$search->location_data = '';
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='sanphammodule' AND ref_type='sanpham'");
			foreach ($db->selectObjects('sanpham') as $item) {
				$search->original_id = $item->id;
				$search->title = ' ' . $item->name . ' ';
				$search->view_link = 'index.php?module=sanphammodule&action=view_detail&id='.$item->id;
				$search->body = ' ' . exponent_search_removeHTML($item->chitiet) . ' ';
				$search->location_data = '';
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>
