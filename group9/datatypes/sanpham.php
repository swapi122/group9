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
			//$object->summary = '';
			//$object->body = '';
		} else {
			$form->meta('id',$object->id);
		}
		global $db;
		$nhasanxuat=$db->selectColumn("nhasanxuat","id,name");
		
		for ($i=0; i<count($nhasanxuat); $i++){
			$provider_id=$nhasanxuat[$i]->id;
		}
		
			//$provider_name
		$loaisanpham=$db->selectColumn("loaisanpham","id,name");
		for ($i=0; i<count($loaisanpham); $i++){
			$product_type_id[$i] = $loaisanpham[$i]->id;
			$product_type_name [$i]= $loaisanpham[$i]->name;
		}
		$arr=array('1','2');
		$form->register('name','Tên',new textcontrol($object->name,50,false,200));
		$form->register('product_type_id','Loại sản phẩm',new dropdowncontrol($object->product_type_id,$arr));
		$form->register('provider_id','Hãng sản xuất',new textcontrol($object->provider_id,50,false,200));
		$form->register('postdate','Ngày đăng',new textcontrol($object->postdate,50,false,200));

		$form->register('xuatxu','Xuất xứ',new textcontrol($object->xuatxu,50,false,200));
		$form->register('kichthuoc','Kích thước',new textcontrol($object->kichthuoc,50,false,200));
		$form->register('mausac','Màu sắc',new textcontrol($object->mausac,50,false,200));
		$form->register('chitiet','Chi tiết',new htmleditorcontrol($object->chitiet));
		//$form->register('body','Body',new htmleditorcontrol($object->body));
		$form->register('upload','Upload Picture', new uploadcontrol());
		$form->register('submit','',new buttongroupcontrol('Save','','Cancel'));
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
		
		return $object;
	}
}

?>