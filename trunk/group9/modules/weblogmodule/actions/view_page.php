<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

if (!defined('EXPONENT')) exit('');

exponent_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);

$template = new template('weblogmodule','_view_page',$loc);

$config = $db->selectObject('weblogmodule_config',"location_data='".serialize($loc)."'");
if ($config == null) {
	$config->allow_comments = 1;
	$config->items_per_page = 10;
}

if (isset($_GET['single'])) {
	$config->items_per_page = 1;
}

$where = "location_data='".serialize($loc)."' AND (is_draft = 0 OR poster = ".($user ? $user->id : -1).")";
if (!exponent_permissions_check('view_private',$loc)) $where .= ' AND is_private = 0';;

$total = $db->countObjects('weblog_post',$where);
$posts = $db->selectObjects('weblog_post',$where . ' ORDER BY posted DESC '.$db->limit($config->items_per_page,($_GET['page']*$config->items_per_page)));
if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
for ($i = 0; $i < count($posts); $i++) {
	$ploc = exponent_core_makeLocation($loc->mod,$loc->src,$posts[$i]->id);
	
	$posts[$i]->permissions = array(
		'administrate'=>exponent_permissions_check('administrate',$ploc),
		'edit'=>exponent_permissions_check('edit',$ploc),
		'delete'=>exponent_permissions_check('delete',$ploc),
		'comment'=>exponent_permissions_check('comment',$ploc),
		'edit_comments'=>exponent_permissions_check('edit_comments',$ploc),
		'delete_comments'=>exponent_permissions_check('delete_comments',$ploc),
		'view_private'=>exponent_permissions_check('view_private',$ploc),
	);
	$comments = $db->selectObjects('weblog_comment','parent_id='.$posts[$i]->id);
	usort($comments,'exponent_sorting_byPostedDescending');
	$posts[$i]->comments = $comments;
}
usort($posts,'exponent_sorting_byPostedDescending');
$template->assign('posts',$posts);
$template->assign('total_posts',$total);
$template->assign('shownext',(($_GET['page']+1)*$config->items_per_page) < $total);
$template->assign('page',$_GET['page']);

$template->register_permissions(
	array('administrate','configure','post','edit','delete','comment','edit_comments','delete_comments','view_private'),
	$loc);
$template->assign('config',$config);

$template->output();