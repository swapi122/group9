<?php

if (!defined("EXPONENT")) exit("");
	global $db;
	
	// mình chưa muốn nó query theo session_id vì có nhiều vấn đề phức tạp
	// do đó mình set cứng như thế này, làm xong sẽ sửa lại
	$session_id = 1;
		
	if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
	if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
	//save url
	exponent_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);
		
	
	$directory = 'files/sanphammodule/';
		if (!file_exists(BASE.$directory)) {
			$err = exponent_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
	
	// query hết tất cả các sản phẩm đang được chọn trong giỏ hàng
	// các sản phẩm này được nhận biết là của người đang xem bởi field session_id
	$products = $db->selectObjects('giohang',"session_id = {$session_id}");
	// ứng với mỗi sản phẩm, mình cần lấy thông tin của sản phẩm này
	// duyệt hết danh sách sản phẩm đang có trong giỏ hàng
	for ($i=0;$i<count($products);$i++)
	{
		// lấy thông tin từng sản phẩm
		$product_id = $products[$i]->product_id;
		$product_detail = $db->selectObject('sanpham',"id = {$product_id}");
		// lấy tiếp cái tên nhà sản xuất cho đẹp trời
		$provider_id=$product_detail->provider_id;
		$provider_name = $db->selectObject('nhasanxuat',"id = {$provider_id}");
		// nhét cái provider_name này vào product_detail, nó sẽ tự sinh ra thuộc tính mới này
		$product_detail->provider_name=$provider_name->name;
		// lấy ảnh sản phẩm ra
		if ($product_detail->file_id == 0) {
					$products[$i]->picpath = '';
				} else {
					$file = $db->selectObject('file', 'id='.$product_detail->file_id);
					$products[$i]->pic_path = $file->directory.'/'.$file->filename;
				}
		// nhét cái product_detail này vào để khi template thì biết mà show ra
		$products[$i]->product_detail=$product_detail;
	}
	$template = new template('giohangmodule',"_viewbasket",$loc);
	$template->assign('moduletitle', "Xem giỏ hàng" );
	$template->assign('products', $products );
	$template->output();
?>
