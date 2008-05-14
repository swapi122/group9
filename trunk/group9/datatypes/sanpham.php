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
# License, or (at your option) any later version.A
#A
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
# $Id: listing.php,v 1.4 2005/05/10 18:32:14 filetreefrog Exp $
##################################################

class sanpham {
	function form($object) {
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		exponent_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			$object->name = '';
			// anh phải reset các biến ở đây nữa. phải reset hết luôn mới không có lỗi
			$object->xuatxu = "";
			$object->gia = '';
			$object->baohanh = '';
			$object->xuatxu = '';
			$object->kichthuoc = '';
			$object->mausac = '';
			$object->chitiet = '';
			$object->product_type_id = '';
			$object->provider_id = '';
			$object->postdate = '';
			$object->ngaysanxuat = '';
		} else {
			$form->meta('id',$object->id);
		}
		global $db;
		$nhasanxuat=$db->selectDropdown("nhasanxuat","name" );
		// get first item of this array for default item
		$default_nhasanxuat;
		
		foreach ($nhasanxuat as $value=>$caption)
		{ 
			$default_nhasanxuat=$value;
			break;
		}
		if ($object->provider_id=='')
		{
			$object->provider_id=$default_nhasanxuat;
		}
		$default_loaisanpham;
		$loaisanpham=$db->selectDropdown("loaisanpham","name" );
		foreach ($loaisanpham as $value=>$caption)
		{
			$default_loaisanpham=$value;
			break;
		}
		if ($object->product_type_id=='')
		{
			$object->product_type_id=$default_loaisanpham;
		}
		
		$form->register('name','Tên',new textcontrol($object->name,50,false,200));
		$form->register('product_type_id','Loại sản phẩm',new dropdowncontrol($object->product_type_id,$loaisanpham,true));
		$form->register('provider_id','Hãng sản xuất',new dropdowncontrol($object->provider_id,$nhasanxuat,true));
		$form->register('xuatxu','Xuất xứ',new textcontrol($object->xuatxu,50,false,200));
		$form->register('ngaysanxuat','Ngày sản xuất',new popupdatetimecontrol($object->ngaysanxuat));
		$form->register('gia','Giá',new textcontrol($object->gia,50,false,200));
		$form->register('baohanh','Bảo hành',new textcontrol($object->baohanh,50,false,200));
		$form->register('kichthuoc','Kích thước',new textcontrol($object->kichthuoc,50,false,200));
		$form->register('mausac','Màu sắc',new textcontrol($object->mausac,50,false,200));
		$form->register('chitiet','Chi tiết',new htmleditorcontrol($object->chitiet));
		$form->register('upload','Hình ảnh', new uploadcontrol());
		$form->register('bigimage','Ảnh lớn', new uploadcontrol());
		//$form->register('postdate','Ngày đăng',new datetimecontrol($object->postdate,true,true));
		$form->register('submit','',new buttongroupcontrol('Lưu','','Hủy bỏ'));

		return $form;
	}
	
	function update($values,$object) {
		$object->name = $values['name'];
		$object->xuatxu = $values['xuatxu'];
		$object->kichthuoc = $values['kichthuoc'];
		$object->mausac = $values['mausac'];
		$object->chitiet = $values['chitiet'];
		$object->product_type_id = $values['product_type_id'];
		$object->provider_id = $values['provider_id'];
		$object->postdate = time();
		$object->ngaysanxuat = $values['ngaysanxuat'];
		$object->ngaysanxuat = popupdatetimecontrol::parseData('ngaysanxuat',$values);
		$object->gia = $values['gia'];
		$object->baohanh = $values['baohanh'];
		return $object;
	}
}

?>
