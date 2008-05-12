<?php



if (!defined("EXPONENT")) exit("");

	$listing = null;		
	if (isset($_GET['id'])) {
		$listing = $db->selectObject('sanpham', 'id='.$_GET['id']);
	}
	
	if ($listing) {
			// delete file
			$sanpham=$db->selectObject("sanpham","id=". $_GET['id']);
			if ($sanpham->file_id != 0)
			{
				$file = $db->selectObject('file','id='.$sanpham->file_id);
				file::delete($file);
			}
			$db->delete('sanpham', 'id='.$_GET['id']);
			exponent_flow_redirect();
	} 
	else 
	{	echo SITE_403_HTML;}

?>
