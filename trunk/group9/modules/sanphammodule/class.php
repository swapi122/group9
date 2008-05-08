<?php


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

/*
 * Author: Đặng Tín Trung & Võ Trần Trọng Nghĩa
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
		
		
		$template = new template('sanphammodule',$view,$loc);
		
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
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
			$sanpham=$db->selectObjects("sanpham","id = {$product_type_id}","postdate DESC LIMIT 0,{$max_product_per_type}");
			// nạp vào cho product_type này
			// mình viết như thế này, mặc dầu trong object product_types không hề có thuộc tính sanpham, nhưng PHP sẽ tự thêm vào
			$product_types[$i]->sanpham = $sanpham;
		}
		
		$template->register_permissions(array('administrate','configure'),$loc);
		$template->assign('product_types', $product_types);
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
