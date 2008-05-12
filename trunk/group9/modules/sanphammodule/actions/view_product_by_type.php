<?php

if (!defined("EXPONENT")) exit("");
	$sanpham = null;
	$template = new template("sanphammodule","_viewproduct_by_type",$loc);
	$ptype_id = $_GET['id'];	
	
	if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
	if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
	if (isset($_GET['id'])) {
		$sanpham=$db->selectObjects("sanpham","product_type_id = {$ptype_id}","postdate DESC ");
	}
	else
	{echo SITE_404_HTML;}
	
	$directory = 'files/sanphammodule/';
		if (!file_exists(BASE.$directory)) {
			$err = exponent_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
		
	exponent_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);

	// lấy tên nhà sản xuất
	$ptype_name=$db->selectObject("loaisanpham","id = {$ptype_id}");
	
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
	
	// tương thích ngược với hàm show
	$product_type->sanpham=$sanpham;
	$template->register_permissions(array('administrate','configure'),$loc);
	$template->assign('product_type', $product_type);
	$template->assign('ptype_name', $ptype_name->name);
	$template->output();
?>
