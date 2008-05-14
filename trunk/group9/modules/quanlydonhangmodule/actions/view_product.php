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
# $Id: view_listing.php,v 1.2 2005/02/19 16:53:35 filetreefrog Exp $
##################################################

if (!defined("EXPONENT")) exit("");
	$listing = null;
	/*if (isset($_GET['id'])) {
		$listing = $db->selectObject("donhang","id=".$_GET['id']);
		if ($listing != null) {
			$loc = unserialize($listing->location_data);
		} else {
			echo SITE_404_HTML;
		}
	}*/	
	if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
	if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
	
	
	$data = $db->selectObjects('donhang');
	$count = count($data);
	$page_count=0;
	$page=isset($_GET['page'])?$_GET['page']:0;
	echo $page;
	$max_item=1;
	if ($count % $max_item > 0) // chia có d&#432; th2i thêm 1 trang
		$page_count = $count / $max_item + 1;
	else
		$page_count = $count/$max_item;
	
	$start_index = $page * $max_item;
	$listings = $db->selectObjects("donhang"," 0<1 LIMIT {$start_index},{$max_item}");
	$template = new template('quanlydonhangmodule','default',$loc);	
	$template->register_permissions(array('administrate','configure'),$loc);
	
	// vì smarty không h&#7895; tr&#7907; c&#7845;u trúc for loop nên mình &#273;ành dùng foreach
	$mypages;
	$count=10;
	for ($i=0;$i<$count;$i++)
		$mypages[$i]=$i;
	$template->assign('listings', $listings);
	$template->assign('page', $page);
	$template->assign('page_count', $page_count);
	$template->assign('pages', $mypages);
	//$template->assign('moduletitle', $title);
	$template->output();

?>