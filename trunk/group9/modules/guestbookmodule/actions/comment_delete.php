<?php
#############################################################
# GUESTBOOKMODULE
#############################################################
# Copyright (c) 2005-2006 Dirk Olten, http://www.extrabyte.de
#
# version 0.5:	Developement-Version
# version 1.0:	1st release for Exponent v0.93.3
# version 1.2:	Captcha added
# version 2.0:	now compatible to Exponent v0.93.5
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##############################################################


if (!defined('EXPONENT')) exit('');

// Sanitize required querystring parameters.
$_GET['id'] = intval($_GET['id']);

$comment = $db->selectObject('guestbook_comment','id='.$_GET['id']);
$post = $db->selectObject('guestbook_post','id='.$comment->parent_id);

if ($comment != null && $post != null) {
	$loc = unserialize($post->location_data);
	$iloc = exponent_core_makeLocation($loc->mod,$loc->src,$post->id);
	
	if ((exponent_permissions_check('delete_comments',$loc)) ||
		(exponent_permissions_check('delete_comments',$iloc))
	) {
	
		$db->delete('guestbook_comment','id='.$_GET['id']);
		exponent_flow_redirect();
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>