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
# $Id: class.php,v 1.4 2005/05/09 05:55:13 filetreefrog Exp $
##################################################

class giohangmodule {
	function name() { return "Giỏ hàng"; }
	function description() { return "Quản lý giỏ hàng"; }
	function author() { return "Phong & Cường"; }

	function hasSources() { return true; }
	function hasContent() { return true; }
	function hasViews() { return true; }

	function supportsWorkflow() { return false; }

	function permissions($internal = "") {
		return array(
			'administrate'=>'Administrate',
			'configure'=>'Configure',
			'create'=>'Create Links',
			'edit'=>'Edit Links',
			'delete'=>'Delete Links'
		);
	}

	function show($view,$loc = null, $title = "") {
		global $db;

		// mình chưa muốn nó query theo session_id vì có nhiều vấn đề phức tạp
		// do đó mình set cứng như thế này, làm xong sẽ sửa lại
		$session_id = 1;
	
		
	    // xóa bỏ những record mà người mua đã chọn hàng quá lâu, xem như bị timeout
	    // tính năng này sẽ làm sau		
		
		// query hết tất cả các sản phẩm đang được chọn trong giỏ hàng
		// các sản phẩm này được nhận biết là của người đang xem bởi field session_id
		$product_count = $db->countObjects('giohang',"session_id = {$session_id}");
		
		$template = new template('giohangmodule',"Default",$loc);
		$template->assign('moduletitle',$title);
		$template->assign('product_count',$product_count );
		$template->output();
	}

	function deleteIn($loc) {
		global $db;
		$db->delete('linklist_link',"location_data='".serialize($loc)."'");
	}

	function copyContent($oloc,$nloc) {
		foreach ($db->selectObjects('linklist_link',"location_data='".serialize($oloc)."'") as $l) {
			$l->location_data = serialize($nloc);
			$db->insertObject($l,'linklist_link');
		}
	}

	function searchName() {
		return 'Liên kết Web';
	}

	function spiderContent($item = null) {
		global $db;

		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');

		$search = null;
		$search->category = 'Links';
		$search->ref_module = 'giohangmodule';
		$search->ref_type = 'linklist_link';
		$search->view_link = '';

		if ($item) {
			$db->delete('search',"ref_module='giohangmodule' AND ref_type='linklist_link' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->title = ' ' . $item->name . ' ';
			$search->body = ' ' . exponent_search_removeHTML($item->description) . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='giohangmodule' AND ref_type='linklist_link'");
			foreach ($db->selectObjects('linklist_link') as $item) {
				$search->original_id = $item->id;
				$search->title = ' ' . $item->name . ' ';
				$search->body = ' ' . exponent_search_removeHTML($item->description) . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}

		return true;
	}
}

?>
